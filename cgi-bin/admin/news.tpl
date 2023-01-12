<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<TITLE><pagetitle></TITLE>
<style type="text/css">
BODY {FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif;}
TEXTAREA {FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif;}
A.black:link {COLOR: #000000; TEXT-DECORATION: none;FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif; FONT-SIZE: 9pt}
A.black:visited {COLOR: #000000; TEXT-DECORATION: none;FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif; FONT-SIZE: 9pt}
A.black:hover {COLOR: #FFFFFF; TEXT-DECORATION: none;FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif; FONT-SIZE: 9pt}
A.blue:link {COLOR: #0441A6; TEXT-DECORATION: none;FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif; FONT-SIZE: 9pt}
A.blue:visited {COLOR: #0441A6; TEXT-DECORATION: none;FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif; FONT-SIZE: 9pt}
A.blue:hover {COLOR: #2776FA; TEXT-DECORATION: none;FONT-FAMILY: Arial,Verdana,Tahoma,sans-serif; FONT-SIZE: 9pt}
.b {text-decoration: none; color:#FF0000;} 
.b:hover {color:#7785FF;}
.c {text-decoration: none; color:#000000;} 
.c:hover {color:#FFFFFF;}
 pre {color: blue;}
PRE.a {color: black;}
TD.colon {COLOR: #000000; FONT-FAMILY: "MS Sans Serif", sans-serif; FONT-SIZE: 9pt}
</style>
<SCRIPT language=JavaScript><!--
var apNm = navigator.appName;
if (apNm.indexOf('Microsoft')>=0) apNm = "MSIE";
//var selectedItem = -1;
var startnum=$startnum;
var stopnum=$stopnum;

function getnum() {
 var n = -1;
 if (document.myform.num) {
  for (var i=startnum;i<=stopnum;i++) {
   if (document.myform.num[i]) {
    if (document.myform.num[i].checked) {
     n = document.myform.num[i].value;
    }
   }
  }
 }
 return n;
}

function help() {
 nw = window.open("/adminhelp.html","help","screenX=250,screenY=70,toolbar=0,location=0,directories=0,status=0,menubar=0,resizable=1,width=384,height=410");
}

function dothis(action) {
 var selectedItem = -1;
 document.myform.action.value = '';

 if ((action == 'edit') || (action == 'del')) {
   selectedItem = getnum();
   if (selectedItem < 0) {
    alert('Выберите один из объектов!  ');
    return;
   }
 }

 if (action.indexOf('start') == 0) {
   n = action.substr(6);
   document.myform.start.value = n;
   action='';
 }

 if (action == 'del') {
  ttx = eval('t'+selectedItem+'.innerText');
  ntx = eval('p'+selectedItem+'.innerText');
  if (!confirm("Удалить этот объект?\n\n"+ttx+"\n----------\n"+ntx)) {
   return;
  }
 }
 document.myform.action.value = action;
// alert('Action='+action+' n='+document.myform.start.value);
 document.myform.submit();
 document.myform.num.value = -1;
}
//--></SCRIPT>
</head>

<body topmargin="0" leftmargin="0" marginwidth="0" marginheigth="0" bgcolor=white>
<parameters>
<center>
<form action="/cgi-bin/sources/search/search.cgi" method="get" align="left">
  <input type="hidden" name="stpos" value="0"><table border="0" cellpadding="0"
  cellspacing="0" width="750">
    <tr>
      <td valign="top" rowspan="2"><table border="0" cellpadding="0" cellspacing="0" width="287">
        <tr>
          <td colspan="2" bgcolor="#A5E4A7" valign="middle" align="center"><b>WWW.ИСХОДНИКИ.РУ</b></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">cpp.sources.ru</font></b></td>
        </tr>
        <tr>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">java.sources.ru</font></b></td>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>web.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>soft.sources.ru</b></font></td>
        </tr>
        <tr>
          <td bgcolor="#C0C0C0" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>jdbc.sources.ru</b></font></td>
          <td bgcolor="#A5E4A7" valign="middle" align="center"><font face="Tahoma"
          style="font-size: 8pt" size="-1"><b>asp.sources.ru</b></font></td>
          <td bgcolor="#000080" valign="middle" align="center"><b><font face="Tahoma"
          style="font-size: 8pt" size="-1" color="#FFFFFF">api.sources.ru</font></b></td>
        </tr>
      </table>
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td><font style="font-size: 8pt" size="2" face="Tahoma">&nbsp; Поиск по
          программированию :<br>
          </font>&nbsp; <input type="text" size="13" name="query"> <input type="submit"
          value="Поиск"><font size="1"><input
          TYPE="Radio" NAME="stype" VALUE="AND" checked>&quot;AND&quot; <input TYPE="Radio"
          NAME="stype" VALUE="OR">&quot;OR&quot;</font>
</td>
        </tr>
      </table>
      </td>
      <td align="center"><font style="font-size: 15pt" color="#4904B1" size="4"
      face="Times New Roman">Информационный сервер</font></td>
    </tr>
    <tr>
      <td>
      </td>
    </tr>
    <tr>
      <td colspan="2"><table border="0" cellpadding="0" cellspacing="1" width="100%">
        <tr>
          <td align="center" width="11%" bgcolor="#E0E0C6"><a
          href="/"><font color="#000000" size="2">На главную</font></a></td>
          <td align="center" width="20%" bgcolor="#E0E0C6"><a
          href="/subscribe.shtml"><font color="#000000" size="2">Подписаться на новости</font></a></td>
          <td align="center" width="11%" bgcolor="#E0E0C6"><a href="http://pascal.sources.ru/cgi-bin/forum/YaBB.cgi"><font color="#000000" size="2">Форум</font></a></td>
          <td align="center" width="9%" bgcolor="#E0E0C6"><a href="/books.shtml"><font color="#000000" size="2">Книги</font></a></td>
          <td align="center" width="9%" bgcolor="#E0E0C6"><a href="http://www.mastak.ru/p/2724"><font color="#000000" size="2">Хостинг</font></a></td>
          <td align="center" width="13%" bgcolor="#E0E0C6"><a href="http://www.countries.ru/"><font color="#000000" size="2">Страны мира</font></a></td>
          <td align="center" width="29%" bgcolor="#E0E0C6"><!--#include virtual="/cgi-bin/sources/times/numberuser.pl"--></td>
        </tr>
      </table>
      </td>
    </tr>
  </table>
</form>

<table cellspacing="8" cellpadding="0" border="0" width="775">

    <tr>
    <td colspan=2>
      <h1 align="center"><pagetitle></h1>
      </td>
    </tr>

    <tr>

<FORM method=POST name=myform action="<newsscript>">
<input type="hidden" name="start" value="<start>">
<input type="hidden" name="login" value="<login>">
<input type="hidden" name="action" value="">
    <!-- ---------------------  begin LEFT Column  --------------------- -->

    <td valign="top">

      <table bgcolor="#000080" cellspacing="1" cellspacing="0" border="0">
        <tr>
          <td width="180" align="center"><b><font color="#FFFFFF" face="Tahoma"><small>Новости:</small></font></b></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td bgcolor="#A5E4A7" colspan="2">&nbsp;<b><font face="Tahoma"><small>Действия:</small></font></b></td>
              </tr>
              <tr>
                <td valign="middle" align="center">•</td>
                <td><a class="blue" href="javascript:dothis('add');"><b>Добавить</b></a></td>
              </tr>
              <tr>
                <td valign="middle" align="center">•</td>
                <td><a class="blue" href="javascript:dothis('edit');"><b>Изменить</b></a></td>
              </tr>
              <tr>
                <td valign="middle" align="center">•</td>
                <td><a class="blue" href="javascript:dothis('del');"><b>Удалить</b></a></td>
              </tr>
              <tr>
                <td valign="middle" align="center">•</td>
                <td><a class="blue" href="javascript:dothis('show');"><b>Список</b></a></td>
              </tr>


<config>

              <tr>
                <td colspan=2>&nbsp</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

    </td>

    <td align="right" valign="top">


      <!-- ---------------------  begin content  --------------------- -->
      <table cellspacing="0" cellpadding="2" border="0" width="100%">
        <tr>
          <td colspan=2 align="center" bgcolor="#000080"><b><font color="#FFFFFF" face="Tahoma"><small>Новые исходники и статьи:</small></font></b></td>
        </tr>
        <pagelist>
$body
        <pagelist>
      </table>
      <br>

      <!-- ---------------------  end content  --------------------- -->

    </td>
  </tr>
</FORM>

  <!-- ---------------------  begin counters and horisontal line  --------------------- -->

  <tr>
    <td align="center" valign="bottom">
      <br>
      <BR>
<!--Rating@Mail.ru COUNTER-->
<!--/COUNTER-->


<br>
<!--NUMBER ONE COUNTER-->
<!--NUMBER ONE COUNTER-->

<BR>
<!-- SpyLOG f:0211 -->
<!-- SpyLOG  -->

      <br>
      <br>
    </td>
    <!-- not visible <td></td> -->
  </tr>

  <tr>
    <td valign="top" align="center" height=24>
      <a href="http://www.sources.ru/">Исходники.Ру</a>
    </td>
    <td valign="top">
      &nbsp;
    </td>
  </tr>
</table>

<br>
</center>
</body>
</html>
