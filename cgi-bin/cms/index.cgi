#!/usr/bin/perl

require "new_config";

#$db_type = 'mysql';		# Тип базы данных
#$db_name = 'cms';		# Имя базы данных
#$db_host = 'localhost';		# Адрес хоста базы данных
#$db_user = 'mysql';		# Логин
#$db_password = 'forummysql1';		# Пароль

use DBI;
use CGI qw/:standart/;
use CGI;
$q=new CGI();

$id_cgi=$q->param('pid');
$action_cgi=$q->param('action');


print ("Content-type: text/html\n\n");

$dbh=DBI->connect("DBI:$db_type:$db_name:$db_host", $db_user, $db_password,);

print "<html><head><title>";

my $sth0 = $dbh->prepare("SELECT ParentID,Name FROM pages WHERE ID='$id_cgi';");
$sth0->execute();


while (@ref0 = $sth0->fetchrow_array()) {
	($parentid0, $name0) = @ref0;
		my $sth1 = $dbh->prepare("SELECT Name FROM pages WHERE ID='$parentid0';");
	$sth1->execute();
  
	while (@ref1 = $sth1->fetchrow_array()) {
		($name1) = @ref1;
		print "$name0 == $name1 ";
	}
	$sth1->finish();
}
$sth0->finish();


print "== Исходники.RU ==</title><link href=\"/style.css\" rel=stylesheet type=text/css></head>";

open HEADER, "top.html";
print <HEADER>;
close(HEADER);


if($id_cgi eq '' || $id_cgi eq '0') {

  print "
<table width=\"770\" border=\"1\" cellpadding=\"7\" cellspacing=\"0\">
  <tr>
    <td width=\"135\" valign=\"top\" bgcolor=\"#f1e5aa\">";

  print "
      <script LANGUAGE=\"JavaScript\"><!--

      function Toggle(node) {
	if (node.nextSibling.style.display == 'none') {
	  // Change the image (if there is an image)
	  if (node.children.length > 0) {
	    if (node.children.item(0).tagName == \"IMG\") {
	      node.children.item(0).src = \"$img_dir/folderopen.gif\";
	    }
	  }
	  node.nextSibling.style.display = '';
	} else {
	  if (node.children.length > 0) 	{
	    if (node.children.item(0).tagName == \"IMG\") {
	      node.children.item(0).src = \"$img_dir/folder.gif\";
	    }
	  }
	  node.nextSibling.style.display = 'none';
	}
      }

      function olka() {}
      </script>";



  $sth0 = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='0' ORDER BY ID;");
  $sth0->execute();
  
  while (@ref0 = $sth0->fetchrow_array()) {
    ($id0, $name0) = @ref0;
    print "
      <table BORDER=\"0\" width=\"175\">
        <tr>
	  <td><a class=blue href=index.cgi?pid=$id0>
	    <img SRC=\"$img_dir/folder.gif\" border=0 width=16 height=15> $name0</a>
            <div>
            <table BORDER=\"0\">";

    my $sth1 = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='$id0' ORDER BY Name;");
    $sth1->execute();
  
    while (@ref1 = $sth1->fetchrow_array()) {
      ($id1, $name1) = @ref1;

      print "
             <tr>
               <td WIDTH=\"0\">\&nbsp;</td>
               <td><a class=blue href=index.cgi?pid=$id1>$name1</a></td>
             </tr>";

    }
    $sth1->finish();

#    if (!@ref1) {
#      print "
#             <tr>
#               <td colspan=\"2\">\&nbsp;</td>
#             </tr>";
#    }

    print "
           </table>
           </div>
         </td>
       </tr>
     </table>";
  }
  $sth0->finish();


#  print "
#	<script LANGUAGE=\"JavaScript\">";
#
#  my $sth0 = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='0' ORDER BY ID;");
#  $sth0->execute();
#  
#  while (@ref0 = $sth0->fetchrow_array()) {
#    ($id0, $name0) = @ref0;
#
#    print "
#	if(aa$id0.nextSibling) {aa$id0.nextSibling.style.display = 'none';}";
#  }
#  $sth0->finish();
#
#  print "
#	</script>\n\n";

  print "
	<br>
	<br><a  class=blue href=index.cgi?action=rating>Популярные<br>страницы</a></td>
	<td valign=\"top\" bgcolor=\"#e5dfbb\">
	  <table border=\"0\" cellspacing=\"3\"><tr><td valign=\"top\">";

  if ( $action_cgi eq 'rating' ) {

    print "<table><tr><td>Ссылка</td><td>Просмотров</td></tr>";

    $sth0=$dbh->prepare("select ID,Hits from rating order by Hits desc limit 20;");
    $sth0->execute || die "SQL-error: select ID,Hits from rating order by Hits desc limit 20;";

    while (@ref0 = $sth0->fetchrow_array()) {
      ($id0, $hits0) = @ref0;

      $sth1=$dbh->prepare("select ID,ParentID,Name from pages where ID='$id0';");
      $sth1->execute || die "?????????? ????????? SQL-??????.";

      while (@ref1 = $sth1->fetchrow_array()) {
        ($id1, $parentid1, $name1) = @ref1;

	$sth2=$dbh->prepare("select ID,Name from pages where ID='$parentid1';");
	$sth2->execute || die "?????????? ????????? SQL-??????.";

	while (@ref2 = $sth2->fetchrow_array()) {
	  ($id2, $name2) = @ref2;

	  print "<tr><td><a class=blue href=index.cgi?pid=$id1>$name1</a> / <a class=blue>($name2)</a></td><td>$hits0</td></tr>";

	}
	$sth2->finish();
      }
      $sth1->finish();
    }
    $sth0->finish();

    print "</table>";

  } else {

    print "Последние добавленные ссылки<br><br>";

    my $sth = $dbh->prepare("SELECT Name,Url,Description,Language,DAYOFMONTH(DateCreate), MONTH(DateCreate) FROM links ORDER BY ID desc LIMIT 15;");
    $sth->execute();

    print "<table>";
 
    while (@ref = $sth->fetchrow_array()) {
      ($name0, $url0, $description0, $language0, $daycreate0, $monthcreate0) = @ref;

      if($monthcreate0 < 10) { $monthcreate0 = "0".$monthcreate0; }

      print "
	<tr>
	  <td valign=\"top\"><a class=\"i\">$daycreate0.$monthcreate0</a></td>
	  <td width=\"700\"><a class=\"blue\" href=\"$url0\" target=_blank>$name0</a> $language0";

      if($description0 ne '') { 
	print "
	  <br> <a class=\"s\"> $description0"; }
        print "
	  <br> <a class=\"i\"> $url0</a> <br><br></td>
	</tr>";
    }

    $sth->finish();

    print "</table>";

  }

  print "</td></tr></table>";

} else {

############################## ????? ???? ???????? ??????? ####################################
############################## ?????????? ???????? #########################################

  $sth0=$dbh->prepare("select ID from rating where ID = '$id_cgi';");
  $sth0->execute || die "?????????? ????????? SQL-??????.";

  while (@ref0 = $sth0->fetchrow_array()) {
    ($id0) = @ref0;

  }
  $sth0->finish();

  if ($id0 eq "") {
    $sth1=$dbh->prepare("Insert into rating Set ID = '$id_cgi', Hits = '1';");
    $sth1->execute || die "?????????? ????????? SQL-??????.";
  } elsif ($id0 ne "") {
    $sth1=$dbh->prepare("Update rating Set Hits = Hits+1 Where ID = '$id_cgi';");
    $sth1->execute || die "?????????? ????????? SQL-??????.";
  }


############################# ????? ?????????? ???????? #####################################


  print "
<table width=\"770\" border=\"1\" cellpadding=\"7\" cellspacing=\"0\">
  <tr>
    <td valign=\"top\" bgcolor=\"#f1e5aa\"><a  class=blue href=index.cgi>Главная</a> / ";

  my $hystory_string;

  my $sth0 = $dbh->prepare("SELECT ID,ParentID,Name FROM pages WHERE ID='$id_cgi';");
  $sth0->execute();
  
  while (@ref0 = $sth0->fetchrow_array()) {
    ($id0, $parentid0, $name0) = @ref0;

    $hystory_string = " <a class=blue href=index.cgi?pid=$id0>$name0</a> / ";

    my $sth1 = $dbh->prepare("SELECT ID,ParentID,Name FROM pages WHERE ID='$parentid0';");
    $sth1->execute();
  
    while (@ref1 = $sth1->fetchrow_array()) {
      ($id1, $parentid1, $name1) = @ref1;

      $hystory_string = " <a class=blue href=index.cgi?pid=$id1>$name1</a> / ".$hystory_string;

      my $sth2 = $dbh->prepare("SELECT ID,ParentID,Name FROM pages WHERE ID='$parentid1';");
      $sth2->execute();
  
      while (@ref2 = $sth2->fetchrow_array()) {
	($id2, $parentid2, $name2) = @ref2;

	$hystory_string = " <a class=blue href=index.cgi?pid=$id2>$name2</a> / ".$hystory_string;

	my $sth3 = $dbh->prepare("SELECT ID,ParentID,Name FROM countries_pages WHERE ID='$parentid2';");
	$sth3->execute();
  
	while (@ref3 = $sth3->fetchrow_array()) {
	  ($id3, $parentid3, $name3) = @ref3;

	  $hystory_string = " <a class=blue href=index.cgi?pid=$id3>$name3</a> / ".$hystory_string;

	}
	$sth2->finish();
      }
      $sth2->finish();
    }
    $sth1->finish();
  }
  $sth0->finish();

  print "$hystory_string</td></tr></table>";



  print "
<table width=\"770\" border=\"1\" cellpadding=\"7\" cellspacing=\"0\">
  <tr>
    <td width=\"135\" valign=\"top\" bgcolor=\"#f1e5aa\">";

  $sth0 = $dbh->prepare("SELECT ParentID, Name, PageText,Type FROM pages WHERE ID='$id_cgi';");
  $sth0->execute();
  
  while (@ref0 = $sth0->fetchrow_array()) {
    ($parentid0, $name0, $pagetext0, $type0) = @ref0;

    print "
<a class=\"blue\">$name0</a><br>";
  }
  $sth0->finish();

  print "\$type0=$type0<hr color=#2259a6>";



############ ????? ?????? ???? ##############################

############# ???? ??????? ?????? ############################
  if ($type0 eq "country") {
    my $sth = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='$id_cgi' and (Type='article' or Type='country chapter') ORDER BY ID;");
    $sth->execute();
  
    while (@ref = $sth->fetchrow_array()) {
      ($id0, $name0) = @ref;
      print "<a class=\"f\" href=index.cgi?pid=$id0>$name0</a><br>";
    }

    $sth->finish();

    print "<hr color=\"#2259a6\"><a class=\"blue\">WWW </a> <hr color=\"#2259a6\">";

    $sth = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='$id_cgi' and Type='link' ORDER BY ID;");
    $sth->execute();
  
    while (@ref = $sth->fetchrow_array()) {
      ($id0, $name0) = @ref;
      print "<a class=\"f\" href=index.cgi?pid=$id0>$name0</a><br>";
    }

    $sth->finish();
  }

####################### ???? ?????? ??????? ????????? ?????? ???? article ??? link #####################
  elsif ($type0 eq "article" || $type0 eq "link") {
    my $sth0 = $dbh->prepare("SELECT ID FROM pages WHERE ID='$parentid0' ORDER BY ID;");
    $sth0->execute();
  
    while (@ref0 = $sth0->fetchrow_array()) {
      ($id0) = @ref0;

      my $sth1 = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='$id0' and (Type='article' or Type='country chapter') ORDER BY ID;");
      $sth1->execute();
  
      while (@ref1 = $sth1->fetchrow_array()) {
	($id1, $name1) = @ref1;
	print "<a class=\"f\" href=index.cgi?pid=$id1>$name1</a><br>";
      }
      $sth1->finish();
    }
    $sth0->finish();

    print "<hr color=\"#2259a6\"><a class=\"blue\">WWW </a> <hr color=\"#2259a6\">";

    $sth = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='$id0' and Type='link' ORDER BY ID;");
    $sth->execute();
  
    while (@ref = $sth->fetchrow_array()) {
      ($id0, $name0) = @ref;
      print "<a class=\"f\" href=index.cgi?pid=$id0>$name0</a><br>";
    }

    $sth->finish();
  }


####################### ???? ?????? ????????? ?????? ???? country chapter #####################
  elsif ($type0 eq "country chapter") {

    $sth = $dbh->prepare("SELECT ID,Name FROM pages WHERE ParentID='$id0' ORDER BY ID;");
    $sth->execute();
  
    while (@ref = $sth->fetchrow_array()) {
      ($id0, $name0) = @ref;
      print "<a class=\"f\" href=index.cgi?pid=$id0>$name0</a><br>";
    }

    $sth->finish();
  }

######################### ???? ?????? ??????? #######################
  elsif ($type0 eq "materik") {

    my $sth = $dbh->prepare("SELECT ID,Name FROM pages WHERE ((ParentID='$id_cgi') and (Type='country')) ORDER BY Name;");
    $sth->execute();
  
    while (@ref = $sth->fetchrow_array()) {
      ($id0, $name0) = @ref;
      print "<a class=\"f\" href=index.cgi?pid=$id0>$name0</a><br>";
    }
    $sth->finish();

  }


##################### ????? ???????????? ??????? #####################


  print "</td><td valign=\"top\" bgcolor=\"#e5dfbb\"><table border=\"0\" cellspacing=\"3\"><tr><td valign=\"top\">";

  if ($type0 eq 'materik') {

    $sth = $dbh->prepare("SELECT PageText FROM pages WHERE ID='$id_cgi';");
    $sth->execute();

    while (@ref = $sth->fetchrow_array()) {
      ($pagetext0) = @ref;

      print $pagetext0;

    }
    $sth->finish();

  }
  elsif ($type0 eq 'link') {

    my $sth = $dbh->prepare("SELECT Name,Url,Description,Language FROM links WHERE ParentID='$id_cgi' ORDER BY Prior desc;");
    $sth->execute();
 
    print "<table>";
 
    while (@ref = $sth->fetchrow_array()) {
      ($name0, $url0, $description0, $language0) = @ref;

      print "<tr><td width=\"600\"><a class=\"blue\" href=\"$url0\" target=_blank><p align=\"justify\">$name0</a> $language0";
      if($description0 ne '') { print "<br> <a class=\"s\"> $description0"; }
	print "<br> <a class=\"i\"> $url0</a> <br><br></p></td></tr>";

      }
      $sth->finish();

      print "</table>";

    }
    elsif($type0 eq 'article' || $type0 eq 'country chapter') {

      print "$pagetext0";

    }
    elsif($type0 eq 'country') {

      print "$pagetext0";

      print "<table>";

      $sth1=$dbh->prepare("select Name,Url,Description,Language from links where CountryID='$id_cgi' order by ID desc limit 5;");
      $sth1->execute;

      while (my @row1=$sth1->fetchrow_array())  {

	($name1, $url1, $description1, $language1) = @row1;

	print "<tr><td width=\"600\"><a class=\"blue\" href=\"$url1\" target=_blank><p align=\"justify\">$name1</a> $language1";
	if($description1 ne '') { print "<br> <a class=\"s\"> $description1"; }
	print "<br> <a class=\"i\"> $url1</a> <br><br></p></td></tr>";

      }
      $sth1->finish();

      print "</table>";

    }
    print "</td></tr></table>";

  }

  $dbh->disconnect();

  print "<td width=\"130\" valign=\"top\" class=\"right\">";

  open HEADER, "bottom.htm";
  print <HEADER>;
  close(HEADER);

#print "</td></tr></table>";

#print "</body></html>";


