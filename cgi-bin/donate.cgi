#!/usr/bin/perl
# -------------Send the CD Order Form to a manager ----------
$mailprog = '/usr/sbin/sendmail';
$orderform = '/donate.html';
$mailto   = 'rswag@sources.ru';


#### Get the input parameters ##########
&GetFormInput;

#-------- Check the Cookies
#HTTP_COOKIE="b=b; YaBBusername=vot; YaBBpassword=yyhLQgDMb6wSU"
&GetCookieInput;

#---------- Check the parameters ---------------

$subject = $field{'subject'};
$name    = $field{'name'};
$date    = $field{'date'};
$currency = $field{'currency'};
$summ    = $field{'summ'};
$email   = $field{'email'};

#-------- Print Debug Info -------------
#print ("Content-type: text/html\n\n");
#print "MyMode='$mymode'<br>\n";
#print "userid= '$userid'<br>\n";
#print "ord= '$order'<br>\n";
#print "dir= $ordir"."$order<br>\n";

if($name && $subject && $currency && $date $summ && $email) {

  #-----------------------------------------------#
  #   Отправка Заказа - SEND                      #
  #-----------------------------------------------#

  #------- Отправка сообщения Менеджеру

  open(SENDMAIL, "|$mailprog -t")
              or die "Can't fork for sendmail: $!\n";

  print SENDMAIL
	"From: Donate Form <noreply\@sources.ru>\n",
	"To: $mailto\n",
	"Subject: $subject\n",
	"\n\n",

	"IP_ADDR:  $ENV{REMOTE_ADDR}\n",
	"Name:     $name\n",
	"Date:     $date\n",
	"currency: $currency\n",
	"Summ:     $sum\n",
	"E-mail:   $email\n",

	"---\n",
	"Sincerely yours,\n",
	"       Donation form. http://www.sources.ru/donate.html\n",
	"\n\n";

  close(SENDMAIL);

  #------ Redirect to Success Page ---------------
  print ("Content-type: text/html\n\n");

  open(FILE, "<./donate.tpl") || print "Cannot open file donate.tpl, error: $!<BR>\n";
  $buf = join('',<FILE>);
  close(FILE);


  $buf=~ s/<name>/$name/ig;
  $buf=~ s/<currency>/$currency/ig;
  $buf=~ s/<date>/$date/ig;
  $buf=~ s/<summ>/$summ/ig;
  $buf=~ s/<email>/$email/ig;

  print $buf;

} else { # NO PARAMETERS!!! Redirect to the Order Form
  print "Location:$orderform\n\n";
}

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

#-------------------------------
sub GetCookieInput {

#	(*fval) = @_ if @_ ;

	local ($buf);
	$buf=$ENV{'HTTP_COOKIE'};

	if ($buf eq "") {
			return 0 ;
		}
	else {

 		@fval=split(/; /,$buf);
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

