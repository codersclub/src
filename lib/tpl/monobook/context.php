<?php
/** Determine the context of the buttons
 * for Monobook for DokuWiki
 * By Terence J. Grant
 * tjgrant [at] tatewake [dot] com
 * License: GPL v2
 */

$pagetype = "article";	/* Normal page */
$monobook['nsclass'] = 'ns-0';		/* Normal page */

if (beginsWith($monobook['discussion-location'], ':'))	/* Strip leading colon */
	$monobook['discussion-location'] = substr($monobook['discussion-location'], 1);

if (beginsWith($ID, "wiki:"))
{
	if (!beginsWith($ID, $monobook['discussion-location']))
	{
		if (!beginsWith($ID, "wiki:user:"))
		{
			$pagetype = "special";	/* Special page */
		}
	}
}

if ($ACT == "search")
{
	$pagetype = "special";	/* Special page */
}

if ($_REQUEST['mbdo'] == 'cite')
{
	$pagetype = "special";	/* Special page */
}
else if ($_REQUEST['mbdo'] == 'detail')
{
	$pagetype = "special";	/* Special page */
}
else if ($_REQUEST['mbdo'] == 'media')
{
	$pagetype = "special";	/* Special page */
}


if ($pagetype == "article")
{
	if (!beginsWith($ID, $monobook['discussion-location']))
	{
		$monobook['content_actions']['article']['class'] = "selected";
		$monobook['content_actions']['article']['wiki'] = ':'.$ID;
		$monobook['content_actions']['article']['text'] = $lang['monobook_article'];
		$monobook['content_actions']['article']['accesskey'] = 'v';

		if ($monobook['discussion'] == 1)
		{
			$monobook['content_actions']['talk']['wiki'] = ':'.$monobook['discussion-location'].':'.$ID;
			//Etienne : Discussion, not found in the lang.php files
			//$monobook['content_actions']['talk']['text'] = "Discussion";
			$monobook['content_actions']['talk']['text'] = $lang['monobook_discussion'];
		}
	}
	else
	{
		$monobook['nsclass'] = 'ns-1';	/* Special page */

		$monobook['content_actions']['article']['wiki'] = ':'.substr($ID,strlen($monobook['discussion-location']));
		$monobook['content_actions']['article']['text'] = $lang['monobook_article'];
		$monobook['content_actions']['article']['accesskey'] = 'v';

		if ($monobook['discussion'] == 1)
		{
			$monobook['content_actions']['talk']['class'] = "selected";
			$monobook['content_actions']['talk']['wiki'] = ':'.$ID;
			//Etienne : Discussion, not found in the lang.php files
			//$monobook['content_actions']['talk']['text'] = "Discussion";
			$monobook['content_actions']['talk']['text'] = $lang['monobook_discussion'];
		}
	}

	if (beginsWith($ID,"wiki:user:"))
	{
		$monobook['nsclass'] = 'ns-1';	/* Special page */
		$monobook['content_actions']['article']['text'] = $lang['monobook_userpage'];
		$monobook['content_actions']['article']['accesskey'] = 'v';
	}

	/* Now the edit button... */
	if ($ACT == "edit")
		$monobook['content_actions']['edit']['class'] = "selected";
	$monobook['content_actions']['edit']['href'] = DOKU_BASE."doku.php?id=".$ID."&amp;do=edit&amp;rev=".$_REQUEST['rev'];
	$monobook['content_actions']['edit']['accesskey']='e';

	if($INFO['writable'])
	{
		if($INFO['exists'])
		{
			$monobook['content_actions']['edit']['text'] = $lang['btn_edit'];
			$monobook['content_actions']['edit']['accesskey']='e';
		}
		else
		{
			$monobook['content_actions']['edit']['text'] = $lang['btn_create'];
			$monobook['content_actions']['edit']['accesskey']='e';
		}
	}
	else
	{
		$monobook['content_actions']['edit']['text'] = $lang['btn_source'];
		$monobook['content_actions']['edit']['accesskey']='e';
	}
}
else if ($pagetype == "special")
{
	$monobook['nsclass'] = 'ns-1';	/* Special page */

	$monobook['content_actions']['article']['class'] = "selected";
	if ($ACT != "search")
	{
		$monobook['content_actions']['article']['href'] = DOKU_BASE."doku.php?id=".$ID;
	}
	else
	{
		$monobook['content_actions']['article']['href'] = "#";
	}
	$monobook['content_actions']['article']['text'] = $lang['monobook_specialpage'];
	$monobook['content_actions']['article']['accesskey'] = 'v';

	/* Now the edit button... */
	if ($ACT == "edit")
		$monobook['content_actions']['edit']['class'] = "selected";
	$monobook['content_actions']['edit']['href'] = DOKU_BASE."doku.php?id=".$ID."&amp;do=edit&amp;rev=".$_REQUEST['rev'];
	$monobook['content_actions']['edit']['accesskey']='e';

	if($INFO['writable'])
	{
		if($INFO['exists'])
		{
			$monobook['content_actions']['edit']['text'] = $lang['btn_edit'];
			$monobook['content_actions']['edit']['accesskey']='e';
		}
		else
		{
			$monobook['content_actions']['edit']['text'] = $lang['btn_create'];
			$monobook['content_actions']['edit']['accesskey']='e';
		}
	}
	else
	{
		$monobook['content_actions']['edit']['text'] = $lang['btn_source'];
		$monobook['content_actions']['edit']['accesskey']='e';
	}
}

	if ($ACT == "revisions")
		$monobook['content_actions']['history']['class'] = "selected";
	$monobook['content_actions']['history']['href'] = DOKU_BASE."doku.php?id=".$ID."&amp;do=revisions";
	$monobook['content_actions']['history']['text'] = $lang['btn_revs'];
	$monobook['content_actions']['history']['accesskey'] = 'o';

	if($conf['useacl'])
	{
		if ($_SERVER['REMOTE_USER'])
		{
			if ($conf['subscribers'])
			{
				if (!$INFO['subscribed'])
				{
					$monobook['content_actions']['watch']['href'] = DOKU_BASE."doku.php?id=".$ID."&amp;do=subscribe";
					//Etienne
					//$monobook['content_actions']['watch']['text'] = "Watch";
					$monobook['content_actions']['watch']['text'] = $lang['btn_subscribe'];
				}
				else
				{
					$monobook['content_actions']['watch']['href'] = DOKU_BASE."doku.php?id=".$ID."&amp;do=unsubscribe";
					//Etienne
					//$monobook['content_actions']['watch']['text'] = "Unwatch";
					$monobook['content_actions']['watch']['text'] = $lang['btn_unsubscribe'];
				}
			}
		}
	}


/* Determine what will be listed on personal tools */
if($conf['useacl'])
{
	if ($_SERVER['REMOTE_USER'])
	{
		$monobook['personal']['userpage']['wiki']=":wiki:user:".$_SERVER['REMOTE_USER'];
		$monobook['personal']['userpage']['text']=$_SERVER['REMOTE_USER'];
		if ($INFO['perm'] == AUTH_ADMIN)
		{
			$monobook['personal']['admin']['href']=DOKU_BASE."doku.php?id=".$ID."&amp;do=admin";
			//Etienne
			//$monobook['personal']['admin']['text']="Admin";
			$monobook['personal']['admin']['text']=$lang['btn_admin'];
		}

		if ($monobook['discussion'] == 1) {
		    //Etienne : My Talk, not found in the lang.php files.
			$monobook['personal']['mytalk']['wiki']=$monobook['discussion-location'].":wiki:user:".$_SERVER['REMOTE_USER'];
			$monobook['personal']['mytalk']['text']=$lang['monobook_mytalk'];
		}

		$monobook['personal']['preferences']['href']=DOKU_BASE."doku.php?id=".$ID."&amp;do=profile";
		//Etienne
		//$monobook['personal']['preferences']['text']="My preferences";
		$monobook['personal']['preferences']['text']=$lang['btn_profile'];

		$monobook['personal']['logout']['href']=DOKU_BASE."doku.php?id=".$ID."&amp;do=logout";
		//Etienne
		//$monobook['personal']['logout']['text']="Log out";
		$monobook['personal']['logout']['text']=$lang['btn_logout'];
	}
	else
	{
		$monobook['personal']['login']['href']=DOKU_BASE."doku.php?id=".$ID."&amp;do=login";
		//Etienne : text is slightly different from the monobook original one.
		//$monobook['personal']['login']['text']="Sign in / create account";
		$monobook['personal']['login']['text']=$lang['btn_login'];
	}
}

/* Etienne Gauthier, 23/04/2006
Function that get a wiki page (to insert into into a bar, for instance)
All Wiki parameters are first 'backup', to totally separate the rendering of the sidebar, and the display of the main content.
*/
function display_wiki_page ($wikipagename) {
    global $ID;
    global $REV;
    global $ACT;
    global $IDX;
    global $DATE;
    global $RANGE;
    global $HIGH;
    global $TEXT;
    global $PRE;
    global $SUF;
    global $SUM;
	global $lang;
    global $_SERVER;

	// Save the configuration for the current page:
    $backup['ID']    = $ID;
    $backup['REV']   = $REV;
    $backup['ACT']   = $ACT;
    $backup['IDX']   = $IDX;
    $backup['INFO']  = $INFO;
    $backup['DATE']  = $DATE;
    $backup['RANGE'] = $RANGE;
    $backup['HIGH']  = $HIGH;
    $backup['TEXT']  = $TEXT;
    $backup['PRE']   = $PRE;
    $backup['SUF']   = $SUF;
    $backup['SUM']   = $SUM;
   
	// Put configuration for the navigation sidebar.
	$ID = $wikipagename;
	$ACT = 'show';
    $REV = '';
    $IDX = '';
    $DATE = '';
    $RANGE = '';
    $HIGH = '';
    $TEXT = '';
    $PRE = '';
    $SUF = '';
    $SUM = '';
    

    //Check the user's rights ont the sidebar page.   
	if($_SERVER['REMOTE_USER'])
		$perm = auth_quickaclcheck($ID);
	else
		$perm = auth_aclcheck($ID,'',null);

	//Use of wiki content : if this page exists, else we do nothing (the Edit link will be there, it's enough).
	$file = wikiFN($ID);
	if (@file_exists($file)) {
		tpl_content();
    	//Add the edit link, for this page.
    	if($perm >= AUTH_EDIT)
    	{
    		echo '<div class="secedit2"><a href="' . DOKU_BASE . 'doku.php?id=' . $ID . '&amp;do=edit&amp;rev=' . $_REQUEST['rev']
    		    . '">' . $lang['btn_secedit'] . '</a></div>';
    	}
	} else {
    	//Add the create link, for this page.
    	if($perm >= AUTH_EDIT)
    	{
    		echo '<div class="secedit2"><a href="' . DOKU_BASE . 'doku.php?id=' . $ID . '&amp;do=edit&amp;rev=' . $_REQUEST['rev']
    		    . '">' . $lang['btn_create'] . '</a></div>';
    	}
	}


	//Rest ore previous value for $ID and $ACT.
    $ID    = $backup['ID'];
    $REV   = $backup['REV'];
    $ACT   = $backup['ACT'];
    $IDX   = $backup['IDX'];
    $INFO  = $backup['INFO'];
    $DATE  = $backup['DATE'];
    $RANGE = $backup['RANGE'];
    $HIGH  = $backup['HIGH'];
    $TEXT  = $backup['TEXT'];
    $PRE   = $backup['PRE'];
    $SUF   = $backup['SUF'];
    $SUM   = $backup['SUM'];
}

/*
Portlet writing function
by Terence J. Grant
tjgrant [at] tatewake [dot] com

07/28/2006 - This function needs cleaning up...
*/
function writeMBPortlet($arr, $name, $subname, $prefix, $istabs = "")
{
	if ($arr)    #write it only if we even have a section for this
	{
		echo '<div id="'.$name.'" class="portlet">';
		echo ' <h5>'.$subname.'</h5>';

		if (!$istabs)
			echo '  <div class="pBody">';

		$ULFlag = 1;

		foreach($arr as $key => $action)
		{
			#TJG 07/28/2006 Initial rel nofollow support
			$rel = "";
			if ($action['rel'])
			{
				$rel = ' rel="nofollow"';
			}
			//Etienne (start)
			if ($action['wiki_page']) #display a wiki page
			{
				if ($ULFlag == 0)
				{
					echo '   </ul>' . "\n";
					$ULFlag = 1;
				}

				display_wiki_page ($action['wiki_page']);
			}
			else	//Etienne (end)
			{
				if ($ULFlag == 1)
				{
					echo '   <ul>' . "\n";
					$ULFlag = 0;
				}
				echo '<li id="'.$prefix.'-'.$key.'"';
				if($action['class'])
				{
					echo ' class="'.$action['class'].'"';
				}
				echo '>';
				if($action['wiki'])    #a wiki link
				{
					if ($action['text'])
					{
						tpl_pagelink($action['wiki'], $action['text']);
					}
					else
					{
						tpl_pagelink($action['wiki']);
					}
				}
				else if ($action['href']) #uses a href
				{
					if ($action['accesskey'])
					{
						echo '<a href="'.$action['href']
							.'" accesskey="'
							. $action['accesskey']
							.'" title="[ALT+'
							. strtoupper($action['accesskey'])
							.']"'
							.$rel.'>';
					}
					else
					{
						echo '<a href="'.$action['href'].'"'.$rel.'>';
					}
					echo $action['text'];
					echo '</a>';
				}//Etienne (start)
				else if ($action['externurl']) #uses an external URL
				{
					echo '<a href="' . $action['externurl']
						. '" class="urlextern" title="' . $action['externurl'] . '" rel="nofollow"'
						.$rel
						.'>'
						. $action['text']
						. '</a>';
				}
				else if ($action['html']) #directly copy the given html
				{
					echo $action['html'];
				}
				//Etienne (end)
				else    #no link
				{
					echo "<font color=\"#cccccc\">".$action['text'].'</font>';
				}

				echo '</li>'."\n";
			}
		}

		if ($ULFlag == 0)
		{
			echo '   </ul>' . "\n";
			$ULFlag = 1;
		}

		if (!$istabs)
			echo '  </div>';

		echo '</div>';
	}
}

?>