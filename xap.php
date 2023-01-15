<?php
function xap_code ($login)
{
  if (getenv('HTTP_X_FORWARDED_FOR')) { $ip=getenv('HTTP_X_FORWARDED_FOR'); } else { $ip=getenv('REMOTE_ADDR');}
  $name = $login.'##'.$ip.'##'.urldecode ($_SERVER['HTTP_HOST']).'##'.urldecode ($_SERVER['REQUEST_URI'])
    .'##'.str_replace(strstr($_SERVER['HTTP_USER_AGENT'], '('), '',$_SERVER['HTTP_USER_AGENT']);
  $str = ' ';
  for ($i = 0; $i < strlen ($name) ; $i++) $str .= dechex(ord(substr($name, $i, 1)));
    $str = trim ($str);
    echo @file_get_contents("http://www.xap.ru/on.php?xap=$str");
  }
  xap_code('vot');
?>
	 