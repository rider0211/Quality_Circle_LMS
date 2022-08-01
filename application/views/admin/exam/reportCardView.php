<style>
	body{
		background-image: none !important;
		background-color: #f2f2f2;
	}
</style>
 
<main role="main" class="content-body">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<?php if(!empty($questions)):?>
						<?php $qnum = 0;
						foreach($questions as $question):?>
						<div class="card mt-3">
							<div class="card-header">
								<?php 
									if (isset($question['ques_file']) && !empty($question['ques_file'])) {
										echo '<img src="'.base_url('assets/uploads/exam/quiz/').$question['ques_file'].'" height="100" width="200" class="img-fluid rounded img-thumbnail border float-right" />';
									}
									echo $qnum+1;
									echo ". ";
									echo empty($question['ques_title'])?'Title is not provided':$question['ques_title']; 
								?>
							</div>
						<div class="card-body">
							<?php foreach ($answers as $answer):?>
								<?php if ($answer['quiz_id'] == $question['id']):?>
									<?php $userAns = $answer;?>
								<?php endif;?>
							<?php endforeach;?>
							<?php
							$userAns['description'] = json_decode($userAns['description'],true);
								switch ($question['type']) {
									case 'multi-choice':
										$checkData = array(
														'correctCheck'=>json_decode($question['content'],true)['correctCheck'],
														'checkbox'=>json_decode($question['content'],true)['checkbox'],
														'userAns'=>$userAns['description']
													);

										$this->load->view('admin/exam/reportcard/multichoice_view', $checkData);
										break;
									case 'checkbox':
										$checkData = array(
														'correctCheck'=>json_decode($question['content'],true)['correctCheck'],
														'checkbox'=>json_decode($question['content'],true)['checkbox'],
														'userAns'=>$userAns['description']
													);
										$this->load->view('admin/exam/reportcard/checkbox_view', $checkData);
										break;
									case 'true-false':
										$checkData = array(
													'tftext'=>json_decode($question['content'],true)['tf'],
													'settrue'=>json_decode($question['content'],true)['settrue'],
													'userAns'=>$userAns['description']
												);
										$this->load->view('admin/exam/reportcard/true_false_view', $checkData);
										break;
									case 'fill-blank':
										$checkData = array('blank'=>json_decode($question['content'],true)['blank'],'userAns'=>$userAns['description']);
										$this->load->view('admin/exam/reportcard/fill_blank_view', $checkData);
										break;
									case 'essay':
										$checkData = array('userAns'=>$userAns['description']);
										$this->load->view('admin/exam/reportcard/essay_view', $checkData);
										break;
									case 'matching':
										$this->load->view(
											'admin/exam/reportcard/matching_view',
											array(
												'content'=>json_decode($question['content'],true)['choice'],
												'match'=>json_decode($question['content'],true)['match'],
												'userAns'=>$userAns['description']
											)
									);
										break;
									default:
										echo 1;
								}
							?>
						</div>
						<?php ++$qnum; endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</main>