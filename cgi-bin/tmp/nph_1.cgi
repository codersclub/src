#!/usr/bin/perl 
use MIME::Base64;

$logfile = "./nph_1.log";

$ENV{HTTP_CGI_AUTHORIZATION} =~ s/basic\s+//i;

($REMOTE_USER,$REMOTE_PASSWD) =
  split(/:/,decode_base64($ENV{HTTP_CGI_AUTHORIZATION}));

open FILE,">>$logfile";
  foreach $key (keys %ENV) {
   print FILE "$key=$ENV{$key}\n";
  }
  print FILE "\$REMOTE_USER\=$REMOTE_USER\n";
  print FILE "\$REMOTE_PASSWD\=$REMOTE_PASSWD\n";
  print FILE "---------------------------\n";
close FILE;

# проверяем значения $REMOTE_USER и $REMOTE_PASSWD
if (!UserAccess($REMOTE_USER,$REMOTE_PASSWD)) { 
  print "WWW-Authenticate: Basic realm=\"\t\t   Login and Password required!!!\"\n";
  print "Status: 401 Unauthorized\n\n";
  print "Ошибка авторизации!\n";
  exit; 
} 

# код, который выполняется при успешной авторизации
print "Content-type: text/html\n\n"; 
print "Привет, $REMOTE_USER!";
exit; 

# простейшая проверка: 
# совпадают ли введенные значения с "user" и "userpas"
sub UserAccess { 
  my $aUser = $_[0]; 
  my $aPass = $_[1]; 

  $res = ( $aUser eq "user" && $aPass eq "userpas" ? 1 : 0); 
  return $res; 
} 

