<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" />
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
<style>
	body{
		background-image: none;
		background-color: white;
	}
	.ui-state-default{
		background-color: transparent !important;
		border-color: transparent !important;
	}
	@media only screen and (min-width: 768px) {
		html.fixed .inner-wrapper {
			padding-top: 60px !important;
		}
	}
</style>
		<form method="post" id="questionForm" name="questionForm" action="<?php echo base_url('instructor/exam/saveQuestion');?>" enctype="multipart/form-data">

		<input type="hidden" name="exam_id" value="<?=$exam_id?>">
		<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow fixed-menu-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4 order-md-2">
						<?php
							$total = $question_count;
							if($total > 0){
								$qData['position'] = isset($qData['position']) ? $qData['position'] : $total;
								$question_number = $qData['position'] + 1;
						?>
                                <?php
                                if($is_only_quiz != 1) {
                                    ?>
                                    <small>Question: <?php echo $question_number . ' / ' . $total; ?></small>
                                    <?php
                                }
                                ?>
						<?php $question_number++; } ?>
						<?php if(isset($title)):?>
							<p><?php echo $title; ?></p>
						<?php endif; ?>
					</div>
					<input type="hidden" name="position" value="<?php if ($question_number > 0):?><?=$question_number?><?php else:?>1<?php endif;?>">
                    <input type="hidden" name="is_only_quiz" value="<?php echo $is_only_quiz?>">
                    <div class="col-md-4 order-md-2">
						<nav class="my-2 my-md-0 mr-md-3 ">
							<button type="submit" class="btn btn-primary" id="saveque">Save</button>
						</nav>
					</div>
				</div>
			</div>
		</div>	
		

		
		