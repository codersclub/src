function print_news_topnews(number, target) { 
titles=new Array('Вывод ToolTip(всплывающей подсказки) в любом месте экрана',
 'Простой пример клиента FTP',
 'Morph3D Screen Saver',
 'Отправка сообщений по локальной сети',
 'Как в Delphi изменить иконку у директории',
 'Программа для управления скоростью CD-ROM приводов');

links=new Array('http://www.sources.ru/cpp/controls/tooltipzen.shtml',
 'http://www.sources.ru/cpp/network/ftpdownload.shtml',
 'http://www.sources.ru/delphi/graphics/morph3d.shtml',
 'http://www.sources.ru/delphi/internet/rl_contact.shtml',
 'http://www.sources.ru/delphi/system/change_folder_icon.shtml',
 'http://www.sources.ru/cpp/system/cdspeed.shtml');

if (target) { target_name="_blank"; }
else { target_name="_top"}
document.write('<li><a target='+target_name+' href="http://www.sources.ru">ИСХОДНИКИ.RU</a><b>: Исходники программ со всего света</b><br>');
for(i=0; i<number; i++) {
 document.write('<li><a target='+target_name+' href="'+links[i]+'">'+titles[i]+'</a>');
 }
}

