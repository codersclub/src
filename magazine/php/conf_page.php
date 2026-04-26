<?php

$page_url = array();
$page_url[0] = array('home/', 'main/archive.html', 'main/authors.html', 'main/magazin.html', 'main/about.html', );
$page_url[1] = array('0804/index.html', '0804/proc.html', '0804/mp3.html', '0804/teamwork.html', '0804/gamedev.html', '0804/3d_rot.html', '0804/kernel.html', '0804/delphidll.html', '0804/delphistr.html', );
$page_url[2] = array('1204/index.html', '1204/create_site.html', '1204/iarc.html', '1204/ups.html', '1204/plugin_irc.html', '1204/multilang.html', '1204/tsocket.html', '1204/kdevelop.html', '1204/linux_live_cd.html', '1204/speech_api.html', '1204/global_web_temp.html', '1204/h323.html', );
$page_url[3] = array('0105/index.html', '0105/cpu64.html', '0105/c_code_design.html', '0105/protect_shareware.html', '0105/templates.html', '0105/scaners.html', '0105/liteon.html', '0105/pc_blocks.html', '0105/your_age_php.html', '0105/web_editors.html', '0105/alternative_soft.html', '0105/soft_review.html', '0105/rest.html', );
$page_url[4] = array('0505/index.html', '0505/delphi2005.html', '0505/antivirus.html', '0505/manyos.html', '0505/asm.html', '0505/st.html', '0505/saper.html', '0505/c_comments.html', '0505/resume.html', '0505/plshr.html', '0505/restroom.html', );
$page_url[5] = array('0805/index.html', '0805/asm.html', '0805/belazar.html', '0805/paint.html', '0805/bwt.html', '0805/helloworld.html', '0805/dllfunctions.html', '0805/antikeylogger.html', '0805/protection.html', '0805/surfaces.html', );
$page_url[6] = array('0106/index.html', '0106/10.html', '0106/06.html', '0106/05.html', '0106/08.html', '0106/04.html', '0106/03.html', '0106/09.html', '0106/07.html', '0106/02.html', '0106/01.html', );
$page_url[7] = array('0906/index.html', '0906/01.html', '0906/02.html', '0906/03.html', '0906/04.html', '0906/05.html', '0906/06.html', '0906/07.html', '0906/08.html', '0906/08_enclosure.html', '0906/09.html', '0906/10.html', '0906/11.html', );
$page_url[8] = array('1207/index.html', '1207/1.html', '1207/2.html', '1207/3.html', '1207/5.html', '1207/6.html', '1207/7.html', '1207/9.html', '1207/10.html', );
$page_url[9] = array('1009/irrlicht_engine.html', '1009/visual_c_vb_lugin.html', '1009/asing_programing.html', '1009/motchet.html', '1009/pascal_to_delphi.html', '1009/linekorn.html', '1009/tech_lang.html', '1009/Symfony.html', '1009/cms_drupal.html', '1009/open_source.html', '1009/real_drop_water.html', '1009/index.html', );


$reklama = array();
//orb: delete reklama Bizar
//$reklama['main/about.html'] = 'Полезные ресурсы к 1000-летию Ярославля. Справочник товаров и услуг <a href="http://www.infoyar.ru/" title="Ярославля и Ярославской области">Ярославля и Ярославской области</a>. Информационный новостной портал <a href="http://yarosinfo.ru/" title="г. Ярославля">г. Ярославля</a>. Сайт, приуроченный к <a href="http://1000letie.ru/" title="тысячелетию Ярославля">тысячелетию Ярославля</a> - история города, достопримечательности, новости.';
//$reklama['home/'] = 'Зарекомендовавшие себя на рынке компании строительной отрасли: фабрика, производящая <a href="http://rusvorota.ru/" title="заборы и ограждения">заборы и ограждения</a> и двери; организация, осуществляющая <a href="http://www.uborkamusora.ru/" title="вывоз мусора">вывоз мусора</a> в Москве и области; поставщик, добывающий <a href="http://pesok-keramzit.ru" title="песок">песок</a> и другие нерудные строительные материалы.<br>Качественная <a href="http://5block.ru">верстка сайтов</a>.';

$last_number = '1009/index.html';
$last_navigation = '<div class="block_menu"><div class="text">
<h4>Последний выпуск</h4>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/irrlicht_engine.html">Использование Irrlicht Engine</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/visual_c_vb_lugin.html">Visual C++ 6/Visual Basic 6: Работа с плагинами</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/asing_programing.html">Асинхронное программирование</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/motchet.html">Менеджер отчётов</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/pascal_to_delphi.html">Секреты Delphi или переход с Pascal’я</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/linekorn.html">О феномене ложных корней систем линейных алгебраических уравнений</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/tech_lang.html">Научно-технический язык</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/Symfony.html">Введение в PHP фреймворки: Symfony</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/cms_drupal.html">CMS Drupal</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/open_source.html">Мир Open source</a><br>
	&nbsp;&raquo;&nbsp;<a href="'. $site['setting']['base'] .'/1009/real_drop_water.html">Реалистичные капли воды</a><br>
</div></div>';


function find_url() {
	global $site, $page_url;
	
	foreach ($page_url as $number => $links) {
		foreach ($links as $link) {
			if ($link == $site['page']['url']) {
				if (is_file('php/page/p_'. $number .'.php')) {
					$site['page']['number_magazine'] = $number;
					return TRUE;
				}
				else {
					return FALSE;
				}
			}
		}
	}
	return FALSE;
}
