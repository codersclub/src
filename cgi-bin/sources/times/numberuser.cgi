#!/usr/bin/perl

  print "Content-type: text/html; charset=windows-1251\n\n";

$dbfile = "times.txt";
$onetime = 180;

$count = 1;
$currtime = time();
$remoteaddr = $ENV{'REMOTE_ADDR'};

  open(INF,$dbfile);
  @indata = <INF>;
  close(INF);

  unlink($dbfile);
  open(OUTF,">$dbfile");
  close(OUTF);
  chmod (0777,"$dbfile");

  foreach $i (@indata) {
    chop($i);
    ($time,$address,$host) = split(/\|/,$i);
    if (($currtime - $time) <= $onetime) {
       if ($address ne $remoteaddr) {
          $count = $count + 1;
          open(OUTF,">>$dbfile");
          print OUTF "$time|$address\n";
          close(OUTF);
       }
       # print "$address<br>\n";
    }
  }
  open(OUTF,">>$dbfile");
  print OUTF "$currtime|$remoteaddr\n";
  close(OUTF);
  
  if ($count > 1) {
     print "<b>$count</b> пользователей на сервере.\n";
  }
  else {
     print "<b>1</b> пользователь на сервере.\n";
  }

exit;

