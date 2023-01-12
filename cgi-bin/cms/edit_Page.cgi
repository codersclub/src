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
	<meta http-equiv=\"Cache-Control\" content=\"no-cache\">
	<title>Editing Page</title>

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

<body vlink=\"black\" alink=\"black\" link=\"black\" bgcolor=\"#DCEBF6\" leftmargin=\"0\" topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" marginwidth=\"0\" marginheight=\"0\" onload=\"PageTextInit();\">


<form name=\"editform\" action=\"list_Pages.cgi\" enctype=\"multipart/form-data\" method=\"post\">
<input type=hidden name=\"action\" value=\"$action_cgi\">
<input type=hidden name=\"step\" value=\"1\">
<input type=hidden name=\"ID\" value=\"";
if($id_cgi eq '') { print "0"; }
else { print $id_cgi; }
print "\">
    <input type=hidden name=\"PageText\" value=\"\">


<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"10\">
<tr>
	<td>
 
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td><img src=\"$img_dir/f_active_left.gif\" alt=\"\" width=\"15\" height=\"30\" border=\"0\"></td>
<td nowrap background=\"$img_dir/f_active_bg.gif\">&nbsp;Свойства страницы&nbsp;</td>
<td><img src=\"$img_dir/f_active_right.gif\" alt=\"\" width=\"15\" height=\"30\" border=\"0\"></td>
<td width=100% background=\"$img_dir/f_passive_blank.gif\" ><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"30\" border=\"0\"></td>
<td><img src=\"$img_dir/f_corner_right.gif\" alt=\"\" width=\"6\" height=\"30\" border=\"0\"></td>
</tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
	<td background=$img_dir/f_left_bg.gif><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>
	<td width=100%>
	
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"5\">
	<tr><td bgcolor=#EFF0EB width=100%>

		<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">
		
		
		    		<tr><td width=100%> 
				Название </td></tr>
		    
		    		<tr><td width=100%>
				<input type=text name=\"Name\" class=blue style=\"width: 100%\" value=\"";



		$sth0=$dbh->prepare("select Name,ParentID from pages where ID='$id_cgi';");
		$sth0->execute || die "Невозможно выполнить SQL-запрос.";

		while(my @row0=$sth0->fetchrow_array())  {

			($name0,$parentid0) = @row0;
			print $name0;

			$sth1=$dbh->prepare("select ID from pages where ID='$parentid0';");
			$sth1->execute || die "Невозможно выполнить SQL-запрос.";

			while(my @row1=$sth1->fetchrow_array())  {

				($id1) = @row1;
				$parentid_cgi = $id1;

			}
			$sth1->finish();

		}
		$sth0->finish();

		    
	print "\"></td></tr><tr><td width=100%> 
				Родительская страница </td></tr>
		    
		    		<tr><td width=100%>
				
				<select style=\"width:100%\" name=\"ParentID\">";

	if ($parentid_cgi eq '' || $parentid_cgi eq '0') {
		print "<option style=\"background-color: #DCEBF6;\"  value=\"0\" selected>Главная</option>";
	}else{
		print "<option style=\"background-color: #DCEBF6;\"  value=\"0\">Главная</option>";
	}




	$sth0=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='0';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

	while(my @row0=$sth0->fetchrow_array())  {

		($id0, $name0, $parentid0) = @row0;
		if ($parentid_cgi eq $id0 && $parentid_cgi ne '0') {
			print "<option  value=\"$id0\" selected >$name0</option>\n";
		}else{
			print "<option  value=\"$id0\"  >$name0</option>\n"; 
		}

		$sth1=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id0';");
		$sth1->execute || die "Невозможно выполнить SQL-запрос.";

		while(my @row1=$sth1->fetchrow_array())  {

			($id1, $name1, $parentid1) = @row1;
			if ($parentid_cgi eq $id1 && $parentid_cgi ne '0') {
				print "<option  value=\"$id1\" selected >&nbsp;&nbsp;&nbsp;&nbsp;$name1</option>\n";
			}else{
				print "<option  value=\"$id1\"  >&nbsp;&nbsp;&nbsp;&nbsp;$name1</option>\n";
			}


			$sth2=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id1';");
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
		    
		    		<tr><td width=100%> 
				Текст страницы </td></tr>
		    
		    		<tr><td width=100%>
				
				

<script language=\"JavaScript\">

function ge(tagName, start)
{
	while (start && start.tagName != tagName) {
		start = start.parentElement;
	}
	return start;
}

function check_link(Comp){
        var anchor = ge(\"A\", Comp.DOM.selection.createRange().parentElement());
        var link = prompt(\"enter link location (eg. http://www.yahoo.com):\", anchor ? anchor.href : \"http://\");
        if (link && link != \"http://\") {
                var range = Comp.DOM.selection.createRange();
                range.pasteHTML('<A HREF=\"' + link + '\">'+range.text+'</A>');
                range.select();
        }
}

</script>

<script language=\"JavaScript\" src=\"$cms_dir/dhtmled.js\"></script>
<script LANGUAGE=\"javascript\" FOR=\"PageText\" EVENT=\"ShowContextMenu\">
	return ShowContextMenu(document.PageTextComp);
</script>
<script LANGUAGE=\"javascript\" FOR=\"PageText\" EVENT=\"ContextMenuAction(itemIndex)\">
	return ContextMenuAction(itemIndex)
</script>
<script language=\"JavaScript\">
function PageTextInit(){
	document.PageTextComp.focus();
	setTimeout('document.PageTextComp.DOM.body.innerHTML = \\'";


	$sth0=$dbh->prepare("select PageText,GotoPage,Type from pages where ID='$id_cgi';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

	while(my @row0=$sth0->fetchrow_array())  {

		($pagetext0, $gotopage0, $typepage0) = @row0;

		$pagetext0 =~ s/\r?\n//gs;	#убираем переносы строки из текста


		print $pagetext0;

	}
	$sth0->finish();




print"\\'', 300);
};
</script>";






print "<object ID=\"ObjTableInfo\" CLASSID=\"clsid:47B0DFC7-B7A3-11D1-ADC5-006008A5848C\" CLASS=\"PageTextEdit\" VIEWASTEXT WIDTH=\"0\" HEIGHT=\"0\"></object>

		<table width=100% border=0 cellpadding=0 cellspacing=0>
		<tr>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_CUT); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/cut.gif\" border=0 width=22 height=22 alt=\"Вырезать\"></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_COPY); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/copy.gif\" border=0 width=22 height=22 alt=\"Копировать\"></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_PASTE); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/paste.gif\" border=0 width=22 height=22alt=\"Вставить\"></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_BOLD); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/bold.gif\" border=0 alt=\"Жирный\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_ITALIC); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/italic.gif\" border=0 alt=\"Наклонный\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_UNDERLINE); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/under.gif\" border=0 alt=\"Подчёркивание\" width=22 height=22></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_JUSTIFYLEFT); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/aleft.gif\" border=0 alt=\"Выравнивание влево\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_JUSTIFYCENTER); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/center.gif\" border=0 alt=\"Выравнивание по центру\" width=22 height=22></a></td>
			<td wudth=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_JUSTIFYRIGHT); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/aright.gif\" border=0 alt=\"Выравнивание вправо\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:align_justify(document.PageTextComp); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/justify.gif\" border=0 alt=\"Заполнение\" width=22 height=22></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_UNORDERLIST,0); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/blist.gif\" border=0 alt=\"Bullets\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_ORDERLIST,0); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/nlist.gif\" border=0 alt=\"Numbering\" width=22 height=22></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_OUTDENT,0); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/ileft.gif\" border=0 alt=\"Decrease Indent\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_INDENT,0); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/iright.gif\" border=0 alt=\"Increase Indent\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_FONT, OLECMDEXECOPT_PROMPTUSER,''); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/font.gif\" border=0 alt=\"Шрифт\" width=22 height=22></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			<td width=22><a href=\"javascript:check_link(document.PageTextComp);\"><img src=\"$img_dir/editor/wlink.gif\" border=0 alt=\"Ссылка\" width=22 height=22></a></td>
			<td width=22><a href=\"JavaScript:ChangeMode(document.PageTextComp); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/text_html.gif\" border=0 alt=\"Текст <-> HTML\"></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			<td width=22><a href=\"JavaScript:document.PageTextComp.execCommand(CMD_IMAGE,0); document.PageTextComp.focus()\"><img src=\"$img_dir/editor/image.gif\" border=0 alt=\"Вставить картинку\"></a></td>
			<td width=8><img src=\"$img_dir/editor/toolbar_separate.gif\" width=8 height=22></td>
			
		</tr>
		</table>

		<table border=0 cellpadding=0 cellspacing=0 width=100%>
		<tr>
			<td>
				<object ID=\"PageTextComp\" CLASSID=\"clsid:2D360201-FFF5-11D1-8D03-00A0C959BC0A\" VIEWASTEXT width=100% height=200 STYLE=\"position: 'relative'; left: 0; top: 0;\">
					<param name=Scrollbars value=true>
				</object>
			</td>
		</tr>
		</table>
				
				</td></tr>
		    
		    		<tr><td width=100%> 
				URL страницы (если нужно сделать статический адрес) </td></tr>
		    
		    		<tr><td width=100%><input type=text name=\"GotoPage\" class=blue style=\"width: 100%\" value=\"$gotopage0\"></td></tr>

		    		<tr><td width=100%> 
				<select name=\"TypePage\">
				<option  value=\"\""; 
				if($typepage0 eq "") { print " selected"; }
				print ">Не указано</option><option  value=\"article\""; 
				if($typepage0 eq "article") { print " selected"; }
				print ">Статья</option><option  value=\"country\""; 
				if($typepage0 eq "country") { print " selected"; }
				print ">Страна</option><option  value=\"country chapter\"";
				if($typepage0 eq "country chapter") { print " selected"; }
				print ">Подраздел в стране</option><option  value=\"materik\"";
				if($typepage0 eq "materik") { print " selected"; }
				print ">Материк</option><option  value=\"link\"";
				if($typepage0 eq "link") { print " selected"; } 
		    		 print ">Ссылки</option></select> Тип страницы </td></tr>
		    
		
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
	<input onclick=\"editform.PageText.value = document.PageTextComp.DOM.body.innerHTML;\" type=image src=\"$img_dir/submit_save.gif\" alt=\"\" width=\"90\" height=\"23\" border=\"0\">
	<img src=\"$img_dir/pix.gif\" width=15 height=1 border=0></td>
</tr>
<tr>
	<td width=\"100%\" background=\"$img_dir/sbar_btm.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"1\" height=\"11\" border=\"0\"></td>
</tr>
</table>

<a href=\"list_Pages.cgi\">вернуться к списку</a>




</td></tr>
</table>

</form>

</body>
</html>";



$dbh->disconnect();
