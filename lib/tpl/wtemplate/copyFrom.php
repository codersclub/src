<?php
 
/**
 * Allows to copy source from another wikipage to currently edited wikipage.
 * The dropdown list is generated from files stored in namespace "templates"
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Jeff Mikels <jeffweb [at] mikels [dot] cc>
 */
 
function html_copyFrom() {
	global $ACT;
	//echos code with a dropdown list of all wikipages stored in templates namespace
	if (($ACT != 'edit') && ($ACT != 'preview')) return '';
	cf_showTemplateList();
}
 
 
function cf_getTemplateIds(){
	require_once(DOKU_INC.'inc/search.php');
	global $conf;
	global $ID;
	$dir = $conf['datadir'];
	$ns='templates';
	//$ns  = cleanID('templates');
	//if(empty($ns)){
	//$ns = dirname(str_replace(':','/',$ID));
	//if($ns == '.') $ns ='';
	//}
// vot ???
	$ns  = utf8_encodeFN(str_replace(':','/',$ns));
	//print p_locale_xhtml('index');
	
	$data = array();
	search($data,$conf['datadir'],'search_index',array('ns' => $ns));
	$templateids = array();
	foreach ($data as $item) {
		if (substr($item[id],0,10) == 'templates:') $templateids[] = $item[id];
	}
	return $templateids;	
}
 
function cf_showTemplateList(){
	$templateids = cf_getTemplateIds();
	if (count($templateids) > 0) {
		echo '<input class="button" type="button" value="use template" onClick="document.getElementById(\'wikitext\').value=document.getElementById(\'templatechoice\').value;"></input>';
		echo '<select class="edit" id="templatechoice">';
		foreach ($templateids as $templateid) {
			$raw = rawWiki($templateid);
			$raw = str_replace('"','&quot;',$raw);
			echo "<option value=\"$raw\">".str_replace("templates:","",$templateid)."</option>";
		}
		echo "</select>";
	}
}
?>
