#!/usr/bin/perl

require "new_config";

use LWP::UserAgent;
use HTML::TokeParser;
use DBI;
use CGI qw/:standard/;
use CGI::Cookie;
use CGI;

$q=new CGI();

$id_cgi=$q->param('pid');
$action_cgi=$q->param('action');


$ua = LWP::UserAgent->new;
$ua->agent("Mozilla/8.0");

$dbh=DBI->connect("DBI:$db_type:$db_name:$db_host", $db_user, $db_password,);

print ("Content-type: text/html\n\n");

print "<html>
	<head>
	<meta http-equiv=\"Cache-Control\" content=\"no-cache\">
	<title>Проверка ссылок</title>
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
	select.small {font: 8pt Tahoma}
	.medium {font: 9pt Tahoma}
	a.white {color: white}
	big {font: bold 11pt Tahoma;}
	td.form {
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
<script language=\"JavaScript\" src=\"$cms_dir/wopen.js\"></script>
</head>

<body alink=\"#000000\" vlink=\"#000000\" link=\"#000000\" bgcolor=\"#DCEBF6\" leftmargin=\"0\" topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" marginwidth=\"0\" marginheight=\"0\">


<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\">
<tr><td>";




print "<form action=\"\" method=\"get\"><table width=\"100%\" bgcolor=\"#CCDBE6\"><tr><td><b>Выберите страницу для проверки ссылок:</b></td>
	<td><select name=\"pid\">";

	if ($id_cgi eq '' || $id_cgi eq '0') {
		print "<option style=\"background-color: #DCEBF6;\"  value=\"0\" selected>Главная</option>";
	}else{
		print "<option style=\"background-color: #DCEBF6;\"  value=\"0\">Главная</option>";
	}




	$sth0=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='0';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

	while(my @row0=$sth0->fetchrow_array())  {

		($id0, $name0, $parentid0) = @row0;

		$sth1=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id0';");
		$sth1->execute || die "Невозможно выполнить SQL-запрос.";

		while(my @row1=$sth1->fetchrow_array())  {

			($id1, $name1, $parentid1) = @row1;
			if ($id_cgi eq $id1 && $id_cgi ne '0') {
				print "<option  value=\"country_$id1\" selected >&nbsp;&nbsp;&nbsp;&nbsp;$name1</option>\n";
			}else{
				print "<option  value=\"country_$id1\"  >&nbsp;&nbsp;&nbsp;&nbsp;$name1</option>\n";
			}


			$sth2=$dbh->prepare("select ID,Name,ParentID,Type from pages where ParentID='$id1' and Type='link';");
			$sth2->execute || die "Невозможно выполнить SQL-запрос.";

			while(my @row2=$sth2->fetchrow_array())  {

				($id2, $name2, $parentid2, $type2) = @row2;
				if ($id_cgi eq $id2 && $id_cgi ne '0') {
					print "<option  value=\"$id2\" selected >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name2</option>\n";
				}else{
					print "<option  value=\"$id2\"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$name2</option>\n";
				}

			}
			$sth2->finish();
		}
		$sth1->finish();
	}
	$sth0->finish();




print "</select></td><td><input type=\"submit\" value=\"&gt;&gt;\"></td></tr></table></form>";

print "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
	<td><img src=\"$img_dir/f_active_left.gif\" alt=\"\" width=\"15\" height=\"30\" border=\"0\"></td>
	<td nowrap background=\"$img_dir/f_active_bg.gif\">&nbsp;Проверенные ссылки&nbsp;</td>
	<td><img src=\"$img_dir/f_active_right.gif\" alt=\"\" width=\"15\" height=\"30\" border=\"0\"></td>
	<td width=100% background=\"$img_dir/f_passive_blank.gif\" ><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"30\" border=\"0\"></td>
	<td><img src=\"$img_dir/f_corner_right.gif\" alt=\"\" width=\"6\" height=\"30\" border=\"0\"></td>
	</tr>
	</table>";


print "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
	<td background=$img_dir/f_left_bg.gif><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>
	<td width=100%>
	
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
	<tr><td bgcolor=white width=100% align=right class=medium>&nbsp;</td></tr>
	</table>
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr><td bgcolor=#EFF0EB width=100%>

	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
	<tr valign=top>
		
		<td >&nbsp;#:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>
		
		<td >&nbsp;Название ссылки:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>
		
		<td >&nbsp;Url:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>
		
		<td width=5%>&nbsp;Состояние:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>
	</tr>

	<tr>
		<td colspan=100 bgcolor=#D4D6CC><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	</tr>";


if ($id_cgi ne '' && $id_cgi =~ /country_/) {
	$id_cgi =~ s/country_//;

	$sth0 = $dbh->prepare("SELECT ID,Name,Url FROM links where CountryID='$id_cgi' ORDER BY Prior desc;");
	$sth0->execute();
  
	while (@ref0 = $sth0->fetchrow_array()) {
		($id0, $name0, $url0) = @ref0;

		print "	<tr bgcolor=\"#FFFFFF\" valign=top>
			<td >$id0</td>
			<td width=2> </td>
			<td >$name0</td>
			<td width=2> </td>
			<td ><a href=\"$url0\" target=_blank>$url0</a></td>";

		$req = HTTP::Request->new(HEAD => $url0);
		$req->header('Accept' => 'text/html');

		$res = $ua->request($req);

		if ($res->is_success) {

			print "<td width=2> </td><td >OK</td>";

		} else {
			print "<td width=2> </td><td >Error: " . $res->status_line . "</td></tr>";
		}
	}
	$sth0->finish();
}


elsif ( $id_cgi ne '' ) {

	$sth0 = $dbh->prepare("SELECT ID,Name,Url FROM links where ParentID='$id_cgi' ORDER BY Prior desc;");
	$sth0->execute();
  
	while (@ref0 = $sth0->fetchrow_array()) {
		($id0, $name0, $url0) = @ref0;

		print "	<tr bgcolor=\"#FFFFFF\" valign=top>
			<td >$id0</td>
			<td width=2> </td>
			<td >$name0</td>
			<td width=2> </td>
			<td ><a href=\"$url0\" target=_blank>$url0</a></td>";

		$req = HTTP::Request->new(HEAD => $url0);
		$req->header('Accept' => 'text/html');

		$res = $ua->request($req);

		if ($res->is_success) {

			print "<td width=2> </td><td >OK</td>";

		} else {
			print "<td width=2> </td><td >Error: " . $res->status_line . "</td></tr>";
		}
	}
	$sth0->finish();
}


print "</table>
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr><td bgcolor=#cccccc><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td></tr>
	</table>

	</td></tr>
	</table>

	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr><td bgcolor=#cccccc><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td></tr>
	</table>";


print "</td>
	<td background=$img_dir/f_right_bg.gif><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"6\" height=\"1\" border=\"0\"></td>
	</tr>
	<tr>
	<td bgcolor=#919B9D><img src=\"$img_dir/f_left_bg.gif\" width=5 height=1 border=0></td>
	<td bgcolor=#919B9D><img src=\"$img_dir/pix.gif\" width=6 height=1 border=0></td>
	<td bgcolor=#919B9D><img src=\"$img_dir/f_right_bg.gif\" width=6 height=1 border=0></td>
	</tr>
	</table>";


$dbh->disconnect();



print "</td></tr></table>";

print "</body></html>";


