<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/**
 * DokuWiki Sidebar Template
 * @author Christopher Smith <chris@jalakai.co.uk>
 *
 * This template is the Dokuwiki Default Template with
 * a few alterations
 *
 * @link   http://wiki.splitbrain.org/wiki:tpl:templates
 * @author Andreas Gohr <andi@splitbrain.org>
 */

// include functions that provide sidebar functionality
@require_once(dirname(__FILE__).'/tplfn_sidebar.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php tpl_pagetitle()?> [<?php echo hsc($conf['title'])?>]</title>

  <?php tpl_metaheaders()?>

  <link rel="shortcut icon" href="<?php echo DOKU_TPL?>images/favicon.ico" />

  <?php /*old includehook*/ @include(dirname(__FILE__).'/meta.html')?>
</head>

<body


<?php if ($conf['sidebar']['enable']) echo " class='$sidebar_class'"; ?>




<?php /*old includehook*/ /* vot @include(dirname(__FILE__).'/topheader.html') */ ?>
<?php /*old includehook*/ @include($conf['datadir'].'/site/topheader.txt')?>


<?php
// echo "Debug ID=".$ID ."<br>";
// echo "Debug ACT=".$ACT ."<br>";
?>


<table cellspacing="0" width="100%">
<tr align="left">

 <td>
    <?php if($conf['breadcrumbs']){?>
    <div class="breadcrumbs">
      <?php tpl_breadcrumbs()?>
      <?php //tpl_youarehere() //(some people prefer this)?>
    </div>
    <?php }?>

    <?php if($conf['youarehere']){?>
    <div class="breadcrumbs">
      <?php tpl_youarehere() ?>
    </div>
    <?php }?>


 </td>


 <td align="right">

        <?php tpl_searchform()?>

 </td>


</tr></table>










<div class="dokuwiki">
  <?php html_msgarea()?>


  <?php /*old includehook*/ //@include(dirname(__FILE__).'/pageheader.html')?>
  <?php /*old includehook*/ @include($conf['datadir'].'/site/pageheader.txt')?>



  <div class="page">



  <div class="stylehead">

<!--
    <div class="header">
      <div class="pagename">
        [[<?php tpl_link(wl($ID,'do=backlink'),tpl_pagename($ID)) ?>]]
      </div>
      <div class="logo">
        <?php tpl_link(wl(),$conf['title'],'name="top" accesskey="h" title="[ALT+H]"')?>
      </div>
    </div>
-->


    <?php /*old includehook*/ //@include(dirname(__FILE__).'/header.html')?>
    <?php /*old includehook*/ @include($conf['datadir'].'/site/header.txt')?>



    <div class="bar" id="bar__top">
      <div class="bar-left" id="bar__topleft">
        <?php tpl_button('edit')?>
        <?php tpl_button('history')?>
      </div>

      <div class="bar-right" id="bar__topright">
        <?php tpl_button('recent')?>
      </div>
    </div>

  </div>






    <!-- wikipage start -->
    <?php tpl_content()?>
    <!-- wikipage stop -->
  </div>





  <?php if ($conf['sidebar']['enable']) { ?>
    <div id="sidebar"><?php tpl_sidebar(); ?>


    <!-- LEFT BANNER -->
    <?php
       if($conf['start'] == $ID) {
	@include($conf['datadir'].'/site/leftbanner.txt');
       }
    ?>
    <!-- /LEFT BANNER -->




    <!-- COUNTERS -->
    <?php
	@include($conf['datadir'].'/site/counters.txt');
    ?>
    <!-- /COUNTERS -->






    </div><!--/sidebar-->

  <?php } ?>


  <?php flush()?>




  <div class="stylefoot">

    <div class="meta">
      <div class="user">
        <?php tpl_userinfo()?>
      </div>
      <div class="doc">
        <?php tpl_pageinfo()?>
      </div>
    </div>

   <?php /*old includehook*/ //@include(dirname(__FILE__).'/pagefooter.html')?>
   <?php /*old includehook*/ @include($conf['datadir'].'/site/pagefooter.txt')?>

    <div class="bar" id="bar__bottom">
      <div class="bar-left" id="bar__bottomleft">
        <?php tpl_button('edit')?>
        <?php tpl_button('history')?>
      </div>
      <div class="bar-right" id="bar__bottomright">
        <?php tpl_button('subscription')?>
        <?php tpl_button('admin')?>
        <?php tpl_button('profile')?>
        <?php tpl_button('login')?>
        <?php tpl_button('index')?>
        <?php tpl_button('top')?>&nbsp;
      </div>
    </div>

  </div>

</div>

<?php /*old includehook*/ /* @include(dirname(__FILE__).'/footer.html') */ ?>
<?php /*old includehook*/ @include($conf['datadir'].'/site/footer.txt')?>

<div class="no"><?php tpl_indexerWebBug()?></div>
</body>
</html>
