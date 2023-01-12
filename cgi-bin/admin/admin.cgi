#!/usr/bin/perl 

use CGI;
require "../news/news.conf";	# News band config
require "./admin.conf";	# Admin config

$script = "http://$ENV{SERVER_NAME}";
$script =~ s~/$~~;
$script .= $ENV{SCRIPT_NAME};

#$moderatorsfile="./news.mod";	# Page Template file


 $debug    = 0;

 $login    = $ENV{'REMOTE_USER'};
 $authtype = $ENV{'AUTH_TYPE'};
 $body     = "";
 $sub      = "";
 $image    = "";
 $more     = "";
 $pagelist = "";
 $end      = 0;
 $jsstart  = 0;
 $jsend    = 0;
# @newslist = ();
 $size     = 0;



 #----- Get Input Parameters ------------
 $query       = new CGI;

 $action      = $query->param('action');
 $start       = $query->param('start');
 $num         = $query->param('num');
 $date        = $query->param('date');
 $text        = $query->param('text');
 $title       = $query->param('title');
 $img         = $query->param('img');
 $link        = $query->param('link');
 $user        = $query->param('user');
 $login       = $query->param('login') unless ($login);

 chomp($action);
 chomp($start);
 chomp($user);
 chomp($text);
 chomp($date);
 chomp($img);
 chomp($link);

 $template = getfile("$templatefile");
 @newslist = getnews();
 $size=@newslist;


# managenews();
#######################################
#sub managenews {

 $sub  = "managenews";
 $pagetitle = "Лента Новостей";


 #printparams();
 #print @newslist;


#  open FILE,">>../news/news.log";
#  print FILE "managenews: action\=$action  num\=$num authtype\=$authtype rem_user\=$ENV{'REMOTE_USER'} \n";
#  print FILE "------------------\n";
#  close FILE;



 if ($action eq 'edit')		{   # Edit the News 
    editnews();
 } elsif  ($action  eq 'add')	{   # Add the News 
    editnews();
 } elsif  ($action eq 'save')	{   # Save News
    savenews();
    shownews();
 } elsif  ($action eq 'del')	{   # Delete the News 
    delnews();
    shownews();
 } else {
    shownews();
 }


# $template =~ s~\$body~$body~ig;
 #print $template;

#}



 print "Content-type: text/html\n\n";


 #-- Make news numbers for Javascript
 $jsstart = 0;
 $jsend   = $end - $start;
 $template =~ s/\$startnum/$jsstart/igm;
 $template =~ s/\$stopnum/$jsend/igm;

 #-- Insert the PageTitle and PageList
 $template=~ s/<pagetitle>/$pagetitle/igm;
 $template=~ s/<pagelist>/$pagelist/igm;
 $template=~ s/<start>/$start/igm;
 $template=~ s/<newsscript>/$script/igm;
 $template=~ s/<login>/$login/igm;

 #-- Insert the main body
# $body .= "$ENV{SERVER_NAME}   $ENV{SCRIPT_NAME} <br>$script";
#$script = "http://$ENV{SERVER_NAME}";
#$script =~ s~/$~~;
#$script .= $ENV{SCRIPT_NAME};

 $template =~ s~\$body~$body~ig;

 if ($debug) {
   $parameters = getparameters();
   $template=~ s/<parameters>/$parameters/igm;
 }

 print $template;

exit;


#######################################
sub makenewsline {
  my ($newdate,$newlink,$newimg,$newtitle,$newtext,$newuser) = @_;

  return join('|',$newdate,$newtitle,$newtext,$newlink,$newimg,$newuser) . "\n";
}

#######################################
sub splitnews {
  my $strn = shift;
  ($date,$title,$text,$link,$img,$user)=split(/\|/,$strn);
}

#---------------------------------------
sub shownews {

 #----- Make Pagelist ------------
 $pagelist = qq~      <tr>
        <td colspan=2 align="right">
~;

 #-------- Make Page List
 $rest = ($size % $maxnews);
 $pages = int( $size / $maxnews );
 $pages++ if ($rest);

 $start = $size - 1 if ($start >= $size );
 $startpage = int( $start / $maxnews ) + 1;

 $end = $start + $maxnews - 1;
 if ($end > ($size - 1)) {
   $end = $size-1;
 }

 $pagelist .= "<br>Страницы: \&nbsp; ";

 for ( $counter = 1; $counter<=$pages; $counter++ ) {
   $curpagestart = ($counter - 1) * $maxnews;
   if ($counter == $startpage) {
    $pagelist .= "\&nbsp; <b>$counter</b>"
   } else {
    $pagelist .= "\&nbsp; <a href\=\"javascript:dothis('start=$curpagestart');\">$counter</a>";
   }
 }

 $pagelist .= qq~
        &nbsp;</td>
      </tr>
~;




 # Add the RadioBox to the news template;
 $newstemplate =~ s~<td width\="35">~<td width="35"><INPUT type=radio name=num value=<num>>~;

 my $news0;


 for ($num=$start; $num<=$end; $num++) {
   if ($newslist[$num]) {
#         ($date,$link,$img,$title,$text,$user)=split(/\|/,$newslist[$num]);

         splitnews($newslist[$num]);

         chomp($text);
         chomp($img);
#         $text=~ s/\n/\n<br>/igm;
         $text =~ s/\\n/\n/igm;
         $img =~ s/\r//;
         chomp($img); # image

         $news0=substitute($newstemplate);

         $body .= $news0;
   } else {exit}
 }
}

#---------------------------------------
sub editnews {
# print "Content-type: text/html\n\n";

#printparams();


 # Get the News for Edit

 if ($action eq 'edit') {
   splitnews($newslist[$num]);

   $subtext = qq~<tr><td colspan=2 align="right">&nbsp;&nbsp;&nbsp;<b>Изменить:</b></td></tr>~;
   $text =~ s/<br>/\n/igm;
#   $text =~ s/\\n/\n/igm;
#   $text =~ s/\&lt;/</igm;
#   $text =~ s/\&gt;/>/igm;
 }

 else {   # if ($action eq 'add')

  $subtext = qq~<tr><td colspan=2 align="right">&nbsp;&nbsp;&nbsp;<b>Добавить:</b></td></tr>~;
  $title = '';
  $text = '';
  $link = '';
  $img = '';
  $num = $size;
  $user = $login;

  my ($sec,$min,$hour,$mday,$mon,$year,$wday) = (localtime(time))[0,1,2,3,4,5,6];
  $mon+=1;
  $hour="0$hour" if ($hour<10);
  $min="0$min" if ($min<10);
  $mday="0$mday" if ($mday<10);
  $mon="0$mon" if ($mon<10);
  $year+=1900;
  $date = "$mday.$mon.$year";
  if ($showtime) {
   $date = "$hour:$min ".$date;
  }
 }


 $body = substitute($edittemplate);

}


#---------------------------------------
sub delnews {
  my $i;
  my @news = ();
  if (($num >= 0) && ($num < $size)) {
    open FILE,">$newsfile";
    for ($i=0; $i < $size; $i++) {
      if ($i != $num) {
        print FILE $newslist[$i];           # if ($i != $num);
        push @news, $newslist[$i];
      }
    }
    close FILE;

    @newslist = @news;

# print "Location: $script\n\n";
#    $query       = new CGI('');
#    $query->redirect($script);
#    exit;

#    ($date,$text,$link,$img)=split(/\|/,$newslist[$num]);
#    splitnews($newslist[$num]);
#    $subtext = qq~<div class="text" align="left">&nbsp;&nbsp;&nbsp;<b>Новость удалена:</b></div>~;
#    $body = substitute($newstemplate); 
  } 
}

#---------------------------------------
sub savenews {

#printparams();

#  open FILE,">../news/news.log";
#  print FILE getparameters();
#  print FILE @newslist;
#  print FILE "------------------\n";
#  close FILE;

  $text =~ s/\r//igm;
  $text =~ s/\n/<br>/igm;
  $text =~ s/<br>/0x01/igm;
  $text =~ s/</\&lt;/igm;
  $text =~ s/>/\&gt;/igm;
  $text =~ s/0x01/<br>/igm;
#  $text =~ s/\n/\\n/igm;

#  my $newtext = $text;
#  my $newdate = $date;
#  my $newimg  = $img;
#  my $newtitle= $title;
#  my $newlink = $link;
    

  if ($num == $size) {
#    unshift @newslist, makenewsline($newdate,$newlink,$newimg,$newtitle,$newtext,$user);
#    unshift @newslist, makenewsline($date,$link,$img,$title,$text,$user);
    unshift (@newslist, "\n");
    $size = @newslist;
    $num = 0;

#  open FILE,">>../news/news.log";
#  print FILE @newslist;
#  print FILE "------------------\n";
#  close FILE;


#    $subtext = qq~<div class="text" align="left">&nbsp;&nbsp;&nbsp;<b>Новость добавлена:</b></div>~;

  } else {

#    $newslist[$num] = makenewsline($newdate,$newlink,$newimg,$newtitle,$newtext,$user);
#    $newslist[$num] = makenewsline($date,$link,$img,$title,$text,$user);
#    $subtext = qq~<div class="text" align="left">&nbsp;&nbsp;&nbsp;<b>Новость сохранена:</b></div>~;
  } 


#  open FILE,">>../news/news.log";
#  print FILE @newslist;
#  print FILE "------------------\n";
#  close FILE;

#  $news = makenewsline($date,$link,$img,$title,$text,$user);
#  $newslist[$num] = $news;
  $newslist[$num] = makenewsline($date,$link,$img,$title,$text,$user);

#  open FILE,">>../news/news.log";
#  print FILE @newslist;
#  print FILE "------------------\n";
#  close FILE;


#  $| = 1;                    # Flush the file buffer
  open FILE, ">$newsfile";
  print FILE @newslist;
  close FILE;

#  $image   = makeimage();

  $action = "";

# $query       = new CGI("");

 print "Location: $script\n\n";
#    $query       = new CGI(Method=>'GET');
#    print $query->redirect($script);
#    redirect($script);
    exit;



#  $body = substitute($newstemplate); 
#  $body ="";
}

#---------------------------------------
sub getnews {
 my ($a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13)=stat("$newsfile");
 my @list=();
 if ($a8==0) {
 } else {
  open FILE,"<$newsfile";
  @list=<FILE>;
  close FILE;
 }
 return @list;
}


#####################################################################
sub makeimage() {

  $img =~ s/\r//;
  chomp($img);
#printparams();

  my $image = $imgtemplate;
#print "image=$image<br>\n";

  if ($img) {
    if ($link) {
    } else {
      $image =~ s~<a href="<link>">~~ig;
      $image =~ s~</a>~~ig;
#print "image=$image<br>\n";
    }
    $image =~ s/<img>/$img/igm;
    $image =~ s/<link>/$link/igm;
#print "image=$image<br>\n";
  } else {
    $image = qq~&nbsp;~;
#    $img   = qq~&nbsp;~;
  }
#print "image=$image<br>\n";
  return $image;
}

#####################################################################
sub getfile() {
  $N = shift;
  my @A = [];
  if (open(F,$N)) {
   @A = <F>; close(F); 
   chomp @A;
   return join("\n",@A);
  } else {
   return "Ошибка чтения содержимого \"$N\" (sub file)\n";
  }
}

########################################
sub printenv {
  my $s = "";
  foreach $key (keys %ENV) {
   $s .= "$key=$ENV{$key}<br>\n";
  }
  return $s;
}

##############################################
sub makemenu {
  my $menu = "";
  if ($object eq '') {
    $menu = qq~
<!--
      <a class="mbtxt" href="javascript:dothis('price');" title="">Прайс</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
-->
      <a class="mbtxt" href="javascript:dothis('news');" title="">Новости</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('util');" title="">Утилиты</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('driver');" title="">Драйвера</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
<!--
      <a class="mbtxt" href="javascript:dothis('param');" title="">Тех.параметры</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
-->
      <a class="mbtxt" href="javascript:dothis('upload');" title="">Загрузка файлов</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('config');" title="">Настройки</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:help();" title="">Помощь</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
~;
  } elsif ($object eq 'config' || $object eq 'upload') {
    $menu = '&nbsp;';
  } elsif ($object eq 'price') {
    $menu = qq~
      <a class="mbtxt" href="javascript:dothis('editpricecat');" title="">Категории</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('editpricegroup');" title="">Разделы</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('editprice');" title="">Товары</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
~;
  } else {
    $menu = qq~
      <a class="mbtxt" href="javascript:dothis('show');" title="">Список</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('add');" title="">Добавить</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('edit');" title="">Изменить</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
      <a class="mbtxt" href="javascript:dothis('del');" title="">Удалить</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
~;
  }
  return $menu;
}

#---------------------------------------
sub printerror {
$msg = shift;
$body = $msgtemplate;
  $body =~ s~<text>~$msg~igm;
}

#---------------------------------------
sub substitute {
  $tpl = shift;		# $newstemplate;

  $more     = $moretemplate;

#  $text=~ s/\n/\n<br>/igm;

  $image = makeimage();

  if ($link) {
    $more =~ s~<newslink>~$link~i;
  } else {
    $more = "";
  }

  $tpl=~ s/<user>/$user/igm;
  $tpl=~ s/<subtext>/$subtext/igm;
  $tpl=~ s/<newstitle>/$title/igm;
  $tpl=~ s/<newstext>/$text/igm;
  $tpl=~ s/<newsdate>/$date/igm;
  $tpl=~ s/<num>/$num/igm;
  $tpl=~ s/<more>/$more/igm;
  $tpl=~ s/<image>/$image/igm;
  $tpl=~ s/<newslink>/$link/igm;
  $tpl=~ s/<newsimg>/$img/igm;


  return $tpl;
}

#     print $query->redirect('./gb.pl');
#      print redirect(-URL => "/cgi-bin/upload.cgi");
#       print "Location: $script\n\n";

##############
sub getparameters {
  my @myfields = $query->param;
  my $retvalue = "";

  foreach $key (@myfields) {
    $retvalue .= "$key=\"".$query->param($key)."\"<br>\n";
  }
  $retvalue .= "-----------------------<br>";
#  $retvalue .= "sub=\"$sub\"<br>\n";
#  $retvalue .= "pagetitle=\"$pagetitle\"<br>\n";
#  $retvalue .= "subtext=\"$subtext\"<br>\n";
#  $retvalue .= "newsdir=\"$newsdir\"<br>\n";
#  $retvalue .= "newsfile=\"$newsfile\"<br>\n";
#  foreach $n (@newslist) {$retvalue .= "news=\"$n\"<br>\n"};
#  $retvalue .= "leftmenu=\"$leftmenu\"<br>\n";
#  $retvalue .= "num=\"$num\"<br>\n";
#  $retvalue .= "size=\"$size\"<br>\n";
##  $retvalue .= "text=\"$text\"<br>\n";
#  $retvalue .= "msgtemplate=\"$msgtemplate\"<br>\n";
#  $retvalue .= "uploadtemplate=\"$uploadtemplate\"<br>\n";
#  $retvalue .= "body=\"$body\"<br>\n";
#  $retvalue .= "========================<br>";

 return $retvalue;
}


# возращает перекодированную переменную, вызов wintokoi(<переменная>)
sub wintokoi {
  my $s=shift;
  $s=~ tr/\xC0\xC1\xC2\xC3\xC4\xC5\xC6\xC7\xC8\xC9\xCA\xCB\xCC\xCD\xCE\xCF\xD0\xD1\xD2\xD3\xD4\xD5\xD6\xD7\xD8\xD9\xDA\xDB\xDC\xDD\xDE\xDF\xE0\xE1\xE2\xE3\xE4\xE5\xE6\xE7\xE8\xE9\xEA\xEB\xEC\xED\xEE\xEF\xF0\xF1\xF2\xF3\xF4\xF5\xF6\xF7\xF8\xF9\xFA\xFB\xFC\xFD\xFE\xFF/\xE1\xE2\xF7\xE7\xE4\xE5\xF6\xFA\xE9\xEA\xEB\xEC\xED\xEE\xEF\xF0\xF2\xF3\xF4\xF5\xE6\xE8\xE3\xFE\xFB\xFD\xFF\xF9\xF8\xFC\xE0\xF1\xC1\xC2\xD7\xC7\xC4\xC5\xD6\xDA\xC9\xCA\xCB\xCC\xCD\xCE\xCF\xD0\xD2\xD3\xD4\xD5\xC6\xC8\xC3\xDE\xDB\xDD\xDF\xD9\xD8\xDC\xC0\xD1/;
return $s;
}

