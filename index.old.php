<?php
global	$HTTP_GET_VARS, 
	$HTTP_POST_VARS,
	$HTTP_CLIENT_IP,
	$REQUEST_METHOD,
	$REMOTE_ADDR,
	$HTTP_PROXY_USER,
	$HTTP_X_FORWARDED_FOR;

//echo "index.php started.<br>\n";

#echo "------------------------<br>\n";
#echo "\$_ENV:.<br>\n";
#
#
#  foreach($_ENV as $k=>$v) { 
#    echo $k."=".$v."<br>\n";
#//    if (preg_match('/^(GLOBALS|_SERVER|_GET|_POST|_COOKIE|_FILES|_ENV|_REQUEST|_SESSION)$/i', $k)) exit();
#//    unset(${$k}); 
#  }




#echo "------------------------<br>\n";
#echo "\$_SERVER:.<br>\n";


  foreach($_SERVER as $k=>$v) { 
#    echo $k."=".$v."<br>\n";
//    if (preg_match('/^(GLOBALS|_SERVER|_GET|_POST|_COOKIE|_FILES|_ENV|_REQUEST|_SESSION)$/i', $k)) exit();
//    unset(${$k}); 
  }


$uri=$_SERVER['REQUEST_URI'];
#echo "\$uri=".$uri."<br>\n";



$root=$_SERVER['DOCUMENT_ROOT'];
#echo "\$root=".$root."<br>\n";

$filename = $root.$uri;
#echo "\$filename=".$filename."<br>\n";

if(is_file($filename))
{
#  echo "\$filename exists<br>\n";
//  $f = fopen($filename,'r');
//  fpassthru($f);
//  fclose($f);

  $lines = file ($filename);

  // Loop through our array, show html source as html source; and line numbers too.
  foreach ($lines as $line_num => $line) {
    //    echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br>\n";
    $ssi_file="";
    if(preg_match('/<!--#include virtual\=\"(.+?)\"-->/i', $line))
    {
//    $line = preg_replace('/<!--#\s*include virtual\=\"*(.+?)\"*\s*-->/i', "&lt;!--#include virtual=&quot;\\1&quot;--&gt;", $line);
    $ssi_file = preg_replace('/<!--#\s*include virtual\=\"*(.+?)\"*\s*-->/i', "\\1", $line);

    if(strlen($ssi_file))
    {
//      echo "\$ssi_file=&quot;".$ssi_file."&quot;";
//      $ssi_body="&lt;!--#include virtual=&quot;{$ssi_file}&quot;--&gt;";
      $file = trim($root.$ssi_file);
//      echo "\$file=".$file."<br>\n";
//      $ssi_body=file($file);
      $ssi_body = implode ('', file($file));
      //    if(is_file($filename))
    }


    $line = preg_replace('/<!--#\s*include virtual\=\"*(.+?)\"*\s*-->/i', $ssi_body, $line);
//    echo $ssi_file;

//    {
//      $ssi_file=\\1;
//      echo "&lt;!--#include virtual=&quot;".$ssi_file."&quot;--&gt;";
//    }
   } // if(preg_match);
    echo $line . "";
  } //for

  // Another example, let's get a web page into a string.  See also file_get_contents().
//  $html = implode ('', file ('http://www.example.com/'));
}
else
{
#  echo "\$filename does NOT exists<br>\n";
}














/*
echo "------------------------<br>\n";
echo "\$_REQUEST:.<br>\n";


//  foreach($_REQUEST as $k=>$v) { 
  foreach($_GET as $k=>$v) { 
    echo $k."=".$v."<br>\n";
//    if (preg_match('/^(GLOBALS|_SERVER|_GET|_POST|_COOKIE|_FILES|_ENV|_REQUEST|_SESSION)$/i', $k)) exit();
//    unset(${$k}); 
  }


//    	$return = array();

// Song * secure patch

echo "------------------------<br>\n";
echo "\$_HTTP_GET_VARS:.<br>\n";
	if ( is_array($HTTP_GET_VARS) )
	{
		while( list($k, $v) = each($HTTP_GET_VARS) )
		{
			echo $k."=".$v."<br>\n";


//			if ( $k == 'INFO' ) continue;
// Song * secure patch
			if( is_array($HTTP_GET_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_GET_VARS[$k]) )
				{
					$return[$k][ $this->clean_key($k2) ] = $this->clean_value($v2);
				}

//			} else $return[$k] = $this->clean_value($v);
		}
	}

*/
/*	
	// Overwrite GET data with post data
	
	if ( is_array($HTTP_POST_VARS) )
	{
		while( list($k, $v) = each($HTTP_POST_VARS) )
		{
			if ( is_array($HTTP_POST_VARS[$k]) )
			{
				while( list($k2, $v2) = each($HTTP_POST_VARS[$k]) )
				{
					$return[$k][ $this->clean_key($k2) ] = $this->clean_value($v2);
				}

			} else $return[$k] = $this->clean_value($v);
		}
	}

	
	//----------------------------------------
	// Sort out the accessing IP
	// (Thanks to Cosmos and schickb)
	//----------------------------------------
	
	$addrs = array();
	
	$addrs[] = $_SERVER['REMOTE_ADDR'];
	$addrs[] = $HTTP_PROXY_USER;
	$addrs[] = $REMOTE_ADDR;
	
	//header("Content-type: text/plain"); print_r($addrs); print $_SERVER['HTTP_X_FORWARDED_FOR']; exit();
	
	$return['IP_ADDRESS'] = $this->select_var( $addrs );
											 
	// Make sure we take a valid IP address
	
	$return['IP_ADDRESS'] = preg_replace( "/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})/", "\\1.\\2.\\3.\\4", $return['IP_ADDRESS'] );
	
	$return['request_method'] = ( $_SERVER['REQUEST_METHOD'] != "" ) ? strtolower($_SERVER['REQUEST_METHOD']) : strtolower($REQUEST_METHOD);
	
	return $return;


*/




?>