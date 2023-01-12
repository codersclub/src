#!/usr/bin/perl 


 print "Content-type: text/html\n\n";

 print "<html><head><title>Page not found</title><head><body>\n";
 print "<br>\n<big>Error 404: Page not found.</big><br><br>\n";

 print "REQUEST_URI=$ENV{REQUEST_URI}<br>\n";
 print "REDIRECT_URL=$ENV{REDIRECT_URL}<br>\n";
 print "REDIRECT_STATUS=$ENV{REDIRECT_STATUS}<br>\n";
 print "REDIRECT_ERROR_NOTES=$ENV{REDIRECT_ERROR_NOTES}<br>\n";
 print "HTTP_REFERER=$ENV{HTTP_REFERER}<br>\n";
 print "REDIRECT_REDIRECT_STATUS=$ENV{REDIRECT_REDIRECT_STATUS}<br>\n";
 print "QUERY_STRING=$ENV{QUERY_STRING}<br>\n";
 print "SCRIPT_NAME= $ENV{SCRIPT_NAME}<br>\n";
 print "REMOTE_ADDR= $ENV{REMOTE_ADDR}<br>\n";
 print "<br><br><br><br>\n";

#  foreach $key (keys %ENV) {
#   print "$key=$ENV{$key}<br>\n";
#  }


 print "</body></html>";
