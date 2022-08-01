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
</script>
<div class="list-group">
	<?php foreach($content["answers"] as $i=>$answer) : ?>
		<div id="answer-<?= $i ?>" class="list-group-item" onclick="active_answer(this)">
			<table width="100%">
				<tr>
					<td>
						<input type="text" class="form-control input-sm" name="content[answers][<?= $i ?>][html]" value="<?= strip_tags($answer["html"]) ?>"/>
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