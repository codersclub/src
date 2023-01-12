#!/usr/bin/perl
#config.pl
#
#           RiSearch
#
# web search engine, version 0.99.01
# (c) Sergej Tarasov, 2000
#
# Homepage: http://risearch.webservis.ru/
# email: risearch@webservis.ru



# File extensions to index
$file_ext = '\.(html|txt|htm|shtml)$';

# List of directories, which should not be indexed
$no_index_dir = '(img|image|temp|tmp|cgi-bin)$';

# List of files, which should not be indexed
$no_index_files = '(robots.txt|dir1/no_index.html|error404.html)';

# Directory where yours html files are located
# Type "." for the current directory
$base_dir = "/wwwroot/usr/local/www/votsrc/htdocs";

# Base URL of your site
#$base_url = "http://www.sources.ru/";
$base_url = "";

# Full word indexing ("YES" or "NO")
$FULL_WORD = "YES";

#index or not numbers (set   $numbers = ""   if you don't want to index numbers)
$numbers = '0-9';

#minimum word length to index
$min_length = 3;

#number of results per page
$res_num=20;

#use escape chars (like &Egrave; or &x255;)
$use_esc = "YES";

#index META tags
$use_META = "YES";

#index IMG ALT tag
$use_ALT = "NO";

# Change below only if you need multilanguage support
# With default settings script will work with
# English, Russian (win1251 encoding) and most European languages

# Capital letters
$CAP_LETTERS = '\xC0-\xDF';

# Lower case letters
$LOW_LETTERS = '\xE0-\xFF';

# Change this as above
sub to_lower_case {
   my $str = shift;
   $str =~ tr{\xC0-\xDF}{\xE0-\xFF};
   return $str;
}

#--- end of configuration --- 
1;