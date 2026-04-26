<div class="page_list">
  <? if(empty($page_list)) { ?>
    <a href="/news/">Все новости...</a>
  <? } else { ?>
    <?= $page_list ?> <span>&nbsp;&nbsp;(<?= $total ?>)</span>
  <? } ?>
</div>

