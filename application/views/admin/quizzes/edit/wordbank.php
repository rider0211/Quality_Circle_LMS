<?php $rand = rand() ?>
<script type="text/javascript">
	$(function() {
		$("#<?= $rand ?> textarea").editor({
			toolbar: ["bold","underline","italic","strikethrough","-",
						"ordered","unordered","indent","outdent","justify","-",
						"forecolor","backcolor","->","blank"],
			actions: {
				blank: function(editor) {
					wnd = editor.frame.get(0).contentWindow;
					var selection = wnd.getSelection();
					var obj = $("<blank></blank>").text(String(selection).trim());
					if(obj.text()=="") {
						alert("Select Word and Click Button.");
						return;
					}
					for (var i=0; i < selection.rangeCount; i++)
						selection.getRangeAt(i).deleteContents();
					var range = selection.getRangeAt(0);
					range.insertNode(obj.get(0));
				}
			}
		});
		$("#<?= $rand ?> ul.editable li").on("contextmenu",function(e) {
			if($("input:text",e.currentTarget).length>0)
				return false;
			$(this).remove();
			return false;
		});
		$("#<?= $rand ?> ul.editable input").change(function(e) {
			input = $(e.currentTarget); 
			ul = input.parent().parent();
			ul.append(
				$("<li>")
					.text(input.val())
					.append($("<input type='hidden' name='content[words][]'>").val(input.val()))
					.on("contextmenu",function(e) { 
						$(this).remove();
						return false; 
					})
				);
			input.val("").focus().scrollIntoView();
		});
	});
</script>
<table id="<?= $rand ?>" style="width:100%">
	<tr>
		<td>
			<textarea name="content[html]" class="form-control" rows="6"><?= $question["html"] ?></textarea>
		</td>
		<td width="5px"></td>
		<td width="200px" valign="top" style="position:relative">
			<div class="editor-body" style="height:100%;width:100%;position:absolute;overflow:auto">
				<ul class="editable">
					<li><input style="width:100%"></li>
					<?php if($question["words"]) foreach($question["words"] as $word) { ?>
						<li>
							<?= $word ?>
							<input type="hidden" name="content[words][]" value="<?= $word ?>">
						</li>
					<?php } ?>
				</ul>
			</div>
		</td>
	</tr>
</table>
