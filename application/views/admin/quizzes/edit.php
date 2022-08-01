<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.core.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.widget.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.mouse.min.js") ?>"></script>
<script type="text/javascript" src="<?= site_url("assets/js/jquery.ui.sortable.min.js") ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= site_url("assets/css/question.css") ?>"/>
<script type="text/javascript" src="<?= site_url("assets/js/question.js") ?>"></script>
<style>
	.note-editor {
		border: none;
	}
	#result .item-handler {
		padding-top: 5px;
	}
	.problem {
		margin-top: 0;
	}
	.problem blockquote {
		padding: 10px 20px;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["quizinfo"]?></h2>
	</header>
	<div>
		<form method="post" class="question" action="<?= site_url("admin/quizzes/save") ?>" enctype="multipart/form-data" >
			<input type="hidden" name="question[id]" value="<?= $question["id"] ?>">
			<div id="option" class="card card-default">
				<div class="card-header">
					<h3 class="card-title"><?=$term["quizinfo"]?></h3>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="form-group col-sm-4">
							<label class="control-label"><?=$term["category"]?></label>
			                <select class="form-control input-sm" name="question[category_id]">
			                	<?php foreach($categories as $category) : ?>
			                        <option class="input-sm" value="<?= $category["id"] ?>" <?= $category["id"]==$question["category_id"]?"selected":"" ?>><?= $category["text"] ?></option>
			                    <?php endforeach ?>
			                </select>
			            </div>
						<!--<div class="form-group col-sm-4" style="display: none;">
							<label class="control-label">Topic</label> 
							<select class="form-control input-sm" name="question[topic_id]" required>
								<option class="input-sm" />

			                    <?php /*foreach($topics as $t) : */?>
			                        <option class="input-sm" value="<?/*= $t["id"] */?>" <?/*= $t["id"]==$question["topic_id"]?"selected":"" */?>><?/*= $t["text"] */?></option>
			                    <?php /*endforeach */?>
			                </select>
						</div>-->
						<div class="form-group col-sm-4">
							<label class="control-label"><?=$term["type"]?></label>
							<select onchange="change_type()"
								class="form-control input-sm" name="question[quiz_type]">
			                    <?php if($types) foreach($types as $t) { ?>
			                        <option value="<?= $t ?>"
									<?= $question["quiz_type"]==$t?selected:"" ?>><?= $t ?></option>
			                    <?php } else { ?>
			                        <option value="<?= $question["quiz_type"] ?>"><?= $question["quiz_type"] ?></option>
			                    <?php } ?>
			                </select>
						</div>
						<div class="form-group col-sm-4">
							<label class="control-label">Quiz Code<span class="required">*</span></label>
							<input type="text" class="form-control input-sm" name="question[quiz_code]" placeholder="eg.: Qz01" required maxlength=10 value="<?= $question["quiz_code"] ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-9">
							<label class="control-label"><?=$term["title"]?></label>
							<input type="text"
								class="form-control input-sm" name="question[quiz_title]"
								value="<?= $question["quiz_title"] ?>" required>
						</div>
						<div class="form-group col-sm-3">
							<label class="control-label"><?=$term["level"]?></label>
							<select class="form-control input-sm" name="question[quiz_level]">
								<option value="easy" <?= $question["quiz_level"]=="easy"?"selected":"" ?>>Easy</option>
								<option value="medium" <?= $question["quiz_level"]=="medium"?"selected":"" ?>>Medium</option>
								<option value="hard" <?= $question["quiz_level"]=="hard"?"selected":"" ?>>Hard</option>
							</select>
						</div>
						<!-- 
			            <div class="form-group col-sm-1">
			                <label class="control-label">Timer</label>
			                <input type="number" min="0" class="form-control input-sm" name="question[attempts]" value="<?= $question[attempts] ?>">
			            </div>
			            <div class="form-group col-sm-1">
			                <label class="control-label">Limite</label>
			                <input type="number" min="0" class="form-control input-sm" name="question[limit_time]" value="<?= $question["limit_time"] ?>">
			            </div>
			            -->
					</div>

                    <div class="form-control row" style="border: none;">
                        <label class="control-label"><?=$term["image"]?> </label>
                        <div class="row">
                            <div class="fileupload fileupload-new" data-provides="fileupload" style="margin-left: 15px;">
                                <div class="input-append">
                                    <div class="uneditable-input" style="width: 278px;">
                                        <i class="fas fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview"><?php echo isset($question)&&isset($question['quiz_obj_path'])?$question['quiz_obj_path']:''; ?></span>
                                    </div>
                                    <span class="btn btn-default btn-file">
											<span class="fileupload-exists"><?=$term["change"]?></span>
											<span class="fileupload-new"><?=$term["selectfile"]?></span>
											<input type="file" name="image" id="quiz_image" />
										</span>
                                    <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                </div>
                            </div>
                            <?php if(isset($question['quiz_obj_path'])){ ?>
                            <div class="col-lg-1 col-sm-2">
								<span data-plugin-lightbox data-plugin-options='{ "type":"image" }' >
			                        <img class="img-fluid" id="current_image" src="<?php echo base_url($question['quiz_obj_path']); ?>" width="40" height="30">
			                    </span>
                            </div>
                            <?php } ?>
                        </div>


				</div>
			</div>
		    <div id="direction" class="card card-default">
			    <div class="card-header">
			        <h3 class="card-title"><?=$term["description"]?></h3>
			    </div>
			    <div class="card-body direction-html">
			    	<textarea class="ckeditor" name="question[quiz_guide]"><?= $question["quiz_guide"] ?></textarea>
			    </div>
			</div>
		    <div id="result" class="card card-default">
				<div class="card-header">
					<h3 class="card-title"><?=$term["quizcontent"]?></h3>
				</div>
				<div class="card-body">
				    <?php
				        if($question["quiz_type"]=='TrueFalse')
				            $this->view("admin/quizzes/edit/truefalse", $question);
				        else if($question["quiz_type"]=='MultipleChoice')
				            $this->view("admin/quizzes/edit/choice", $question);
				        else if($question["quiz_type"]=='MultipleResponse' || $question["quiz_type"]=='MultipleSwitch')
				            $this->view("admin/quizzes/edit/check", $question);
				        else if($question["quiz_type"]=='FillInTheBlank')
				            $this->view("admin/quizzes/edit/typein", $question);
				        else if($question["quiz_type"]=='Sequence')
				            $this->view("admin/quizzes/edit/sequence", $question);
				        else if($question["quiz_type"]=='Matching')
				            $this->view("admin/quizzes/edit/match", $question);
				        else if($question["quiz_type"]=='FillInTheBlankEx')
				            $this->view("admin/quizzes/edit/fill", $question);
				        else if($question["quiz_type"]=='MultipleChoiceText' || $question["quiz_type"]=='MultipleChoiceLine' || $question["quiz_type"]=='Correct')
				            $this->view("admin/quizzes/edit/correct", $question);
				        else if($question["quiz_type"]=='WordBank')
				            $this->view("admin/quizzes/edit/wordbank", $question);
				        else if($question["quiz_type"]=='Numeric')
				            $this->view("admin/quizzes/edit/numeric", $question);
				        else if($question["quiz_type"]=='Grouping')
				            $this->view("admin/quizzes/edit/group", $question);
				        else if($question["quiz_type"]=='Translate')
				            $this->view("admin/quizzes/edit/translate", $question);
				        else if($question["quiz_type"]=='RecordAudio' || $question["quiz_type"]=='RecordVideo')
				            $this->view("admin/quizzes/edit/record", $question);
				    ?>
				</div>
			</div>
			<div class="form-group" style="padding-top:20px">
				<button class="btn btn-default">
					<i class="fa fa-save"></i>
					<?=$term["save"]?>
				</button>
				<?php if($question["id"]) { ?>
					<button type="button" class="btn btn-default" onclick="preview()">
						<i class="fa fa-check"></i>
						<?=$term["preview"]?>
					</button>
				<?php } ?>
				<a class="btn btn-default" href="<?= site_url("admin/quizzes/index") ?>">
					<i class="fa fa-arrow-left"></i>
					<?=$term["back"]?>
				</a>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript">
    var modified = false;
    var editor;
	/*CKEDITOR.config.removePlugins = 'colorbutton,find,flash,font,' +
				'forms,iframe,image,newpage,removeformat,' +
				'smiley,specialchar,stylescombo,templates';*/
	/*CKEDITOR.config.toolbarGroups = [
		{ name: 'editing',		groups: [ 'basicstyles', 'links' ] },
		{ name: 'undo' },
		{ name: 'clipboard',	groups: [ 'selection', 'clipboard' ] },
		{ name: 'custom' }
	];*/

    function change_type() {
    	type = $("[name='question[quiz_type]']").val();
    	if(type=="MultipleSwitch")
    		$(".message").removeClass("hidden");
    	else
    		$(".message").addClass("hidden");
    }
	function init_upload_btn(btn) {
		new AjaxUpload(btn, {
			name: "asset",
			action: "<?= site_url("testasset/upload") ?>",
			data: {
				type: "image",
			},
			responseType: "json",
			onSubmit: function(file, ext){
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
					alert("Incorrect file type.");
					return false;
				}
			},
			onComplete: function(file, res){
				if(res.success) {
					var node = $(this._button).parents("tr");
					$(":hidden", node).val(res.data);
					$("img", node).attr("src","<?= site_url("admin/quizzes/asset/image") ?>/"+res.data).removeClass("hidden");
					$("button.unlink", node).removeAttr("disabled");
				} else {
					alert(res.message);
				}
			}
		});
	}
	function unlink(node) {
        if($(":hidden", node).val()=="")
            return;
        if(confirm("Would you like to delete this file?")) {
            $.post("<?= site_url("admin/quizzes/asset/remove") ?>",{
                file: $(":hidden", node).val()
            }, function(res) {
                if(res.success) {
                    $("button.unlink", node).attr("disabled", true);
                    $(":hidden", node).val("");
                    $("img", node).removeAttr("src").addClass("hidden");
                } else {
                    alert(res.message);
                }
            });
        }
    }
    function toggle_partial() {
        $("td.partial").toggleClass("hidden");
    }
    function audio_play() {
        var audio = $("#audio audio").get(0);
        if(audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
        $("#audio .player").toggleClass("pause");
    }
    function validate() {
        var req = $("form.question input[required]:visible");
        for(i=0;i<req.length;i++) {
            var obj = $(req.get(i));
            if(obj.val()=="") {
                if(obj.attr("placeholder"))
                    alert(obj.attr("placeholder"));
                obj.focus();
                return false;
            }
        }
        req = $("form.question select[required]:visible");
        for(i=0;i<req.length;i++) {
            var obj = $(req.get(i));
            if($("option:selected",obj).val()=="") {
                if(obj.attr("placeholder"))
                    alert(obj.attr("placeholder"));
                $(obj).focus();
                return false;
            }
        }
        return true;
    }
    function save() {
        if(!validate()) {
			return;
		}
        var i = 0;
		$("table.sections tbody tr").each(function(i,tr) {
			data = $(tr).data();
			if(!data.id) {
				$("form.question").param("sections["+i+"][scheme_id]",data.scheme);
				$("form.question").param("sections["+i+"][lecture_code]",data.lecture);
			}
		});
		$("form.question").param("content[direction][html]",$(".direction-html").code());
		if($(".detail-html").length)
			$("form.question").param("content[detail][html]",$(".detail-html").code());
		$("form.question").submit();
    }
	function preview() {
		var id = <?= intval($question["id"]) ?>;
		window.location = "<?= site_url("admin/quizzes/preview") ?>/"+id;
	}
	function append() {
        $("[name='question[id]']").val(0);
        $("[name='question[uuid]']").val("");
        modified = false;
    }
</script>
