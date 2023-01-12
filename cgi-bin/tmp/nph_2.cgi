#!/usr/bin/perl 
use MIME::Base64;

$logfile = "./nph_2.log";

open FILE,"<nph_2.dat";
$num = <FILE>;
close FILE;

if ($num <= 1) {
  print "WWW-Authenticate: Basic realm=\"\t\t   Login and Password required!!!\"\n";
  print "Status: 401 Unauthorized\n\n";
  print "Ошибка авторизации!\n";
} else {
 print "Content-type: text/html\n\n"; 
 print "Привет!";
}

open FILE,">>$logfile";
  foreach $key (keys %ENV) {
   print FILE "$key=$ENV{$key}\n";
  }
  print FILE "---------------------------\n";
close FILE;


open FILE,">nph_2.dat";
 $num++;
 print FILE "$num\n";
close FILE;

