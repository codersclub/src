#!/usr/bin/perl

#### Check for file mask recursively ################
print "Check for file mask recursively\n";

my %searchmask=(
	"src\=\\\"\.\./img/" => "src\=\"/img/",
	"src\=\\\"img/" => "src\=\"/img/"
	    );

my $excludedir="./htdocs/pascal/tmt";

my ($mask, $tmp, $filename);

$mask = shift;

#print "\$mask\=\"$mask\"\n";

$mask =~ s/\./\\./g;
$mask =~ s/\*/.*/g;

print "\$mask\=\"$mask\"\n";
#print "\$searchmask\=\"$searchmask\"\n";


list(".");
exit;



#-------------------------------
sub list {
  my $dir=shift;

  return if($dir =~ /^$excludedir/);

  my @files=();
  my @dirs=();

  opendir(DIR, $dir) or die "Can't open $dir: $!";
  while( defined ($filename = readdir DIR) ) {
    next if $filename =~ /^\.\.?$/;     # skip . and ..
    if(-d "$dir/$filename") {
      push(@dirs,$filename);
    } else {
      push(@files,$filename) if($filename =~ /^$mask/);
    }
  }
  closedir(DIR);
  @files=sort(@files);
  @dirs =sort(@dirs);

  my $dirprinted = 0;

  foreach $filename(@files) {
    chomp($filename);
    my $changed=0;

    open(FILE,"<$dir/$filename") || die("\n   Error: Can't open the $dir/$filename\n");
    my @lines = <FILE>;
    close(FILE);
    my $body = join("",@lines);
    $body =~ s/\r//;


    foreach $key (keys %searchmask) {
      $replace = $searchmask{$key};
      if($body =~ s/$key/$replace/g) {
        if(!$dirprinted) {
          print "\n$dir\n";
          print "$excludedir\n";
          print "-------------------------\n";
          $dirprinted = 1;
        }
        print "$dir/$filename";
        print " : FOUND $key\n";
        $changed = 1;
      }
    }

    if($changed) {
#      open(FILE,">$dir/$filename") || die("\n   Error: Can't open the $dir/$filename for write\n");
#      print FILE $body;
#      close(FILE);
    }
  }



  foreach $filename(@dirs) {
    chomp($filename);
    list("$dir/$filename");
  }

}