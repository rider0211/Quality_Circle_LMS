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
<script type="text/javascript">
	
</script>

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
					<h2 class="card-title col-lg-6">Manual Exam Set Mark</h2>									
					<div class="card-actions">
						<a class="btn btn-default" href="<?php echo base_url(); ?>admin/examhistory/viewexam"><i class="fas fa-table"></i><?=$term["examhistorylist"]?></a>
					</div>
				</header>
				<div class="row">
		            <div class="col-md-12">
		                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
		            </div>
			    </div>
			    <?php if(!empty($answers)){ 
			        $total_mark1 = 0;
					$total_mark2 = 0;
					$total_pass_mark = 0;
					$total_max_mark = 0;
			    ?>
			    <div class="row">

			    </div>
	    		<div class="row">	    		    
					<div class="form-group">
						<div class="col-sm-8">
						    <table class="table table-bordered table-striped mb-0 dataTable no-footer" role="grid" style="width:800px">
						    	<tr role="row">
								    <th>Section</th>
								    <th>Marker1</th> 
								    <th>Marker2</th>
								    <th>Pass Mark</th>
								    <th>Maximum Mark</th>
							  	</tr>
							  	<?php $anum = 0; foreach($answers as $answer){
							  		$anum++;						  		
							  		?>
							    <tr role="row">
								    <td><?=$anum?></td>
								    <td><?=$answer['mark1']?></td> 
								    <td><?=$answer['mark2']?></td>
								    <td><?=$questions[$anum-1]['pass_mark']?></td>
								    <td><?=$questions[$anum-1]['max_mark']?></td>
							  	</tr>
							  	<?php 
							  		$total_mark1 = $total_mark1+$answer['mark1'];
							  		$total_mark2 = $total_mark2+$answer['mark2'];

							  		$total_pass_mark = $total_pass_mark+$questions[$anum-1]['pass_mark'];
									$total_max_mark = $total_max_mark+$questions[$anum-1]['max_mark'];
							  	}

							  	$totla_mark = ($total_mark1+$total_mark2)/2;
							  	$pass_flag = "Not Determine";

							  	if($totla_mark<$total_pass_mark){
							  		$pass_flag = "Fail";
							  	}else{
							  		$pass_flag = "Pass";
							  	}
							  	?>

							  	<tr>
								    <td>Total</td>
								    <td><?=$total_mark1?></td> 
								    <td><?=$total_mark2?></td>
								    <td><?=$total_pass_mark?></td>
								    <td><?=$total_max_mark?></td>
							  	</tr>
							  	<tr>
								    <td>Name of Result Marker</td>
								    <td><?=$marker1?></td> 
								    <td><?=$marker2?></td>
								    <td colspan="2"><?=$observer?></td>							    
							  	</tr>

							</table>
						</div>
						<div class="col-sm-12">
							<section class="card">								
								<div class="card-body">
									<p class="m-0">
										<button type="button" id="report_btn" onclick="javascript:examReport()" class="mb-1 mt-1 mr-1 btn btn-lg btn-default">
										<i class="fas fa-graduation-cap" style="margin:3px"></i>Exam Report</button>
									</p>									
								</div>
							</section>
							<section class="card">								
								<div class="card-body" id="exam_result">

								</div>
							</section>													
						</div>
					</div>
				</div>
				<?php }?>
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
													$essay_answer = json_decode($answers[$qnum]['description'],true)['essay'];
															
													$this->load->view('admin/exam/subviews/essay_set_mark',array("answer"=>$essay_answer,"id"=>$answers[$qnum]['id']));
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
    var totla_mark = "<?php echo $totla_mark; ?>";
	var pass_flag = "<?php echo $pass_flag; ?>";	
	var marker1_id = "<?php echo $marker1_id; ?>";
	var marker2_id = "<?php echo $marker2_id; ?>";
	var observer_id = "<?php echo $observer_id; ?>";
	var exam_history_id = "<?php echo $exam_history_id; ?>";
	var user_id = "<?php echo $user_id; ?>";
	var editor;
	var image_path = "<?=$exam['image_path']?>";
	if (image_path != "" && image_path != null){
		$("#exam_image_div").attr("src",base_url+"assets/uploads/exam/"+image_path);
		$("#exam_image_div").css("display","block");
	}

	function setMark(id) {
	  var answer_id = id;
      var answer_mark = $("#mark_"+id).val();
      //document.location.reload(); 
     
      $.ajax({
          url: base_url+'admin/examhistory/set_mark_answer',
          dataType: 'json',
          data: {
              id: answer_id,
              mark: answer_mark,
              marker1_id: marker1_id,
              marker2_id: marker2_id,
              observer_id: observer_id 
          },
          success: function (response) {
              document.location.reload();
          }
       }); 

    }     

    function examReport() {
	   $.ajax({
          url: base_url+'admin/examhistory/exam_result',
          dataType: 'json',
          data: {
              exam_history_id: exam_history_id,
              pass_flag: pass_flag,
              observer_id: observer_id,
              totla_mark: totla_mark
          },
          success: function (response) {
          	  $("#exam_result").html("Exam Result: " + pass_flag+"!");
              //document.location.reload();
          }
       }); 
    }
</script>
<script type="text/javascript">	
	
	$(document).ready(function() {
		if(user_id!=marker1_id&&user_id!=marker2_id&&user_id!=observer_id){
			$(".btn-success").prop('disabled',true);
		}			
		if(user_id!=observer_id){
			$("#report_btn").prop('disabled',true);
		}
	});	
</script>