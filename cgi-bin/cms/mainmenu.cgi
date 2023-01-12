#!/usr/bin/perl

require "new_config";

use CGI qw/:standard/;
use CGI::Cookie;
use CGI;
$q=new CGI();

$tabset_cgi=$q->param('tabset');
$subtabset_cgi=$q->param('subtabset');


print "Content-type: text/html\n\n";

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
<meta http-equiv=\"Cache-Control\" content=\"no-cache\">
<style>
        body, td {font: 8pt Tahoma}
        a.white {color: white}
	.menu, .menuact { 
		font: bold 8pt Tahome; 
		color: white; 
		font-align: center;
		margin-bottom: 10px;
		text-decoration: none;
    	}
	.menuact { 
		font: bold 9pt Tahome; 
		margin-bottom: 4px;
		filter: DropShadow(Color=\"black\",OffX=\"1\",OffY=\"1\",Positive=\"1\");
		height:10;
    	}
</style>
</head>

<body bgcolor=\"#4485D8\" leftmargin=\"0\" topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";

print "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td background=\"$img_dir/bg_darkblue.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"4\" border=\"0\"></td>
  </tr>
</table>

<table width=\"100%\" height=\"59\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td background=\"$img_dir/bg_darkblue.gif\">

      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td><img src=\"$img_dir/logo.gif\" alt=\"\" width=\"220\" height=\"73\" border=\"0\"></td>
          <td width=\"100%\">
            <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <tr valign=\"bottom\">";

if ($tabset_cgi > 0) {
  print "
                <td><img src=\"$img_dir/dash.gif\" alt=\"\" width=\"4\" height=\"73\" border=\"0\"></td>"; 
}

if ($tabset_cgi eq '0' || $tabset_cgi eq '') {
  print "
                <td  align=\"center\" background=\"$img_dir/tab_structure_on.gif\"  width=\"114\" height=\"73\" border=\"0\"><a href=\"mainmenu.cgi?tabset=0\"><div class=\"menuact\">Структура</div></a></td>"; 
} else {
  print "
                <td style=\"cursor: hand\" onclick=\"location='?page=mainmenu;tabset=0';parent.left.location='tree_Pages.cgi';parent.right.location='list_Pages.cgi';\"  align=\"center\" background=\"$img_dir/tab_structure.gif\"  width=\"107\" height=\"73\" border=\"0\"><div class=\"menu\">Структура</div></td>"; 
}

if ($tabset_cgi > 1) {
  print "
                <td><img src=\"$img_dir/dash.gif\" alt=\"\" width=\"4\" height=\"73\" border=\"0\"></td>"; 
}

if ($tabset_cgi eq '1') {
  print "
                <td  align=\"center\" background=\"$img_dir/tab_content_on.gif\"  width=\"114\" height=\"73\" border=\"0\"><a href=\"mainmenu.cgi?tabset=1\"><div class=\"menuact\">Клиенты</div></a></td>"; 
} else {
  print "
                <td style=\"cursor: hand\" onclick=\"location='mainmenu.cgi?tabset=1'\"  align=\"center\" background=\"$img_dir/tab_content.gif\"  width=\"107\" height=\"73\" border=\"0\"><div class=\"menu\">Клиенты</div></td>";
}

if ($tabset_cgi > 2 || $tabset_cgi < 1) {
  print "
                <td><img src=\"$img_dir/dash.gif\" alt=\"\" width=\"4\" height=\"73\" border=\"0\"></td>";
}

if ($tabset_cgi eq '2') {
  print "
                <td  align=\"center\" background=\"$img_dir/tab_interactive_on.gif\"  width=\"114\" height=\"73\" border=\"0\"><a href=\"mainmenu.cgi?tabset=2\"><div class=\"menuact\">Интерактив</div></a></td>";
} else {
  print "
                <td style=\"cursor: hand\" onclick=\"location='mainmenu.cgi?tabset=2';parent.left.location='new_feedback_menu.cgi';parent.right.location='new_list_Feedbacks.cgi';\"  align=\"center\" background=\"$img_dir/tab_interactive.gif\"  width=\"107\" height=\"73\" border=\"0\"><div class=\"menu\">Интерактив</div></td>";
}

if ($tabset_cgi > 3 || $tabset_cgi < 2) {
  print "
                <td><img src=\"$img_dir/dash.gif\" alt=\"\" width=\"4\" height=\"73\" border=\"0\"></td>";
}

if ($tabset_cgi eq '3') {
  print "
                <td  align=\"center\" background=\"$img_dir/tab_settings_on.gif\"  width=\"114\" height=\"73\" border=\"0\"><a href=\"mainmenu.cgi?tabset=3\"><div class=\"menuact\">Настройки</div></a></td>";
} else {
  print "
                <td style=\"cursor: hand\" onclick=\"location='mainmenu.cgi?tabset=3';parent.left.location='new_user_menu.cgi';parent.right.location='new_list_Users.cgi';\"  align=\"center\" background=\"$img_dir/tab_settings.gif\"  width=\"107\" height=\"73\" border=\"0\"><div class=\"menu\">Настройки</div></td>";
}

if ($tabset_cgi > 4 || $tabset_cgi < 3) {
  print "
                <td><img src=\"$img_dir/dash.gif\" alt=\"\" width=\"4\" height=\"73\" border=\"0\"></td>";
}

if ($tabset_cgi eq '4') {
  print "
                <td  align=\"center\" background=\"$img_dir/tab_help_on.gif\"  width=\"114\" height=\"73\" border=\"0\"><a href=\"mainmenu.cgi?tabset=4\"><div class=\"menuact\">Помощь</div></a></td>";
} else {
  print "
                <td style=\"cursor: hand\" onclick=\"location='mainmenu.cgi?tabset=4'\"  align=\"center\" background=\"$img_dir/tab_help.gif\"  width=\"107\" height=\"73\" border=\"0\"><div class=\"menu\">Помощь</div></td>";
}

if ($tabset_cgi < 4) {
  print "
                <td><img src=\"$img_dir/dash.gif\" alt=\"\" width=\"4\" height=\"73\" border=\"0\"></td>";
}


print "
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>";


print "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><img src=\"$img_dir/bar_topleft.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
    <td background=\"$img_dir/bar_topbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"";

$temp_tab = 215 + 111*$tabset_cgi;

print "$temp_tab\" height=\"14\" border=\"0\" /></td>
    <td><img src=\"$img_dir/tab_btm.gif\" alt=\"\" width=\"121\" height=\"14\" border=\"0\"></td>
    <td width=\"100%\" background=\"$img_dir/bar_topbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"14\" border=\"0\"></td>
    <td><img src=\"$img_dir/bar_topright.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
  </tr>
</table>";

# подменю
print "
<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td background=\"$img_dir/bar_leftbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"13\" border=\"0\"></td>
    <td colspan=\"2\" width=\"100%\">
      <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td>";

if ($subtabset_cgi eq '' || $subtabset_cgi eq '0') {
  print "
          <td><img src=\"$img_dir/ico_forum.gif\" width=\"19\" height=\"19\" border=\"0\"/></td>
          <td><a href=\"mainmenu.cgi?tabset=0&subtabset=0\" onclick=\"parent.left.location='tree_Pages.cgi';parent.right.location='list_Pages.cgi';\"><font color=white style=\"text-decoration: none\">Страницы</a></td>";
} else {
  print "
          <td>
            <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
              <tr>
		<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
		<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
		<td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	      </tr>
	      <tr>
		<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"21\" border=\"0\"></td>
		<td background=\"$img_dir/button_bg.gif\">
                  <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
		      <td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td><td><img src=\"$img_dir/ico_forum.gif\" width=\"19\" height=\"19\" border=\"0\" /></td><td><a href=\"mainmenu.cgi?tabset=0&subtabset=0\" onclick=\"parent.left.location='tree_Pages.cgi';parent.right.location='list_Pages.cgi';\"><font color=white style=\"text-decoration: none\">Страницы</a></td><td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
	            </tr>
                  </table>
	        </td>
	        <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	      </tr>
              <tr>
	        <td><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	        <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
                <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
              </tr>
            </table>
          </td>";

}


# вертикальная палочка
print "
          <td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
          <td><img src=\"$img_dir/dash_small.gif\" alt=\"\" width=\"2\" height=\"19\" border=\"0\"></td>
          <td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>";


if ($subtabset_cgi eq '1') {
  print "
          <td><img src=\"$img_dir/ico_forum.gif\" width=\"19\" height=\"19\" border=\"0\"/></td><td><a href=\"mainmenu.cgi?tabset=0&subtabset=1\" onclick=\"parent.left.location='tree_Pages.cgi';parent.right.location='check_url.cgi';\"><font color=white style=\"text-decoration: none\">Проверка ссылок</a></td>";
} else {
  print"
          <td>
            <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	      <tr>
	        <td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	        <td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	        <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	      </tr>
	      <tr>
	        <td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"21\" border=\"0\"></td>
	        <td background=\"$img_dir/button_bg.gif\">

	          <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
		      <td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td><td><img src=\"$img_dir/ico_forum.gif\" alt=\"\" width=\"19\" height=\"19\" border=\"0\" /></td><td><a href=\"mainmenu.cgi?tabset=0&subtabset=1\" onclick=\"parent.left.location='tree_Pages.cgi';parent.right.location='check_url.cgi'\"><font color=white style=\"text-decoration: none\">Проверка ссылок</a></td><td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
	            </tr>
                  </table>

	        </td>
	        <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	      </tr>
	      <tr>
	        <td><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	        <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	        <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	      </tr>
            </table>
          </td>";

}

# вертикальная палочка
print "
          <td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
          <td><img src=\"$img_dir/dash_small.gif\" alt=\"\" width=\"2\" height=\"19\" border=\"0\"></td>
          <td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>";


if ($subtabset_cgi eq '2') {
  print "
          <td><img src=\"$img_dir/ico_forum.gif\" width=\"19\" height=\"19\" border=\"0\"/></td><td><a href=\"mainmenu.cgi?tabset=0&subtabset=2\" onclick=\"parent.left.location='tree_Links.cgi';parent.right.location='list_Links.cgi';\"><font color=white style=\"text-decoration: none\">Ссылки</a></td>";
} else {
  print "
    	  <td>
      	    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
	      <tr>
	  	<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	  	<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	  	<td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
	      </tr>
	      <tr>
	        <td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"21\" border=\"0\"></td>
 	        <td background=\"$img_dir/button_bg.gif\">
                  <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                    <tr>
	              <td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td>
                      <td><img src=\"$img_dir/ico_forum.gif\" alt=\"\" width=\"19\" height=\"19\" border=\"0\" /></td>
                      <td><a href=\"mainmenu.cgi?tabset=0&subtabset=2\" onclick=\"parent.left.location='tree_Links.cgi';parent.right.location='list_Links.cgi';\"><font color=white style=\"text-decoration: none\">Ссылки</a></td>
                      <td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
             	    </tr>
                  </table>
                </td>
                <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
              </tr>
              <tr>
                <td><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
                <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
                <td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
              </tr>
            </table>
          </td>";

}


print "
        </tr>
      </table>
    </td>
    <td background=\"$img_dir/bar_rightbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
  </tr>
</table>

<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td><img src=\"$img_dir/bar_btmleft.gif\" alt=\"\" width=\"5\" height=\"7\" border=\"0\"></td>
    <td width=\"100%\" background=\"$img_dir/bar_btmbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"7\" border=\"0\"></td>
    <td><img src=\"$img_dir/bar_btmright.gif\" alt=\"\" width=\"5\" height=\"7\" border=\"0\"></td>
  </tr>
</table>
</body>
</html>";
