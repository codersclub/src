#!/usr/bin/perl

$startmask = qq~<\!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head>
<title>\$title</title>
<meta name="keywords" content="">
<meta name="description" content="">
~;

@tokill =   ("\r", "<tbody>", "<\/tbody>"
	    );

@toreplace = (
        ["<strong>",	"<b>"],
        ["</strong>",	"</b>"],
        ["<em>",		"<i>"],
        ["</em>",	"</i>"],
        ["\=\"msdn/",	"\=\"/msdn/"],
	["\"t1.gif",	"\"/img/t1.gif"],
        ["\"rt.gif",	"\"/img/rt.gif"],
	["<div align\=\"center\"><center>", "<div align\=\"center\">"],
	["</center></div>", "</div>"],
	["href\=\"http://www\.sources\.ru/", "href\=\"/"],
	["<\!\-\-\#include virtual\=\"/ssi/top\.html\"\-\->",  "<\!\-\-#include virtual\=\"/ssi/top2\.html\"\-\->"]

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
@files = sort(grep(/\.s*html$/, readdir(DIR)));
#@files = sort(grep(/\.s*tst$/, readdir(DIR)));
closedir(DIR); 	                #


$i = 0;       #

foreach $filename(@files) {

  chomp($filename);
#print "$filename\n";

  $title = "";
  $changed=0;
  $header =0;

  open(ORD,"<./$filename") || die("Can't open the $filename\n");
  @lines = <ORD>;
  close(ORD);
  $lines = join("",@lines);
  $save = $lines;
 

#  if (empty($lines[0])) {
#    while (empty($lines[0])) { shift @lines } # kill start empty strings
#    $changed=1;
#  }


#  $lines[0] =~ s/^\s+//;
#  $lines[0] =~ s/\s+$/\n/;
#  $lines[0] =~ s/<B>\s*([A-Za-z\s\-\w\,\/\.]+)<\/B>/$1/;

    if ($lines =~ m#^\<\!DOCTYPE#i) {
      $header=1;
    }



    ($title) = ($lines =~ m#<title>(.*?)</title>#is);

    if ($title eq "") {($title) = ($lines =~ m#<h1 align\="center">\s*(.*?)\s*</h1>#is);};

    if ($title eq "") {
      if ($lines =~ m#<h1>\s*(.+?)\s*</h1>#is) {
        $title = $1;
#        $title .= "XXXXXXXXXXX";
        $title =~ s#<\w.*>##ig;
        $title =~ s#</\w.*>##ig;
        $lines =~ s#<h1>\s*(.+?)\s*</h1>#<h1>$title</h1>#is;
        $changed=1;
      }
    };
    if ($title eq "") {($title) = ($lines =~ m#<h2 align\="center">\s*(.*?)\s*</h2>#is)};
    if ($title eq "") {($title) = ($lines =~ m#<h2>\s*(.*?)\s*</h2>#is)};

    if ($title eq "") {
      if ($lines =~ m#<strong><big><big><big>\s*(.*?)\s*</big></big></big></strong>#is) {
        $title = $1;
        $lines =~ s#<strong><big><big><big>\s*(.*?)\s*</big></big></big></strong>#<h1>$1</h1>#is;
        $changed=1;
      }
    };
    if ($title eq "") {
      if ($lines =~ m#<b><font size\=\"3\">\s*(.+?)\s*</font></b>#is) {
        $title = $1;
        $title =~ s#</*\w.*>##ig;
        $lines =~ s#<b><font size\=\"3\">\s*(.+?)\s*</font></b>#<h1>$1</h1>#is;
        $changed=1;
      }
    };
    if ($title eq "") {
      if ($lines =~ m#<font size\=\"3\">\s*(.+?)\s*</font>#is) {
        $title = $1;
        $title =~ s#<\w.*>##ig;
        $title =~ s#</\w.*>##ig;
        $lines =~ s#<font size\=\"3\">\s*(.+?)\s*</font>#<h1>$title</h1>#is;
        $changed=1;
      }
    };
    if ($title eq "") {
      if ($lines =~ m#<font size\=\"3\">\s*(.+?)\s*</font>#is) {
        $title = $1;
        $lines =~ s#<font size\=\"3\">\s*(.+?)\s*</font>#<h1>$1</h1>#is;
        $changed=1;
      }
    };
    if ($title eq "") {
      if ($lines =~ m#<h3 align\=\"center\">\s*(.+?)\s*</h3>#is) {
        $title = $1;
        $title =~ s#</*\w.*>##ig;
        $lines =~ s#<h3 align\=\"center\">\s*(.+?)\s*</h3>#<h1>$title</h1>#is;
        $changed=1;
      }
    };
    if ($title eq "") {
      if ($lines =~ m#<h3>\s*(.+?)\s*</h3>#is) {
        $title = $1;
        $title =~ s#</*\w.*>##ig;
        $lines =~ s#<h3>\s*(.+?)\s*</h3>#<h1>$title</h1>#is;
        $changed=1;
      }
    };
    $title =~ s/\s+/ /ig;
    $title =~ s#</*\w.*>##ig;
    $title =~ s/\s+/ /ig;
    if ($title eq "") {$title = "No title"};








    for ($i = 0; $i < scalar(@tokill); $i++) {
      $killstr=$tokill[$i];
      chomp($killstr);
      if ($lines =~ m~$killstr~i) {
        $lines =~ s~$killstr~~igs;
	#$killstr =~ s~\r~\\r~;
	#print "   $killstr removed.\n";
        $changed=1;
      }
    }

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



#     $line =~ s~(\b[A-Z\_\-\d]+)</B>~<a href="$ltmp.htm">~;   
   

#  exit;

  if ($changed) {
    
   
    open(ORD,">./$filename.bak") || die("Can't rewrite the $filename.bak\n");
    print ORD $save;
    close(ORD);

    $start = $startmask;
    $start =~ s~\$title~$title~;
    
    open(ORD,">./$filename") || die("Can't rewrite the $filename\n ");
    
    print ORD $start if (!$header);
    
    print ORD $lines;
    close(ORD);

    print "$filename - $title\n";
#    $tmp = <>;
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

