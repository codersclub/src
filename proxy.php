<?php

$body = "";
$url = "http://forum.sources.ru/cgi-bin/printenv.cgi";
//$url='http://www.njabl.org/cgi-bin/lookup.cgi?query=24.5.1.8';
$f = fopen($url,"r");
if(!$f)
{
  echo "Can't open the URL: $url<br>\n";
  exit;
}
    
while(!feof($f))
{
  $body .=fgetc($f);
}
      
$body = preg_replace("/\n/","<br>\n",$body);      
echo $body;
      
?>
      
      
      