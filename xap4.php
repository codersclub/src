<?php
function xap_code($login)
{
  $path = ''; $file = ''; $site = str_replace('www.', '', $_SERVER["HTTP_HOST"]);
  if (strlen($_SERVER["REQUEST_URI"]) > 180) return;
  if ($_SERVER["REQUEST_URI"] == '') $_SERVER["REQUEST_URI"] = '/';
  $file = base64_encode("$_SERVER[REQUEST_URI]");
  $path_code = md5($file); $user_pref = substr($login, 0, 2);
  $path = substr($path_code, 0, 1).'/'.substr($path_code, 1, 2).'/';
  $domain = "$login.tnx.net";
  $path = "/users/$user_pref/$login/$site/$path$file.txt";
  if ($fp = fsockopen ("$domain", 80, $errno, $errstr, 7))
  {
   fputs ($fp, "GET $path HTTP/1.0\r\nhost: $domain\r\n\r\n");
   $fl = 0;
   while (!feof($fp)) {
     $str = trim(fgets($fp,4096));
     if ($str == 'HTTP/1.1 404 Not Found') return;
     if ($fl == 1) echo $str;
     if ($str == "") $fl = 1;
    }
    fclose ($fp);
  }
}
xap_code(strtolower("vot"));
?>