<?php
    $numbers = range(0,count($content["answers"])-1);
    srand($solution_id);
    shuffle($numbers);
?>
<form class="list-group">
    <?php foreach($numbers as $i) : ?>
        <?php
            $answer = $content["answers"][$i];
        ?>
        <?php if($quiz_type==MultipleResponse) { ?>
            <label class="list-group-item">
                <table width="100%">
                    <tr>
                        <td width="25px">

                            <div class="checkbox-custom checkbox-default">
                                <input id="multiCheckbox<?php echo $i; ?>" type="checkbox" name="solution[]" <?= is_array($solution) && array_search($i,$solution)!==FALSE?"checked":"" ?> value="<?= $i ?>">

                                <label for="multiCheckbox<?php echo $i; ?>">  <?= strip_tags($answer["html"]) ?></label>
                            </div>


                        </td>
                        <?php if($answer["answer"]) { ?>
                            <td width="1px" class="image">
                                <img height="50px" src="/assets/image/<?= $answer["image"] ?>">
                            </td>
                        <?php } ?>
                        <!--<td>
                            <?/*= strip_tags($answer["html"]) */?>
                        </td>-->
                    </tr>
                </table>
            </label>
        <?php } ?>
        <?php if($quiz_type==MultipleSwitch) { ?>
            <div class="list-group-item">
                <table width="100%">
                    <tr>
                        <?php if($answer["answer"]) { ?>
                            <td width="1px" class="image">
                                <img height="50px" src="/assets/image/<?= $answer["image"] ?>">
                            </td>
                        <?php } ?>
                        <td>
                            <?= strip_tags($answer["html"]) ?>
                        </td>
                        <td align="right">
                            <label>
                                <input type="radio" name="solution[<?= $i ?>]" <?= $solution[$i]==1?"checked":"" ?> value="1">
                                <?= $content["message"]["true"] ?>
                            </label>
                            <label>
                                <input type="radio" name="solution[<?= $i ?>]" <?= $solution[$i]==="0"?"checked":"" ?> value="0">
                                <?= $content["message"]["false"] ?>
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>
    <?php endforeach ?>
</form>
