    <div class="announce">
        <span class="img">
            <?//= $n ?>
            <?= $row['date'] ?>
            <br>
<? if($row['img']) { ?>
            <img src="<?= $row['img'] ?>">
<? } ?>
        </span>

        <span>
            <?= $row['user'] ?>
            <br>
<? if($row['link']) { ?>
            <a href="<?= $row['link'] ?>"><?= $row['title'] ?></a>
<? } else { ?>
            <?= $row['title'] ?>
<? } ?>
            <br>
            <?= $row['text'] ?>
        </span>
    </div>
