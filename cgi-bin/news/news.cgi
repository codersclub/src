#!/usr/bin/perl 

use CGI;
require "./news.conf";
$script = "http://$ENV{SERVER_NAME}$ENV{SCRIPT_NAME}";


$body     = "";
$more     = "";
$date     = "";
$text     = "";
$link     = "";
$img      = "";
$user     = "";

print "Content-type: text/html\n\n";

 $query    = new CGI;

 #----- Get Input Parameters ------------
 $start = $query->param('start');
 chomp($start);

 @newslist = getnews();
 $size=@newslist;

 $pagelist = qq~      <tr>
        <td colspan=2 align="right">
~;

   #-------- Make Page List
   $rest = ($size % $maxnews);
   $pages = int( $size / $maxnews );
   $pages++ if ($rest);

  # $start = 0 unless $start;
  # $start = 0 if ($start < 0 );
   $start = $size - 1 if ($start >= $size );
   $startpage = int( $start / $maxnews ) + 1;

   $end = $start + $maxnews - 1;
   if ($end > ($size - 1)) {
     $end = $size-1;
   }

 if ($start ne '') {
   
   $pagelist .= "<br>Страницы: \&nbsp; ";

   for ( $counter = 1; $counter<=$pages; $counter++ ) {
     $curpagestart = ($counter - 1) * $maxnews;
     if ($counter == $startpage) {
      $pagelist .= "\&nbsp; <b>$counter</b>"
     } else {
      $pagelist .= "\&nbsp; <a href\='$script\?start\=$curpagestart'>$counter</a>"
     }
   }

 } else { #----- Link to News Archive 
   if ($size > $maxnews) {
     $pagelist .= qq~<br><a class=blue href="$script\?start\=0"><b>Архив поступлений</b></a>~;
   }
 }

 $pagelist .= qq~
        &nbsp;</td>
      </tr>
~;

 makenews();

 print $body;

exit;


#---------------------------------------
sub makenews {
 my $news0;
 my $i=0;

 for ($num=$start; $num<=$end; $num++) {
     if ($newslist[$num]) {
#18/05|SendMail - отправка почты через SMTP|Простая консольная программа на Delphi для отправки сообщений из командной строки или из подготовленного текстового файла. Допускает File Attach.<br>Компилятор: Delphi 2+|http://pascal.sources.ru/delphi/internet/sendmail.htm||vot
         ($date,$title,$text,$link,$img,$user)=split(/\|/,$newslist[$num]);
#         chomp($text);
         chomp($user);
         $text=~ s/\n/\n<br>/igm;
         $img =~ s/\r//;
         chomp($img); # image

         $news0=substitute($newstemplate);

         $body .= $news0;


         ################
         # ADVERTISMENT #
         ################

         if($i==1) {
           $body .= "<tr><td colspan=2><!--Рекламная пауза--></td></tr>\n";
         }
     } else {exit}

   $i++;
 }

 $body .= $pagelist;

 if ($start ne '') {
   $tmp = getfile($archivetemplate);
   $tmp =~ s~<!--#include virtual\=\"(.+)?\?start\=\d+\"\s*-->~$body~i;

   $body = $tmp;
 }
}



#---------------------------------------
sub substitute {
  $tpl = shift; # $newstemplate;
  my $image = $imgtemplate;
  $more  = $moretemplate;

  $text=~ s/\n/\n<br>/igm;
  $img =~ s/\r//;
  chomp($img);

  if ($link) {
    $more =~ s~<link>~$link~i;
  } else {
    $more = "";
  }

  if ($img) {
    if (!$link) {
      $image = qq~<img src="<img>" alt="" border="0">~;
    }
    $image =~ s/<img>/$img/igm;
    $image =~ s/<link>/$link/igm;
  } else {
    $image = qq~&nbsp;~;
    $img   = qq~&nbsp;~;
  }

  $tpl=~ s/<newsdate>/$date/igm;
  $tpl=~ s/<newstitle>/$title/igm;
  $tpl=~ s/<newstext>/$text/igm;
  $tpl=~ s/<num>/$num/igm;
  $tpl=~ s/<more>/$more/igm;
  $tpl=~ s/<image>/$image/igm;
  $tpl=~ s/<newslink>/$link/igm;
  $tpl=~ s/<img>/$img/igm;
  $tpl=~ s/<user>/$user/igm;

  return $tpl;
}

#---------------------------------------
sub getnews {
 my ($a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13)=stat("$newsfile");
 my @lista=[];
 if ($a8==0) {
 } else {
  open FILE,"<$newsfile";
  @lista=<FILE>;
  close FILE;
 }
 return @lista;
}


#####################################################################
sub getfile() {
  $N = shift;
  my @A = [];
  if (open(F,$N)) {
   @A = <F>; close(F); 
   chomp @A;
   return join("\n",@A);
  } else {
   return "Ошибка чтения содержимого \"$N\" (sub file)\n";
  }
}

