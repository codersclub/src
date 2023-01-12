#!/usr/bin/perl

&GetFormInput;

$datafile = "/usr/local/www/votsrc/htdocs/added.html"; 

$Id = $field{'id'};
$Name = $field{'name'};
$Message = $field{'S1'};

$NonCGIPath = "/home/sites/site58/web";

@days = ('Воскресенье','Понедельник','Вторник','Среду','Четверг','Пятницу','Субботу');
@months = ('Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября',
		'Октября','Ноября','Декабря');

($sec, $min, $hour, $mday, $mon, $year, $wday, $yday, $isdst) = localtime(time);
if($hour < 10) { $hour = "0$hour"; }
if ($min < 10) { $min = "0$min"; }
if ($sec < 10) { $sec = "0$sec"; }
if ($year < 1999) {$year+=1900};

$date = "$days[$wday], $mday-го $months[$mon], $year года";

print ("Content-type: text/html\n\n");

open HEADER, $NonCGIPath."/ssi/top.html";
print <HEADER>;
close(HEADER);

open(ADDURL, ">>$datafile") || die; 
print ADDURL "<hr>";
print ADDURL "<p><b>Добавлено в </b>$date</p>";
print ADDURL "<p><b>Имя, E-mail: </b>",$Name,"</p>";
print ADDURL "<p><b>Тип: </b>",$Id,"</p>";
print ADDURL "<p><b>Текст: </b>",$Message,"</p>";
close(ADDURL);

print "<center><table border=\"0\" width=\"500\" cellpadding=\"0\">
  <tr>
    <td width=\"300\" align=center<font color=\"#ffffff\"><br><br><b>Ваше сообщение добавлено!</b><br><br>
    После проверки Администратором, оно будет размещено на сайте.<br><br>Спасибо!</td>
  </tr></table></center><br><br><br>";

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


