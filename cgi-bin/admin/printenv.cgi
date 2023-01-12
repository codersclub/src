#!/usr/bin/perl 


 print "Content-type: text/html\n\n";

 print "Hello!<br>\n";
  foreach $key (keys %ENV) {
   print "$key=$ENV{$key}<br>\n";
  }

