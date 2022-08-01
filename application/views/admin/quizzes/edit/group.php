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
		var num = $("#result .list-group.answers .list-group-item").length;
		var row = $("#result .list-group.answers .list-group-item:last").clone().unbind("click").click(function() {
			edit_answer(num+2);
		});
		$("input", row).each(function() {
			$(this).attr("name", $(this).attr("name").replace(num-1,num));
		});
		row.appendTo($("#result .list-group.answers"));

		row = $("#items #new").clone().removeAttr("id");
		$("input", row).each(function() {
			$(this).attr("name", "content[answers]["+num+"]" + this.name);
		});
		row.appendTo($("#items"));
	}
	function del_answer() {
		if(confirm("Sure Remove Column?")) {
			var cur = $("#result .answers .list-group-item.active");
			cur.remove();
		}
	}
	function edit_answer(id) {
		$("#edit .modal-body").html("").append($("#items > :nth-child("+id+")").clone());
		$("#edit button#btn-ok").unbind("click").click(function() {
			$("#items > :nth-child("+id+")").replaceWith($("#edit .modal-body .list-group"));
		});
		$("#edit button#btn-cancel").unbind("click").click(function() {
			$("#edit .modal-body .list-group").remove();
		});
	}
	function active_item(row) {
		$("#edit .active").removeClass('active');
		$(row).addClass('active');
	}
	function add_item() {
		var num = $("#edit .list-group .list-group-item").length;
		var row = $("#edit .list-group .list-group-item:last").clone().removeClass("active");
		row.appendTo($("#edit .list-group"));
	}
	function del_item() {
		if(confirm("Sure Remove Item?")) {
			var cur = $("#edit .list-group-item.active");
			cur.remove();
		}
	}
</script>
<div class="list-group answers">
	<?php foreach($content["answers"] as $i=>$answer) : ?>
		<div id="answer-<?= $i ?>" class="list-group-item" onclick="active_answer(this)">
			<table width="100%">
				<tr>
					<td width="1px" class="image">
						<input type="hidden" name="content[answers][<?= $i ?>][image]" value="<?= $answer["image"] ?>">
						<img class="<?= $answer["image"]?"":"hidden" ?>" height="50px" src="/assets/image/<?= $answer["image"] ?>">
					</td>
					<td>
						<input type="text" class="form-control input-sm" name="content[answers][<?= $i ?>][html]" value="<?= strip_tags($answer["html"]) ?>"/>
					</td>
					<td width="100px">
						<div class="btn-group btn-group-sm pull-right">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#edit" onclick="edit_answer(<?= $i+2 ?>)">Items</button>
						</div>
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
<div id="items" class="hidden">
	<div id="new" class="list-group">
		<div class="list-group-item" onclick="active_item(this)">
			<input type="text" class="form-control input-sm" name="[items][]"/>
		</div>
	</div>
	<?php foreach($content["answers"] as $i=>$answer) : ?>
		<div class="list-group">
			<?php foreach($answer["items"] as $item) : ?>
				<div class="list-group-item" onclick="active_item(this)">
					<input type="text" class="form-control input-sm" name="content[answers][<?= $i ?>][items][]" value="<?= $item ?>"/>
				</div>
			<?php endforeach ?>
		</div>
	<?php endforeach ?>
</div>
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content panel panel-primary form-horizontal">
			<div class="modal-header panel-heading">
				<h4 class="modal-title" id="myModalLabel">Items</h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<div class="item-handler btn-group pull-left">
					<button type="button" class="btn btn-default" onclick="add_item()">Append</button>
					<button type="button" class="btn btn-default" onclick="del_item()">Remove</button>
				</div>
				<button id="btn-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="btn-ok" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>