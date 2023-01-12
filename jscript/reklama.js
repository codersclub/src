// При глюках, пишите! Vova.Sitsi@mail.ee
//
// Given script is written by Vova from STV and if you view it from the cache,
// That it is loaded was with http: // www.stv.ee / ~ kopli.
// If you want to use it on the site, make on us link!

// Длина массивов.
var vsego=8; // Всего записей. Изменяй этот параметр при добавлении/удалении баннеров!!!

var kartinka = new Array(vsego); // Следующий массив задаёт источник картинки
var kuda = new Array(vsego);
var alt = new Array(vsego);

// Далее блоками заполняются массивы
kartinka[0]="www.online.ee/~aaleo/ruinee/animbtn.gif"; // Источник картинки
kuda[0]="vovik.virtualave.net/cgi-bin/down.cgi?ruinee"; // Адрес сайта
alt[0]="Русские страницы Эстонии"; // Alt & Status
	kartinka[1]="js.hotmail.ru/bm.gif"; // Источник картинки
	kuda[1]="js.hotmail.ru/"; // Адрес сайта
	alt[1]="Java Scripts - лучшие java скрипты!"; // Alt & Status
kartinka[2]="www.listsoft.ru/img/banners/pestraja.gif"; // Источник картинки
kuda[2]="vovik.virtualave.net/cgi-bin/down.cgi?listsoft.ru"; // Адрес сайта
alt[2]="List SOFT"; // Alt & Status
	kartinka[3]="koronator.com.ua/tv/tv_agent.gif";
	kuda[3]="vovik.virtualave.net/cgi-bin/down.cgi?tv_agent.html";
	alt[3]="TV agent - телепрограмма всех телеканалов на вашем компьютере";
kartinka[4]="www.chat.ru/~sphilipp/images/simban.gif";
kuda[4]="www.superbest.net/banner/banner.cgi?url=http://philipp.da.ru&user=Vova_Sitsi+Javascript&log=JS_Log";
alt[4]="JavaScript`ики";
	kartinka[5]="sq.hotmail.ru/bm.gif"; // Источник картинки
	kuda[5]="sq.hotmail.ru/"; // Адрес сайта
	alt[5]="Sonique - лучший mp3 плеер! Теперь на русском! Куча скинов и плаг-инов!"; // Alt & Status
kartinka[6]="www.rovensanto.ee/linksxx/lib_88.jpg";
kuda[6]="vovik.virtualave.net/cgi-bin/down.cgi?linksxx.da.ru";
alt[6]=	"Библиотека линков";
	kartinka[7]="www.sq.hotmail.ru/soft/bm.gif";
	kuda[7]="www.sq.hotmail.ru/soft/";
	alt[7]=	"sSoftware - полезные программы для работы и отдыха";
var ndx=Math.floor(Math.random()*kartinka.length); // Случайный выбор

function showStatus(index){
	if (index<alt.length){
window.status=alt[index]}}

function bannerik(rek,stolb,tab_bord){
	if (rek<1){rek=1;}
	if (rek>kartinka.length){rek=kartinka.length;}
	if (stolb<1){stolb=1;}
	if (stolb>rek){stolb=rek;}
		//alert(alt.length); // всего записей
	var rjad=Math.ceil(rek/stolb); // число рядов <tr>
document.write('<table border='+tab_bord+'>');

	for (i=0; i<rjad ; i++ ){
document.write('<tr>');

	for (j=0; j<stolb ; j++ ){
if (kartinka.length-ndx<=rek) {var n=rek-(kartinka.length-ndx);}
	else {var n=ndx+rek;}
document.write('<td align="center">');
	if (rek>0){
document.write(
'<A HREF="http://'+kuda[n]+'" target="_blank" onMouseOver="showStatus('+n+') ;return true" onMouseOut="window.status=\'Reklaam Script From Vova!\' ;return true">'+
'<img src="http://'+ kartinka[n] +'" name="pildid" height="31" width="88" vspace="3" hspace="3" border=0 alt="'+alt[n]+'"></A>');
if (n == 8){
document.write('<br><font size="-2"face="Arial,Helvetica"><A HREF="http://www.superbest.com/banner">Обмен кнопками</a></font>');}
rek--;
}
document.write('</td>');}
document.write('</tr>');}
document.write('</table>');}