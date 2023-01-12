#!/usr/bin/perl
#
#           RiSearch
#
# web search engine, version 0.99.01
# (c) Sergej Tarasov, 2000
#
# Homepage: http://risearch.webservis.ru/
# email: risearch@webservis.ru
#

$| = 1;

#DEFINE CONSTANTS
$HASHSIZE = 90001;

require './search.cfg';


print "Content-Type: text/html\n\n";

open HEADER, "./header";
print <HEADER>;
close(HEADER);

$query = "";
if($ENV{'REQUEST_METHOD'} eq 'GET'){ 
   $query=$ENV{'QUERY_STRING'};
   }
 elsif($ENV{'REQUEST_METHOD'} eq 'POST'){
   read(STDIN, $query, $ENV{'CONTENT_LENGTH'});
   }

#$ENV{'QUERY_STRING'} = "";

@formfields=split /&/,$query;

#$stype = "AND";
foreach(@formfields){
   if(/^query=(.*)/){$ndquery=$1}
   if(/^stpos=(.*)/){$stpos=$1}
   if(/^stype=(.*)/){$stype=$1}
   }

$query=urldecode($ndquery);

$query=~tr/A-Z/a-z/;
$query = to_lower_case($query);



if (!$query) {
  print qq~
  <tr><td colspan=3>
  <p class='title'><br>Поиск по сайту
  <br><img border=0 height=4 width=50% align='top' src="/img/b.gif" alt="">
  </p></td></tr>
  <tr><td colspan=3 align='center'><br><br><b>Задайте искомое значение!</b></td></tr>
  ~;
} else {
  $query2print = $query;
  $query2print =~ s/</\&lt;/g;
  $query2print =~ s/>/\&gt;/g;
  $query2print =~ s/\"/\&quot;/g;

  print qq~
  <tr><td colspan=3>
  <p class='title'>Результаты поиска
  <br><img border=0 height=4 width=50% align='top' src="/img/b.gif" alt="">
  </p></td></tr>
  <tr><td></td><td colspan=2>Query: <b>$query2print</b>
  ~;
  $query =~s/[\."'\?\(\)]/ /g;
  @dum = split /[, ]+/,$query;
  @query = ();
  foreach $dum (@dum) {
    if (length($dum) >= $min_length) { $query[$#query+1] = $dum }
  }
  for ($i=0; $i<scalar(@query); $i++) {
    if ($query[$i] =~ /\!/)   { $wholeword[$i] = 1;} # WholeWord
    $query[$i] =~s/[\! ]//g;
    if ($stype eq "AND")     { $querymode[$i] = 2;} # AND
    if ($query[$i] =~ /^\-/) { $querymode[$i] = 1;} # NOT
    if ($query[$i] =~ /^\+/) { $querymode[$i] = 2;} # AND
    $query[$i] =~s/^[\+\- ]//g;
  }

  if ($stpos <0) {$stpos = 0}

  open HASH, "./hash" or die "Could not open hash.";
  binmode(HASH);

  open HASHWORDS, "./hashwords" or die "Could not open hashwords.";
  binmode(HASHWORDS);

  open SITEWORDS, "./sitewords" or die "Could not open sitewords.";

  open FINFO, "./finfo" or die "Could not open finfo.";

  open WORD_IND, "word_ind" or die "Could not open word_ind.";
  binmode(WORD_IND);

  @allres = ();

  for ($j=0; $j<scalar(@query); $j++) {
    $query = @query[$j];
    @{$allresw[$j]} = ();
    
    
    @letters = unpack("C*", $query);                            
    $a = $letters[0];
    $b = $letters[1];
    $c = $letters[2];
    $d = $letters[3];
    $num = int( ($a*14511 - $b*13779 + $c*$d*94333)/5 ) % $HASHSIZE;
    seek(HASH,$num*4,0);
    read(HASH,$dum,4);
    $dum = unpack("N", $dum);
    seek(HASHWORDS,$dum,0);
    read(HASHWORDS,$dum,4);
    $dum1 = unpack("N", $dum);
    for ($i=0; $i<=$dum1; $i++) {
      read(HASHWORDS,$dum,8);
      ($wordpos, $filepos) = unpack("NN", $dum);
      seek(SITEWORDS,$wordpos,0);
      $word = <SITEWORDS>;
      $word =~ s/\x0A//;
      $word =~ s/\x0D//;
      if ( ($wholeword[$j]==1) && ($word ne $query) ) {$word = ""}
      if (index($word,$query)>=0){
        seek(WORD_IND,$filepos,0);
        read(WORD_IND,$dum,4);
        $dum2 = unpack("N",$dum);
        $dum2 = $dum2/4;
        for($k=1; $k<=$dum2; $k++){
      	  read(WORD_IND,$dum,4);
          push(@{$allres[$j]}, $dum);
        }    # for $k
      }
    }   # for $i
  } # for $query

  ($t1,$t2,$t3,$t4) = times;
  print "<BR> Found: \n";
  @res = ();
  for ($j=0; $j<scalar(@query); $j++) {
    push(@res,@{$allres[$j]});
    print scalar@{$allres[$j]}?scalar@{$allres[$j]}:0,"\n";
  }
  print "<BR>Search time: $t1<br><br></td></tr>\n";
#  print "<OL START=",$stpos+1,"><tr>\n";

  for ($i=0; $i<scalar(@query); $i++) {
    %union=%isect=();
    @resonly=();

    if ($querymode[$i] == 1) {               # NOT
      @seen{@{$allres[$i]}} = ();
      foreach $e (@res) {
        push (@resonly, $e) unless exists $seen{$e};
      }
      @res = @resonly;
    }

    if ($querymode[$i] == 2) {               # AND
      foreach $e (@res) { $union{$e} = 1 }
      foreach $e (@{$allres[$i]}) {
        if ($union{$e}) { $isect{$e}=1 }
      }
      @res = keys %isect;
    }
  }

  %seen = ();
  foreach $item (@res) {
    $seen{$item}++;
  }
  @res = keys %seen;

  for ($i=$stpos; $i < $stpos+$res_num; $i++) {
    if ($i == scalar(@res)) {last}
    $strpos = unpack("N",$res[$i]);
    seek(FINFO,$strpos,0);
    $dum = <FINFO>;
    ($url, $size, $title, $descr) = split(/::/,$dum);

    print "<tr><td></td><td colspan=2 class=subheader><img height=2 src='/img/1x1.gif' width=1></td></tr>\n";
    print "<tr><td valign='top'>&nbsp;&nbsp;",$i + 1,"&nbsp;&nbsp;</td><td class='subheader' width='*'>\n";
    print "&nbsp;<a class=subheader href=\"$url\"><b>$title</b></a></td><td class=black>&nbsp;";
    if ($size ne "") {print "&nbsp;&nbsp;",$size,"k&nbsp;&nbsp;\n"};
    print "</td></tr><tr><td>&nbsp;</td><td class=black><p style='margin-left:20px'>";
    print "$descr<br><br></p></td><td>&nbsp;</td></tr>\n";
  }  # for

  $rescount = scalar(@res);
  print "<tr><td></td><td colspan=2><br>Found ",$rescount," matches.<br></td></tr>\n";
  print "<tr><td class=page colspan=3 align=right>Страницы:&nbsp;&gt;&gt;&nbsp;<b>";
  $j = 1;
  for ($i=1; $i<=$rescount; $i += $res_num) {
    if (($i+$res_num-1)<$rescount) {$fini = $i+$res_num-1}
    else {$fini = $rescount};
    if (($i - 1) == $stpos ) {
      print $j++," &nbsp;";
    } else {
      print "<a href=search.cgi?query=",$ndquery,"\&stpos=",$i-1,"\&stype=",$stype,">",$j++,"</A> &nbsp;";
    }
  }
  print "</b></td></tr>\n";
  print "<tr><td></td><td class=subheader colspan=2><img height=2 src='/img/1x1.gif' width=1></td></tr>\n";

}

open FOOTER, "footer";
print <FOOTER>;
close(FOOTER);
