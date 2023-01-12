#!/usr/bin/perl

require "new_config";

use DBI;
use CGI qw/:standard/;
use CGI::Cookie;
use CGI;
$q=new CGI();

$id_cgi=$q->param('ID');
$emailfilter_cgi=$q->param('EmailFilter');
$action_cgi=$q->param('action');
$part_cgi=$q->param('part');

$parentid_cgi=$q->param('ParentID');
$countryid_cgi=$q->param('CountryID');
$name_cgi=$q->param('Name');
$description_cgi=$q->param('Description');
$url_cgi=$q->param('Url');
$language_cgi=$q->param('Language');
$priority_cgi=$q->param('Prior');


if ($part_cgi eq '') { $part_cgi = 1; }

$dbh=DBI->connect("DBI:$db_type:$db_name:$db_host", $db_user, $db_password,);


if($action_cgi eq "new") {

	$sth0=$dbh->prepare("insert into links (ParentID,Name,Url,Description,Language,Prior,CountryID) values ('$parentid_cgi','$name_cgi','$url_cgi','$description_cgi','$language_cgi','$priority_cgi','$countryid_cgi');");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

}
elsif($action_cgi eq "edit") {

	$sth0=$dbh->prepare("update links set Name='$name_cgi', ParentID='$parentid_cgi', Url='$url_cgi', Description='$description_cgi', Language='$language_cgi', Prior='$priority_cgi' where ID='$id_cgi';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

}
elsif($action_cgi eq "delete") {

	$sth0=$dbh->prepare("delete from links where ID='$id_cgi';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

}





$count_rows = 0;
$count_pages = 1;
$rows_per_page = 50;


print ("Content-type: text/html\n\n");


print "<html>
	<head>
	<title>Список</title>
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
<tr>
	<td>

<form action=\"\" method=\"get\">
<input type=\"hidden\" name=\"page\" value=\"list_Pages\">


<table width=\"100%\" bgcolor=\"#CCDBE6\">
<tr>

<td><b>Фильтр:</b></td>


<td>Родительская страница</td>

<td>

<select name=\"ParentID\">";

if ($parentid_cgi eq '' || $parentid_cgi eq '0') {
	print "<option style=\"background-color: #DCEBF6;\" value=\"0\" selected >   все   </option>";
}else{
	print "<option style=\"background-color: #DCEBF6;\" value=\"0\"  >   все   </option>";
}




	$sth0=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='0';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

	while(my @row0=$sth0->fetchrow_array())  {

		($id0, $name0, $parentid0) = @row0;

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

</td>


<td>
<input type=\"submit\" value=\"&gt;&gt;\">
</td>

</tr>
</table>
</form>";






########################################## Вывод списка ####################################################


print "<form action=\"&baseurl;\" method=\"post\">
<input type=\"hidden\" name=\"page\" value=\"explorer\">
<input type=\"hidden\" name=\"cid\" value=\"@(/cid)@\">

 
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td><img src=\"$img_dir/f_active_left.gif\" alt=\"\" width=\"15\" height=\"30\" border=\"0\"></td>
<td nowrap background=\"$img_dir/f_active_bg.gif\">&nbsp;Список ссылок&nbsp;</td>
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
		
		<td >&nbsp;Название:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>

		<td >&nbsp;Родительская страница:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>

		<td >&nbsp;Страна:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>

		<td >&nbsp;Прио-<br>ритет:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>
		
		<td width=5%>&nbsp;Действия:</td>
		<td width=2><img src=\"$img_dir/hr_list.gif\" width=2 height=17 border=0></td>
	</tr>

	<tr>
		<td colspan=100 bgcolor=#D4D6CC><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	</tr>";



if ($parentid_cgi eq '' || $parentid_cgi eq '0') {
	$sth0=$dbh->prepare("select ID,ParentID,Name,Url,Prior from links order by ID desc;");
}else{
	$sth0=$dbh->prepare("select ID,ParentID,Name,Url,Prior from links where ParentID='$parentid_cgi' order by Prior desc;");
}


	$sth0->execute;

	while(my @row0=$sth0->fetchrow_array())  {

		$count_rows++;

		($id0, $parentid0, $name0, $url0, $priority0) = @row0;

		if ( $count_rows <= ($rows_per_page*$part_cgi) && $count_rows >= ($rows_per_page*($part_cgi-1)+1)) {
			print "	<tr bgcolor=\"#FFFFFF\" valign=top>
				<td ><nobr><a href=\"edit_Link.cgi?action=edit&ID=$id0&ParentID=$parentid0\"><img src=\"$img_dir/ico_articleedit.gif\" width=\"16\" height=\"16\" border=\"0\" alt=\"редактировать\" align=\"left\" valign=\"middle\"><a>
				$id0</td>
				<td width=2> </td>
				<td ><a href=\"$url0\" target=_blank>$name0</a></td>
				<td width=2> </td>";


			$sth1=$dbh->prepare("select Name,ParentID from pages where ID='$parentid0';");
			$sth1->execute || die "Невозможно выполнить SQL-запрос.";

			while(my @row1=$sth1->fetchrow_array())  {

				($name1, $parentid1) = @row1;

				print "<td >$name1</a></td>
				<td width=2> </td>";

			}
			$sth1->finish();

			$sth1=$dbh->prepare("select Name,ParentID from pages where ID='$parentid1';");
			$sth1->execute || die "Невозможно выполнить SQL-запрос.";

			while(my @row1=$sth1->fetchrow_array())  {

				($name1, $parentid1) = @row1;

				print "<td >$name1</a></td>
				<td width=2> </td>";

			}
			$sth1->finish();

			print "<td align=right>$priority0</a></td>
				<td width=2> </td>

				<td nowrap width=5%>&nbsp;   
		    		    <a onclick=\"return confirm('Подтвердить удаление?');\" href=\"list_Links.cgi?action=delete&ID=$id0\" onclick=\"\"><img src=\"$img_dir/ico_del.gif\" width=\"16\" height=\"17\" border=\"0\" alt=\"удалить\" ><a>
				    </td>
				<td width=2> </td>
				</tr>";
		}

	}
	$sth0->finish();

	$count_pages = int($count_rows / $rows_per_page) + 1;



	print "</table>
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr><td bgcolor=#cccccc><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td></tr>
	</table>

	</td></tr>
	</table>

	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	<tr><td bgcolor=#cccccc><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\"></td></tr>
	</table>
	

	
    <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
    <tr>
      <td bgcolor=white nowrap>";

	if ($count_pages > 1) {
		if ($part_cgi > 1) { print "<a href=\"list_Links.cgi?part=1\"><img src=\"$img_dir/ico_rr_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\"></a>"; }
		else { print "<img src=\"$img_dir/ico_rr_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">"; }

		if ($part_cgi > 1) { print "<a href=\"list_Links.cgi?part=".($part_cgi-1)."\"><img src=\"$img_dir/ico_r_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\"></a>"; }
		else { print "<img src=\"$img_dir/ico_r_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">"; }

		print "<img src=\"$img_dir/ico_blue_line.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">";

		if ($part_cgi < $count_pages) { print "<a href=\"list_Links.cgi?part=".($part_cgi+1)."\"><img src=\"$img_dir/ico_f_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\"></a>"; }
		else { print "<img src=\"$img_dir/ico_f_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">"; }

		if ($part_cgi < $count_pages) { print "<a href=\"list_Links.cgi?part=$count_pages\"><img src=\"$img_dir/ico_ff_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\"></a>"; }
		else { print "<img src=\"$img_dir/ico_ff_on.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">"; }

		print "</td><td bgcolor=white nowrap>";
	}

	print "Стр. $part_cgi из $count_pages</td>
	      <td bgcolor=white width=100%></td>
	    </tr>
	    </table>
    

	
	
	</td>
	<td background=$img_dir/f_right_bg.gif><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"6\" height=\"1\" border=\"0\"></td>
</tr>
<tr>
	<td bgcolor=#919B9D><img src=\"$img_dir/f_left_bg.gif\" width=5 height=1 border=0></td>
	<td bgcolor=#919B9D><img src=\"$img_dir/pix.gif\" width=6 height=1 border=0></td>
	<td bgcolor=#919B9D><img src=\"$img_dir/f_right_bg.gif\" width=6 height=1 border=0></td>
</tr>
</table>


</td></tr>
</table>
</form>

</body>
</html>";


$dbh->disconnect();


