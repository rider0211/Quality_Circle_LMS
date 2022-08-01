<?php $rand = rand() ?>
<script type="text/javascript">
	$(function() {
		$("textarea#<?= $rand ?>").editor({
			toolbar: ["bold","underline","italic","strikethrough","-",
				"ordered","unordered","indent","outdent","justify","-",
				"forecolor","backcolor","-",
				"image","audio","video"],
			init: function(editor) {
				new AjaxUpload($(".button.video",editor.toolbar), {
					name: "asset",
					action: "<?= base_url("admin/question/upload/video") ?>",
					responseType: "json",
					onSubmit: function(file, ext){
						if (ext!="mp4"){
							alert("Error File Type.");
							return false;
						}
					},
					onComplete: function(file, res){
						if(res.success) {
							var video = $("<video controls><source type='video/mp4'></source></video>");
							$("source",video).attr("src","<?= ASSET_PATH ?>/video/"+res.data);
							editor.rangePasteHTML(video.get(0).outerHTML);
						} else {
							alert(res.message);
						}
					}
				});
				new AjaxUpload($(".button.audio",editor.toolbar), {
					name: "asset",
					action: "<?= base_url("admin/question/upload/audio") ?>",
					responseType: "json",
					onSubmit: function(file, ext){
						if (! (ext && /^(mp3|wav)$/.test(ext))){
							alert("Error File Type.");
							return false;
						}
					},
					onComplete: function(file, res){
						if(res.success) {
							var audio = $("<audio controls><source type='audio/mpeg'></source></audio>");
							$("source",audio).attr("src","<?= ASSET_PATH ?>/audio/"+res.data);
							editor.rangePasteHTML(audio.get(0).outerHTML);
						} else {
							alert(res.message);
						}
					}
				});
			}
		});
	});
</script>
<textarea id="<?= $rand ?>" name="content[html]" class="form-control" rows="6"><?= $question["html"] ?></textarea>
