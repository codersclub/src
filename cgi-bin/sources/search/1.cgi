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

$query2print = $query;
$query2print =~ s/</\&lt;/g;
$query2print =~ s/>/\&gt;/g;
$query2print =~ s/\"/\&quot;/g;

if (!$query) {
  print qq~
  <tr><td colspan=3>
  <p class='title'><br>Поиск по сайту
  <br><img border=0 height=4 width=50% align='top' src="/img/b.gif" alt="">
  </p></td></tr>
  <tr><td colspan=3 align='center'><br><br><b>Задайте искомое значение!</b></td></tr>
  ~;
} else {
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


}
