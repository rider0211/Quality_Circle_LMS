<div class="list-group">
	<?php if($question["answers"]) foreach($question["answers"] as $i=>$item) : ?>
		<div class="list-group-item" onclick="active_row(this)">
			<input type="text" class="form-control input-sm" name="content[answers][<?= $i ?>][html]" value="<?= $item[html] ?>"/>
		</div>
	<?php endforeach ?>
</div>
<div class="row">
	<div class="item-handler btn-group  btn-group-sm pull-right">
		<button type="button" class="btn btn-default" onclick="add_row(this)">ADD</button>
		<button type="button" class="btn btn-default" onclick="del_row(this)">DELETE</button>
	</div>
</div>
