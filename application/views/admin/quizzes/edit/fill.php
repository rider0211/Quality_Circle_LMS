<style>
	#blanks td.image img {
		margin-right: 10px;
	}
	#details .editor-body iframe {
		height: 300px;
	}
</style>
<script type="text/javascript">
	var a_count = <?= $content["answers"]?count($content["answers"]):0 ?>;
    function add_blank() {
    	editor = CKEDITOR.instances["content[detail][html]"];
    	
		$("#edit .modal-body").append($("#new").clone().removeAttr("id"));
		$("#edit .modal-body .list-group-item:first input:text").val(editor.getSelection().getSelectedText());
		$("#edit button#btn-ok").unbind("click").click(function() {
			var id = a_count++;
			var blank ="<button data-id='"+id+"' contenteditable=false onclick='edit_blank(this)'><button>";
			//if ( editor.mode == 'wysiwyg' ) {
				editor.insertHtml(blank);
			//}
			
			$("#edit input").each(function() {
				this.name = "answers[" + id + "]" + this.name;
			});
			$("#blanks #answer-" + id).remove();
			$("#blanks").append($("#edit .modal-body .list-group").attr("id","answer-"+id));
		});
		$("#edit button#btn-cancel").unbind("click").click(function() {
			$("#edit .modal-body").html("");
		});
		$("#edit").modal();
	}
	function active_answer(row) {
		$("#edit .active").removeClass('active');
		$(row).addClass('active');
	}
	function up_answer() {
		var cur = $("#edit .list-group-item.active");
		var prev = cur.prev(".list-group-item");
		cur.after(prev);
	}
	function down_answer() {
		var cur = $("#edit .list-group-item.active");
		var next = cur.next(".list-group-item");
		cur.before(next);
	}
	function add_answer() {
		var num = $("#edit .list-group .list-group-item").length;
		var row = $("#edit .list-group .list-group-item:last").clone().removeClass("active");
		$("input", row).each(function() {
			$(this).attr("name", $(this).attr("name").replace("["+(num-1)+"][html]","["+num+"][html]"));
		});
		row.appendTo($("#edit .list-group"));
	}
	function del_answer() {
		if(confirm("Sure Remove Item?")) {
			var cur = $("#edit .list-group-item.active");
			cur.remove();
		}
	}
	function edit_blank(el) {
		var id = $(el).data("id");
		$("#edit .modal-body").append($("#answer-"+id));
		$("#edit button#btn-ok").unbind("click").click(function() {
			$("#blanks").append($("#edit .modal-body .list-group"));
		});
		$("#edit button#btn-cancel").unbind("click").click(function() {
			$("#blanks").append($("#edit .modal-body .list-group"));
		});
		$("#edit").modal();
	}
</script>
<button type="button" class="btn btn-default" onclick="add_blank()">Add Blank</button>
<textarea name="content[detail][html]" class="ckeditor"><?= $content["detail"]["html"] ?></textarea>
<div id="blanks" class="hidden">
	<div id="new" class="list-group">
		<div class="list-group-item" onclick="active_answer(this)">
			<table width="100%">
				<tr>
					<td>
						<input type="text" class="form-control input-sm" name="[0][html]"/>
					</td>
					<td width="100px" class="partial <?= $partial?"":"hidden" ?>">
						<input type="number" min="0" class="form-control input-sm" name="[0][points]" value="<?= $points ?>">
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php foreach($content["answers"] as $i=>$answer) : ?>
		<div id="answer-<?= $i ?>" class="list-group">
			<?php foreach($answer as $j=>$row) : ?>
				<div class="list-group-item" onclick="active_answer(this)">
					<table width="100%">
						<tr>
							<td>
								<input type="text" class="form-control input-sm" name="answers[<?= $i ?>][<?= $j ?>][html]" value="<?= $row["html"] ?>"/>
							</td>
							<td width="100px" class="partial <?= $partial?"":"hidden" ?>">
								<input type="number" min="0" class="form-control input-sm" name="answers[<?= $i ?>][<?= $j ?>][points]" value="<?= $row[points] ?>">
							</td>
						</tr>
					</table>
				</div>
			<?php endforeach ?>
		</div>
	<?php endforeach ?>
</div>
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content panel panel-primary form-horizontal">
			<div class="modal-header panel-heading">
				<h4 class="modal-title" id="myModalLabel">Edit Blank's Content</h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<div class="item-handler btn-group pull-left">
					<button type="button" class="btn btn-default" onclick="add_answer()">Append</button>
					<button type="button" class="btn btn-default" onclick="up_answer()">Up</button>
					<button type="button" class="btn btn-default" onclick="down_answer()">Down</button>
					<button type="button" class="btn btn-default" onclick="del_answer()">Remove</button>
				</div>
				<button id="btn-cancel" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button id="btn-ok" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>