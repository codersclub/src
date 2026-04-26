<? header('Content-Type: text/html; charset=windows-1251'); ?>

<? include('./ssi/top.html'); ?>

<TABLE border="0" align="center" cellpadding="0" cellspacing="0" width="970">
 <TR valign="top">
  <TD width=150>


<!-- Left Column -->

<? include('./ssi/leftmenu.html'); ?>

<BR>
<BR>

<? include('./ssi/leftbanner.html'); ?>
<br>
<br>



<? include('./ssi/toplist.html'); ?>

<BR>
<BR>


<!-- /Left Column -->
    </TD>



  <!-- CENTER Column -->
  <TD id="centercolumn">



<!-- NEWS BAND -->
   <H2 align="center">
     Интересные материалы:
   </H2>
   <table cellspacing="7" border="0" width="100%">
   <noindex>
   <? //include('./cgi-bin/news/news.cgi'); ?>
   </noindex>
   </table>
<!-- //NEWS BAND -->


<!-- MEETINGS -->
   <? include('./ssi/meetings.html'); ?>
<!-- MEETINGS -->

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

<? include('./ssi/right_banner.html'); ?>

</div>




<div class=inbox>

<? include('./ssi/right_banner_main.html'); ?>

</div>
</noindex>

<br>
<br>

<div class=inbox>

<? include('./ssi/right_vot_main.html'); ?>

</div>

<br>
<br>

<div class=inbox>

<? include('./ssi/right_vot_main2.html'); ?>

</div>


<br>
<br>

<div class=inbox>

<? include('./ssi/right_vot_main3.html'); ?>

</div>


<? include('./enews.html'); ?>





    </TD>
  </TR>
</TABLE>




<hr>

<TABLE border="0" align="center" cellpadding="0" cellspacing="0" width="750">
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
<br>

<noindex>
<!-- BOTTOM-RIGHT BANNER -->

<!-- /BOTTOM-RIGHT BANNER -->
</noindex>
</td>
</tr>
</table>









</BODY>
</HTML>

