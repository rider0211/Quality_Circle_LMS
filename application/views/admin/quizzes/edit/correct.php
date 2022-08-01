<?php $rand = rand() ?>
<script type="text/javascript">
	$(function() {
		var cmbMode = $("<select name='content[mode]'>")
			.append("<option value='word'>Word Correcting</option>")
			.append("<option value='char'>Char Correcting</option>")
			.val("<?= $question["mode"]?$question["mode"]:"word" ?>");
		$("textarea#<?= $rand ?>").editor({
			toolbar: [cmbMode,"-","bold","underline","italic","strikethrough","-",
						"ordered","unordered","indent","outdent","justify","-",
						"forecolor","backcolor","->","blank"],
			actions: {
				blank: function(editor) {
					var problem = $(editor.frame).closest("li.problem");
					wnd = editor.frame.get(0).contentWindow;
					var selection = wnd.getSelection();
					if(selection.toString()=="") {
						alert("Select Word and Click Button.");
						return;
					}
					sub = add_blank("MultipleChoice",selection.toString());
					var obj = $("<input>").focus(edit_blank).attr("data-id",sub.data("id"));
					for (var i=0; i < selection.rangeCount; i++)
						selection.getRangeAt(i).deleteContents();
					var range = selection.getRangeAt(0);
					range.insertNode(obj.get(0));
					obj.focus();
				}
			},
			init: function(editor) {
				var problem = $(editor.frame).closest("li.problem");
				$("input",editor.frame.get(0).contentWindow.document).each(function(i,el) {
					$(el).focus(edit_blank);
				});
			}
		});
	});
</script>
<textarea id="<?= $rand ?>" name="content[html]" class="form-control" rows="6"><?= $question["html"] ?></textarea>

<script type="text/javascript">
// 	function add_blank() {
// 		var editor = $("#details .editor-body iframe").get(0).contentWindow;
// 		var selection = editor.getSelection();

// 		$("#edit .modal-body").append($("#new").clone().removeAttr("id"));
// 		var arrLines = String(selection).split("\n");
// 		for(var i=0;i<arrLines.length;i++) {
// 			if(arrLines[i].trim()=="")
// 				continue;
// 			if(i>0) add_answer();
// 			$("#edit .modal-body .list-group-item:last-child input:text").val(arrLines[i].replace(/^\w\W+/,"").trim());
// 		}
// 		//$("#edit .modal-body .list-group-item:first input:text").val(selection);
// 		$("#edit button#btn-ok").unbind("click").click(function() {
// 			for (var i=0; i < selection.rangeCount; i++)
// 				selection.getRangeAt(i).deleteContents();

// 			var id = $("input",editor.document.body).length;
// 			var range = selection.getRangeAt(0);
// 			var obj = $("<input readonly size=4 />").focus(function(e) {
// 				e.view.parent.edit_blank(e.target.id);
// 			}).attr("id",id);
// 			range.insertNode(obj.get(0));
// 			$("#edit input").each(function() {
// 				this.name = "answers[" + id + "]" + this.name;
// 			});
// 			$("#result #answer-" + id).remove();
// 			$("#result").append($("#edit .modal-body .list-group").attr("id","answer-"+id));
// 			$("#details textarea").val(editor.document.body.innerHTML);
// 		});
// 		$("#edit button#btn-cancel").unbind("click").click(function() {
// 			$("#edit .modal-body").html("");
// 		});
// 	}
// 	function edit_blank(id) {
// 		$("#edit .modal-body").append($("#answer-"+id));
// 		$("#edit button#btn-ok").unbind("click").click(function() {
// 			$("#result").append($("#edit .modal-body .list-group"));
// 		});
// 		$("#edit button#btn-cancel").unbind("click").click(function() {
// 			$("#result").append($("#edit .modal-body .list-group"));
// 		});
// 		$("#btn-edit").click();
// 	}
</script>
