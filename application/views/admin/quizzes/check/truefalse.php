<?php
    $numbers = range(0,count($content["answers"])-1);
    srand($solution_id);
    shuffle($numbers);
?>
<form class="list-group">
	<div>
		<label style="padding-right:20px">
			<input type="radio" name="solution[correct]" <?= $solution->correct=="true"?checked:'' ?> value="true">
			<?= $content["message"][0] ?>
		</label>
		<label>
			<input type="radio" name="solution[correct]" <?= $solution->correct=="false"?checked:'' ?> value="false">
			<?= $content["message"][1] ?>
		</label>
	</div>
    <?php foreach($numbers as $i) : ?>
        <?php
            $answer = $content["answers"][$i];
        ?>
		<label class="list-group-item">
			<table width="100%">
				<tr>
					<td width="25px">
						<input type="checkbox" name="solution[reason][]" <?= is_array($solution->reason) && array_search($i,$solution->reason)!==FALSE?"checked":"" ?> value="<?= $i ?>">
					</td>
					<?php if($answer["answer"]) { ?>
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
</form>
