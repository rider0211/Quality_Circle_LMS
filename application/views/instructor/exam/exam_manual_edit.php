<style>
	body{
		background-image: none;
		background-color: white !important;
	}
	.btn-block{
		background-color: #DAD9D9 !important;
	}
	.ui-state-default{
		background-color: transparent !important;
	}
	#cke_1_contents{
		max-height: 300px;
	}
	#cke_2_contents{
		max-height: 300px;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" />
<script src="<?php echo base_url(); ?>assets/js/uploader_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["exammanagement"]?></h2>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="form-wizard" id="exam_wizard">
				<?php echo form_open('instructor/exam/add_exam_manual', array("id"=>"frm_exam")); ?>
				<header class="card-header" style="background-color: #DAD9D9;">
					<h2 class="card-title"><?=$term["examinfo"]?></h2>
					<div class="card-actions">
						<button type="submit" id="btn_save" class="btn btn-default" style="margin-right: 10px;"><?=$term["save"]?></button>
						<a class="btn btn-default" href="<?php echo base_url(); ?>instructor/exam"><i class="fas fa-table"></i><?=$term["examlist"]?></a>
					</div>
				</header>
				<div class="row">
		            <div class="col-md-12">
		                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
		            </div>
			    </div>
				<input type="hidden" name="exam_id" id="exam_id" value="<?php echo isset($exam)&&isset($exam['id'])?$exam['id']:0; ?>">
				<div class="row">
					<div class="col-sm-4">
						<div class="col-lg-12" data-plugin-portlet id="portlet-1">
							<section class="card card-question" id="card-1" data-portlet-item>
								<header class="card-header portlet-handler">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>
									<h2 class="card-title"><i class="el el-question-sign"></i>Questions</h2>
								</header>
								<div id="quiz_type_div" class="card-body">
									<div class="row">
										<div class="col-md-6 mb-3">
											<button type="button" class="btn btn-default btn-block redirect" data-goto="essay"><i class="fa fa-pencil-square-o"></i> Essay</button>
										</div>
									</div>
								</div>
							</section>
						</div>
						<div class="col-lg-12" data-plugin-portlet id="portlet-2">
							<section class="card card-question" id="card-2" data-portlet-item>
								<header class="card-header portlet-handler">
									<div class="card-actions">
										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
										<a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
									</div>
									<h2 class="card-title"><i class="el el-cog"></i>Popular Settings</h2>
								</header>
								<div class="card-body">
									<div class="row">
										<label class="col-sm-12 control-label text-sm-left pt-2"><?=$term["limittimemin"]?></label>
										<div style="color: red; font-weight: bold;font-size:11px;" class="col-sm-12 text-sm-left"><?=$term["nolimittimehint"]?></div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<input type="number" name="limit_time" class="form-control" placeholder="Time Limitation" required="" value="<?php echo isset($exam)&&isset($exam['limit_time'])?$exam['limit_time']:''; ?>">
										</div>
									</div>
									<div class="row">
										<label class="col-sm-12 control-label text-sm-left pt-2"><?=$term["minimumpasspercent"]?></label>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<input type="text" name="min_percent" class="form-control" placeholder="<?=$term["minimumpasspercent"]?>" required="" value="<?php echo isset($exam)&&isset($exam['min_percent'])?$exam['min_percent']:''; ?>">
											<label>%</label>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-12 control-label text-sm-left pt-2"><?=$term["certificatetemplate"]?></label>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<select class="form-control" name="certificate_id" readonly>
												<?php
												foreach ($certification as $key => $cert_temp) {
													if($cert_temp["id"] == $exam["certificate_id"]) {
														$str_selected = "selected";
													} else {
														$str_selected = "";
													}
													echo sprintf("<option value='%d' %s>%s</option>",$cert_temp["id"], $str_selected, $cert_temp["title"] );
												}
												?>
											</select>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-12 control-label text-sm-left pt-2"><?=$term["marker"]?>1</label>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<select class="form-control" name="marker1_id" readonly>
												<?php
												foreach ($instructor as $key => $instructor_array) {
													if($instructor_array["id"] == $exam["marker1_id"]) {
														$str_selected = "selected";
													} else {
														$str_selected = "";
													}
													echo sprintf("<option value='%d' %s>%s</option>",$instructor_array["id"], $str_selected, $instructor_array["fullname"] );
												}
												?>
											</select>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-12 control-label text-sm-left pt-2"><?=$term["marker"]?>2</label>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<select class="form-control" name="marker2_id" readonly>
												<?php
												foreach ($instructor as $key => $instructor_array) {
													if($instructor_array["id"] == $exam["marker2_id"]) {
														$str_selected = "selected";
													} else {
														$str_selected = "";
													}
													echo sprintf("<option value='%d' %s>%s</option>",$instructor_array["id"], $str_selected, $instructor_array["fullname"] );
												}
												?>
											</select>
										</div>
									</div>
									<div class="row">
										<label class="col-sm-12 control-label text-sm-left pt-2"><?=$term["observer"]?></label>
									</div>
									<div class="form-group row">
										<div class="col-sm-12">
											<select class="form-control" name="observer_id" readonly>
												<?php
												foreach ($observer as $key => $observer_array) {
													if($observer_array["id"] == $exam["observer_id"]) {
														$str_selected = "selected";
													} else {
														$str_selected = "";
													}
													echo sprintf("<option value='%d' %s>%s</option>",$observer_array["id"], $str_selected, $observer_array["fullname"] );
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</section>
						</div>
					</div>
					</form>
					<div class="col-sm-8">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="control-group" style="border-bottom: 1px solid #C2C2C2;" onclick = "exam_title_modal()">
									<label id="exam_title_label" class="control-label col-lg-12" style="font-size: 22px;color: black;" for="textinput-0">
										<?php if ($exam['title'] != ""):?>
												<?=$exam['title']?>
											<?php else:?>
												<?=$term["examtitle"]?>
										<?php endif;?>
									</label>
									<img id="exam_image_div" class="col-lg-12" style="height: 10rem;width: auto;display: none;">
									<label id="exam_description_label" class="control-label col-lg-12" style="font-size: 15px;" for="textinput-0">
										<?php if ($exam['description'] != ""):?>
											<?=$exam['description']?>
										<?php else:?>
											<?=$term["typedescriptionhere"]?>
										<?php endif;?>
									</label>
								</div>
							</div>
						</div>
						<div id="quiz-editor" class="form-group">
							<?php if(!empty($questions)):?>
								<ol class="quiz" id="sortable">
									<?php $qnum = 0; foreach($questions as $question): ?>
										<li class="ui-state-default" data-id = "<?=$question['id']?>">
											<p class="edit-me">
												<?php echo empty($question['ques_title'])?'Title is not provided':$question['ques_title']; ?>
											</p>
											<?php
											$question['content'] = json_decode($question['content'],true);
											switch ($question['type']) {
												case 'essay':
													$this->load->view('instructor/exam/subviews/essay');
													break;
												default:
													echo 1;
											}
											?>
											<!--Controls-->
											<div class="form-check showme hide mt-3 bg-light">
												<div class="row">
													<div class="col-md-6 order-md-2">
														<input type="button"  data-id="<?php echo $question['id']; ?>" name="" class="btn btn-sm btn-primary edit-ques" value="Edit Question">
															<span class="ml-3 clone-ques" style="cursor: pointer;" data-id="<?php echo $question['id']; ?>">
																<i class="fa fa-clone text-success"></i>
															</span>
															<span class="ml-3" style="cursor: pointer;">
																<i class="fa fa-arrows text-info"></i>
															</span>
															<span class="ml-3 preview" style="cursor: pointer;" data-id="<?php echo $question['id']; ?>">
																<i class="fa fa-eye text-primary"></i>
															</span>
															<span class="ml-3 remove-question" style="cursor: pointer;" data-id="<?php echo $question['id']; ?>">
																<i class="fa fa-trash remove text-danger"></i>
															</span>
													</div>
													<div class="col-md-6 order-md-2">
													</div>
												</div>
											</div>
											<!--Controls-->
										</li>
										<?php ++$qnum; endforeach; ?>
								</ol>
							<?php else:?>
								No Question Found
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- end: page -->
</section>
<div id="Exam_title_modal" class="modal fade">
	<div class="modal-dialog" style = "width: 70%;max-width: 70%;">
		<div class="modal-content">
			<div class="modal-header bg-default">
				<h3 class="modal-title"><?=$term["examinfo"]?></h3>
			</div>
			<form id="exam_title_form" class="form-horizontal">
				<div class="modal-body">
					<div class="col-lg-12" style="display: flex;">
						<label class="col-lg-2 control-label text-sm-left pt-2"><?=$term["examtitle"]?></label>
						<input type="text" id="exam_title" name="title" class="form-control col-lg-10" placeholder="<?=$term["examtitle"]?>" required="" value="<?php echo isset($exam)&&isset($exam['title'])?$exam['title']:''; ?>">
					</div>
					<div class="col-lg-12" style="display: flex;padding-top: 30px;">
						<div class="col-lg-4">
							<div class="col-lg-12">
								<input type="file" class="file-input-overwrite" name="exam_image">
							</div>
						</div>
						<div class="col-lg-8">
							<label class="col-lg-2 control-label text-sm-left pt-2"><?=$term["description"]?></label>
							<textarea class="ckeditor form-control" name="description" id="exam_description" rows="5" ><?php echo isset($exam)&&isset($exam['description'])?$exam['description']:''; ?></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<label class="col-lg-2 control-label text-sm-left pt-2">Instruction</label>
						<textarea class="ckeditor form-control" name="instruction" id="exam_instruction" rows="5" ><?php echo isset($exam)&&isset($exam['instruction'])?$exam['instruction']:''; ?></textarea>
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="createExam()">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
<div id="mySidenav" class="sidenav previewQue bg-light">
	<i class="fa fa-close text-dark closebtn" onclick="closeNav()"></i>
	<div id="showSideQue"></div>
</div>
<style>
	#quiz_type_div .cb-wrap{
		position: relative !important;
		width: 100% !important;
		left: 0 !important;
		top: 0 !important;
	}
	.stage-wrap{
		width: 100% !important;
	}
</style>
<script>
	$(function(){
		if(!$("html").hasClass("sidebar-left-collapsed"))
		{
			$("html").addClass("sidebar-left-collapsed");
			$("html").removeClass("sidebar-left-opened");
		}
	});
	var base_url = "<?php echo base_url(); ?>";
	var editor;
	var image_path = "<?=$exam['image_path']?>";
	if (image_path != "" && image_path != null){
		$("#exam_image_div").attr("src",base_url+"assets/uploads/exam/"+image_path);
		$("#exam_image_div").css("display","block");
	}
	jQuery(document).ready(function() {
		CKEDITOR.on( 'instanceReady', function( ev ) {
			editor = ev.editor;
		});

		$("#frm_category").validate({
			highlight: function( label ) {
				$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function( label ) {
				$(label).closest('.form-group').removeClass('has-error');
				label.remove();
			},
			errorPlacement: function( error, element ) {
				var placement = element.closest('.input-group');
				if (!placement.get(0)) {
					placement = element;
				}
				if (error.text() !== '') {
					placement.after(error);
				}
			}
		});
	});
	function exam_title_modal(){
		$("#Exam_title_modal").modal();
	}
	function createExam(){
		var file = $('input[name="exam_image"]')[0].files[0];
		var A = new FormData();
		if ($("#exam_title").val() == ""){
			$("#exam_title").focus();
			return;
		}
		A.append("title", $("#exam_title").val());
		A.append("type", 'Manual');
		A.append("description", CKEDITOR.instances['exam_description'].getData());
		A.append("instruction", CKEDITOR.instances['exam_instruction'].getData());
		A.append("exam_id", $("#exam_id").val());
		if (file) {
			A.append("exam_image", file);
		}
		var C = new XMLHttpRequest();
		C.open("POST", base_url + 'instructor/exam/save_exam_title');
		C.onload = function() {
			var E;
			E = JSON.parse(C.responseText);
			if (E.exam_id != "0") {
				new PNotify({
					title: 'Success',
					text: 'Successfully Saved.',
					icon: 'icon-checkmark3',
					type: 'success'
				});
				$("#exam_id").val(E.exam_id);
				$('#Exam_title_modal').modal('hide');
				$("#exam_title_label").html($("#exam_title").val());
				if (E.image_path != ""){
					$("#exam_image_div").attr("src",base_url+"assets/uploads/exam/"+E.image_path);
					$("#exam_image_div").css("display","block");
				}
				$("#exam_description_label").html(CKEDITOR.instances['exam_description'].getData());
			} else if (E == "FAILED") {
				new PNotify({
					title: 'Error',
					text: 'Failed.',
					icon: 'icon-blocked',
					type: 'error'
				});
			}
			return;
		};
		C.send(A);
	}
	$(document).ready(function(){
		//Redirection
		$('.redirect').click(function() {
			var exam_id = $("#exam_id").val();
			if (exam_id == "0"){
				swal({
					text: "You have to add exam before edit a question!",
					icon: "warning"
				});
				return false;
			}
			var redirect = $(this).data('goto');
			var controller = 'instructor/exam/';
			switch(redirect) {
				case 'essay':
					url = "essay/"+exam_id;
					break;
				default:
					url = '';
			}
			window.location.href = base_url + controller + url;
			return false;
		});
		$('.clone-ques').click(function() {
			var ol = $('ol.quiz');
			var $this = $(this);
			var actionUrl = '<?php echo base_url()?>instructor/exam/cloneQuestion';
			var id = $(this).data('id');
			$.post( actionUrl, {id:id},function( data ) {
				//ol.find('li').index(id).clone(true).appendTo(ol);
				location.reload();
			});
		});
		$('.remove-question').click(function() {
			var $this = $(this);
			var actionUrl = '<?php echo base_url()?>instructor/exam/removeQuestion';
			var id = $(this).data('id');
			$.post( actionUrl, {id:id},function( data ) {
				$this.closest('li').remove();
				location.reload();
			});
		});
	});
	$(function() {
		$("#frm_exam").submit(function(e) {
			var temp_count = "<?=count($questions)?>";
			if (temp_count == "0"){
				swal({
					text: "Exam have to one question at least.",
					icon: "warning"
				});
				e.preventDefault();
				return false;
			}
		});
		var oldList, newList, item;
		$('#sortable').sortable({
			start: function(event, ui) {
				item = ui.item;
				newList = oldList = ui.item.parent().parent();
				ui.item.startPos = ui.item.index();
				cpList = ui.item.parent().parent().index();
				ui.item.startpos1 = ui.item.parent().parent().index();
				//   console.log(ui.item.startpos1);
			},
			stop: function(event, ui) {
				var id = ui.item.attr('data-id');
				var startpos = ui.item.startPos;
				var newpos = ui.item.index();
				updatePagePostion(id,startpos,newpos);
			},
			change: function(event, ui) {
				if(ui.sender) newList = ui.placeholder.parent().parent();
			},
			connectWith: "#sortable"
		}).disableSelection();
	});
	function updatePagePostion(id,startpos,newpos){
		//loaderStart();
		formData = "id="+id+'&startpos='+startpos+'&newpos='+newpos+'&exam_id='+$("#exam_id").val();
		var url = "<?php echo base_url() ?>instructor/exam/update_position";
		$.ajax({
			url: url,
			type: 'POST',
			data: formData,
			dataType : 'json',
			dataType : 'json',
			success: function(data){
				loaderStop();
				location.reload();
			}
		});
	}
</script>
<script src="<?php echo base_url(); ?>assets/js/custom-edit.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>