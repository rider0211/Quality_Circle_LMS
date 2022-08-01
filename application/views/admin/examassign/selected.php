<?php if($exams) foreach($exams as $t) { ?>
	<div class="list-group-item form-inline" data-id="<?php echo $t["id"] ?>" data-assign="<?php echo $t["assign_id"] ?>">
		<span class="selected-img" onclick="deselectTopic(this)"></span>
		<span class="form-control" style="border:none"><?php echo $t["exam_title"] ?></span>
		<input class="pull-right form-control form-control-sm datepicker" onchange="updateDate(this)" value="<?php echo $t["start_date"] ?>">
	</div>
<?php } ?> 