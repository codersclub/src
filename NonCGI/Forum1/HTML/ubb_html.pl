#!/usr/bin/perl

use DBI;
use Digest::MD5 qw'md5_hex';
use Time::Local;
#use strict; 

#########################################
# MySQL parameters:

my $mysql_host = "localhost";
my $mysql_port = "3306";

my $dbuser     = "root";
my $dbpassword = "";


#########################################
# database parameters:

my $dbname     = "invision";
my $dbprefix   = "ibf_";               # prefix for tables

my $forum_id   = 4;  # C++             # The forum ID to be converted to



#########################################
# Temporary Variables:

my %users  = ();

my ($dbh, $request, $rows_affected);



#############################################################
#############################################################
# Connecting to the DataBase....


print "Connecting to the DataBase $dbname\.\.\. ";

$dbh=DBI->connect("DBI:mysql:database=$dbname;
                   host=$mysql_host;
                   port=$mysql_port",
                   $dbuser,
                   $dbpassword,
                   {'RaiseError'=>1 }
                 );

print "ok\n";

PressAnyKey();







#####################################################
# read the topic list for this OLD forum

opendir(DIR, ".");
@files = sort(grep(/\.s*html$/, readdir(DIR)));
#@files = sort(grep(/\.s*tst$/, readdir(DIR)));
closedir(DIR); 	                #





##################################################
print "Inserting Topics...\n";

foreach $filename(@files) {

  chomp($filename);
  #print "$filename\n";

  $i = 0;       #
  $changed=0;

  $topic_id       = 0;
  $topicsubj      = '';
  $first_post     = 0;
  $starter_id     = 0;
  $author_mode    = 1;
  $starter_name   = '';
  $real_name      = '';
  $starter_email  = '';
  $start_date     = 0;
  $last_post      = 0;
  $last_poster_id = 0;
  $last_poster_name= '';
  $posts          = 0;
  $views          = 0;
  $locked         = 0;
  $pinned         = 0;
  $approved       = 1;
  $state          = 'open';
  $icon           = 0;




  open(ORD,"<./$filename") || die("Can't open the $filename\n");
  @lines = <ORD>;
  close(ORD);

  $lines = join("",@lines);
  $save = $lines;

  $lines =~ s/\r//;

 


  ($topic_subj) = ($lines =~ m#<title>(.*?)</title>#is);

  $topic_subj =~ s/ - Форум на исходниках//ig;

  $topic_subj =~ s/^\s*//ig;
  $topic_subj =~ s/\s*$//ig;
  if ($topic_subj eq "") {$topic_subj = "No title"};


  ($forumname) = ($lines =~ m~<IMG SRC\=\"/NonCGI/tline\.gif\" WIDTH\=12 HEIGHT\=12 BORDER\=0><IMG SRC\=\"/NonCGI/open\.gif\" WIDTH\=15 HEIGHT\=11 BORDER\=0>\&nbsp\;\&nbsp\;<A HREF\=\"/cgi-bin/sources/forumdisplay\.pl\?action\=topics\&forum\=Основной\&number\=1\">(.*?)</A>~is);

   
  print "filename:  $filename\n";
  print "forumname: ".win2dos($forumname)."\n";
  print "title:     ".win2dos($topic_subj)."\n";









  while ($lines =~ m~<FONT SIZE\="2" face\="Verdana, Arial"><B>(.*?)</B></FONT>~is) {
    $post_id    = 0;
#   $old_post_id= "$old_topic_id\-$posts";
    $old_post_id= "$old_topic_id";
    $post_title = '';
    $post_date  = 0;
    $post       = '';
    $author_id  = 0;
    $author_name= '';
    $real_name  = '';
    $email      = '';
    $ip_address = '';
    $ns         = '';
    $attach     = '';
    $icon       = '';
    $icon_id    = 0;
    $queued     = 0;
    $use_sig    = 1;
    $use_emo    = 1;
    $attach     = 0;
    $new_topic  = $posts ? 0 : 1;
    $append_edit= 0;
    $edit_time  = 0;
    $edit_name  = '';



    $i++;
    $author = $1;
    $author =~ s~^webmaster$~purpe~;
    $author =~ s~^Valery Votintsev$~vot~;
    $userid = checkuserid($author);

    $lines =~ s~<FONT SIZE\="2" face\="Verdana, Arial"><B>(.*?)</B></FONT>~~is;

    $lines =~ s~>опубликован (\d*-\d*-\d+ \d+:\d+) MSK~~is;

    $date = $1;

    $lines =~ s~</FONT><HR>(.*?)\s*</FONT>\s*</td></tr>~~is;
    $text = $1;

    $text =~ s~<br>~\n~ig;
    $text =~ s~<p>~\n~ig;
    $text =~ s~\&nbsp;~ ~igs;
    $text =~ s~\&lt;~<~igs;
    $text =~ s~\&gt;~>~igs;
    $text =~ s~\s*$~~is;
    $udate = &strtotime($date);

    print "\#$i:     $author ($userid), $date ($udate\=".&timetostr($udate).")
\=\=\= ".win2dos($text)."\n";

    ###########################################################
    ### insert the topic with the first post parameters #######

    if($i == 1) {
      $real_name       = mysql_escape_string($real_name);
      $starter_name    = mysql_escape_string($starter_name);
      $last_poster_name= mysql_escape_string($last_poster_name);
      $topicsubj       = mysql_escape_string($topicsubj);
      $topicsubj       = 'No subject' unless ($topicsubj);
      $starter_id      = checkuserid($starter_name);
      $start_date      = strtotime($start_date);
      $last_poster_id  = checkuserid($last_poster_name);
      $state           = $locked ? 'closed' : 'open';

      # insert the topic and get it's ID
      $topic_id = inserttopic($forum_id,$approved,$state,$pinned,$topicsubj,
                              $starter_name,$starter_id,$start_date,
                              $posts+1,$views,$author_mode);

      #print "$old_topic_id,$topicsubj,$real_name,$starter_email,$start_date,$posts,$starter_name,$icon,$locked,$pinned\n";
      #PressAnyKey();

    }


    my ($post_id, $old_post_id, $post_title, $post_date,
        $post, $author_id, $author_name, $real_name,
        $email, $ip_address, $ns, $attach, $icon,
        $queued, $use_sig, $use_emo);

    $tmp = <>;

    #################################################
    ### insert the next post

    if ($topic_id) {   # if the topic was inserted OK
      $post_title   = mysql_escape_string(trim($post_title));
      $post_title   = $topicsubj if (!$post_title);
      $post_title   = 'No subject' if (!$post_title);

      $email        = mysql_escape_string(trim($email));
      $post_date    = strtotime($post_date);
      $edit_time    = ($edit_time) ? strtotime($edit_time) : 0;
      $edit_name    = '' if (!$edit_name);
      $append_edit  = $edit_name ? 1 : 0;
      $ns           = $ns ? '0' : '1';
      $icon         = 'xx' if (!$icon);
      $ip_address   = '' if (!$ip_address);
      $post         = trim($post);

      # [quote author=??? link=board=pascal;num=1014576096;start=0#1 date=02/28/02  05:37:54] 11111 [/quote]
      # [quote author=vot link=board=news;num=1013957587;start=40#1 date=02/17/02 в 20:19:38]
      # [quote author=vot link=board=news;num=1013957587;start=30#40 date=02/21/02 &nbsp;01:49:08]
      # [QUOTE=admin,3.11.03, 17:13] 11111 [/QUOTE]

      $post         =~ s~\[quote author\=(.+?) link\=(.+?) date\=(\d\d)/(\d\d)/(\d\d)(.+?)(\d\d):(\d\d):(\d\d)\]~\[QUOTE\=$1, $4\.$3\.$5, $7:$8:$9\]~igm;
      $post         = mysql_escape_string($post);
      $real_name    = mysql_escape_string($real_name);
      $author_name  = mysql_escape_string($author_name);
      $author_name  = $real_name if ($author_name eq 'Guest');
      $author_id    = checkuserid($author_name);



      # Debug info:
      print "*** topic_id not defined!" if (!defined $topic_id);
      print "*** author_id not defined!" if (!defined $author_id);
      print "*** topicsubj not defined!" if (!defined $topicsubj);
      print "*** author_name not defined!" if (!defined $author_name);
      print "*** email not defined!" if (!defined $email);
      print "*** post_date not defined!" if (!defined $post_date);
      print "*** ip_address not defined!" if (!defined $ip_address);
      print "*** ns not defined!" if (!defined $ns);
      print "*** edit_time not defined!" if (!defined $edit_time);
      print "*** edit_name not defined!" if (!defined $edit_name);
      print "*** post not defined!" if (!defined $post);
      print "*** icon not defined!" if (!defined $icon);


      insertpost($forum_id,$topic_id,$queued,
                 $author_id,$author_name,$ip_address,
                 $post_date,$post_title,$post,
                 $use_sig,$use_emo,
                 $append_edit,$edit_name,$edit_time,
                 $new_topic,$old_post_id);


      # Debug info:
#              print "\t\+ $author_name\:\($author_id)\:$email\:$ip_address\:$post_date\:$icon\:$ns\n";

#              PressAnyKey();

#              rotate($posts);

      # for the forum:
      $last_title      = $topicsubj;

      $totalposts++;

      # for the topic:
      $last_post       = $post_date;
      $last_poster_id  = $author_id;
      $last_poster_name= $author_name;
      $start_date      = $post_date unless $posts;

      $posts++;

    } # if (trim($messageFileEntry))  #if message not empty

  }   # for each message


  # Update the topic for last poster info
  updatetopic($topic_id,$last_poster_id,$last_poster_name,$last_post,$start_date);

    }
  }


  print "--------------------------------\n";


  $tmp = <>;
#    print "\n";


}  # foreach filename




#########################################################


  foreach my $boardFileEntry (@boardFile) {     # For each TOPIC (thread)


    if (trim($boardFileEntry)) {
  #$topic_id = 1; ######### !!!!!!!!!!!!!!!!!!!!!

        if ($topic_id) {   # if the topic was inserted OK



          ##############################################################################
          #print "Importing Messages...\n";

          $posts = 0;

          if (-e "$datadir/$old_topic_id.txt" 
              && ($topicsubj !~ /^Перемещён: /)) {    # if no "Moved to: " in the Subject

            print "\t- $boardname: $old_topic_id: ";

            my @messageFile = file("$datadir/$old_topic_id.txt");



            foreach my $messageFileEntry (@messageFile) {   # For each MESSAGE in the topic
      #       Message structure:
      #       0      1      2       3        4    5    6          7  8   9    10       11
      #       subj|RealName|email|date&time|login|icon|attach|ip|text|NS|modifdate|modifby
      #       ($msub, $mname, $memail, $mdate, $musername, $micon, $mattach, $mip, $postmessage, $ns, $mlm, $mlmb, $msglocked)

              if (trim($messageFileEntry)) {
                my ($post_title,$real_name,$email,$post_date,
                    $author_name,$icon,$attach,$ip_address,
                    $post,$ns,$edit_time,$edit_name) = split(/\|/, $messageFileEntry);

  #          eraseoldid($topic_id,$forum_id); # Erase the rating field in all the posts for the topic


            $totaltopics++;


          } else {  # Delete the topic because of file nonexists
            $request = $dbh->do("DELETE FROM $dbprefix"."topics WHERE tid=$topic_id");
          }

          print "$posts msgs.\n";

  #        PressAnyKey();


        }   # if ($topic_id) {   # if the topic was inserted OK
      }   # if ($present{$old_topic_id})
    }     # if (trim($boardFileEntry))
  }       # for each TOPIC



  # Update the forum:
  # if this is not empty only!!!:
  # $last_id
  # $last_poster_id
  # $last_poster_name

  $request = $dbh->prepare("SELECT forum_id, COUNT(*) AS totaltopics, SUM(posts) AS totalposts
                           FROM $dbprefix"."topics GROUP BY forum_id");
  $request->execute();

  while (my $ans = $request->fetchrow_hashref()) {
    if ($forum_id == $ans->{'forum_id'}) {
      $dbh->do("UPDATE $dbprefix"."forums SET
               topics=".$ans->{'totaltopics'}.
               ", posts=".$ans->{'totalposts'}.
               " WHERE id=".$ans->{'forum_id'});
    }
  }
  $request->finish;

#  $rows_affected = $dbh->do("UPDATE $dbprefix"."forums SET
#                   topics          = '$totaltopics',
#                   posts           = '$totalposts'
#                   WHERE id \= $forum_id LIMIT 1");
#  #                 last_post       = '$last_post',
#  #                 last_id         = '$last_id',
#  #                 last_poster_id  = '$last_poster_id',
#  #                 last_poster_name= '$last_poster_name'


  print "* $boardname: converted $totaltopics topics, $totalposts messages.\n";

#  PressAnyKey();

} # if exists $boardname.txt

print "\n";
PressAnyKey();


















#########################################################
# Close the connection

$dbh->disconnect;

print "\nDisconnected from the DataBase $dbname\.\n";
print "All done.\n";

exit;









####################################
sub empty {
 ($tmp) = @_;
 chomp($tmp);
 $tmp =~ s/\s//g;
 return 1 if ($tmp eq ''); 
 return 0;
}


#################################################################
sub checkuserid {
  my $name=shift;

  my $request = $dbh->prepare("SELECT id FROM $dbprefix"."members WHERE name='$name' LIMIT 1");
  $request->execute();
  my @row = $request->fetchrow_array();
  my $id     = $row[0];
  $id     = 0 if (!$id);
  $request->finish;
  return ($id);
}




#####################################################################
# Recode Windows-1251 -> DOS-866
sub win2dos {
  $_ = shift;
  tr/\xC0\xC1\xC2\xC3\xC4\xC5\xC6\xC7\xC8\xC9\xCA\xCB\xCC\xCD\xCE\xCF\xD0\xD1\xD2\xD3\xD4\xD5\xD6\xD7\xD8\xD9\xDA\xDB\xDC\xDD\xDE\xDF\xE0\xE1\xE2\xE3\xE4\xE5\xE6\xE7\xE8\xE9\xEA\xEB\xEC\xED\xEE\xEF\xF0\xF1\xF2\xF3\xF4\xF5\xF6\xF7\xF8\xF9\xFA\xFB\xFC\xFD\xFE\xFF\xB8\xA8\xB9/\x80\x81\x82\x83\x84\x85\x86\x87\x88\x89\x8A\x8B\x8C\x8D\x8E\x8F\x90\x91\x92\x93\x94\x95\x96\x97\x98\x99\x9A\x9B\x9C\x9D\x9E\x9F\xA0\xA1\xA2\xA3\xA4\xA5\xA6\xA7\xA8\xA9\xAA\xAB\xAC\xAD\xAE\xAF\xE0\xE1\xE2\xE3\xE4\xE5\xE6\xE7\xE8\xE9\xEA\xEB\xEC\xED\xEE\xEF\xF1\xF0\x4E/;
  return $_;
}

#####################################################################
sub strtotime {
# calculate epoch seconds at midnight on that day in this timezone
#2000-07-27 13:24:28
#02/06/02 в 00:32:59
  my $n;
  my $s = shift;
#  if ($s =~ m~(\d\d\d\d)\-(\d\d)\-(\d\d)(.*)(\d\d):(\d\d):*(\d\d)*~) {
  if ($s =~ m~(\d\d)\-(\d\d)\-(\d\d\d\d)(.*)(\d\d):(\d\d)~) {
    #$n = timelocal($sec,$min,$hour,$day,$month-1,$year);
#    $n = timelocal($7,$6,$5,$3,$2-1,$1);
    $n = timelocal(0,$6,$5,$1,$2-1,$3);
  } elsif ($s =~ m~(\d\d)\/(\d\d)\/(\d\d)(.*)(\d\d):(\d\d):*(\d\d)*~) {
    #$n = timelocal($sec,$min,$hour,$day,$month-1,$year);
#    $n = timelocal($7,$6,$5,$2,$1-1,$3);
    $n = timelocal(0,$6,$5,$2,$1-1,$3);
  } else {


    $n = time();
  }
  return $n;
}

#####################################################################
sub timetostr {
  my $n = shift;
  return "".localtime($n);
}

######################################
sub PressAnyKey {
  my $title = shift;
  if ($title) {print "\* $title"}
  else {print "* Press Enter: "}
  my $tmp = <>;
}

