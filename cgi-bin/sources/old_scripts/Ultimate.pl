#!/usr/bin/perl

#
###                  PRIMARY FREEWARE UBB SCRIPT                ##
#
# Ultimate Bulletin Board is copyright Infopop Corporation, 1998-1999.
#
#       ------------ Ultimate.cgi -------------
#
#  This file contains intro functionality for the Freeware UBB.
#
#  Infopop Corporation offers no
#  warranties on this script.  The owner/licensee of the script is
#  solely responsible for any problems caused by installation of
#  the script or use of the script, including messages that may be
#  posted on the BB.
#
#  All copyright notices regarding the Ultimate Bulletin Board
#  must remain intact on the scripts and in the HTML
#  for the scripts.  These "powered by" and copyright notices MUST
#  remain visible when the pages are viewed on the Internet.
#
#  You may not SELL this script.  You may offer it freely to others.
#  It is freeware.  You may not alter the code and then call it another
#  name.  You may not alter the code and then resell it under another
#  name, either.
#
# For more info on the Ultimate BB, including licensing info,
# see http://www.UltimateBB.com
#
###############################################################
#
#If you are running UBB on IIS,
#you may need to add the following line
#if so, just remove the "#" sign before the print line below
#print "HTTP/1.0 200 OK\n";
eval {
  ($0 =~ m,(.*)/[^/]+,)   && unshift (@INC, "$1"); # Get the script location: UNIX / or Windows /
  ($0 =~ m,(.*)\\[^\\]+,) && unshift (@INC, "$1"); # Get the script location: Windows \
 
#substitute all require files here for the file

require "UltBB.purpe";
require "Date.pl";
require "mods.file";
require "Styles.file";
require "ubb_library.pl";
};

print ("Content-type: text/html\n\n");

if ($@) {
    print "Error including required files: $@\n";
    print "Make sure these files exist, permissions are set properly, and paths are set correctly.";
 exit;
}

&ReadParse;
 

foreach $row(@in) {
	($Name, $Value) = split ("=", $row);
	$Name = &decodeURL($Name);
	$Value = &decodeURL($Value);
		if ($Name eq "forum") {
			$Forum = $Value;
			$Forum =~ s/\/\\//g;
			$ForumCoded = &HTMLIFY($Forum);
			$ForumCoded =~ tr/ /+/;
			$Forum = &UNHTMLIFY($Forum);
	}
		if ($Name eq "TopicSubject") {
			$TopicSubject = $Value;
			$TopicSubject =~ s/<.+?>//g;
				$TopicSubject = &UNHTMLIFY($TopicSubject);
	}
		if ($Name eq "UserName") {
		$UserName = $Value;
		$UserNameFile = $UserName;
		$UserNameFile =~ s/ /_/g; #remove spaces
	}


		if ($Name eq "PasswordConfirm") {
			$PasswordConfirm = $Value;
		}

		if ($Name eq "number") {
			$number = $Value;
	}
		if ($Name eq "DaysPrune") {
			$DaysPrune = $Value;
	}
	if ($Name eq "topic") {
			$topic = $Value;
	}

	if ($Name eq "Email") {
			$Email = $Value;
			$Email =~tr/A-Z/a-z/; 
	}
	if ($Name eq "URL") {
			$URL = &CleanThis($Value);
			$URL = &PipeCleaner($URL);
	}
	if ($Name eq "Permissions") {
			$Permissions = $Value;
	}
	if ($Name eq "Occupation") {
			$Occupation = &CleanThis($Value);
			$Occupation = &PipeCleaner($Occupation);
	}
	if ($Name eq "Location") {
			$Location = &CleanThis($Value);
			$Location = &PipeCleaner($Location);
	}
	if ($Name eq "TotalPosts") {
		$TotalPosts = $Value;
	}
	if ($Name eq "Status") {
		$Status = $Value;
	}
	if ($Name eq "Interests") {
			$Interests = &CleanThis($Value);
			$Interests = &PipeCleaner($Value);
	}
		if ($Name eq "sendto") {
			$sendto = $Value;
	}
}  # end FOREACH $row

if ($VariablesPath eq "") {
	$VariablesPath = $CGIPath;
}


		$SubjectCoded = &HTMLIFY($TopicSubject);
		$SubjectCoded =~ tr/ /+/;

if (@in == 0) {
&Intro;
}
 
if ($in{'action'} eq "intro") {
 &Intro;
 }  

if ($in{'action'} eq "agree") {
 &Agree;
 } 
 if ($in{'action'} eq "email") {
 &DoEmail($in{'ToWhom'});
 }  

  
if ($in{'action'} eq "register") {
   &Register;
 }  
 
if ($in{'action'} eq "rules") {
 &Rules;
 }  
 
if ($in{'action'} eq "lostpw") {
	if ($UseEmail eq "ON") {
 &LostPW;
 }  else {
 &StandardHTML("Sorry, but this feature is not available, per your administrator's directions.  Use your back button to return to the BB.");
 }
 }  
 

 ## INTRO PAGE SUBROUTINES ####
 
sub Intro {

	&GetDateTime;

&ForumsTopHTML;


open (FORUMFILE, "$VariablesPath/forums.pl");
	@forums = <FORUMFILE>;
close (FORUMFILE);
@forums = grep(/\|/, @forums);

@sortforums = @forums;

for (@sortforums) {
@thisforuminfo = split(/\|/, $_);
chomp($thisforuminfo[8]);
$x = "$thisforuminfo[8]";

$GetHour = "";
$GetMinute = "";
$MilHour = "";
$TheDate = "";
$LatestTime = "";

## Get Forum Data from lastnumber.file(s)
open (FORUMDATA, "$ForumsPath/Forum$x/lastnumber.file"); 
 my @data = <FORUMDATA>;
close (FORUMDATA);
$TotalTopics = $data[1];
chomp($TotalTopics);
$TotalPosts = $data[2];
chomp($TotalPosts);

if ($TotalTopics eq "") {
	$TotalTopics = "0";
	}
	
if ($TotalPosts eq "") {
	$TotalPosts = "0";
	}

if ($TotalTopics > 0) {
#open lasttime.file for forum
open (LTime, "$ForumsPath/Forum$x/lasttime.file"); 
    @lasttime = <LTime>;
close (LTime);

$LastDate = $lasttime[0];
$LastTime = $lasttime[1];
chomp($LastDate);
chomp($LastTime);
#split time/date
($GetHour, $GetMinute) = split(/:/, $LastTime);
($GetMinute, $AMpm) = split(/ /, $GetMinute);
chomp($AMpm);
($GetMonth, $GetDate, $GetYear) = split(/-/, $LastDate);
$CheckThisYear = length($GetYear);
	if ($CheckThisYear < 4)  {
	if ($CheckThisYear  == 2) {
		$GetYear = ("19" . "$GetYear");
		}  else {
		$GetYear = $GetYear - 100;
		$GetYear = sprintf ("%2d", $GetYear);
		$GetYear =~tr/ /0/;
		$GetYear = ("20" . "$GetYear");
		}
	}

	
	&MilitaryTime2;
	$MilTime = "$MilHour:$GetMinute";

if ($TimeFormat eq "24HR") {
	$LatestTime = "$MilTime";
} else {
		$LatestTime = "$LastTime";
	}
	
if ($DateFormat eq "Euro") {
$TheDate = "$GetDate-$GetMonth-$GetYear";
$DateWording = "Все даты в формате DD-MM-YY.";
}  else {
$TheDate = "$GetMonth-$GetDate-$GetYear";
$DateWording = "Все даты в формате MM-DD-YY.";
}
}  else {
$GetMonth = "";
$GetDate= "";
$GetYear = "";
$LatestTime = "";
$TheDate = "";
}

@thisforum = &GetForumRecord($x);

$ForumName = $thisforum[1];
$Moderator = ("Forum" . "$x" . "Moderator");
$Moderator = $$Moderator;
$ForumDesc = $thisforum[2];
$OnOff = $thisforum[3];
chomp($OnOff);

$ForumCoded = &HTMLIFY($ForumName);
$ForumCoded =~ tr/ /+/;
$ForumDesc =~ s/&quot;/"/g;

if ($ForumDescriptions eq "no") {
	$ForumDesc = "";
}

if ($GetMonth ne "") {

# Compare Last Login Time to Last Post Time.. 

$LPMonth = $GetMonth;
		
$CheckThisYear = length($GetYear);

	if ($CheckThisYear < 4)  {
	if ($CheckThisYear  == 2) {
		$JYear = ("19" . "$GetYear");
		}  else {
		$GetYear = $GetYear - 100;
		$GetYear = sprintf ("%2d", $GetYear);
		$GetYear =~tr/ /0/;
		$JYear = ("20" . "$GetYear");
		}
	} else  {
		$JYear = "$GetYear";
	}
	
} # end if/else month ne ""


if ($OnOff eq "On") {
&ForumsGutsHTML;
} ## End IF ONOFF Conditional
}

&ForumsBottomHTML;
}  #END INTRO SR ###


sub ForumsTopHTML {
print <<INTROHTML;
<HTML>
<HEAD><TITLE>$BBName</title>
</head>
 <BODY text="#000000" link="#000080" vlink="#800080">
<FONT FACE="Verdana, Arial" SIZE="2">
<center>
<table border=0 width=95%>
<tr>
<TD align=left>

<table border="0" cellpadding="0" cellspacing="0"
      width="287">
        <tr>
          <td colspan="2" bgcolor="#A5E4A7" valign="middle" align="center"><b>WWW.ИСХОДНИКИ.РУ</b></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">cpp.sources.ru</font></b></td>
        </tr>
        <tr>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">java.sources.ru</font></b></td>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>web.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>soft.sources.ru</b></font></td>
        </tr>
        <tr>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>jdbc.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>asp.sources.ru</b></font></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">api.sources.ru</font></b></td>
        </tr>
      </table>

</td>
<td>
<CENTER>
<B><FONT SIZE="3" FACE="Verdana, Arial" COLOR="#000080">$BBName</FONT></B>
<br><FONT SIZE="1" FACE="Verdana, Arial">
<A HREF="$CGIURL/ubbmisc.pl?action=editbio&Browser=$Browser&DaysPrune=$DaysPrune"><ACRONYM TITLE="Click here to edit your profile.">профайл</ACRONYM></A> | <A HREF="$CGIURL/Ultimate.pl?action=agree"><ACRONYM TITLE="Регистрация бесплатна!">регистрация</ACRONYM></A> | <A HREF="$NonCGIURL/faq.html" target=_blank><ACRONYM TITLE="Frequently Asked Questions">faq</ACRONYM></A>
</FONT>
</CENTER>
</td></TR>
</table>
<table border=0 width=95%>
<TR>
<tr BGCOLOR="#d5e6e1">
<td valign=bottom>
<FONT SIZE="1" FACE="Verdana, Arial" COLOR="$TableStripTextColor">Раздел</FONT>
</td>
<td NOWRAP valign=bottom align=center>
<FONT SIZE="1" FACE="Verdana, Arial" COLOR="#000080">Сообщений</FONT>
</td>
<td NOWRAP valign=bottom align=center>
<FONT SIZE="1" FACE="Verdana, Arial" COLOR="$TableStripTextColor">Последнее сообщение</FONT>
</td>
<td valign=bottom>
<FONT SIZE="1" FACE="Verdana, Arial" COLOR="$TableStripTextColor">Модератор</FONT>
</td></tr>
INTROHTML
}  ## END FORUMS TOP HTML

sub ForumsGutsHTML {
print <<ForumSummary;
<TR>
<TD BGCOLOR="#f7f7f7" valign=top><FONT SIZE='2' FACE='Verdana, Arial'><B>
<A HREF="$CGIURL/forumdisplay.pl?action=topics&forum=$ForumCoded&number=$x&DaysPrune=$DaysPrune&LastLogin=$LastLogin">$ForumName</A></B><BR>
$ForumDesc
</FONT>
</td>
<td BGCOLOR="#dedfdf" align=center valign=top NOWRAP>
<FONT SIZE='2' FACE="Verdana, Arial">$TotalPosts</FONT>
</td><td BGCOLOR="#f7f7f7" NOWRAP valign=top align=center>
<FONT SIZE='2' FACE="Verdana, Arial">$TheDate <FONT COLOR="#000080" SIZE="2" FACE="Verdana, Arial">$LatestTime</FONT>
</td><td BGCOLOR="#dedfdf" valign=top>
<FONT SIZE='2' FACE="Verdana, Arial">$Moderator</FONT></td></tr>
ForumSummary
}  ## END FORUMS GUTS HTML

sub ForumsBottomHTML {
print <<BOTTOMhtml;
</table>
</center>
<P>
<FONT SIZE="1" FACE="Verdana, Arial" COLOR="#8C9A7A">Время $TimeZone.  $DateWording</FONT>
<P>
<P><center></font>
BOTTOMhtml

&PageBottomHTML;
}  ## END Forums Bottom HTML subroutine


### END Intro Page Subroutines ####
 


sub Agree {
print <<Agreement;
<HTML>
 <BODY text="#000000" link="#000080" vlink="#800080">
<FONT SIZE="2" FACE="Verdana, Arial">
<table border=0><TR><TD>

<table border="0" cellpadding="0" cellspacing="0"
      width="287">
        <tr>
          <td colspan="2" bgcolor="#A5E4A7" valign="middle" align="center"><b>WWW.ИСХОДНИКИ.РУ</b></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">cpp.sources.ru</font></b></td>
        </tr>
        <tr>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">java.sources.ru</font></b></td>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>web.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>soft.sources.ru</b></font></td>
        </tr>
        <tr>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>jdbc.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>asp.sources.ru</b></font></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">api.sources.ru</font></b></td>
        </tr>
      </table>

</TD><TD align=center><FONT SIZE="+1" FACE="Verdana, Arial" COLOR="#000080"><B>$BBName Правила</B></FONT></td></tr></table> 
<br><BR>
<FONT SIZE="2" FACE="Verdana, Arial">
<HR width=95%>
<CENTER><B><FONT SIZE="2" FACE="Verdana, Arial" COLOR="#000080">$BBName Rules & Policies</B></CENTER>
<P>
<Blockquote>
$BBRules</FONT>
</blockquote>
<HR width=90%><CENTER>
</CENTER>
</FONT>
<p></font>
</BODY></HTML>
Agreement
}

sub Register {

print<<RegHTML;
<HTML>
<HEAD>
	<TITLE>$BBName Регистрация</TITLE>
</HEAD>
 <BODY text="#000000" link="#000080" vlink="#800080">
<FONT SIZE="3" FACE="Verdana, Arial">

<table border="0" cellpadding="0" cellspacing="0"
      width="287">
        <tr>
          <td colspan="2" bgcolor="#A5E4A7" valign="middle" align="center"><b>WWW.ИСХОДНИКИ.РУ</b></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">cpp.sources.ru</font></b></td>
        </tr>
        <tr>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">java.sources.ru</font></b></td>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>web.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>soft.sources.ru</b></font></td>
        </tr>
        <tr>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>jdbc.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>asp.sources.ru</b></font></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">api.sources.ru</font></b></td>
        </tr>
      </table>

<FONT SIZE="3" FACE="Verdana, Arial" COLOR="#000080"><br><B>
Регистрация в форуме
</B></FONT>
<P>
<table border=0>
<tr>
<td colspan=2>
<FONT SIZE="2" FACE="Verdana, Arial">
<B>Для того, чтобы общаться в форуме, Вам совершенно необходимо зарегистрироваться.  
<BR><BR>
Логин может быть не более 25 символов, а пароль не более 13 символов.  Пожалуйста используйте только буквы и цифры.  Пароль чувствителен к регистру.  Это значит, что "Howard" отличается от "HOWARD."
<BR><BR>
Пожалуйста обязательно заполните поля, помеченные звёздочкой.
<br><br></B></FONT>
</td></tr>
<tr>
<FORM NAME="Register" METHOD=POST ACTION="ubbmisc.pl">

<TD BGCOLOR="#f7f7f7"><FONT SIZE="2" FACE="Verdana, Arial"><B>Логин *</B></FONT></TD>
<TD><INPUT TYPE="TEXT" NAME="UserName" VALUE="" SIZE=25 MAXLENGTH=25>
 </TD>
</TR>
<TR><TD BGCOLOR="#dedfdf"><FONT SIZE="2" FACE="Verdana, Arial"><B>Пароль *</B></FONT></TD><TD><INPUT TYPE="PASSWORD" NAME="Password" VALUE="" SIZE=13 MAXLENGTH=13> </TD></TR><TR><TD><FONT SIZE="2" FACE="Verdana, Arial"><B>Пароль (дубль 2) *</B></FONT></TD><TD><INPUT TYPE="PASSWORD" NAME="PasswordConfirm" VALUE="" SIZE=13 MAXLENGTH=13></TD></tr>

<TR>
	<TD BGCOLOR="#f7f7f7"><FONT SIZE="2" FACE="Verdana, Arial"><B>Email *</B></FONT></TD>
	<TD><INPUT TYPE="TEXT" NAME="Email" VALUE="" SIZE=30 MAXLENGTH=50>
 </TD>
</TR>
<TR>
	<TD BGCOLOR="#dedfdf"><FONT SIZE="2" FACE="Verdana, Arial"><B>Город, Область, Страна</B></FONT></TD>
	<TD><INPUT TYPE="TEXT" NAME="Location" VALUE="" SIZE=30 MAXLENGTH=50>
 </TD></tr>

<TR>
	<TD BGCOLOR="#f7f7f7"><FONT SIZE="2" FACE="Verdana, Arial"><B>Род занятий</B></FONT></TD>
	<TD><INPUT TYPE="TEXT" NAME="Occupation" VALUE="" SIZE=30 MAXLENGTH=50>
 </TD>
</TR>

<TR>
	<TD BGCOLOR="#dedfdf"><FONT SIZE="2" FACE="Verdana, Arial"><B>Домашняя страничка</B></FONT></TD>
	<TD><INPUT TYPE="TEXT" NAME="URL" VALUE="http://" SIZE=30 MAXLENGTH=100>
 </TD></tr>
<TR>
	<TD BGCOLOR="#f7f7f7"><FONT SIZE="2" FACE="Verdana, Arial"><B>Увлечения</B></FONT></TD>
	<TD><INPUT TYPE="TEXT" NAME="Interests" VALUE="" SIZE=30 MAXLENGTH=200>
 </TD></tr>
</TABLE>
<P>

<BR><BR>
<CENTER>
<INPUT TYPE="HIDDEN" NAME="action" VALUE="RegSubmit">
<INPUT TYPE="SUBMIT" NAME="Submit" VALUE="Сохранить">
<INPUT TYPE="RESET" NAME="Reset" VALUE="Очистить">
</FORM>
<BR><BR>
</center><BR></font></BODY>
</HTML>
RegHTML
}  ## END Register SR ##

