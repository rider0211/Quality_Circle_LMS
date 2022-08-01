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
				<header class="card-header" style="background-color: #DAD9D9;">
					<h2 class="card-title"><?=$term["exampreview"]?></h2>
					<div class="card-actions">
						<a class="btn btn-default" href="<?php echo base_url(); ?>admin/examhistory/viewexam"><i class="fas fa-table"></i><?=$term["examhistorylist"]?></a>
					</div>
				</header>
				<div class="row">
		            <div class="col-md-12">
		                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
		            </div>
			    </div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="control-group" style="border-bottom: 1px solid #C2C2C2;">
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
											<?php if (!empty($question['ques_file'])):?>
												<img class="col-lg-12" style="height: 10rem;width: auto;" src="<?=base_url()?>assets/uploads/exam/quiz/<?=$question['ques_file']?>">
											<?php endif;?>
											<?php
											$question['content'] = json_decode($question['content'],true);
											switch ($question['type']) {
												case 'multi-choice':
													$checkData = array(
															'correctCheck'=>json_decode($answers[$qnum]['description'],true)['multichoice'],
															'checkbox'=>$question['content']['checkbox'],
													);
													$this->load->view('admin/exam/subviews/multichoice', $checkData);
													break;
												case 'checkbox':
													$checkData = array(
															'correctCheck'=>json_decode($answers[$qnum]['description'],true)['checkbox'],
															'checkbox'=>$question['content']['checkbox'],
													);
													$this->load->view('admin/exam/subviews/checkbox', $checkData);
													break;
												case 'true-false':
													$checkData = array(
															'tftext'=>$question['content']['tf'],
															'settrue'=>json_decode($answers[$qnum]['description'],true)['true_false'],
													);
													$this->load->view('admin/exam/subviews/true_false_preview', $checkData);
													break;
												case 'fill-blank':
													$checkData = array('blank'=>json_decode($answers[$qnum]['description'],true)['blank']);
													$this->load->view('admin/exam/subviews/fill_blank_preview', $checkData);
													break;
												case 'essay':
													$answer = $answers[$qnum]['description'];
													$this->load->view('admin/exam/subviews/essay_preview',array("answer"=>$answer));
													break;
												case 'matching':
													$this->load->view(
															'admin/exam/subviews/matching_preview',
															array(
																	'content'=>$question['content']['choice'],
																	'match'=>$question['content']['match'],
																	'answers'=>json_decode($answers[$qnum]['description'],true)['matching'],
															)
													);
													break;
												default:
													echo 1;
											}
											?>
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
	var base_url = "<?php echo base_url(); ?>";
	var editor;
	var image_path = "<?=$exam['image_path']?>";
	if (image_path != "" && image_path != null){
		$("#exam_image_div").attr("src",base_url+"assets/uploads/exam/"+image_path);
		$("#exam_image_div").css("display","block");
	}
</script>