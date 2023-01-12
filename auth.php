<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

// Root path
//define( 'ROOT_PATH', "/usr/local/www/votforum/htdocs/" );
define( 'ROOT_PATH', "/home/forum/htdocs/" );



class info {

	var $member     	= array();
	var $is_bot       	= 0;
	var $input      	= array();
	var $session_id 	= "";
	var $session_type 	= "";
	var $base_url   	= "";
	var $vars       	= "";
	var $skin       	= "";
	var $skin_id    	= "0";     // Skin Dir name
	var $skin_rid   	= "";      // Real skin id (numerical only)
	var $lang_id    	= "en";
	var $lang       	= "";
	var $server_load 	= 0;
	var $lastclick  	= "";
	var $location   	= "";
	var $debug_html 	= "";
	var $perm_id    	= "";
	var $forum_read 	= array();
	var $topic_cache 	= "";
	var $version    	= "v1.2";

	function info() 
	{
		global $sess, $std, $DB, $INFO;
		
		$this->vars = &$INFO;
		
		$this->vars['TEAM_ICON_URL']   = $INFO['html_url'] . '/team_icons';
		$this->vars['AVATARS_URL']     = $INFO['html_url'] . '/avatars';
		$this->vars['mime_img']        = $INFO['html_url'] . '/mime_types';

	}
}



require ROOT_PATH."../conf_global.php";

require ROOT_PATH."sources/functions.php";
$std   = new FUNC;

require ROOT_PATH."sources/session.php";
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

//DEBUG
	if ( $ibforums->member['id'] ) {
		echo "Hello, ".$ibforums->member['name'];
	} else {
		echo "Hello, guest!";
	}

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


