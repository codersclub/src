#!/usr/bin/perl

print "HTTP/1.0 401 Unauthorized\n";
print "Content-type: text/html\n";
print "WWW-Authenticate: Basic realm=\"/Check\"\n\n";

print "Пожалуйста, введите пароль.\n";

exit;