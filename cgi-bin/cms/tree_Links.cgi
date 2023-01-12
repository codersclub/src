#!/usr/bin/perl

require "new_config";

use DBI;

$dbh=DBI->connect("DBI:$db_type:$db_name:$db_host", $db_user, $db_password,);

print ("Content-type: text/html\n\n");

print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
<meta http-equiv=\"Cache-Control\" content=\"no-cache\">
<link rel=\"StyleSheet\" href=\"$cms_dir/tree.css\" type=\"text/css\">
<link rel=\"styleSheet\" href=\"$cms_dir/explorer.css\" type=\"text/css\">
<script type=\"text/javascript\" src=\"$cms_dir/tree.js\"></script><script type=\"text/javascript\">
      <!--
        var Tree = new Array;
        //// nodeId | parentNodeId | nodeName | nodeColor | type | id\n";



$count = 0;
$count_tree1 = 0;
$count_tree2 = 0;
$count_tree3 = 0;


	$sth0=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='0';");
	$sth0->execute || die "Невозможно выполнить SQL-запрос.";

	while(my @row0=$sth0->fetchrow_array())  {
#		$count++;
#		$count_tree1 = $count;
		($id0, $name0, $parentid0) = @row0;
#		print "Tree[$count-1] =\"$count|$parentid0|$name0||folder|$id0\";\n";


		$sth1=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id0';");
		$sth1->execute;

		while(my @row1=$sth1->fetchrow_array())  {
			$count++;
			$count_tree2 = $count;
			($id1, $name1, $parentid1) = @row1;
			print "Tree[$count-1] =\"$count|$count_tree1|$name1||folder|$id1\";\n";


			$sth2=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id1' and Type='link';");
			$sth2->execute;

			while(my @row2=$sth2->fetchrow_array())  {
				$count++;
				$count_tree3 = $count;
				($id2, $name2, $parentid2) = @row2;
				print "Tree[$count-1] =\"$count|$count_tree2|$name2||folder|$id2\";\n";

				$sth3=$dbh->prepare("select ID,Name,ParentID from pages where ParentID='$id2';");
				$sth3->execute;

				while(my @row3=$sth3->fetchrow_array())  {
					$count++;
					($id3, $name3, $parentid3) = @row3;
					print "Tree[$count-1] =\"$count|$count_tree3|$name3||folder|$id3\";\n";

				}
				$sth3->finish();
			}
			$sth2->finish();
		}
		$sth1->finish();
	}
	$sth0->finish();

$dbh->disconnect();



print "--></script><script language=\"javascript\">
      function getDateFilterString()
      {
	    return 'from_ts='+date.from_ts_year.value+date.from_ts_month.value+date.from_ts_day.value+'000000;till_ts='+date.till_ts_year.value+date.till_ts_month.value+date.till_ts_day.value+'235959;';
      }
			      
      function edit()
      {
        if (!cur_type || cur_cid==0) {
          alert('Выберите элемент для редактирования');
        } else if (cur_type == 'folder') {
          parent.right.location = 'list_Links.cgi?ParentID='+cur_cid;
        } else if (cur_type == 'item') {
          parent.right.location = 'list_Links.cgi?ParentID='+cur_cid;
        }
      }
      
      function reload()
      {
            window.location='?page=tree_Links;items_fid=0';
      }
      
      function add_image(link, slink, alt, w, h, id, lw, lh){
	    glob_link=link;
	    glob_slink=slink;
	    glob_alt=alt;
	    glob_w=w;
	    glob_h=h;
	    glob_id=id;
	    glob_lw=lw;
	    glob_lh=lh;
	    
	    Pop=window.open('/popup.html','new','width=300,height=200,locatopn=0,menubar=0,resizable=0,scrollbars=0,status=1,toolbar=0,screenX=300,screenY=250,left=100,top=50');
      }

      function new_folder()
      {
//        if (!cur_type || cur_type == 'title') {
//          alert('???????? ??????, ? ??????? ????????? ?????????');
//        }  else {
          parent.right.location = 'edit_Link.cgi?action=new&ParentID='+cur_cid;
//        }
      }

      function new_news()
      {
        if (!cur_type || cur_type == 'title' || cur_cid == 0) {
          alert('???????? ?????');
        } else {
          parent.right.location = '?page=edit_Link;ParentID='+cur_cid;
        }
      };

      function show_news()
      {
        if (!cur_type || cur_type == 'title' || cur_cid == 0 ) {
          alert('???????? ??????');
        } else {
          parent.left.location = '?page=tree_Links;items_fid='+cur_cid;
          parent.right.location = '?page=list_Links;ParentID='+cur_cid;
        }
      };

      function getFolderCid()
      {
        if (!cur_type || cur_type == 'title') {
          return 0;
        } else {
          return cur_cid;
        }
      };


      function delete_item()
      {
        if (!cur_type || cur_cid==0) {
          alert('Выберите папку или документ');
        } else if (confirm(\"Вы действительно хотите удалить этот объект ?\")) {
          if (cur_type == 'folder') {
            parent.right.location = 'list_Links.cgi?action=delete&ID='+cur_cid;
          } else if (cur_type == 'item') {
            parent.right.location = 'list_Links.cgi?action=delete&ID='+cur_cid;
          }
        }	
      };

      function item_preview()
      {
        if (!cur_type || cur_cid==0) {
          parent.right.location = 'http://212.83.24.28/index.cgi?page=jump';
        } else if (cur_type == 'folder') {
          parent.right.location = 'http://212.83.24.28/index.cgi?page=jump;type=folder;cid='+cur_cid;
        } else {
          parent.right.location = 'http://preview.itass.ru/index.cgi?page=jump;type=title;tid='+cur_cid;
        }
      };

      function item_publish()
      {
        if (!cur_type || cur_cid==0 || cur_type == 'folder') {
          alert('???????? ????????');
        } else {
          parent.left.location = '?page=tree_Pages;categtype=@(/categtype)@;cid=@(/cid)@;ts=@(/ts)@;publish_tid='+cur_cid+'';
        }
      };
      </script><script language=\"JavaScript\" src=\"$cms_dir/hpmain.js\"></script>
</head>
<body bgcolor=\"#4587D8\" leftmargin=\"0\" topmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";



print "<br><table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td><img src=\"$img_dir/bar_topleft_cl.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
<td background=\"$img_dir/bar_topbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"14\" border=\"0\"></td>
<td width=\"100%\" background=\"$img_dir/bar_topbg_cl.gif\"><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
<td><img src=\"$img_dir/bar_topright_cl.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
</tr></table>

<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td background=\"$img_dir/bar_leftbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"13\" border=\"0\"></td>
<td colspan=\"2\" width=\"100%\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td>
<td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">
<tr>
<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
<td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
</tr>
<tr>
<td bgcolor=\"white\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"21\" border=\"0\"></td>
<td><a onclick=\"new_folder()\" style=\"cursor: hand\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width: 100%\"><tr>
<td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td>
<td><img src=\"$img_dir/ico_addfolder.gif\" alt=\"\" width=\"20\" height=\"19\" border=\"0\"></td>
<td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td>
<td><font color=\"white\" class=\"smaller\">Нов.ссылка</font></td>
<td><img src=\"$img_dir/pix.gif\" width=\"5\" height=\"14\" border=\"0\"></td>
</tr></table></a></td>
<td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
</tr>
<tr>
<td><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
<td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
<td bgcolor=\"black\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"1\" border=\"0\"></td>
</tr>
</table></td>
<td><img src=\"$img_dir/pix.gif\" width=\"8\" height=\"14\" border=\"0\"></td>
<td></td>
</tr></table></td>
<td background=\"$img_dir/bar_rightbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
</tr></table>
<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td background=\"$img_dir/bar_leftbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>
<td colspan=\"2\" width=\"100%\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"8\" border=\"0\"></td></tr></table></td>
<td background=\"$img_dir/bar_rightbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"1\" border=\"0\"></td>
</tr></table>
<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td background=\"$img_dir/bar_leftbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"13\" border=\"0\"></td>
<td colspan=\"2\" width=\"100%\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\"><tr>
<td><img src=\"$img_dir/pix.gif\" width=\"6\" height=\"14\" border=\"0\"></td>
<td><a style=\"cursor: hand\" onclick=\"edit()\"><img src=\"$img_dir/ico_properties.gif\" alt=\"Показать раздел\" width=\"16\" height=\"13\" border=\"0\"></a></td>
<td><img src=\"$img_dir/pix.gif\" width=\"7\" height=\"14\" border=\"0\"></td>
<td><img src=\"$img_dir/dash_small.gif\" alt=\"\" width=\"2\" height=\"19\" border=\"0\"></td>
<td><img src=\"$img_dir/pix.gif\" width=\"7\" height=\"14\" border=\"0\"></td>
<td><a style=\"cursor: hand\" onclick=\"reload()\"><img src=\"$img_dir/ico_refresh.gif\" alt=\"Обновить\" width=\"15\" height=\"13\" border=\"0\"></a></td>
</tr></table></td>
<td background=\"$img_dir/bar_rightbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
</tr></table>
<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td><img src=\"$img_dir/bar_btmleft.gif\" alt=\"\" width=\"5\" height=\"7\" border=\"0\"></td>
<td width=\"100%\" background=\"$img_dir/bar_btmbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"7\" border=\"0\"></td>
<td><img src=\"$img_dir/bar_btmright.gif\" alt=\"\" width=\"5\" height=\"7\" border=\"0\"></td>
</tr></table>
<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td><img src=\"$img_dir/bar_topleft_cl.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
<td background=\"$img_dir/bar_topbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"14\" border=\"0\"></td>
<td width=\"100%\" background=\"$img_dir/bar_topbg_cl.gif\"><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"14\" border=\"0\"></td>
<td><img src=\"$img_dir/bar_topright_cl.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
</tr></table>
<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td background=\"$img_dir/bar_leftbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"13\" border=\"0\"></td>
<td colspan=\"2\" width=\"100%\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td><img src=\"$img_dir/pix.gif\" width=\"10\" height=\"1\" border=\"0\"></td>
<td><font color=\"white\" class=\"big\">Ссылки</font></td>
</tr></table></td>
<td background=\"$img_dir/bar_rightbg.gif\"><img src=\"$img_dir/pix.gif\" alt=\"\" width=\"5\" height=\"14\" border=\"0\"></td>
</tr></table>
<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr>
<td><img src=\"$img_dir/bar_btmleft.gif\" alt=\"\" width=\"5\" height=\"7\" border=\"0\"></td>
<td width=\"100%\" background=\"$img_dir/bar_btmbg.gif\"><img src=\"$img_dir/pix.gif\" width=\"1\" height=\"7\" border=\"0\"></td>
<td><img src=\"$img_dir/bar_btmright.gif\" alt=\"\" width=\"5\" height=\"7\" border=\"0\"></td>
</tr></table>";



print "<table width=\"222\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td width=\"100%\" align=\"center\"><div id=\"scroll\" style=\"position: relative; overflow-x:hidden; overflow-y:scroll; overflow-x:scroll; width:215px; height:200px\"><table width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"12\" bgcolor=\"#DCEBF6\"><tr><td valign=\"top\">
	<div id=\"tree\"><script type=\"text/javascript\">
                createTree(Tree, 11, \"ссылки\", 0);
              </script></div></td></tr></table></div></td></tr></table>
<br><br>
</body>
</html>";


