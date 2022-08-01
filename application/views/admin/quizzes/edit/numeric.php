<style>
	#result td.image img {
		margin-right: 10px;
	}
</style>
<script type="text/javascript">
	function active_answer(row) {
		$("#result .active").removeClass('active');
		$(row).addClass('active');
		//$(".item-handler button:disabled").removeAttr("disabled");
	}
	function up_answer() {
		var cur = $("#result .list-group-item.active");
		var prev = cur.prev(".list-group-item");
		cur.after(prev);
	}
	function down_answer() {
		var cur = $("#result .list-group-item.active");
		var next = cur.next(".list-group-item");
		cur.before(next);
	}
	function add_answer() {
		var num = $("#result .list-group .list-group-item").length;
		var row = $("#result .list-group .list-group-item:last").clone();
		$("input", row).each(function() {
			$(this).attr("name", $(this).attr("name").replace(num-1,num));
		});
		row.appendTo($("#result .list-group"));
	}
	function del_answer() {
		if(confirm("Sure Remove Item?")) {
			var cur = $("#result .list-group-item.active");
			cur.remove();
		}
	}
	function change_type(row) {
		var type = $("select", row).val();
		if(type=='between') {
			$("td.value",row).addClass("hidden");
			$("td.range",row).removeClass("hidden");
		} else {
			$("td.range",row).addClass("hidden");
			$("td.value",row).removeClass("hidden");
		}
	}
</script>
<div class="list-group">
	<?php if($content["answers"]) foreach($content["answers"] as $i=>$answer) : ?>
		<div id="answer-<?= $i ?>" class="list-group-item form-inline" onclick="active_answer(this)">
			<table width="100%">
				<tr>
					<td class="type" width="200px">
						<select name="content[answers][<?= $i ?>][type]" class="form-control input-sm" onchange="change_type($(this).parents('.list-group-item table'))">
							<?php foreach($operators as $k=>$v) { ?>
								<option class="input-sm" value="<?= $k ?>" <?= isset($answer["type"]) && $k==$answer["type"]?"selected":"" ?>><?= $v ?></option>
							<?php } ?>
						</select>
					</td>
					<td class="value <?= $answer["type"]=="between"?"hidden":"" ?>">
						<input type="number" class="form-control input-sm" name="content[answers][<?= $i ?>][value]" value="<?= strip_tags($answer["value"]) ?>"/>
					</td>
					<td class="range <?= $answer["type"]=="between"?"":"hidden" ?>">
						<input type="number" class="form-control input-sm" name="content[answers][<?= $i ?>][from]" value="<?= strip_tags($answer["from"]) ?>"/>
						~
						<input type="number" class="form-control input-sm" name="content[answers][<?= $i ?>][to]" value="<?= strip_tags($answer["to"]) ?>"/>
					</td>
					<td width="100px" class="partial <?= $this->partial?"":"hidden" ?>">
						<input type="number" min="0" class="form-control input-sm" name="content[answers][<?= $i ?>][points]" value="<?= $answer["points"] ?>">
					</td>
				</tr>
			</table>
		</div>
	<?php endforeach ?>
</div>
<div class="item-handler btn-group  btn-group-sm pull-right">
	<button type="button" class="btn btn-default" onclick="add_answer()">Append</button>
	<button type="button" class="btn btn-default" onclick="up_answer()">Up</button>
	<button type="button" class="btn btn-default" onclick="down_answer()">Down</button>
	<button type="button" class="btn btn-default" onclick="del_answer()">Remove</button>
</div>