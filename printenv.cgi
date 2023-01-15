#!/usr/bin/perl 


 print "Content-type: text/html\n\n";

 print "<br>\n<big>Error 404: Page not found.<br>\n";

#   print "HTTP_REFERER=$ENV{HTTP_REFERER}<br>\n";

  foreach $key (keys %ENV) {
   print "$key=$ENV{$key}<br>\n";
  }

