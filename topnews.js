function print_news_topnews(number, target) { 
titles=new Array('Как программно добавить принтер',
 'Свои апплеты в панели управления',
 'Как получить список установленных модемов в Win95/98',
 'Ищем все компьютеры в сети',
 'Сортировка DBGrid по клику на колонке',
 'Как открыть базу данных Microsoft Access .MDB в Delphi');

links=new Array('http://www.sources.ru/delphi/system/addprinter.shtml',
 'http://www.sources.ru/delphi/system/control_panel_applets.shtml',
 'http://www.sources.ru/delphi/internet/modem_list_which_installed.shtml',
 'http://www.sources.ru/delphi/internet/find_all_computers_on_network.shtml',
 'http://www.sources.ru/delphi/db/sort_dbgrid_on_column_click.shtml',
 'http://www.sources.ru/delphi/db/open_microsoft_access_databases.shtml');

if (target) { target_name="_blank"; }
else { target_name="_top"}
document.write('<li><a target='+target_name+' href="http://www.sources.ru">ИСХОДНИКИ.RU</a><b>: Исходники программ со всего света</b><br>');
for(i=0; i<number; i++) {
 document.write('<li><a target='+target_name+' href="'+links[i]+'">'+titles[i]+'</a>');
 }
}

