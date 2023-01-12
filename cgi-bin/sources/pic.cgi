#!/usr/bin/perl

eval {
require "pic.setup";
};

&GetFormInput;

$Id = $field{'id'};

if($Id eq "" || $Id < 1) {
	$Id = "1";
}



print ("Content-type: text/html\n\n");

open HEADER, $NonCGIPath."/ssi/top.html";
print <HEADER>;
close(HEADER);

open (PIC, "pic") || die;
@lines = <PIC>;
close(PIC);

$Count = "1";
$StrokaZakazaFull = '';

foreach $StrokaZakazaFull(@lines) {
   @StrokaZakaza = ();
   @StrokaZakaza = split(/\Q|\E/o, $StrokaZakazaFull);

   if($StrokaZakaza[0] eq $Id) {

	print "<p align=\"center\"><b>$StrokaZakaza[1]</b></p><p align=\"center\">";

	if($Count eq "1") {
		print "&lt;&lt;&lt; Назад";
	}
	else {
		print "<a href=$CGIURL/pic.cgi?id=",$Id-1,">&lt;&lt;&lt; Назад</a>";
	}

	print " <b>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</b> 
		<a href=$CGIURL/pic.cgi?id=",$Id+1,"> Вперед &gt;&gt;&gt;</a></p>
		<p align=\"center\"><img src=\"$NonCGIURL/pic/$StrokaZakaza[2]\" border=\"1\" ></p>
		<p align=\"center\">";

	if($Count eq "1") {
		print "&lt;&lt;&lt; Назад";
	}
	else {
		print "<a href=$CGIURL/pic.cgi?id=",$Id-1,">&lt;&lt;&lt; Назад</a>";
	}

	print "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</b> 
		<a href=$CGIURL/pic.cgi?id=",$Id+1,"> Вперед &gt;&gt;&gt;</a></p>";

   }

   $Count++;

}

print "<p align=\"center\">Другие картинки:</p>
	<p align=\"center\">";

for($i=1; $i<$Count; $i++) {
   if($i eq $Id) {
	if($Id < 10) {
	   print "[<font color=red>0$Id</font>]";
	}
	else {
	   print "[<font color=red>$Id</font>]";
	}
   }
   else {
	if($i < 10) {
	   print "[<a href=\"$CGIURL/pic.cgi?id=$i\">0$i</a>]";
	}
	else {
	   print "[<a href=\"$CGIURL/pic.cgi?id=$i\">$i</a>]";
	}
   }
}

print "</p><p align=\"center\">&nbsp;</p><p align=\"center\">&nbsp;</p>";

open BOTTOM, $NonCGIPath."/ssi/bottom.html";
print <BOTTOM>;
close(BOTTOM);





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


