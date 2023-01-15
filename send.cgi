#!/usr/bin/perl
# -------------Send the Order Form to a manager ----------
$mailprog = '/usr/sbin/sendmail';
$mailto   = 'admin@sources.ru';


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
	"REDIRECT_URL=$ENV{REDIRECT_URL}\n",
	"REDIRECT_STATUS=$ENV{REDIRECT_STATUS}\n",
	"REDIRECT_ERROR_NOTES=$ENV{REDIRECT_ERROR_NOTES}\n",
	"HTTP_REFERER=$ENV{HTTP_REFERER}\n",
	"REDIRECT_REDIRECT_STATUS=$ENV{REDIRECT_REDIRECT_STATUS}\n",
	"SCRIPT_NAME= $ENV{SCRIPT_NAME}\n",
	"REMOTE_ADDR= $ENV{REMOTE_ADDR}\n",
	"QUERY_STRING=$ENV{QUERY_STRING}\n",
	"HTTP_COOKIE=$ENV{HTTP_COOKIE}\n",
	"\n---\n",
	"Sincerely yours,\n",
	"          Error 404 handler at www.sources.ru\n",
	"\n\n";

  close(SENDMAIL);

#------ Redirect to Success Page ---------------
print ("Content-type: text/html\n");
print "Location:$donepage\n\n";

##########################################
sub GetFormInput {

	(*fval) = @_ if @_ ;
	local ($buf);
	if ($ENV{'REQUEST_METHOD'} eq 'POST') {
		read(STDIN,$buf,$ENV{'CONTENT_LENGTH'});
	}
	else {
		$buf=$ENV{'QUERY_STRING'};
	}
	if ($buf eq "") {
			return 0 ;
		}
	else {

 		@fval=split(/&/,$buf);
		foreach $i (0 .. $#fval){
		  ($name,$val)=split (/=/,$fval[$i],2);
		  $val=~tr/+/ /;
		  $val=~ s/%(..)/pack("c",hex($1))/ge;
		  $name=~tr/+/ /;
		  $name=~ s/%(..)/pack("c",hex($1))/ge;

		  if (!defined($field{$name})) { 
			$field{$name}=$val;
		  }
		  else {
                    $field{$name} .= ",$val";	
                    #if you want multi-selects to goto into an array change to:
                    #$field{$name} .= "\0$val";
		  }
		 }
		}
  return 1;
}
