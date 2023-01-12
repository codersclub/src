#!/usr/bin/perl

#
###                  FREEWARE UBB SCRIPT                ##
#
# Ultimate Bulletin Board is copyright Infopop Corporation, 1998 -2000.
#
#       ------------ forumdisplay.cgi -------------
#
#  This file contains functionality for the Freeware UBB.
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

}  # end FOREACH $row

if ($VariablesPath eq "") {
	$VariablesPath = $CGIPath;
}

		$SubjectCoded = &HTMLIFY($TopicSubject);
		$SubjectCoded =~ tr/ /+/;
		


if (@in == 0) {
&Topics;
}
 
if ($in{'action'} eq "topics") {
 &Topics;
 }  


sub Topics {


if ($DaysPrune eq "") {
$DaysPrune = "20";
}

@thisforum = &GetForumRecord($number);

$Moderator = ("Forum" . "$number" . "Moderator");
$Moderator = $$Moderator;
$Forum = $thisforum[1];
$CustomTitle = $thisforum[9];
chomp($CustomTitle);


$ForumCoded = &HTMLIFY($Forum);
$ForumCoded =~ tr/ /+/;

@theprofile = &OpenProfile("$Moderator.cgi");
	
$ModeratorEmail = "$theprofile[2]";


&TopicTopHTML;

&CurrentDate;

##### create new day summary file, if necessary
unless (-e "$ForumsPath/Forum$number/$RunOnDate.threads") {
my $CreateThreadFile = "yes";
&ForumSummary($number);
## REMOVE OLDER .threads file, if necessary
# @threadfiles contains list of all thread files
foreach $threadfile(@threadfiles) {
	if ($threadfile ne "$RunOnDate.threads") {
		unlink ("$ForumsPath/Forum$number/$threadfile");
	}
}
}  # end UNLESS THREADS SUMMARY EXISTS
##########

if ($CreateThreadFile ne "yes") {
#open thread file online
open (THREADS, "$ForumsPath/Forum$number/$RunOnDate.threads") or die(&StandardHTML("Unable to read Forum$number thread summary file $!"));
@finalarray = <THREADS>;
close (THREADS);
}
@finalarray = sort(@finalarray);

## @finalarray hold thread summary used to display page

$x = $number;
#set Days Prune variable to 3 digits for matching--

if ($DaysPrune == 1) {
	$Days1 = "SELECTED";
	 @finalarray = grep (/^000|001/, @finalarray);
}

if ($DaysPrune == 2) {
	$Days2 = "SELECTED";
	@finalarray = grep (/^(000|001|002)/, @finalarray);
}

if ($DaysPrune == 5) {
	$Days5 = "SELECTED";
		@finalarray = grep (/^(000|001|002|003|004|005)/, @finalarray);
}

if ($DaysPrune == 10) {
	$Days10 = "SELECTED";
		@finalarray = grep (/^(000|001|002|003|004|005|006|007|008|009|010)/, @finalarray);
}

if ($DaysPrune == 20) {
	$Days20 = "SELECTED";
}

if ($DaysPrune == 30) {
	$Days30 = "SELECTED";
}

if ($DaysPrune == 45) {
	$Days45 = "SELECTED";
}

if ($DaysPrune == 60) {
	$Days60 = "SELECTED";
}

if ($DaysPrune == 75) {
	$Days75 = "SELECTED";
}

if ($DaysPrune == 100) {
	$Days100 = "SELECTED";
}

if ($DaysPrune == 365) {
	$Days365 = "SELECTED";
}

&TopicMidHTML;

CHECKEACH: for $eachone(@finalarray) {

	@threadinfo = split(/\|\^\|/, $eachone);
	
	if ($threadinfo[0] <= $DaysPrune) {
	#format date
	my $ThisMonth = substr($threadinfo[2], 4, 2);
	my $ThisYear = substr($threadinfo[2], 0, 4);
	my $ThisDay = substr($threadinfo[2], 6, 2);
	my $JYear = substr($threadinfo[2], 0, 4);
	$hour = substr($threadinfo[2], 8, 2);
	$min = substr($threadinfo[2], 10, 2);
	
	if ($DateFormat eq "Euro") {
	$TheDate = "$ThisDay-$ThisMonth-$ThisYear";
	$DateWording = "Все даты в формате День-Месяц-Год.";
	}  else {
	$TheDate = "$ThisMonth-$ThisDay-$ThisYear";
	$DateWording = "Все даты в формате Месяц-День-Год.";
	}
	


#format time option 1
	if ($TimeFormat eq "24HR")  {
		$FormatTime = "$hour:$min";
	}
	&NormalTime;

#format time option 2
	if ($TimeFormat eq "AMPM")  {
		$FormatTime = "$hour:$min $AMPM";
	}

&TopicGutsHTML;
}  else {   #if within prune range
last CHECKEACH;
}
}

&TopicBottomHTML;
&GetForumSelectList;
&TopicBottom2NonJShtml;


}  ## END TOPICS SR ####


sub TopicTopHTML {
print <<TOP;
<HTML>
<HEAD><TITLE>$BBName</title>
</head>
 <BODY bgcolor="#FFFFFF" text="#000000" link="#000080" vlink="#800080" topmargin=0>
<FONT SIZE="2" FACE="Verdana, Arial">
<b>
TOP
}  ## END TOPIC TOP HTML sr

sub TopicMidHTML {
print <<OtherMiddle;
<center>
<table border=0 width=95%>
<tr>
<form method="get" action="/cgi-bin/sources/search/search.pl">
<td align=left valign=top>
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
<BR>
<FONT SIZE="2" FACE="Verdana, Arial" color="#000080"><B>$Forum</B>
<br><FONT size= "1" COLOR="#800080">(moderated by <A HREF="mailto:$ModeratorEmail">$Moderator</A>)
<BR>
<BR>

<input type="text" size="18" name="query" value> <input type="submit" value="Поиск">
<input TYPE="Radio" NAME="stype" VALUE="AND" checked>&quot;AND&quot; 
<input TYPE="Radio" NAME="stype" VALUE="OR">&quot;OR&quot;

</FONT></font>
</td>
</form>
<td valign=top nowrap><FONT SIZE="1" FACE="Verdana, Arial">
<IMG SRC="$NonCGIURL/open.gif" WIDTH=15 HEIGHT=11 BORDER=0>&nbsp;&nbsp;<A HREF="$CGIURL/Ultimate.pl?action=intro"><ACRONYM TITLE="Return to summary page of all forums.">$BBName</ACRONYM></A>
<br>
<IMG SRC="$NonCGIURL/tline.gif" WIDTH=12 HEIGHT=12 BORDER=0><IMG SRC="$NonCGIURL/open.gif" WIDTH=15 HEIGHT=11 BORDER=0>&nbsp;&nbsp;$Forum
<P>
<CENTER>
<FONT SIZE="2" FACE="Verdana, Arial">
<A HREF="$CGIURL/postings.pl?action=newtopic&number=$number&forum=$ForumCoded&DaysPrune=$DaysPrune" ALT="Спросить"><b>СПРОСИТЬ</b></A></FONT>
<BR>
<A HREF="$CGIURL/ubbmisc.pl?action=editbio&Browser=$Browser&DaysPrune=$DaysPrune"><ACRONYM TITLE="Click here to edit your profile.">профайл</ACRONYM></A> | <A HREF="$CGIURL/Ultimate.pl?action=agree"><ACRONYM TITLE="Registration is free!">регистрация</ACRONYM></A> | <A HREF="$NonCGIURL/faq.html" target=_blank><ACRONYM TITLE="Frequently Asked Questions">faq</ACRONYM></A>
<p>
<BR>
<FORM ACTION="forumdisplay.pl" METHOD="GET">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="topics">
<INPUT TYPE="HIDDEN" NAME="forum" VALUE="$Forum">
<INPUT TYPE="HIDDEN" NAME="number" VALUE="$number">
<SELECT NAME="DaysPrune">
	<OPTION value="1" $Days1>Показать сообщения за этот день
	<OPTION value="2" $Days2>Показать сообщения за последние 2 дня
	<OPTION value="5" $Days5>Показать сообщения за последние 5 дней
	<OPTION value="10" $Days10>Показать сообщения за последние 10 дней
	<OPTION value="20" $Days20>Показать сообщения за последние 20 дней
	<OPTION value="30" $Days30>Показать сообщения за последние 30 дней
	<OPTION value="45" $Days45>Показать сообщения за последние 45 дней
	<OPTION value="60" $Days60>Показать сообщения за последние 60 дней
	<OPTION value="75" $Days75>Показать сообщения за последние 75 дней
	<OPTION value="100" $Days100>Показать сообщения за последние 100 дней
	<OPTION value="365" $Days365>Показать сообщения за последний год
</SELECT>
<INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE="Вперёд">
</FORM>
</center>
</FONT>
</td></tr></table>
</b><a href="http://www.mastak.ru/p/2724">Mastak.ru</a> » Скидки для российских разработчиков условно-бесплатных программ<b>
<table border=0 width=95%>
<tr bgcolor="#D5E6E1">
<td>
<FONT SIZE="1" FACE="Verdana, Arial" color="#000080">Вопрос</FONT>
</td>
<td>
<FONT SIZE="1" FACE="Verdana, Arial" color="#000080">Автор</FONT>
</td>
<td><FONT SIZE="1" FACE="Verdana, Arial" color="#000080">Ответов</FONT>
</td>
<td NOWRAP><FONT SIZE="1" FACE="Verdana, Arial" color="#000080">Последний ответ</FONT>
</td></tr>
OtherMiddle
}  ## END Middle HTML for Topic Page 

sub TopicGutsHTML {
print <<GUTS;
<TR>
<TD bgcolor="#F7F7F7"><IMG SRC="$NonCGIURL/closed.gif" WIDTH=14 HEIGHT=11 BORDER=0><FONT SIZE="2" FACE="Verdana, Arial">&nbsp;
<A HREF="$NonCGIURL/Forum$number/HTML/$threadinfo[3]">$threadinfo[4]</A>
</FONT>
</td>
<td bgcolor="#dedfdf">
<FONT SIZE="2" FACE="Verdana, Arial">$threadinfo[6]</FONT>
</td>
<td align=center bgcolor="#F7F7F7">
<FONT SIZE="2" FACE="Verdana, Arial">$threadinfo[5]</FONT>
</td>
<td NOWRAP bgcolor="#dedfdf">
<FONT SIZE="2" FACE="Verdana, Arial">$TheDate <FONT SIZE="1" FACE="Verdana, Arial" COLOR="#000080">$FormatTime</FONT></FONT>
</td></tr>
GUTS
}  ## END Guts HTML for Topic Page


sub TopicBottomHTML {
print<<BOTTOM
</table>
<br>
<table border=0 width=95%>
<tr><td align=left valign=top>
<FONT SIZE="1" FACE="Verdana, Arial" COLOR="#800080">Время $TimeZone. $DateWording</FONT></td>
<td align=right NOWRAP>
<FONT SIZE="2" FACE="Verdana, Arial">
<FORM ACTION="forumdisplay.pl" METHOD="POST">
<INPUT TYPE="HIDDEN" NAME="action" VALUE="topics">
<B>Перейти: </B><SELECT NAME="number">
BOTTOM
} ## End TopicBottomNonIEhtml

sub TopicBottom2NonJShtml {
print<<TrueTopicBottom;
</SELECT><INPUT TYPE="SUBMIT" NAME="SUBMIT" VALUE="Вперёд"></FORM></FONT></TD></tr></TABLE>
</center>

<p>
<CENTER><A HREF="$CGIURL/postings.pl?action=newtopic&number=$number&forum=$ForumCoded">Задать вопрос</A><P>
TrueTopicBottom

&PageBottomHTML;
}

