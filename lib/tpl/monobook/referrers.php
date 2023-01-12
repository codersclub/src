<?php 

function doReff($refignore)
{
	global $conf;
	global $_SERVER;
	global $monobook;

	$refhi = getenv("HTTP_REFERER");
	$ref = strtolower($refhi);
$a = 'http://'.$refignore;
$b = 'http://www.'.$refignore;

	if (beginsWith($ref,'http://buy-') == FALSE)
	if (beginsWith($ref,'http://swiki') == FALSE)
	if (beginsWith($ref,'http://kiomono.mpage.jp') == FALSE)
	if (beginsWith($ref,'http://phentermine') == FALSE)
	if (beginsWith($ref,'http://cheap-') == FALSE)
	if (beginsWith($ref,'http://drug.') == FALSE)
	if (beginsWith($ref,$a) == FALSE)
	if (beginsWith($ref,$b) == FALSE)
	{

		#if referrer not null
		if (strcmp($refhi,"") == 0)
		{
			$refhi = "NULL";
		}

		#get current date
		$curdate = date("l");
		$curdatefile = $conf['datadir']."/wiki/referrers.txt";
		#open ref file
		if (is_writable($curdatefile))
		{
			if ($_SERVER['REMOTE_USER'] != $conf['superuser'])
			{
				$datas = file($curdatefile);
				$data = trim($datas[0]);

				#if we're still on the same day
				if (strcmp($data, "====== Referrers : $curdate ======") == 0)
				{
					#append
					$fp = fopen($curdatefile, "a");
				}
				else
				{
					#start over
					$fp = fopen($curdatefile, "w");
					fwrite($fp, "====== Referrers : $curdate ======\n\n");
					fwrite($fp, "^ hostname ^ ip address ^ referrer ^\n");
				}
				#write new ref
				$rh = getenv("REMOTE_ADDR");
				if (strstr(strtolower(getenv(HTTP_USER_AGENT)), "wget") != FALSE) { $rh = "**%%".$rh."%%**"; }
				fwrite($fp, "| %%".gethostbyaddr($rh)."%% | ".$rh." | $refhi |\n");
				fclose($fp);
			}
		}
		else if (file_exists($curdatefile))
		{
			msg("wiki:referrers.txt is not writable by the server", -1);
		}
	}
}

function doReff2($refignore)
{
	$x = gethostbyaddr(getenv("REMOTE_ADDR"));

	//don't include the multitude of search engines...
	if (!endsWith($x, "msnbot.msn.com"))
		if (!endsWith($x, ".gigablast.com"))
			if (!endsWith($x, ".ask.com"))
				if (!endsWith($x, ".inktomisearch.com"))
					if (!endsWith($x, ".looksmart.com"))
						if (!endsWith($x, ".googlebot.com"))
							if (!endsWith($x, ".become.com"))
								if (!endsWith($x, ".phx.gbl"))
									doReff($refignore);
}

#Perform the referrer script...
doReff2($monobook['referrer-ignore']);

?>