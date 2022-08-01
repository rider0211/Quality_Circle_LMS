<?php
    $words = array();
    foreach($content["answers"] as $answer)
        $words = array_merge($words, $answer["items"]);
    srand($solution_id);
    shuffle($words);
    $picked = array();
?>
<style>
    .target .list-group-item-header {
        padding: 8px;
    }
</style>
<form class="form-inline list-group">
    <?php foreach($content["answers"] as $i=>$answer) { ?>
        <div class="target list-group-item" style="width: 100%">
            <label class="control-label list-group-item-header pull-left"><?= $answer["html"] ?></label>
            <?php if($solution[$i]) foreach($solution[$i] as $w=>$word) { ?>
                <label class="form-control input-sm" draggable><?= $word ?><input type="hidden" name="solution[<?= $i ?>][]" value="<?= $word ?>"></label>
                <?php $picked[] = $word ?>
            <?php } ?>
        </div>
    <?php } ?>
</form>
<p style="padding-top: 20px; margin: 0" class="form-inline">
    <?php foreach($words as $i=>$word) : ?>
        <?php
            if($picked && array_search($word,$picked)!==FALSE) {
                continue;
            }
        ?>
        <label class="form-control input-sm" draggable><?= $word ?><input type="hidden" value="<?= $word ?>"></label>
    <?php endforeach ?>
</p>

