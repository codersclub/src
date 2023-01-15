<?php

// Root path
define( 'ROOT_PATH', "/usr/local/www/votforum/htdocs/" );

require ROOT_PATH."conf_global.php";
require ROOT_PATH."sources/functions.php";
$std   = new FUNC;
$sess  = new session();

$INFO['sql_driver'] = !$INFO['sql_driver'] ? 'mySQL' : $INFO['sql_driver'];

$to_require = ROOT_PATH."sources/Drivers/".$INFO['sql_driver'].".php";
require ($to_require);

$DB = new db_driver;

$DB->obj['sql_database']     = $INFO['sql_database'];
$DB->obj['sql_user']         = $INFO['sql_user'];
$DB->obj['sql_pass']         = $INFO['sql_pass'];
$DB->obj['sql_host']         = $INFO['sql_host'];
$DB->obj['sql_tbl_prefix']   = $INFO['sql_tbl_prefix'];
$DB->obj['debug']            = ($INFO['sql_debug'] == 1) ? $_GET['debug'] : 0;

if ( $DB->connect() )
{
	$ibforums->input = $std->parse_incoming();
	$ibforums->member = $sess->authorise();

//	if ( $ibforums->member['id'] ) {
//		echo "Hello, ".$ibforums->member['name'];
//	} else {
//		echo "Hello, guest!";
//	}

	$result = $DB->query("SELECT COUNT(*) FROM ibf_sessions where running_time > UNIX_TIMESTAMP()-15*60");

//	$res = $DB->get_affected_rows($result); // number of selected rows
//	$res = $DB->fetch_simple_row($result); // one row
	$row = $DB->fetch_simple_row($result); // one row
	$s = $row[0] == 1 ? "" : "s";

	echo $row[0]." user".$s." online"; 

//        echo "Result = ".$result;


	$DB->close_db();
}

?>


