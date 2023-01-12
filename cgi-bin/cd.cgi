#!/usr/bin/perl
# -------------Send the CD Order Form to a manager ----------
$mailprog = '/usr/sbin/sendmail';
$orderform = 'http://pascal.sources.ru/cd/index.htm';
$mailto   = 'cd@sources.ru';


#### Get the input parameters ##########
&GetFormInput;

#-------- Check the Cookies
#HTTP_COOKIE="b=b; YaBBusername=vot; YaBBpassword=yyhLQgDMb6wSU"
&GetCookieInput;

$YaBBusername = $field{'YaBBusername'} ;
$YaBBpassword = $field{'YaBBpassword'} ;

#---------- Check the parameters ---------------

$product = $field{'product'} ;
$name    = $field{'name'};
$company = $field{'company'};
$country = $field{'country'};
$zipcode = $field{'zipcode'};
$region  = $field{'region'};
$city    = $field{'city'};
$street  = $field{'street'};
$phone   = $field{'phone'};
$email   = $field{'email'};
$icq     = $field{'icq'};
$sendto  = $field{'sendto'};

#-------- Print Debug Info -------------
#print ("Content-type: text/html\n\n");
#print "MyMode='$mymode'<br>\n";
#print "userid= '$userid'<br>\n";
#print "ord= '$order'<br>\n";
#print "dir= $ordir"."$order<br>\n";

if ($product && $name && $city && $sendto) {

  #-----------------------------------------------#
  #   Отправка Заказа - SEND                      #
  #-----------------------------------------------#

  #------- Отправка сообщения Менеджеру

  open(SENDMAIL, "|$mailprog -t")
              or die "Can't fork for sendmail: $!\n";

  print SENDMAIL
	"From: CD Order Form <webmaster\@sources.ru>\n",
	"To: $mailto\n",
	"Subject: CD Order\n",
	"\n\n",

	"CD Type:  $product\n",
	"Name:     $name\n",
	"Company:  $company\n",
	"ZipCode:  $zipcode\n",
	"Country:  $country\n",
	"Region:   $region\n",
	"City:     $city\n",
	"Street:   $street\n",
	"Phone:    $phone\n",
	"E-mail:   $email\n",
	"ICQ:      $icq\n",
	"YaBBusername: $YaBBusername\n",
	"YaBBpassword: $YaBBpassword\n",
	"Send the order to:  $sendto\n\n",
	"REMOTE_ADDR= $ENV{REMOTE_ADDR}\n",

	"---\n",
	"Sincerely yours,\n",
	"       CD order web-form. http://pascal.sources.ru/cd/index.htm\n",
	"\n\n";

  close(SENDMAIL);

  #------ Redirect to Success Page ---------------
  print ("Content-type: text/html\n\n");

  open(FILE, "<./cd.tpl") || print "Cannot open file cd.tpl, error: $!<BR>\n";
  $buf = join('',<FILE>);
  close(FILE);


  $buf=~ s/<product>/$product/ig;
  $buf=~ s/<name>/$name/ig;
  $buf=~ s/<company>/$company/ig;
  $buf=~ s/<zipcode>/$zipcode/ig;
  $buf=~ s/<country>/$country/ig;
  $buf=~ s/<region>/$region/ig;
  $buf=~ s/<city>/$city/ig;
  $buf=~ s/<street>/$street/ig;
  $buf=~ s/<phone>/$phone/ig;
  $buf=~ s/<email>/$email/ig;
  $buf=~ s/<icq>/$icq/ig;
  $buf=~ s/<sendto>/$sendto/ig;

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

