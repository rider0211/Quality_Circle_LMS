<?php if($trainings) foreach($trainings as $t) { ?>
	<div class="list-group-item form-inline" data-id="<?php echo $t["id"] ?>">
		<span class="form-control" style="border:none; font-size: 0.85rem;"><?php echo $t["training_title"] ?></span>
		<span class="selectable-img" onclick="selectTopic(this)"></span>
	</div>
<?php } ?> 