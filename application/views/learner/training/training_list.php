<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png" />
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_company/responsive.css" rel="stylesheet">
<style>
	.courseUl{
		width:100%
	}
</style>

<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>

<section role="main" class="content-body" style="width:85%;">
    <header class="page-header">
        <h2>Instructor Led Training List</h2>
        <div class="right-wrapper">
        </div>
    </header>

    <input type="hidden" id="base_url" value="<?= base_url()?>">

	<div class="row demand-page">
		<div class="col-lg-12">
			<section class="card" style="padding: 0px">
		<header class="card-header">
		<h2 class="card-title">Training List</h2>
	</header>
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="catalogBox">
					<div class="row">
						<div class="col-sm-12">
							<div class="sortPanel">
								<div class="sortSet"> 
                                    <select id="location" name="location" style="border: 1px solid #ccc !important;padding: 8px 10px !important;">
                                        <option value=""> Select Location </option>
                                        <?php foreach($location as $item){ ?>
                                            <option value="<?= $item['location']; ?>" <?= $location_name==$item['location']?'selected':''; ?>> <?= $item['location']; ?></option>
                                        <?php } ?>
                                    </select>

                                    <select id="course_id" name="course_id" style="border: 1px solid #ccc !important;padding: 8px 10px !important;">
                                        <option value=""> Select Course </option>
                                        <?php foreach($course_filter_list as $courseitem){

											if($course['course_self_time'] == "Time Restricted"){
												$showDuration = $paid_course['duration'] > 1 ? $paid_course['duration']. " Days" : $paid_course['duration']." Day";
												$duration = $paid_course['duration'] - 1;
												$enddate = strtotime('+'.$duration .' days', strtotime($paid_course['start_day']. " " . $paid_course['end_time']));
												$currentdays = time();
											}else{
												$enddate = $paid_course['duration'] * 8 * 24 * 60;
												$currentdays = $paid_course['session_time']?$paid_course['session_time']:0;
											}
											if($currentdays <= $enddate){

										?>
                                            <option value="<?= $courseitem['id']; ?>" <?= $course_name==$courseitem['id']? 'selected': ''; ?>> <?= ucfirst($courseitem['title']); ?></option>
                                        <?php } }  ?>
                                    </select>
								</div><!--sortSet-->
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->

					<div class="row">
						<?php if($free_course_list || $paid_course_list){ ?>
							<div class="col-sm-12">
								<?php foreach($free_course_list as $free_course):
									if($free_course['course_self_time'] == "Time Restricted"){
										$showDuration = $free_course['duration'] > 1 ? $free_course['duration']. " Days" : $free_course['duration']." Day";
										$duration = $free_course['duration'] - 1;
										$enddate = strtotime('+'.$duration .' days', strtotime($free_course['start_day']. " " . $free_course['end_time']));
										$currentdays = time();
									}else{
										$enddate = $free_course['duration'] * 8 * 24 * 60;
										$currentdays = $free_course['session_time']?$free_course['session_time']:0;
									}
									if($currentdays <= $enddate){  ?> 
									<div class="whitePanel">
										<div class="row">
											<div class="col-lg-4 col-md-5 col-sm-6">
												<div class="leftImgBox">
													<?php 
														$courseimgpath = getCourseImgById($free_course['course_id']);
														$imgName = end(explode('/', $courseimgpath));
														if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){								
													?>
														<img src="<?= base_url($courseimgpath); ?>" class="rounded img-fluid" alt="learnerlearner">
													<?php }else{ ?>
														<img src="<?= base_url().'assets/uploads/ilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">
													<?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
												<h5>
													<?php
														$showDuration = $free_course['duration'] > 1 ? $free_course['duration']. " Days" : $free_course['duration']." Day";												
														$duration = $free_course['duration'] - 1;
														$enddate = strtotime('+'.$duration .' days', strtotime($free_course['start_day']. " " . $free_course['end_time']));
													?>

													<?= ucfirst($free_course['title']);?>, <?= $showDuration; ?> <br />
													<p>Duration: <?= $showDuration; ?> </p>
													<p>Start Date: <?= date("M d, Y h:i:sa", strtotime($free_course['start_day'] . " " . $free_course['start_time']));?></p>                                       
													<p>End Date: <?= date("M d, Y h:i:sa", $enddate);?></p>
												</h5>
												<ul class="courseUl">
													<li><?=nl2br(substr($free_course['description'],0,300)); ?>...</li>
												</ul>
												<?php if($free_course['enroll_id'] == ''){ ?>
													<a class="btnBlue" href="javascript:enroll(<?=$free_course['course_id']?>,<?=$free_course['course_time_id']?>)" >
														<?=$term["enrollnow"]?>
													</a>
													<a class="btnBlue" href="<?= base_url('company/'.$company['url'].'/training/view/'.$free_course['course_time_id'])?>" >
														<?=$term["viewdetails"]?>
													</a>
												<?php } else{ ?>
													<a class="btnBlue" href="<?=base_url('company/'.$company['url'].'/demand/detail/'.$free_course['course_id'])?>" >
														<?=$term["viewcourse"] ?>
													</a>
												<?php } ?>

											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
								<?php } 
								endforeach; ?>

								<?php foreach($paid_course_list as $paid_course):
									if($paid_course['course_self_time'] == "Time Restricted"){
										$showDuration = $paid_course['duration'] > 1 ? $paid_course['duration']. " Days" : $paid_course['duration']." Day";
										$duration = $paid_course['duration'] - 1;
										$enddate = strtotime('+'.$duration .' days', strtotime($paid_course['start_day']. " " . $paid_course['end_time']));
										$currentdays = time();

									}else{
										$enddate = $paid_course['duration'] * 8 * 24 * 60;
										$currentdays = $paid_course['session_time']?$paid_course['session_time']:0;
									}

									if($currentdays <= $enddate){
								?> 
									<div class="whitePanel">
										<div class="row">
											<div class="col-lg-4 col-md-5 col-sm-6">
												<div class="leftImgBox">
													<?php 
														$courseimgpath = getCourseImgById($paid_course['course_id']);
														$imgName = end(explode('/', $courseimgpath));
														if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){								
													?>
														<img src="<?= base_url($courseimgpath); ?>" class="rounded img-fluid" alt="learnerlearner">
													<?php }else{ ?>
														<img src="<?= base_url().'assets/uploads/ilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">
													<?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
												<h5>
													<?php
														$showDuration = $paid_course['duration'] > 1 ? $paid_course['duration']. " Days" : $paid_course['duration']." Day";												
														$duration = $paid_course['duration'] - 1;
														$enddate = strtotime('+'.$duration .' days', strtotime($paid_course['start_day']. " " . $paid_course['end_time']));
													?>
													<?= ucfirst($paid_course['title']);?>, <?= $showDuration; ?> <br />
													<p>Duration: <?= $showDuration; ?> </p>
													<p>Start Date: <?= date("M d, Y h:i:sa", strtotime($paid_course['start_day'] . " " . $paid_course['start_time']));?></p>                                       
													<p>End Date: <?= date("M d, Y h:i:sa", $enddate);?></p>
													<p>USD: $ <?= $paid_course['pay_price']?></p>
												</h5>
												<ul class="courseUl">
													<li><?=nl2br(substr($paid_course['description'],0,300)); ?>...</li>
												</ul>
												<?php if(!$paid_course['pay_id']){ ?>
													<a class="btnBlue" href="<?=base_url()?>pricing/payment/<?=$paid_course['course_id']?>/course" >
														Pay Now
													</a>
													<a class="btnBlue" href="<?= base_url('company/'.$company['url'].'/training/view/'.$paid_course['course_time_id'])?>" >
														<?=$term["viewdetails"]?>
													</a>
												<?php }else if(!$paid_course['enroll_id']){ ?>
													<a class="btnBlue" href="javascript:enroll(<?=$paid_course['course_id']?>,<?=$paid_course['course_time_id']?>)" >
														<?=$term["enrollnow"]?>
													</a>
													<a class="btnBlue" href="<?= base_url('company/'.$company['url'].'/training/view/'.$paid_course['course_time_id'])?>" >
														<?=$term["viewdetails"]?>
													</a>
												<?php } else{ ?>
													<a  class="btnBlue" href="<?=base_url('company/'.$company['url'].'/demand/detail/'.$paid_course['course_id'])?>"  >
														<?=$term["viewcourse"]?>
													</a>
												<?php } ?>
											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
								<?php } 
								endforeach; ?>
							</div><!--col-12-->
							<div class="col-sm-12 paginationBox">
	                            <?= $links ?>
							</div><!--col-12-->
						<?php }else{ ?>
							<div class="col-sm-12">
								<p style="text-align: center">No record found.</p>
							</div>
						<?php } ?>
					</div><!--row-->
				</div><!--courseBox-->
			</div><!--col-12-->
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->
</div>
</div>
</section>
<div class="modal lg" id="policyModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Our Enrollment Pact</h5>
		</div>
		<div class="modal-body">
			<input type="hidden" id="book_course_id" name="book_course_id">
			<input type="hidden" name="id" id="id">
			<p>Your Peace of Mind Protection Under our Agreement for Cancellation, Transfer, Substitution, and "No-Show".</p>

			<p>If your plans changed and you are unable to attend the training course you have the following options available to you;</p>

			<p>	1.	More than 30 days to the start date of the course, you may: </p>
					<p>-Submit no hassle request to cancel your enrollment for a full refund less payment collection and administrative fees of 8% of the cost of the course.</p>
					<p>-Submit  no hassle request for transfer to another similar training course if availability exists.</p>
					<p>-Submit  no hassle request to substitute a colleague at no additional cost.  </p>
		 	<p>2.	Less than 30 days but more that 15 days to the start date of the course you may;</p>
			<p>-Submit no hassle request to cancel your enrollment for a 50% refund of the cost of the course. </p>
			<p>-Submit  no hassle request for transfer to another similar training course if  availability exists.</p>
			<p>-Submit  no hassle request to substitute a colleague additional cost. </p>


			<p>3.Less than 15 days to the start date of the course you may;</p>
			<p>-Submit no hassle request to cancel your enrollment for no refund. </p>
			<p>-Submit  no hassle request for transfer to another similar training course if   availability exists.</p>
			<p>-Submit  no hassle request to substitute a colleague for no additional cost. </p>

			<p>4. No show at the start of the training enrollment cancelled and no refund, replacement or substitution possible</p>
			<p>5. Although unlikely, unforeseen circumstances can necessitate cancellation of a course by Quality Circle in which case a full refund will be returned.</p>
			<p>6. Since the GoSmart is 100% automated any request for substitution would require the prospective participant to sign up on the academy { https://gosmartacademy.com } and notify support@gosmartacademy.com or support@qualitycircleint.com. After which an invitation for the course would be sent and the participant who would have to sign-up for the training to gain access.</p>
				<br>
				<!-- <input type="checkbox" name="term" id="term"> I agree with the terms and conditions  -->

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" onClick="booknow()"><?=$term["enrollnow"]?></button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
	</div>
	</div>
</div>
<script>
	var company_url = "<?= base_url('company/'.$company['url'])?>";
  	function enroll(course_id, id){
		$('#book_course_id').val(course_id);
		$('#id').val(id);
		$('#policyModal').modal('show');
	}
    function booknow() {
		var course_id = $("#book_course_id").val();
		var id = $("#id").val();
        $.ajax({
            url: $('#base_url').val()+'learner/training/booknow',
            type: 'POST',
            data: {'course_time_id': id, 'course_id': course_id},
            success: function (data, status, xhr) { 
                new PNotify({
                    title: 'Success',
                    text: 'Success Book Now',
                    type: 'success'
                });
                location.reload();
            },
            error: function(data){
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['alreadybooking']; ?>',
                    type: 'warning'
                });
            }
        });
    }
    $("#location").on('change',(function () {
        window.location = $('#base_url').val()+ 'learner/training?location='+$("#location").val();
    }));
	$("#course_id").on('change',(function () {
        window.location = $('#base_url').val()+ 'learner/training?course='+$("#course_id").val();
    }));
</script> 