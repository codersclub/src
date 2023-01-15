<!--
var ie=1;
var loc;

//окно заказа
function Winopen(url)
{
if (ie){
	var	width=250;
	var	height=150;
	new_win = window.open(url, "new_win", 'width = '+width+' , height = '+height+',resizable=0,scrollbars=0,menubar=0,status=0, left='+Math.max(0,(screen.width-width)/2)+', top='+Math.max(0,(screen.height-height)/2));
} else {
	new_win = window.open(url, "new_win", 'resizable=0,scrollbars=0,menubar=0,status=0,left=0,top=0');
	}
}

//изображения в новом окне	
function newWindow(url,id,width,height)
{
height=height+0;
if (loc!=id)
{
	zoom=window.open(url, id, 'width = '+width+' , height = '+height+',resizable=0,scrollbars=0,menubar=0,status=0, left='+Math.max(0,(screen.width-width)/2)+', top='+Math.max(0,(screen.height-height)/2))
	loc=id;
} else {
	if(document.all) zoom.close();
		else if(zoom.document) zoom.close();
	zoom=window.open(url, id, 'width = '+width+' , height = '+height+',resizable=0,scrollbars=0,menubar=0,status=0, left='+Math.max(0,(screen.width-width)/2)+', top='+Math.max(0,(screen.height-height)/2))
	}
}
	
//окно alert
function FormAlert(al,name,j)
{
var width, height;
if (j<7)
{width=250; height=250;}
else
{width=250; height=350;}

newWindow('win_new.htm?text=<center><b>Пожалуйста, заполните поля:</b></center><br>'+al,name,width,height);
}

//окно alert_system_message
function FormAlert2(al,name)
{
var width, height;
  width=250;
  height=200;

 if (ie) window.open('win_new.htm?text='+al, name,'width='+width+', height='+height+',resizable=0,scrollbars=0,menubar=0,status=0, left='+Math.max(0,(screen.width-width)/2)+', top='+Math.max(0,(screen.height-height)/2));
  else {
  var re=new RegExp("<br>","g");  
  alert(al.replace(re,"\n")); 
  }
}

//проверка форм
function CheckFields(fname,form_num)
{
var form_name=eval('document.'+fname);
var li=(ie) ?'<li>':''
var br=(ie) ?'':'\n'
	var al='';
	var j='';
	var al_post='';
temp_f=eval('f'+form_num+'_Fld');	
temp_a=eval('f'+form_num+'_Alrt');	

for (i=0; i<temp_f.length; i++)
{
	var item = eval('document.'+fname+'.'+temp_f[i]);
  re1 = new RegExp("^ +$","g");
	if (item.value=='' || re1.test(item.value))
 {
		al_post=al;
		al+=li+temp_a[i]+br;
		j++;
	}
}

if (al != '')
{
 if (ie) {
	FormAlert(al, fname, j);
	}
	else {
	alert('Заполните следующие поля:\n\n' + al);
	}
	return false;
	exit;
}

form_name.submit();
return true;
};

//проверка формы поиска

function CheckFormSpec()
{
var it=document.form_search;
var al='';

if (it.word.value=='Поиск'){
		al='Введите слово для поиска';
}

if (it.word.value.length<2){
		al='Слово для поиска должно содержать не менее 2-х символов';
}

if (al != '')
{
 if (ie) {
width=250;
height=150;
newWindow('win_new.htm?text='+al,"form0",width,height);
	}
	else {
	alert(al);
	}
	return false;
	exit;
}

it.submit();
return true;
};


//-->
