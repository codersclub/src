#!/usr/bin/perl

opendir(DIR, ".");
@files = sort(grep(/\.htm$/, readdir(DIR)));
#@files = sort(grep(/\.s*html$/, readdir(DIR)));
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
 

#<!--#include virtual\="(\.\.)*\/*t_hmenu2\.htm"\s*-->\s*<TD class\=silver width\=35\%>\&nbsp;<!--#exec cgi\="/cgi-bin/onetimep\.cgi"\s*-->\s*</TD></TR></TABLE></TD></TR></TABLE></FORM>


    # Kill FrontPage stuff
    if ($lines =~ m#<\!--\#include virtual\="(\.\.)*\/*t_hmenu2\.htm"\s*-->\s*<TD.*\/FORM>#is) {
      $lines =~ s#<\!--\#include virtual\="(\.\.)*\/*t_hmenu2\.htm"\s*-->\s*<TD.*\/FORM>#<!--\#include virtual\="\/t_hmenu\.htm"-->\n#igs;
      $changed=1;
    }

  print "$filename ";

  if ($changed) {
   
    open(ORD,">./$filename.bak") || die("Can't rewrite the $filename.bak\n");
    print ORD $save;
    close(ORD);

    open(ORD,">./$filename") || die("Can't rewrite the $filename\n ");
    print ORD $lines;
    close(ORD);

    print "changed.\n";

  } else {
    print "NOT FOUND.\n";
  }# if changed

  $tmp = <>;

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

