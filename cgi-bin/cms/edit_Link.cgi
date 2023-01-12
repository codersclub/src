#!/usr/bin/perl

require "new_config";

use DBI;
use CGI qw/:standard/;
use CGI::Cookie;
use CGI;
$q=new CGI();

$id_cgi=$q->param('ID');
$parentid_cgi=$q->param('ParentID');
$action_cgi=$q->param('action');


$dbh=DBI->connect("DBI:$db_type:$db_name:$db_host", $db_user, $db_password,);

print ("Content-type: text/html\n\n");

print "<html>
	<head>
	<title>Editing Announce</title>

	<style>
	body, td, input, submit, select {
	scrollbar-arrow-color : white;
	scrollbar-base-color : #4182D7;
	scrollbar-face-color : #4182D7;
	scrollbar-highlight-color : #FFFFFF;
	scrollbar-shadow-color : white;
	}
	</style>

	<style>
	body, td {font: 8pt Tahoma}
	a.white {color: white}
	big {font: bold 11pt Tahoma;}
	td.form {
		background-image: url($img_dir/bg_form.gif);
		background-attachment : fixed;
		background-position : center;
		background-repeat : no-repeat;
	}

.blue {
	background-color: white;
	font-size : 10pt;
	border : solid 1;
	border-color : #4183D6;
}	
</style>

<script language=\"JavaScript\" src=\"$cms_dir/listMove.js\"></script>

</head>

<body vlink=\"black\" alink=\"black\" link=\"black\" bgcolor=\"#DCEBF6\" leftmargin=\"0\" topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" marginwidth=\"0\" marginheight=\"0\">


<form name=\"editform\" action=\"list_Links.cgi\" enctype=\"multipart/form-data\" method=\"post\">
<input type=hidden name=\"action\" value=\"$action_cgi\">
<input type=hidden name=\"ID\" value=\"";
if($id_cgi eq '') { print "0"; }
else { print $id_cgi; }
print "\">";


$sth0=$dbh->prepare("select ParentID from countries_pages where ID='$parentid_cgi';");
$sth0->execute || die "Невозможно выполнить SQL-запрос.";

while(my @row0=$sth0->fetchrow_array())  {
	($parentid0) = @row0;

	print "<input type=hidden name=\"CountryID\" value=\"$parentid0\">";

}
$sth0->finish();




print "<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\">
<tr>
	<td>
 
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td><img src=\"$img_dir/f_active_left.gif\" width=\"15\" height=\"30\" border=\"0\"></td>
<td nowrap background=\"$img_dir/f_active_bg.gif\">&nbsp;Свойства ссылки&nbsp;</td>
<td><img src=\"$img_dir/f_active_right.gif\" width=\"15\" height=\"30\" border=\"0\"></td>
<td width=100% background=\"$img_dir/f_passive_blank.gif\" ><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"30\" border=\"0\"></td>
<td><img src=\"$img_dir/f_corner_right.gif\" width=\"6\" height=\"30\" border=\"0\"></td>
</tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
	<td background=$img_dir/f_left_bg.gif><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"1\" border=\"0\"></td>
	<td width=100%>
	
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
	<tr><td bgcolor=#EFF0EB width=100%>

		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
		

		$sth0=$dbh->prepare("select ParentID,Name,Url,Description,Language,Prior from links where ID='$id_cgi';");
		$sth0->execute || die "Невозможно выполнить SQL-запрос.";

		while(my @row0=$sth0->fetchrow_array())  {

			($parentid0, $name0, $url0, $description0, $language0, $priority0) = @row0;

			$description0 =~ s/\r?\n//gs;	#убираем переносы строки из текста

			if ($priority0 eq '') { $priority0 = '0'; }

			$parentid_cgi = $parentid0;

		}
		$sth0->finish();


		print "<tr><td width=100%> Название </td></tr>
		    <tr><td width=100%><input type=text name=\"Name\" class=blue style=\"width: 100%\" value=\"$name0\"></td></tr>";


		print "<tr><td width=100%> 
				Родительская страница </td></tr>
		    
		    		<tr><td width=100%>
				<select style=\"width:100%\" name=\"ParentID\">";



	$sth0=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='0';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

	while(my @row0=$sth0->fetchrow_array())  {

		($id0, $name0, $parentid0) = @row0;
#		if ($parentid_cgi eq $id0 && $parentid_cgi ne '0') {
#			print "<option  value=\"$id0\" selected >$name0</option>\n";
#		}else{
#			print "<option  value=\"$id0\"  >$name0</option>\n"; 
#		}

		$sth1=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id0';");
		$sth1->execute || die "Невозможно выполнить SQL-запрос.";

		while(my @row1=$sth1->fetchrow_array())  {

			($id1, $name1, $parentid1) = @row1;
			if ($parentid_cgi eq $id1 && $parentid_cgi ne '0') {
				print "<option  value=\"$id1\" selected >&nbsp;&nbsp;&nbsp;&nbsp;$name1</option>\n";
			}else{
				print "<option  value=\"$id1\"  >&nbsp;&nbsp;&nbsp;&nbsp;$name1</option>\n";
			}


			$sth2=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id1' and Type='link';");
			$sth2->execute || die "Невозможно выполнить SQL-запрос.";

			while(my @row2=$sth2->fetchrow_array())  {

				($id2, $name2, $parentid2) = @row2;
				if ($parentid_cgi eq $id2 && $parentid_cgi ne '0') {
					print "<option  value=\"$id2\" selected >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name2</option>\n";
				}else{
					print "<option  value=\"$id2\"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name2</option>\n";
				}

				$sth3=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id2';");
				$sth3->execute || die "Невозможно выполнить SQL-запрос.";

				while(my @row3=$sth3->fetchrow_array())  {

					($id3, $name3, $parentid3) = @row3;
					if ($parentid_cgi eq $id3 && $parentid_cgi ne '0') {
						print "<option  value=\"$id3\" selected >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name3</option>\n";
					}else{
						print "<option  value=\"$id3\"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name3</option>\n";
					}

				}
				$sth3->finish();
			}
			$sth2->finish();
		}
		$sth1->finish();
	}
	$sth0->finish();


		print "</select>
			</td></tr>

		    <tr><td width=100%> Url </td></tr>
		    <tr><td width=100%><input type=text name=\"Url\" class=blue style=\"width: 100%\" value=\"$url0\"></td></tr>

		    <tr><td width=100%> Описание </td></tr>
		    <tr><td width=100%><textarea name=\"Description\" class=blue rows=\"5\" style=\"width: 100%\">$description0</textarea></td></tr>

		    <tr><td width=100%> Язык </td></tr>
		    <tr><td width=100%><input type=text name=\"Language\" class=blue style=\"width: 100%\" value=\"$language0\"></td></tr>

		    <tr><td width=100%> Приоритет </td></tr>
		    <tr><td width=100%><input type=text name=\"Prior\" class=blue style=\"width: 100%\" value=\"$priority0\"></td></tr>

		    
	</table>

	</td></tr>
	</table>";




print "	<td background=$img_dir/f_right_bg.gif><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"6\" height=\"1\" border=\"0\"></td>
</tr>
<tr>
	<td bgcolor=#919B9D><img src=\"$img_dir/f_left_bg.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>
	<td bgcolor=#919B9D><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"6\" height=\"1\" border=\"0\"></td>
	<td bgcolor=#919B9D><img src=\"$img_dir/f_right_bg.gif\" alt=\"\" width=\"6\" height=\"1\" border=\"0\"></td>
</tr>
</table>


<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
	<td rowspan=3><img src=\"$img_dir/sbar_left.gif\" alt=\"\" width=\"5\" height=\"38\" border=\"0\"></td>
	<td width=\"100%\" background=\"$img_dir/sbar_top.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"10\" height=\"4\" border=\"0\"></td>
	<td rowspan=3><img src=\"$img_dir/sbar_right.gif\" alt=\"\" width=\"5\" height=\"38\" border=\"0\"></td>
	<td><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td>
</tr>
<tr valign=middle>
	<td width=\"100%\" background=\"$img_dir/sbar_bg.gif\" align=right><img src=\"$img_dir/hrv.gif\" alt=\"\" width=\"2\" height=\"20\" hspace=3 border=\"0\"><img src=\"$img_dir/hrv.gif\" alt=\"\" width=\"2\" height=\"20\" hspace=3 border=\"0\"><img src=\"$img_dir/hrv.gif\" alt=\"\" width=\"2\" height=\"20\" hspace=3 border=\"0\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"2\" height=\"20\" hspace=3 border=\"0\">
	<input type=image src=\"$img_dir/submit_save.gif\" width=\"90\" height=\"23\" border=\"0\">
	<img src=\"$img_dir/pix.gif\" alt=\"\" width=\"15\" height=\"1\" border=\"0\"></td>
</tr>
<tr>
	<td width=\"100%\" background=\"$img_dir/sbar_btm.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"11\" border=\"0\"></td>
</tr>
</table>

<a href=\"list_Links.cgi?ParentID=$parentid_cgi\">вернуться к списку</a>




</td></tr>
</table>

</form>

</body>
</html>";



$dbh->disconnect();
