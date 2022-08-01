<script type="text/javascript">
	$(function() {
		var cmbMode = $("<select name='content[mode]'>")
			.append("<option value='word'>Select Word</option>")
			.append("<option value='para'>Select Paragraph</option>")
			.val("<?= $question["mode"] ?>");
		$("textarea[name='content[html]']").editor({
			toolbar: [	cmbMode,"-",
						"bold","underline","italic","-",
						"ordered","unordered","indent","outdent","justify","-",
						"forecolor","->","mark"],
			actions: {
				mark: function(editor) {
					var problem = $(editor.frame).closest("li.problem");
					var selection = editor.fbody.getSelection();
					var state = editor.options.check.mark(editor.fbody);
					if(selection.toString()=="" && !state) {
						alert("First Select Paragraph.");
						return;
					}
					range = selection.getRangeAt(0);
					if(state) {
						sc = $(range.startContainer).parents("mark");
						ec = $(range.endContainer).parents("mark");
						sc.replaceWith(sc.html());
						ec.replaceWith(ec.html());
					} else {
						mode = $("select",editor.toolbar).val();
						if(mode=="para") {
							if($(range.startContainer).parents("p,h1,h2,h3,h4,h5").length)
								range.setStartBefore($(range.startContainer).parents("p,h1,h2,h3,h4,h5").get(0));
							else if(range.startContainer.tagName!="BODY" && range.startContainer!=range.endContainer)
								range.setStartBefore(range.startContainer);
							if($(range.endContainer).parents("p,h1,h2,h3,h4,h5").length)
								range.setEndAfter($(range.endContainer).parents("p,h1,h2,h3,h4,h5").get(0));
							else if(range.endContainer.tagName!="BODY" && range.startContainer!=range.endContainer)
								range.setEndAfter(range.endContainer);
						}
						node = range.extractContents();
						if($(node).parents("mark").length==0) {
							mark = $("<mark>").append(node);
							range.insertNode(mark.get(0));
						} else {
							range.insertNode(node);
						}
					}
					selection.collapseToEnd();
				}
			},
			check: {
				mark: function(fbody) {
					var selection = fbody.getSelection();
					range = selection.getRangeAt(0);
					if($(range.startContainer).parents("mark").length)
						return true;
					if($(range.endContainer).parents("mark").length)
						return true;
					return false;
				}
			}
		});
	});
</script>
<textarea name="content[html]" class="form-control" rows="6"><?= $question["html"] ?></textarea>
