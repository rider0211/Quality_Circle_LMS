<?php
    $order = range(0,count($content["answers"])-1);
    srand($id);
    shuffle($order);
    if(!$solution) {
        $solution = $order;
        srand($solution_id);
        shuffle($solution);
    }
?>
<form>
    <ul class="list-group">
    <?php foreach($solution as $i) : ?>
        <?php
            for($j=0;$j<count($order);$j++) {
                if($i==$order[$j]) {
                    $answer = $content["answers"][$j];
                    break;
                }
            }
        ?>
        <li class="list-group-item" draggable>
            <table width="100%">
                <tr>
                    <?php if($answer["image"]) { ?>
                        <td width="1px" class="image">
                            <img height="50px" src="/assets/image/<?= $answer["image"] ?>">
                        </td>
                    <?php } ?>
                    <td>
                        <?= strip_tags($answer["html"]) ?>
                        <input type="hidden" name="solution[]" value="<?= $i ?>">
                    </td>
                </tr>
            </table>
        </li>
    <?php endforeach ?>
    </ul>
</form>
