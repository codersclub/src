<!DOCTYPE HTML>
<html>
<head>
	<title><?= $site['page']['title'] ?></title>
	<meta name="description" content="<?= $site['page']['description'] ?>">
	<meta name="keywords" content="<?= $site['page']['keywords'] ?>">
	<meta http-equiv="Content-Type" content="text/html;charset=windows-1251">
	<link rel="stylesheet" type="text/css" href="<?= $site['setting']['base'] ?>/magazine.css">
</head>

<body>

<table border="0" width="100%" height="100%">
<tr>
	<td colspan="2" height="120" style="padding: 15px;">
		<table border="0" width="100%" height="100%">
		<tr>
			<td>
			   <A href="/">
			     <IMG border=0 width=273 height=102 src="/img/jassy.gif">
			   </A>
			</td>

			<td>
				<a href="<?= $site['setting']['base'] ?>/home/">
                                <img src="<?= $site['setting']['base'] ?>/img/logo.gif" alt="Sources.RU Magazine" border="0">
				</a>
			</td>
			<td align="right" class="text" style="padding: 15px;">Поиск по журналу
                            <br>
			<form name="" action="http://www.google.com/search?client=opera&rls=ru&sourceid=opera&ie=utf-8&oe=utf-8" method="GET">
			<input name="q" type="text" class="find_site">
			&nbsp;<input class="find_site_sub" type="submit" value="Искать">
			</form>
			</td>
		</tr>
		</table>
	</td>
</tr>

<tr>
	<td colspan=2 height="50">
	  <div id="menu" style="padding-left:10px;">
	  <ul>
     <li><a href="<?= $site['setting']['base'] ?>/home/" <?= (($site['page']['act'] == '')?(' class="menu_selected"'):('')) ?>>Главная</a></li>
     <li><a href="<?= $site['setting']['base'] ?>/last/" <?= (($site['page']['act'] == '/')?(' class="menu_selected"'):('')) ?>>Выпуск</a></li>
     <li><a href="<?= $site['setting']['base'] ?>/main/archive.html" <?= (($site['page']['act'] == 'main/archive.html')?(' class="menu_selected"'):('')) ?>>Архив</a></li>
     <li><a href="<?= $site['setting']['base'] ?>/main/authors.html" <?= (($site['page']['act'] == 'main/authors.html')?(' class="menu_selected"'):('')) ?>>Авторы</a></li>
     <li><a href="<?= $site['setting']['base'] ?>/main/magazin.html" <?= (($site['page']['act'] == 'main/magazin.html')?(' class="menu_selected"'):('')) ?>>Редколлегия</a></li>
     <li><a href="<?= $site['setting']['base'] ?>/main/about.html" <?= (($site['page']['act'] == 'main/about.html')?(' class="menu_selected"'):('')) ?>>О журнале</a></li>
	  </ul>
	  </div>
  <div id="ferb"></div>
	</td>
</tr>

<tr>
	<td colspan="2">
		<table border="0" width="100%" height="100%"><tr>
			<td valign="top" width="250" style="padding: 20px;">

<div class="block_menu"><div class="text">
<h4>Меню</h4>
	&nbsp;&raquo;&nbsp;<a href="<?= $site['setting']['base'] ?>/home/"><b>Главная</b></a><br>
	&nbsp;&raquo;&nbsp;<a href="<?= $site['setting']['base'] ?>/last/">Выпуск</a><br>
	&nbsp;&raquo;&nbsp;<a href="<?= $site['setting']['base'] ?>/main/archive.html">Архив</a><br>
	&nbsp;&raquo;&nbsp;<a href="<?= $site['setting']['base'] ?>/main/authors.html">Авторы</a><br>
	&nbsp;&raquo;&nbsp;<a href="<?= $site['setting']['base'] ?>/main/magazin.html">Редколлегия</a><br>
	&nbsp;&raquo;&nbsp;<a href="<?= $site['setting']['base'] ?>/main/about.html">О журнале</a><br>
</div></div>
<br>

<?= $site['page']['block_number_mag'] ?>
<?//= $site['page']['block_sapa'] ?>

<? if ($site['page']['block_all_article'] != '') { ?>
	<div class="block_menu">
            <div class="text">
                <h4>Статьи</h4>
                <div class="all_links"><?= $site['page']['block_all_article'] ?></div>
            </div>
	</div>
<? } ?>


<!-- Rating@Mail.ru counter -->
<script type="text/javascript">
var _tmr = window._tmr || (window._tmr = []);
_tmr.push({id: "89876", type: "pageView", start: (new Date()).getTime()});
(function (d, w, id) {
  if (d.getElementById(id)) return;
  var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
  ts.src = "https://top-fwz1.mail.ru/js/code.js";
  var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
  if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
})(document, window, "topmailru-code");
</script><noscript><div>
<img src="https://top-fwz1.mail.ru/counter?id=89876;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" />
</div></noscript>

<a target="_top" href="https://top.mail.ru/jump?from=89876">
<img src="https://top.mail.ru/counter?id=89876;t=57;js=13;r=;j=false;s=1638*922;d=24;rand=0.8706636620410987" alt="TopList" width="88" height="31" border="0">
</a>
<!-- //Rating@Mail.ru counter -->



</td>

	<td valign="top" style="padding: 20px;" class="text2">
	<?= $site['page']['body'] ?>
	<br><br>
	</td>
	</tr>
	</table>
</td>
</tr>

<tr>
	<td height="40" class="text">
	<?= $site['page']['design'] ?>
	</td>
	<td align="right">
	<?= $site['page']['copyright'] ?>
	</td>
</tr>
</table>

</body>
</html>
