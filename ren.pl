#!/usr/bin/perl

#### Create the Order list ################
my ($mask, $tmp, $filename, $newfilename, @files);

#($mask) = $_;
#$mask = $_;
#$mask =~ s/\./\\./;

@files=();

print "\$mask\=\"$mask\"\n";

#print "\@ARGV\=\"",@ARGV."\"\n";

if (@ARGV) {
  foreach $filename (@ARGV) { 
    chomp($filename);
    print "$filename = ";

    $newfilename = $filename;
#       $newfilename =~ s/\s//;
    $newfilename = lc($newfilename);
    rename $filename, $newfilename;
    print "$newfilename\n";
    $tmp = <>;
  }
}
exit;






$tmp = <>;
   
opendir(DIR, ".");
#@files = sort(grep(/$mask$/, readdir(DIR)));
@files = sort(grep(/$mask/, readdir(DIR)));
closedir(DIR); 	                # закрыть каталог

foreach $filename(@files) {                 # читаем список файлов
  chomp($filename);
  print "$filename = ";

  $newfilename = $filename;
#       $newfilename =~ s/\s//;
  $newfilename = lc($newfilename);
#  rename $filename, $newfilename;
  print "$newfilename\n";
  $tmp = <>;
}

