<?php
//-------------------------------------------------
// SOURCES.RU Index Layout

require_once(THIS_PATH."ssi/top.html");

?>

<TABLE border="0" align="center" cellpadding="0" cellspacing="0" width="970">
 <TR valign="top">
  <TD width=150>


<!-- Left Column -->

<?php
require_once(THIS_PATH."ssi/leftmenu.html");
?>

<BR>
<BR>

<?php
require_once(THIS_PATH."ssi/leftbanner.html");
?>

<br>
<br>


<center>

<noindex>

<!--TopList COUNTER-->
<a target="_top" href="http://top.list.ru/jump?from=89876">
<script language="JavaScript"><!--
d=document;a='';a+=';r='+escape(d.referrer)
js=10//--></script>
<script language="JavaScript1.1"><!--
a+=';j='+navigator.javaEnabled()
js=11//--></script>
<script language="JavaScript1.2"><!--
s=screen;a+=';s='+s.width+'*'+s.height
a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth)
js=12//--></script>
<script language="JavaScript1.3"><!--
js=13//--></script>
<script language="JavaScript"><!--
d.write('<img src="http://top.list.ru/counter'+
'?id=89876;t=57;js='+js+a+';rand='+Math.random()+
'" alt="TopList" '+ 'border=0 height=31 width=88>')
if(js>11)d.write('<'+'!-- ')//--></script>
<noscript>
<img src="http://top.list.ru/counter?js=na;id=89876;t=57"
border="0" height="31" width="88" alt="TopList">
</noscript>
<script language="JavaScript"><!--
if(js>11)d.write('--'+'>')//--></script></a>
<!--/TopList COUNTER-->

<a href="http://counter.rambler.ru/top100/"><img
src="http://counter.rambler.ru/top100.cnt?163871" alt="Rambler's Top100"
width="1" height="1" border="0"></a>

<!-- SpyLOG f:0211 -->
<script language="javascript"> 
u="u1624.10.spylog.com";d=document;nv=navigator;na=nv.appName;p=0;j="N"; 
d.cookie="b=b";c=0;bv=Math.round(parseFloat(nv.appVersion)*100); 
if (d.cookie) c=1;n=(na.substring(0,2)=="Mi")?0:1;rn=Math.random(); 
z="p="+p+"&rn="+rn+"&c="+c;if (self!=top) {fr=1;} else {fr=0;} 
sl="1.0";</script>
<script language="javascript1.1"> 
pl="";sl="1.1";j = (navigator.javaEnabled()?"Y":"N");</script>
<script language="javascript1.2"> 
sl="1.2";s=screen;px=(n==0)?s.colorDepth:s.pixelDepth; 
z+="&wh="+s.width+'x'+s.height+"&px="+px; 
</script>
<script language="javascript1.3"> 
sl="1.3"</script>
<script language="javascript"> 
y="";y+="<a href='http://"+u+"/cnt?f=3&p="+p+"&rn="+rn+"' target=_blank>"; 
y+="<img src='http://"+u+"/cnt?"+z+"&j="+j+"&sl="+sl+ 
"&r="+escape(d.referrer)+"&fr="+fr+"&pg="+escape(window.location.href); 
y+="' border=0 width=88 height=31 alt='SpyLOG'>"; 
y+="</a>"; d.write(y);if(!n) { d.write("<"+"!--"); }//--></script>
<noscript>
<a href="http://u1624.10.spylog.com/cnt?f=3&amp;p=0" target="_blank"><img
src="http://u1624.10.spylog.com/cnt?p=0" alt="SpyLOG" border="0" width="88"
height="31"></a>
</noscript>
<script language="javascript1.2"><!-- 
if(!n) { d.write("--"+">"); }//--></script>
<!-- /SpyLOG -->

<!-- HotLog -->
<script language="javascript">
hotlog_js="1.0";hotlog_d=document; hotlog_n=navigator;hotlog_rn=Math.random();
hotlog_n_n=(hotlog_n.appName.substring(0,3)=="Mic")?0:1;
hotlog_r=""+hotlog_rn+"&s=14399&r="+escape(hotlog_d.referrer)+"&pg="+
escape(window.location.href);
hotlog_d.cookie="hotlog=1"; hotlog_r+="&c="+(hotlog_d.cookie?"Y":"N");
hotlog_d.cookie="hotlog=1; expires=Thu, 01-Jan-70 00:00:01 GMT"</script>
<script language="javascript1.1">
hotlog_js="1.1";hotlog_r+="&j="+(navigator.javaEnabled()?"Y":"N")</script>
<script language="javascript1.2">
hotlog_js="1.2";hotlog_s=screen;
hotlog_r+="&wh="+hotlog_s.width+'x'+hotlog_s.height+"&px="+((hotlog_n_n==0)?
hotlog_s.colorDepth:hotlog_s.pixelDepth)</script>
<script language="javascript1.3">hotlog_js="1.3"</script>
<script language="javascript">hotlog_r+="&js="+hotlog_js;
hotlog_d.write("<img src=\"http://hit2.hotlog.ru/cgi-bin/hotlog/count?"+
hotlog_r+"&\" border=0 width=1 height=1>")</script>
<noscript><img src="http://hit2.hotlog.ru/cgi-bin/hotlog/count?s=14399"
border="0" width="1" height="1"></noscript>
<!-- /HotLog -->

</noindex>	

</center>

<BR>
<BR>


<!-- /Left Column -->
    </TD>



  <!-- CENTER Column -->
  <TD id="centercolumn">



<!-- NEWS BAND -->
<?php
echo grab_forum(90,7,'Новости сайта и форума:');
?>
<!-- //NEWS BAND -->





<!-- NEW SOURCES -->
<?php
echo grab_forum(150,7,'Новые исходники:');
?>
<!-- //NEW SOURCES -->





<!-- NEW SOFT -->
<?php
echo grab_forum(167,7,'Новое и полезное ПО:');
?>
<!-- //NEW SOFT -->





<!-- MEETINGS -->
<?php
//our_meetings();
?>
<!-- //MEETINGS -->


   </TD>



   <!-- RIGHT COLUMN -->
   <TD width="150">



<!--

<div class=boxtitle>
Внимание
</div>
<div class=boxcontent>
Для желающих поделиться с народом исходниками:
<A href="mailto:sources@pisem.net">sources@pisem.net</A>
<BR>
<BR>
</div>

-->

<noindex>
<div class=boxcontent>

<?php
require_once(THIS_PATH."ssi/right_banner.html");
?>


</div>




<div class=inbox>

<?php
require_once(THIS_PATH."ssi/right_banner_main.html");
?>


</div>
</noindex>


<br>
<br>

<div class=inbox>

<?php
require_once(THIS_PATH."ssi/right_vot_main.html");
?>

</div>

<br>
<br>

<div class=inbox>

<?php
require_once(THIS_PATH."ssi/right_vot_main2.html");
?>

</div>


<br>
<br>

<div class=inbox>

<?php
require_once(THIS_PATH."ssi/right_vot_main3.html");
?>


</div>





<?php
//require_once(THIS_PATH."enews.html");
?>






    </TD>
  </TR>
</TABLE>




<hr>

<TABLE border="0" align="center" cellpadding="0" cellspacing="4" width="970">
<tr align="center">
<td width="50%">

<!-- BOTTOM-LEFT BANNER -->

<!--div class=bordered style="height:60;overflow:auto"-->
<!--div class=bordered style="height:60"-->
<div class=bordered>
<div class=inbox>

<!-- left banner text -->
<br>
</div>
</div>
<!-- /BOTTOM-LEFT BANNER -->
</td>


<td>

<!--bizar-->
Гаражные <a href="http://www.bestrol.ru/" title="рольставни">рольставни</a> ворота, встроенные рольставни
<br>

<noindex>

<!-- BOTTOM-RIGHT BANNER -->

<SCRIPT language='JavaScript'> var loc = ''; </SCRIPT>
<SCRIPT language='JavaScript1.4'>try{ var loc = escape(top.location.href); }catch(e){;}</SCRIPT>
<SCRIPT language='JavaScript'>
 document.write("<SC"+"RIPT language='JavaScript' src='http://ad.strict.tbn.ru/bb.cgi?cmd=ad&hreftarget=_blank&pubid=2850676&pg=3&r=js&ssi=nofillers&vbn=353&num=1&w=468&h=60&&ref="+escape(document.referrer)+"&loc="+loc+"&nocache="+Math.round(Math.random()*999111)+"'>\n</SC"+"RIPT>");
</SCRIPT>

<!-- /BOTTOM-RIGHT BANNER -->
</noindex>

</td>
</tr>
</table>







<P align="center">
<A href="cit.html">
<FONT color="#FFFFFF">
&nbsp;1</FONT>
</A>
</P>

</BODY>
</HTML>
 
