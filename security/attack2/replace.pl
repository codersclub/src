#!/usr/bin/perl

$startmask = qq~<\!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<title>\$title</title>
<meta name="keywords" content="">
<meta name="description" content="">
<\!\-\-#include virtual\="/ssi/top2\.html"\-\->
<h1>¿“¿ ¿ Õ¿ INTERNET</h1>
~;

@tokill =   ("\r", 
             "<tbody>", 
             "<\/tbody>",
             "<link rel\=\"STYLESHEET\" .* type\=\"text/css\">",
		"<html>(.+?)<div class\=l align\=left>"

#             "<html>(.+?)<body[^>]*>"
#             " bgcolor\=\"\#ffffff\""

	    );

@toreplace = (
        ["<strong>",	"<b>"],
        ["</strong>",	"</b>"],
        ["<em>",	"<i>"],
        ["</em>",	"</i>"],
        ["<BODY BGCOLOR\=\"lightsteelblue\">", "<body>"],
	["<div align\=\"center\"><center>", "<div align\=\"center\">"],
	["</center></div>", "</div>"],
        ["<a href\=\"http://bugtraq\.ru/library/books/attack/preface/index\.html\"","<a href\=\"index-2\.htm\""]
             );


#    for ($i = 0; $i < scalar(@tokill); $i++) {
#      $repstr = $tokill[$i];
#print "   \"$repstr\"\n";
#    }

#$t = <>;

#    for ($i = 0; $i < scalar(@toreplace); $i++) {
#      $repstr = $toreplace[$i][0];
#      $newstr = $toreplace[$i][1];
#print "   \"$repstr\" -\> \"$newstr\"\n";
#    }

#$t = <>;
#exit;

opendir(DIR, ".");
@files = sort(grep(/\.s*html*$/, readdir(DIR)));
#@files = sort(grep(/\.s*tst$/, readdir(DIR)));
closedir(DIR); 	                #


@files = sort(@files);

$i = 0;       #

foreach $filename(@files) {

  chomp($filename);
#print "$filename\n";

  $bakname = $filename;
  $bakname =~ s/\.(.+?)$//;
  $bakname .= '.bak';

  $title = "";
  $changed=0;
  $header =0;

  open(ORD,"<./$filename") || die("Can't open the $filename\n");
  @lines = <ORD>;
  close(ORD);
  $lines = join("",@lines);
  $save = $lines;
 

  while (empty($lines[0])) { 
    shift @lines;             # kill start empty strings
    $changed=1;
  }


#  $lines[0] =~ s/^\s+//;
#  $lines[0] =~ s/\s+$/\n/;
#  $lines[0] =~ s/<B>\s*([A-Za-z\s\-\w\,\/\.]+)<\/B>/$1/;

    if ($lines =~ m#^\<\!DOCTYPE#i) {
      $header=1;
    }



    ($title) = ($lines =~ m#<title>(.*?)</title>#is);

    if ($title =~ m#BugTraq\.Ru:\s(.+?)$#is) {
      $title = $1;
      $changed=1;
    }

    if ($title eq "") {($title) = ($lines =~ m#<h1 align\="center">\s*(.*?)\s*</h1>#is);};

    if ($title eq "") {
      if ($lines =~ m#<h1>\s*(.+?)\s*</h1>#is) {
        $title = $1;
        $title =~ s#<\w.*>##ig;
        $title =~ s#</\w.*>##ig;
        $lines =~ s#<h1>\s*(.+?)\s*</h1>#<h1>$title</h1>#is;
        $changed=1;
      }
    }
    if ($title eq "") {($title) = ($lines =~ m#<h2 align\="center">\s*(.*?)\s*</h2>#is)};
    if ($title eq "") {($title) = ($lines =~ m#<h2>\s*(.*?)\s*</h2>#is)};

    if ($title eq "") {
      if ($lines =~ m#<strong><big><big><big>\s*(.*?)\s*</big></big></big></strong>#is) {
        $title = $1;
        $lines =~ s#<strong><big><big><big>\s*(.*?)\s*</big></big></big></strong>#<h1>$1</h1>#is;
        $changed=1;
      }
    }
    if ($title eq "") {
      if ($lines =~ m#<b><font size\=\"3\">\s*(.+?)\s*</font></b>#is) {
        $title = $1;
        $title =~ s#</*\w.*>##ig;
        $lines =~ s#<b><font size\=\"3\">\s*(.+?)\s*</font></b>#<h1>$1</h1>#is;
        $changed=1;
      }
    }
    if ($title eq "") {
      if ($lines =~ m#<font size\=\"3\">\s*(.+?)\s*</font>#is) {
        $title = $1;
        $title =~ s#<\w.*>##ig;
        $title =~ s#</\w.*>##ig;
        $lines =~ s#<font size\=\"3\">\s*(.+?)\s*</font>#<h1>$title</h1>#is;
        $changed=1;
      }
    }
    if ($title eq "") {
      if ($lines =~ m#<font size\=\"3\">\s*(.+?)\s*</font>#is) {
        $title = $1;
        $lines =~ s#<font size\=\"3\">\s*(.+?)\s*</font>#<h1>$1</h1>#is;
        $changed=1;
      }
    }
    if ($title eq "") {
      if ($lines =~ m#<h3 align\=\"center\">\s*(.+?)\s*</h3>#is) {
        $title = $1;
        $title =~ s#</*\w.*>##ig;
        $lines =~ s#<h3 align\=\"center\">\s*(.+?)\s*</h3>#<h1>$title</h1>#is;
        $changed=1;
      }
    }
    if ($title eq "") {
      if ($lines =~ m#<h3>\s*(.+?)\s*</h3>#is) {
        $title = $1;
        $title =~ s#</*\w.*>##ig;
        $lines =~ s#<h3>\s*(.+?)\s*</h3>#<h1>$title</h1>#is;
        $changed=1;
      }
    }


    $title =~ s/\s+/ /ig;
    $title =~ s#</*\w.*>##ig;
    $title =~ s/\s+/ /ig;
    if ($title eq "") {$title = "No title"};





    ##############################################################
    # Kill not needed lines


    for ($i = 0; $i < scalar(@tokill); $i++) {
      $killstr=$tokill[$i];
      chomp($killstr);
      if ($lines =~ m~$killstr~is) {
        $lines =~ s~$killstr~~igs;
	#$killstr =~ s~\r~\\r~;
	#print "   $killstr removed.\n";
        $changed=1;
      }
    }


      if ($lines =~ m~\s*<br>\s*<p align\=right class\=smallr>\s*(.+?)<table align\="center" cellspacing\="0" cellpadding\="0">~is) {
        $lines =~ s~s*<br>\s*<p align\=right\sclass\=smallr>\s*(.+?)<table align\="center" cellspacing\="0" cellpadding\="0">~<table align\="center" cellspacing\="0" cellpadding\="0">~igs;
        $changed=1;
      }


#      if ($lines =~ m~</div>\s*</td>\s*<td width\=5>(.+?)<table align\="center" cellspacing\="0" cellpadding\="0">~is) {
#        $lines =~ s~</div>\s*</td>\s*<td width\=5>(.+?)<table align\="center" cellspacing\="0" cellpadding\="0">~<table align\="center" cellspacing\="0" cellpadding\="0">~igs;
#        $changed=1;
#      }

      if ($lines =~ m~</table>\s*<br>\s*<center>\s*<table width\=468 bgcolor\="#6E767E"(.+?)$~is) {
        $lines =~ s~</table>\s*<br>\s*<center>\s*<table width\=468 bgcolor\="#6E767E"(.+?)$~</table>\n~igs;
        $changed=1;
      }





    ##############################
    # Replace some stuff

    for ($i = 0; $i < scalar(@toreplace); $i++) {
      $repstr = $toreplace[$i][0];
      $newstr = $toreplace[$i][1];
      chomp($repstr);
      chomp($newstr);
      $repstr =~ s~\$~\\\$~g;
      $repstr =~ s~\.~\\\.~g;
      $repstr =~ s~\*~\\\*~g;
      $repstr =~ s~\=~\\\=~g;
      $repstr =~ s~\-~\\\-~g;
      $repstr =~ s~\+~\\\+~g;
      $repstr =~ s~\"~\\\"~g;
      $repstr =~ s~\[~\\\[~g;
      $repstr =~ s~\]~\\\]~g;
      $repstr =~ s~\(~\\\(~g;
      $repstr =~ s~\)~\\\)~g;
      if ($lines =~ m~$repstr~i) {
        $lines =~ s~$repstr~$newstr~eig;
	#print "   $repstr -\> $newstr\n";
        $changed=1;
      }
    }



    ##############################
    # Kill FrontPage stuff

    if ($lines =~ m#<font face\=\"Arial,Helvetica,Verdana\">(.+?)</font>#is) {
      $lines =~ s#<font face\=\"Arial,Helvetica,Verdana\">(.+?)</font>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<font face\=\"Arial,Helvetica,Verdana\" size\=\"2\">(.+?)</font>#is) {
      $lines =~ s#<font face\=\"Arial,Helvetica,Verdana\" size\=\"2\">(.+?)</font>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<p align="left">\s*(.+?)\s*</p>#is) {
      $lines =~ s#<p align="left">\s*(.+?)\s*</p>#$1#igs;
      $changed=1;
    }
    
    if ($lines =~ m#<font size\=\"2\">\s*(.+?)\s*</font>#is) {
      $lines =~ s#<font size\=\"2\">\s*(.+?)\s*</font>#$1#igs;
      $changed=1;
    }
    
    while ($lines =~ m#<span\s*class\="verdana">(.+?)</span>#is) {
      $lines =~ s#<span\s*class\="verdana">(.+?)</span>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<font class\="verdana" face\="Verdana" size\="\-1">(.+?)</font>#is) {
      $lines =~ s#<font class\="verdana" face\="Verdana" size\="\-1">(.+?)</font>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<font size\="\-1" face\="Verdana">(.+?)</font>#is) {
      $lines =~ s#<font size\="\-1" face\="Verdana">(.+?)</font>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<font\s*face\="Times New Roman"\s*size\="4">(.+?)</font>#is) {
      $lines =~ s#<font\s*face\="Times New Roman"\s*size\="4">(.+?)</font>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<font\s*size\="4">(.+?)</font>#is) {
      $lines =~ s#<font\s*size\="4">(.+?)</font>#$1#igs;
      $changed=1;
    }

    if ($lines =~ m#<font\s*face\="Times New Roman,Times"\s*size\="-1">(.+?)</font>#is) {
      $lines =~ s#<font\s*face\="Times New Roman,Times"\s*size\="-1">(.+?)</font>#$1#igs;
      $changed=1;
    }


    ###############################
    # Kill Teleport stuff



    # <a href="tppmsgs/msgs0.htm#21" tppabs="http://www.nsa.gov:8080/">
    # <a href="tppmsgs/msgs0.htm#1" tppabs="http://www.hackzone.ru/windows/attack/">
    # <a href="tppmsgs/msgs0.htm#7" tppabs="http://www.ssl.stu.neva.ru/psw/" target="_blank">
    if ($lines =~ m~<a href\="(tppmsgs/msgs\d*\.htm#\d*)" tppabs\="(http://[^"]+)"([^>]*)>~is) {
      $lines =~ s~<a href\="(tppmsgs/msgs\d*\.htm#\d*)" tppabs\="(http://[^"]+)"([^>]*)>~<a href="$2"$3>~igs;
      $changed=1;
#      print qq~found1: <a href\="(tppmsgs/msgs\d*\.htm#\d*)" tppabs\="(http://[\w\d\./\-_]+)">~,"\n";
#$tmp = <>
    }


    # <a href="toc.html" tppabs="http://rus-linux.net/MyLDP/BOOKS/ATTACK/toc.html">
    if ($lines =~ m~<a\shref\="([^"]+)"\stppabs\="http://[^"]+"([^>]*)>~is) {
#      print qq~found2: <a\shref\="([^"]+)"\stppabs\="http://[^"]+"([^>]*)>~,"\n";
      $lines =~ s~<a\shref\="([^"]+)"\stppabs\="http://[^"]+"([^>]*)>~<a href\="$1"$2>~igs;
      $changed=1;
#$tmp = <>
    }

    # <a href="http://www.linkexchange.ru/users/000648/goto.map" tppabs="http://www.linkexchange.ru/users/000648/goto.map" target="_top">
    if ($lines =~ m~<a\shref\="(http://[^"]+)"\stppabs\="http://[^"]+"([^>]*)>~is) {
#      print qq~found2: <a\shref\="([^"]+)"\stppabs\="http://[^"]+"*>~,"\n";
      $lines =~ s~<a\shref\="([^"]+)"\stppabs\="http://[^"]+"([^>]*)>~<a href\="$1"$2>~igs;
      $changed=1;
#$tmp = <>
    }

    # <img src="dot.gif" tppabs="http://rus-linux.net/MyLDP/BOOKS/ATTACK/images/dot.gif" width=10 height=1 border="0">
    # <img src="dot.gif" tppabs="http://rus-linux.net/MyLDP/BOOKS/ATTACK/images/dot.gif" width=10 height=1 border="0">
    # <img ismap src="rle.cgi-000648" tppabs="http://www.linkexchange.ru/cgi-bin/rle.cgi?000648" alt="RLE Banner Network" border="0" height="60" width="468">
    while ($lines =~ m~<img(.*?)src\="([^"]+)"\stppabs\="(http://[^"]+)"\s(.+?)>~is) {
#      print qq~found2: <img src\="([^"]+)"\stppabs\="http://[^"]+"\s(.+?)>~,"\n";
#      print qq~found2: <img src\="$1" tppabs\="$2" $3>~,"\n";
      $lines =~ s~<img(.*?)src\="([^"]+)"\stppabs\="(http://[^"]+)"\s(.+?)>~<img$1src\="$2" $4>~is;
#      print qq~found2: $1 $2 $3~,"\n";
      $changed=1;
#$tmp = <>
    }


    ###############################
    # Kill Banner stuff

    #<tr>
    #<td align="center" bgcolor="#888888">
    #<table border="0" cellspacing="0" cellpadding="2" align="CENTER" bgcolor="black" align="center" width="470">
    #<tr><td valign="middle" align="left">
    #<a href="http://www.linkexchange.ru/users/000648/goto.map" tppabs="http://www.linkexchange.ru/users/000648/goto.map" target="_top"> <img ismap src="rle.cgi-000648" tppabs="http://www.linkexchange.ru/cgi-bin/rle.cgi?000648" alt="RLE Banner Network" border="0" height="60" width="468"></a>
    #
    #</td></tr></table>
    #</td>
    #</tr>

    if ($lines =~ m~<tr>\n*<td align\="center" bgcolor\="#888888">(.+?)</td></tr></table>\n*</td>\n*</tr>~is) {
      $lines =~ s~<tr>\n*<td align\="center" bgcolor\="#888888">(.+?)</td></tr></table>\n*</td>\n*</tr>~~igs;
      $changed=1;
#      print qq~found1: <a href\="(tppmsgs/msgs\d*\.htm#\d*)" tppabs\="(http://[\w\d\./\-_]+)">~,"\n";
#$tmp = <>
    }


    # <a href="http://www.hackzone.ru/rc5/"><img src="rc5-100x100.gif" border="0" width="100" height="100" border="0"></a>
    if ($lines =~ m~<a href\="http://www\.hackzone\.ru/rc5/"><img src\="rc5-100x100\.gif" border\="0" width\="100" height\="100" border\="0"></a>~is) {
      $lines =~ s~<a href\="http://www\.hackzone\.ru/rc5/"><img src\="rc5-100x100\.gif" border\="0" width\="100" height\="100" border\="0"></a>~~igs;
      $changed=1;
    }

    #<br>
    #<a href="http://counter.rambler.ru/top100/"><img src="rambler.gif" alt="Rambler's Top100" width=88 height=31 border=0></a>
    #<a href="tppmsgs/msgs0.htm#5" tppabs="http://counter.rambler.ru/top100/"><img src="rambler.gif" tppabs="http://rus-linux.net/MyLDP/BOOKS/ATTACK/rambler.gif" alt="Rambler's Top100" width=88 height=31 border=0></a>
    #<br>

    if ($lines =~ m~<br>\s*<a href="http://counter\.rambler\.ru/top100/"><img [^>]+></a>\s*<br>~is) {
      $lines =~ s~<br>\s*<a href="http://counter\.rambler\.ru/top100/"><img [^>]+></a>\s*<br>~~igs;
      $changed=1;
    }


    ###############################
    # Kill all the codepage links

    #<a href="tppmsgs/msgs0.htm#1" tppabs="http://www.hackzone.ru/windows/attack/"><font size="1" color="white">win</font></a>
    #<a href="tppmsgs/msgs0.htm#2" tppabs="http://www.hackzone.ru/koi8/attack/"><font size="1" color="white">koi</font></a>
    #<a href="tppmsgs/msgs0.htm#3" tppabs="http://www.hackzone.ru/msdos/attack/"><font size="1" color="white">dos</font></a>
    #<a href="tppmsgs/msgs0.htm#4" tppabs="http://www.hackzone.ru/mac/attack/"><font size="1" color="white">mac</font></a>
    while ($lines =~ m~<a\shref\=[^>]+><font [^>]+>(win|koi|dos|mac)</font></a>~is) {
      $lines =~ s~a\shref\=[^>]+><font [^>]+>(win|koi|dos|mac)</font></a>~\&nbsp;~igs;
      $changed=1;
    }


    ##########################################
    # Replace the End of the doc by standard footer

    $lines =~ s~</body>\s*</html>~<\!\-\-#include virtual\=\"/ssi/bottom\.html\"\-\->~is;
	


#     $line =~ s~(\b[A-Z\_\-\d]+)</B>~<a href="$ltmp.htm">~;   
   

#  exit;

  if ($changed) {
    
   
    open(ORD,">./$bakname") || die("Can't rewrite the $bakname\n");
    print ORD $save;
    close(ORD);

    $start = $startmask;
    $start =~ s~\$title~$title~ig;

    
    open(ORD,">./$filename") || die("Can't rewrite the $filename\n ");
    
    print ORD $start if (!$header);
    
    print ORD $lines;
    close(ORD);


    print "$filename - $title\n";
    $tmp = <>;
#    print "\n";
  } # if changed
}  # foreach filename

exit;

####################################
sub empty {
 ($tmp) = @_;
 chomp($tmp);
 $tmp =~ s/\s//g;
 return 1 if ($tmp eq ''); 
 return 0;
}

