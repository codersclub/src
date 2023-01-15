#!/usr/bin/perl -w
print "Replace CRLF with <br>\n";
print "Filename: ";
my $filename = "1.txt";
chomp $filename;
if ($filename) {
  if (-e $filename) {
    print $filename;
    open (FILE, "<$filename") || print "*** Error reading the \"$filename\".\n";
    @buf = <FILE>;
    $buflen = scalar(@buf);
    close FILE;

    open (FILE, ">2.txt");
    for ($i = 0; $i < $buflen; $i++) {
      chomp $buf[$i];
      $buf[$i] =~ s/\|/\&\#124;/g;

      if ($buf[$i]) {
        print FILE "$buf[$i]";
      } else {
        print FILE "\&nbsp;";
      }
#      print $i, "=$buf[$i]\n";
      if (($i+1) < $buflen) {
        print FILE "<br>";
      }
    }
    close FILE;
  } else {
    print "*** File \"$filename\" not found.\n";
  }
}
