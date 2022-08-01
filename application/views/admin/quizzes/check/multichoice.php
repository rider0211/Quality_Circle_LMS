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
        <label class="list-group-item">
            <table width="100%">
                <tr>
                    <td width="25px">
                        <div class="radio-custom">
                            <input id="multiChoice<?php echo $i; ?>" type="radio" name="solution" <?= $solution!=NULL && $solution[correct]==$i?"checked":"" ?> value="<?= $i ?>">
                            <label for="multiChoice<?php echo $i; ?>"><?= strip_tags($answer["html"]) ?></label>
                        </div>
                     </td>
                    <?php if($answer["image"]) { ?>
                        <td width="1px" class="image">
                            <img height="50px" src="/assets/image/<?= $answer["image"] ?>">
                        </td>
                    <?php } ?>
                 <!--   <td>
                        <?/*= strip_tags($answer["html"]) */?>
                    </td>-->
                </tr>
            </table>
        </label>
    <?php endforeach ?>
</form>
