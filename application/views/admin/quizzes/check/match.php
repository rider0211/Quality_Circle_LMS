<div class="row">
    <div class="col-sm-5" style="padding-right: 0">
        <div class="list-group column1">
            <?php
                srand(time());
                $numbers1 = range(0,count($content["column1"])-1);
                $numbers2 = range(0,count($content["column2"])-1);
                shuffle($numbers1);
                shuffle($numbers2);
            ?>
            <?php foreach($numbers1 as $i) : ?>
                <?php
                    $answer = $content["column1"][$i];
                ?>
                <label class="list-group-item">
                    <table width="100%">
                        <tr>
                            <?php if($answer["image"]) { ?>
                                <td width="1px" class="image">
                                    <img height="50px" src="/assets/image/<?= $answer["image"] ?>">
                                </td>
                            <?php } ?>
                            <td>
                                <?= strip_tags($answer["html"]) ?>
                            </td>
                            <td width="30px" align="right">
                                <input type="radio" name="column1" value="<?= $i ?>" onchange="match_column()">
                            </td>
                        </tr>
                    </table>
                </label>
            <?php endforeach ?>
        </div>
    </div>
    <div class="col-sm-2" style="padding:0">
        <form>
            <?php if($solution) foreach($solution as $i=>$match) { ?>
                <span class="match">
                    <input type="hidden" name="solution[<?= $i ?>][column1]" value="<?= $match->column1 ?>">
                    <input type="hidden" name="solution[<?= $i ?>][column2]" value="<?= $match->column2 ?>">
                </span>
            <?php } ?>
        </form>
        <canvas height="0"></canvas>
    </div>
    <div class="col-sm-5" style="padding-left: 0">
        <div class="list-group column2">
            <?php foreach($numbers2 as $i) : ?>
                <?php
                    $answer = $content["column2"][$i];
                ?>
                <label class="list-group-item">
                    <table width="100%">
                        <tr>
                            <td width="30px">
                                <input type="radio" name="column2" value="<?= $i ?>" onchange="match_column()">
                            </td>
                            <?php if($answer["image"]) { ?>
                                <td width="1px" class="image">
                                    <img height="50px" src="/assets/image/<?= $answer["image"] ?>">
                                </td>
                            <?php } ?>
                            <td>
                                <?= strip_tags($answer["html"]) ?>
                            </td>
                        </tr>
                    </table>
                </label>
            <?php endforeach ?>
        </div>
    </div>
</div>