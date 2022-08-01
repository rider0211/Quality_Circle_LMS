<?php $rand = rand() ?>
<script type="text/javascript">
	$(function() {
		$("textarea#<?= $rand ?>").editor({
			toolbar: ["bold","underline","italic","strikethrough","-",
						"ordered","unordered","indent","outdent","justify","-",
						"forecolor","backcolor","->","blank"],
			init: function(editor) {
				var problem = $(editor.frame).closest("li.problem");
				$("input",editor.frame.get(0).contentWindow.document).each(function(i,el) {
					$(el).focus(edit_blank);
				});
				btn = $("img[name='blank']",problem).attr("data-toggle","dropdown").addClass("dropdown-toggle");
				$(".dropdown-menu a",problem).click(function(e) {
					var problem = $(e.currentTarget).closest("li.problem");
					var editor = $("textarea",problem).data("editor"); 
					wnd = editor.frame.get(0).contentWindow;
					var selection = wnd.getSelection();
					if(selection.toString()=="") {
						alert("Select Word and Click Button.");
						return;
					}
					sub = add_blank($(e.currentTarget).data("type"),selection.toString());
					var obj = $("<input>").focus(edit_blank).attr("data-id",sub.data("id"));
					for (var i=0; i < selection.rangeCount; i++)
						selection.getRangeAt(i).deleteContents();
					var range = selection.getRangeAt(0);
					range.insertNode(obj.get(0));
					obj.focus();
				});
				btn.after($(".dropdown-menu",problem).css("left","auto").css("right",0));
				btn.dropdown();
			}
		});
	});
</script>
<textarea id="<?= $rand ?>" name="content[html]" class="form-control" rows="6"><?= $question["html"] ?></textarea>
<ul class="dropdown-menu" role="menu">
	<li><a data-type="FillInTheBlank">FillIn Add</a></li>
	<li><a data-type="MultipleChoice">Choice Add</a></li>
	<li><a data-type="CompleteBlank">Complete Add</a></li>
</ul>
