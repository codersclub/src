#!/usr/bin/perl 

$mailprog = '/usr/sbin/sendmail';
$mailto   = 'admin@sources.ru';
$exclude  = 0;
$uri      = $ENV{REQUEST_URI};
$server   = $ENV{SERVER_NAME};
$referer  = $ENV{HTTP_REFERER};
$agent    = $ENV{HTTP_USER_AGENT};
$ip       = $ENV{REMOTE_ADDR};


# Check for BAD server name

  if ($server =~ m~symmy\.com~) {
    $exclude = 1;
  }


# Check for bad user agent

  if ($agent =~ m~^WebCopier~i) {
    $exclude = 1;
  }

  if ($agent =~ m~^WebAlta~i) {
    $exclude = 1;
  }

  if ($agent =~ m~^XSpider~i) {
    $exclude = 1;
  }

  if ($agent =~ m~^Java/~i) {
    $exclude = 1;
  }

  if ($agent =~ m~Fucking~i) {
    $exclude = 1;
  }

# Check for BAD client IP

  if($ip eq '94.178.77.244') {
    $exclude = 1;
  }
  if($ip eq '79.124.108.102') {
    $exclude = 1;
  }
  if($ip eq '72.30.79.83') {
    $exclude = 1;
  }
  if($ip eq '72.53.93.28') {
    $exclude = 1;
  }
  if($ip eq '194.186.186.90') {
    $exclude = 1;
  }
  if($ip eq '213.154.195.1') {
    $exclude = 1;
  }


  if ($server !~ m~(sources\.ru|213\.248\.\d*\.\d*)~) {
  }


# Check for BAD referer

  if ($referer =~ m~:\\~) {
    $exclude = 1;
  }

  if ($referer =~ m~antoshik\.my1\.ru~) {
    $exclude = 1;
  }

  if ($referer =~ m~gproxyru\.appspot\.com~) {
    $exclude = 1;
  }

  if ($referer =~ m~web\.archive\.org~) {
    $exclude = 1;
  }

# Check for wrong characters in URI

  if ($uri =~ m~[\@\<\>]~) {
    $exclude = 1;
  }

  if ($uri =~ m~YaBB\.cgi~) {
    $exclude = 1;
  }

  if ($uri =~ m~^\/ios\/~) {
    $exclude = 1;
  }


  if ($uri =~ m~tppabs\=~) {
    $exclude = 1;
  }


  if ($uri =~ m~program\.exe~) {
    $exclude = 1;
  }

  if ($uri =~ m~touchdown\.ru~) {
    $exclude = 1;
  }

  if ($uri =~ m~category\/~) {
    $exclude = 1;
  }

  if ($uri =~ m~Category\.aspx~) {
    $exclude = 1;
  }


  if ($uri =~ m~\.spylog\.com~) {
    $exclude = 1;
  }

  if ($uri =~ m~favicon\.(ico|gif)~) {
    $exclude = 1;
  }

  if ($uri =~ m~\.ru\.ico~) {
    $exclude = 1;
  }

  if ($uri =~ m~\/vlata\.gif~) {
    $exclude = 1;
  }

  if ($uri =~ m~\/\'~) {
    $exclude = 1;
  }

  if ($uri =~ m~\(null\)~) {
    $exclude = 1;
  }

  if ($uri =~ m~forum\.html~) {
    $exclude = 1;
  }

  if ($uri =~ m~\/techdays~) {
    $exclude = 1;
  }

  if ($uri =~ m~\.files/~) {
    $exclude = 1;
  }

  if ($uri =~ m~_files/~) {
    $exclude = 1;
  }

  if ($uri =~ m~\.shtml_files/~) {
    $exclude = 1;
  }

  if ($uri =~ m~Subject\=RSWAG~) {
    $exclude = 1;
  }

  if ($uri =~ m~/obidos/~) {
    $exclude = 1;
  }

  if ($uri =~ m~http://~i) {
    $exclude = 1;
  }

  if ($uri =~ m~Ultimate\.(pl|cgi)~) {
    $exclude = 1;
  }

  if ($uri =~ m~forumdisplay\.pl~) {
    $exclude = 1;
  }

  if ($uri =~ m~(ubbmisc|postings)\.pl~) {
    $exclude = 1;
  }

  if ($uri =~ m~MSOffice/~) {
    $exclude = 1;
  }

  if ($uri =~ m~_vti_bin/~) {
    $exclude = 1;
  }

  if ($uri =~ m~^/doku\.php~) {
    $exclude = 1;
  }

  if ($uri =~ m~^/lib/~) {
    $exclude = 1;
  }

  if ($agent =~ m~^Mail\.Ru~) {
    $exclude = 1;
  }


#---------------------------------
# !!! TEMPORARY !!!
$exclude = 1;
#---------------------------------




if(!$exclude) {

  open(SENDMAIL, "|$mailprog -t")
              or print "Can't fork for sendmail: $!\n";

  print SENDMAIL
	"From: Error 404 <admin\@sources.ru>\n",
	"To: $mailto\n",
	"Subject: Error 404\n",
	"\n\n",

	"-- Page not found: ---------\n",
	"SERVER_NAME=$ENV{SERVER_NAME}\n",
	"REQUEST_URI=$ENV{REQUEST_URI}\n",
	"HTTP_REFERER=$ENV{HTTP_REFERER}\n",
	"REDIRECT_URL=$ENV{REDIRECT_URL}\n",
	"REDIRECT_STATUS=$ENV{REDIRECT_STATUS}\n",
	"REDIRECT_ERROR_NOTES=$ENV{REDIRECT_ERROR_NOTES}\n",
	"REDIRECT_REDIRECT_STATUS=$ENV{REDIRECT_REDIRECT_STATUS}\n",
	"SCRIPT_NAME= $ENV{SCRIPT_NAME}\n",
	"REMOTE_ADDR= $ENV{REMOTE_ADDR}\n",
	"QUERY_STRING=$ENV{QUERY_STRING}\n",
	"HTTP_COOKIE=$ENV{HTTP_COOKIE}\n",
	"HTTP_USER_AGENT=$ENV{HTTP_USER_AGENT}\n",
    	"\n---\n",
	"Sincerely yours,\n",
	"          Error 404 handler at www.sources.ru\n",
	"\n\n";

  close(SENDMAIL);

}

#------------------------------------------------------


 print "Content-type: text/html\n\n";


 PrintTemplate("./ssi/top.html");

 print qq( 
<table align="center" width="620" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <h2>Page not found.</h2>
    <br><br>
    <h2>Запрашиваемый документ на сервере не найден</h2>
    <br><br>
    Информация передана администратору.<br>
    <br>
    <br>
    </td>
  </tr>
</table>
);

 PrintTemplate("./ssi/bottom.html");


# print "<html><head><title>Page not found</title><head><body>\n";
# print "<br>\n<big>Error 404: Page not found.</big><br><br>\n";
#
# print "REQUEST_URI=$ENV{REQUEST_URI}<br>\n";
# print "REDIRECT_URL=$ENV{REDIRECT_URL}<br>\n";
# print "HTTP_REFERER=$ENV{HTTP_REFERER}<br>\n";
# print "REDIRECT_STATUS=$ENV{REDIRECT_STATUS}<br>\n";
# print "REDIRECT_ERROR_NOTES=$ENV{REDIRECT_ERROR_NOTES}<br>\n";
# print "REDIRECT_REDIRECT_STATUS=$ENV{REDIRECT_REDIRECT_STATUS}<br>\n";
# print "REMOTE_ADDR= $ENV{REMOTE_ADDR}<br>\n";
# print "QUERY_STRING=$ENV{QUERY_STRING}<br>\n";
# print "SCRIPT_NAME= $ENV{SCRIPT_NAME}<br>\n";
# print "<br><br><br><br>\n";

#  foreach $key (keys %ENV) {
#   print "$key=$ENV{$key}<br>\n";
#  }


# print "</body></html>";

########################################
sub PrintTemplate {
  my($filename) = @_;
  open(FILE, "<$filename") || print "Cannot open file $filename, error: $!<BR>\n";
  print <FILE>;
  close(FILE);
}

