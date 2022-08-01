<style>
	.btnGray {
	display: inline-block;
	height: 45px;
	border-radius: 4px;
	background: #bcc4c7;
	color: #fff;
	font-weight: 400;
	line-height: 45px;
	padding: 0px 10px;
	text-align: center;
}
</style>
<section class="sectionBox">
	<div class="container">
		<div class="row">
		
			<div class="col-md-12">
				<ul class="catalogTab">
					<li><a href="<?php echo base_url($company['company_url'])?>/demand">On Demand</a></li>
					<li class="active"><a href="<?php echo base_url($company['company_url'])?>/classes">VILT</a></li>
					<!-- <?php
						$userType = $this->session->userdata('user_type');
						$userID = $this->session->userdata('userId');
						if($userType == 'Instructor' || $userType == 'Learner') { ?>
							<li><a href="https://webrtc.gosmartacademy.com/index.php?userID=<?php echo $userID ?>" target="_blank">VILT Room</a></li>
					<?php } ?> -->
					<li><a href="<?php echo base_url($company['company_url'])?>/training">Instructor Led Training</a></li>
					<li><a href="<?php echo base_url($company['company_url'])?>/bookshop">Book Shop</a></li>
				</ul><!--catalogTab-->
			</div><!--col-12-->
			
			<div class="col-md-3">				
				<div class="catalogBox">					
					<ul class="filtersLeft">
						<li>
						<h3 class="titleH3 _mt-0"><i class="fa fa-align-left"></i> Filters</h3>
							<button class="accordion">Class Type</button>
							<div class="panel" style="display:block">
							  <label class="radioBox">Upcoming
								  <input onclick="sortByDate(this)" type="radio" <?php echo $check_value=='upcoming' ? 'checked' : ''?> value="upcoming" name="radio">
								  <span class="checkmark"></span>
							  </label>
							  <label class="radioBox">Past
								  <input onclick="sortByDate(this)" id="past_radio" type="radio" <?php echo $check_value=='past' ? 'checked' : ''?>  value="past" name="radio">
								  <span class="checkmark"></span>
							  </label>
							</div>
						</li>						
					</ul><!--filtersLeft-->
				</div>
			</div><!--col-3-->
			
			<div class="col-md-9">
				<div class="catalogBox">
					<div class="row">
						<div class="col-sm-12">
							<div class="sortPanel">
								<div class="sortSet">
<!--									<label>Sort By :</label>-->
<!--									<select>-->
<!--										<option>Price</option>-->
<!--										<option>Top Rating</option>-->
<!--										<option>Popular</option>-->
<!--									</select>-->
								</div><!--sortSet-->
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->					
					<div class="row">
						<div class="col-sm-12">
							<?php foreach($courses as $course): ?>
							<div class="whitePanel">
								<div class="row">
									<div class="col-md-5 col-sm-4">
										<div class="leftzBox">
                                        	<?php
												$imgName = end(explode('/', $course->virtual_course_path));
												$ext = pathinfo($imgName, PATHINFO_EXTENSION);											
												if($imgName != '' && file_exists(getcwd().'/'.$course->virtual_course_path) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){
											?>
												<img src="<?php echo base_url($course->virtual_course_path); ?>">
											<?php }else{ ?>
												<img src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>">                                		
											<?php } ?>
										</div><!--leftImgBox-->
									</div><!--col-4-->
									<div class="col-md-7 col-sm-8 courseInfo">
										<h5><?php echo $course->title?></h5>
										<ul class="courseUl">
											<a href="#"><?php echo $course->first_instructor['email']?></a>
                                            
                                            <li><?php echo $course->course_self_time; ?>, Publish date: <?php echo date("M d, Y", strtotime($course->reg_date));?></li>
                                            <?php
												$showDuration = $course->duration > 1 ? $course->duration. " Days" : $course->duration." Day";												
												$duration = $course->duration - 1;
												$enddate = strtotime($course->start_at .'+'.$duration .'days');
											?>
											<li>Duration: <?php echo $showDuration; ?> </li>
											<li>Start Date: <?php echo date("M d, Y", strtotime($course->start_at));?></li>
											<li>End Date: <?php echo date("M d, Y", $enddate);?></li>	
										</ul>
										<div class="coursePrice _plr-0">
											<div class="row">
												<div class="col-lg-5 col-md-12 col-sm-5 col-xs-5 col-full">
													<?php echo $course->pay_type == 0 ? 'Onsite Training' : '$'.$course->pay_price; ?>
												</div>
												<?php if($check_value != 'past') {  ?>
													<div class="col-lg-7 col-md-12 col-sm-7 col-xs-7 col-full">
													<?php if($this->session->userdata('user_type') == 'Instructor' || $this->session->userdata('user_type') == 'Admin'){?>
                                                    <a href="javascript:viewcourse(1,<?php echo $course->id ?>,'<?= $course->start_at ?>')" class="btnBlue">Start Course</a>                                                   
													<?php }else{?>
                                                    
                                                    	<?php if(is_null($course->is_pay['id'])){?>
                                                        <?php
															$activev = 'No';
															//$start_datev = $course->start_at;
															//$currentDatevilt = date('Y-m-d h:i:s',time());																				
															//$enddate = date('Y-m-d h:i:s',strtotime($course->start_at .'+'.$duration .'days'));
															
															$start_datev = strtotime($course->start_at);
															$currentDatevilt = time();
															if($currentDatevilt >= $start_datev && $currentDatevilt <= $enddate){
																$activev = 'Yes';
															}
															if($activev == 'Yes'){
														?>
														<a href="javascript:enrollNow(<?php echo $course->id ?>,<?php echo $course->pay_type ?>,<?php echo $course->time_id ?>,<?php echo $course->course_id; ?>)" class="btnBlue">Enroll Now</a>
														<?php } else { ?>
                                                        	<?php $startdatetime = date('d, M Y h:i:sa',strtotime($course->start_at)); ?>
															<a href="javascript:void(0)" onclick='swal({title: "Please wait until course is started! Course start date time is: <?php echo $startdatetime ;?>"});' class="btnBlue">Enroll Now</a>
														<?php } ?>
															
				                                        <?php }else {?>
				                                        	<?php if($course->expired == 'yes'){?>
																<a href="javascript:" class="btnGray">View Course</a>
															<?php }else if($course->expired == 'no') {?>
																<a href="javascript:viewcourse(0,<?php echo $course->id ?>,'<?= $course->start_at ?>')" class="btnBlue">View Course</a>
															<?php }?>
				                                        <?php }?>
				                                    <?php }?>
													<a href="<?php echo base_url($company['company_url'].'/classes/view/'.$course->time_id)?>" class="btnBlue">View Details</a>
													</div>
												<?php } ?>
											</div><!--row-->
										</div><!--coursePrice-->
									</div><!--col-8-->
								</div><!--row-->
							</div><!--whitePanel-->
							<?php endforeach; ?>
						</div><!--col-12-->
						<div class="col-sm-12 paginationBox">
                            <?php echo $links ?>
						</div><!--col-12-->
					</div><!--row-->
				</div><!--courseBox-->
			</div><!--col-12-->
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->

<a class="mb-1 mt-1 mr-1 modal-basic btn btn-default alert-modal" href="#modalCenter" hidden></a>

<div id="modalCenter" class="modal-block mfp-hide">
	<section class="card">
		<div class="card-body">
			<div class="modal-wrapper">
				<div class="modal-text text-center">
					<p style="font-size:25px">You don’t have permission to access this user course. Please contact Administrator</p>
					<a style="background-color:green" class="btn btn-primary modal-confirm" href="mailto: admin@qualitycircleint.com"/> Contact</a>
					<button class="btn btn-default modal-dismiss">Cancel</button>
				</div>
			</div>
		</div>
	</section>
</div>


<script type="text/javascript">

	$('.alert-modal').magnificPopup({
        type: 'inline',
        preloader: false,
        callbacks: {
            beforeOpen: function() {
            }
        }
    });

    $('.modal-dismiss').on('click',function(){
    	 $.magnificPopup.close();
    })

	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	    acc[i].addEventListener("click", function() {
	        this.classList.toggle("active");
	        var panel = this.nextElementSibling;
	        if (panel.style.display === "block") {
	            panel.style.display = "none";
	            panel.style.display = "none";
	        } else {
	            panel.style.display = "block";
	        }
	    });
	}
    var company_url = "<?= base_url($company['company_url'])?>";
    var isLogin = "<?php echo $this->session->userdata ('isLoggedIn')?>";
    var email = "<?php echo $this->session->userdata ('email')?>";
    var user_type = "<?php echo $this->session->userdata('user_type')?>";
	$(function(){
        $("ul.pagination a").addClass('page-link');
    });
	function viewcourse(is_instructor,id, startAt){

			var currentDate = new Date();
			var courseStartDate = new Date(startAt);
			courseStartDate.setHours(courseStartDate.getHours() - 1);
			console.log(courseStartDate);

			if(courseStartDate.getTime() > currentDate.getTime()) {		
				console.log(courseStartDate.getTime()-currentDate.getTime());
				swal({
					title: "This course will be available at "+courseStartDate,
				});
				return;
			}
			// var same = d1.getTime() === d2.getTime();
			// var notSame = d1.getTime() !== d2.getTime();

			$.ajax({
				url: "<?php echo base_url() ?>admin/live/enterCourse",
				type: 'POST',
				data: {
					'course_id':id,
					'is_instructor': is_instructor,
					'start_at': startAt
				},
				dataType : 'json',
				success: function(data){
					if(data.success == 1){
						window.location.href = data.msg;
					} else{
						swal({
							title: "Instructor is not available. Please wait until the instructor is online",
						});
					}
				}
			});
		//}
	}

	function enrollNow(id,pay_type,time_id,course_id){
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 1){
				if(user_type !== "Learner"){
					// window.location = "<?php echo VILT_URL?>"+id;
				}else{
					swal({
					  title: "You have to pay 99$ to take part in this course",
					  buttons: true
					}).then((willDelete) => {
					  if (willDelete) {
					  	$.ajax({
				            url: "<?php echo base_url() ?>learner/live/pay_course/",
				            type: 'POST',
				            data: {'course_id':id,'time_id':time_id,'vilt_course_id':course_id},
				            dataType : 'json',
				            success: function(data){
				                if(data == 'success') {
				                	swal({
									  title: "You have successfully enroll this course. Please wait until course is started!",
									});
									setTimeout(function(){ window.location.reload(); }, 10000);
				                }else{
				                	swal({
									  title: " Error!",
									});
				                }
				                		  
				            }
				        });
					  } else {
					    // return;
					  }
					});

				}
			}else if(pay_type == 0){
				$.ajax({
		            url: "<?php echo base_url() ?>admin/inviteuser/get_Inviteuser",
		            type: 'POST',
		            data: {'email':email,
		        			'type':'1',
		        			'course_id':id,
							'time_id':time_id
						},
		            dataType : 'json',
		            success: function(data){
					
		                var cnt = data;
		                if(cnt == 1) {
		                	$.ajax({
					            url: "<?php echo base_url() ?>learner/live/pay_course/",
					            type: 'POST',
					            data: {'course_id':id,'time_id':time_id,'vilt_course_id':course_id},
					            dataType : 'json',
					            success: function(data){
					                if(data == 'success') {
					                	swal({
										  title: "You have successfully enroll this course. Please wait until course is started!",
										});
										setTimeout(function(){ window.location.reload() }, 10000);
					                }else{
					                	swal({
										  title: " Error!",
										});
					                }
					            }
					        });		                	
		                }else{
		                	$('.alert-modal').click();		                	
		                }		                		  
		            }
		        });				
			}
		}
	}
	function sortByDate(e){
		window.location = company_url + '/classes?sort=' + e.value;
	}
</script>