<?php

@header("Content-type: text/html; charset=windows-1251");

$site = array();
$site['setting']['base'] = 'http://sources.ru/magazine';		//change: изменить при смене сервера
	
include 'php/conf_page.php';		//загрузка массива страниц + загрузка "последнего номера" + загрузка рекламы

//закончилась инициализация переменных начинается работа сайта

//загрузка УРЛ
$site['page']['url'] = (isset($_GET['rq']) && !empty($_GET['rq']))?($_GET['rq']):('home/');		//текущая страница (без начального слеша)
if ($site['page']['url'] == 'last/') {
	$site['page']['url'] = $last_number;
}
if ($site['page']['url'] == 'main/index.html') {
	$site['page']['url'] = 'home/';
}
	
//инициализация
$site['page']['title'] = 'Sources.RU Magazine';
$site['page']['description'] = 'Sources.RU Magazine - Лучший компьютерный журнал Рунета!';
$site['page']['keywords'] = 'компьютерный журнал, исходники, кодинг';
$site['page']['design'] = '&nbsp;Design by <noindex><a href="http://forum.sources.ru/index.php?showuser=19968" rel="nofollow">Шишкин Алексей (Лёха)</a></noindex>';
$site['page']['copyright'] = '&nbsp;&copy;2004-2008 by <a href="http://sources.ru" rel="nofollow">sources.ru</a>&nbsp;';

/*
define('_SAPE_USER', '8d7b320ed52b6d8acd6c0f3a7deb2545'); 
require_once(_SAPE_USER .'/sape.php');

$o['force_show_code'] = true;
$sape = new SAPE_client( $o );
	$site['page']['block_sapa'] = '
<div class="block_menu"><div class="text">
<h4>Ссылки</h4>
'. ((isset($reklama[$site['page']['url']]))?($reklama[$site['page']['url']] .' '):('')) . $sape->return_links() .'
</div></div>
';
*/

//переписывают статьи журнала
$site['page']['number_magazine'] = 0;		//номер журнала
$site['page']['block_number_mag'] = '';	//меню навигации по номеру
$site['page']['body'] = '';					//содерживое статьи (центральная область сайта)
	
if (find_url()) {
	include 'php/page/p_'. $site['page']['number_magazine'] .'.php';
}
else {
	$site['page']['block_number_mag'] = $last_navigation;
	$site['page']['title'] .= ' - 404 Not found';
	$site['page']['body'] = '<br><div class="block_menu"><div class="text">Такой страницы у нас нет.<br>Обратитесь к администрации, может сделают ;).</div></div>';
}


$site['page']['block_all_article'] = '';
$i = 0;
foreach ($page_url as $number => $mag) {
	foreach ($mag as $link) {
		$site['page']['block_all_article'] .= '<a href="'. $site['setting']['base'] .'/'. $link .'">'. (++$i) .'</a> ';
	}
}
	
	
include 'php/skin_01.php';
