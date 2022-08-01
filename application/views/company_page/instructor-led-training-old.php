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
					<li><a href="<?php echo base_url($company['company_url'])?>/classes">Open Live Classes</a></li>
					<!-- <?php
						$userType = $this->session->userdata('user_type');
						$userID = $this->session->userdata('userId');
						if ($userType == 'Instructor' || $userType == 'Learner') { ?>
							<li><a href="https://webrtc.gosmartacademy.com/index.php?userID=<?php echo $userID ?>" target="_blank">VILT Room</a></li>
					<?php } ?> -->
					<li class="active"><a href="<?php echo base_url($company['company_url'])?>/training">Instructor Led Training</a></li>
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
						<div class="col-sm-3">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Location</label>
                                    <select id="location" name="location">
                                        <option value="all"> All </option>
                                        <?php foreach($location as $item){ ?>
                                            <option value="<?php echo $item['location']; ?>" <?php $location_name==$item['location']?print 'selected':print ''; ?>> <?php echo $item['location']; ?></option>
                                        <?php }  ?>
                                    </select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Category</label>
		                            <select id="category_id" name="category_id">
		                                <option value="0"> All </option>
		                                <?php foreach($category as $item){ ?>
		                                    <option value="<?php echo $item['id']; ?>" <?php $category_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
		                                <?php }  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Standard</label>
		                            <select id="standard_id" name="standard_id">
		                                <option value="0"> All </option>
		                                <?php foreach($standard as $item){ ?>
		                                    <option value="<?php echo $item->id; ?>" <?php $standard_id==$item->id?print 'selected':print ''; ?>> <?php echo $item->name; ?></option>
		                                <?php }  ?>
		                            </select>
								</div>
							</div>
						</div>
					</div>
					<?php if(count($courses) > 0) : ?>
						<?php foreach($courses as $course): ?>
		                    <div class="row">
								<div class="col-sm-12">
									<div class="whitePanel">
										<div class="row">
											<div class="col-md-2 col-sm-3 col-xs-6">
												<div class="leftImgBox DateIcon">
													<div class="DateBox">
		                                             <span class="MonthShow"><?php echo $course->mreg_date?></span><!--MonthShow-->
		                                             <span class="DateShow"><?php echo $course->dreg_date?></span><!--DateShow-->
		                                            </div><!--DateShow-->
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-md-10 col-sm-9 col-xs-12 courseInfo">
												<h5><?php echo $course->title?></h5>
												<ul class="courseUl">
												  <li><?php echo $course->description?></li>
												</ul>
												<?php if($check_value != 'past') {  ?>
													<div class="row">
													<div class="col-sm-12 coursePrice">
														<?php if($this->session->userdata('user_type') == 'Instructor' || $this->session->userdata('user_type') == 'Admin'){?>
															
																<a href="javascript:viewcourse(<?php echo $course->course_id ?>)" class="btnBlue">View Course</a>
															
														<?php }else{?>
															<?php if(is_null($course->is_pay['id'])){?>
															    <a href="javascript:enroll(<?php echo $course->training_course_id ?>,<?php echo $course->pay_type ?>)" class="btnBlue">Enroll Now</a>
					                                        <?php }else {?>
					                                        	<?php if($course->expired == 'yes'){?>
																	<a href="javascript:" class="btnGray">View Course</a>
																<?php }else if($course->expired == 'no') {?>
																	<a href="javascript:viewcourse(<?php echo $course->course_id ?>)" class="btnBlue">View Course</a>
																<?php }?>
					                                        <?php }?>
					                                    <?php }?>
					                                    <a href="<?php echo base_url($company['company_url'].'/training/view/'.$course->id) ?>" class="btnBlue">View Details</a>

													</div>
													</div>
												<?php } ?>

											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
								</div><!--col-12-->
							</div>
						<?php endforeach;?>
					<?php else : ?>
		                <div class="row">
							<div class="col-sm-12">
								<div class="whitePanel">
								   <div class="row">
								   		<h3>No Courses Found !!</h3>
								   </div>
								</div>
							</div>
						</div>
					<?php endif; ?>
                    
					<div class="col-sm-12 paginationBox">
                        <?php echo $links ?>
					</div>
					
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


<script>

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
	var company_url = "<?= base_url($company['company_url'])?>";
	var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
	var email = "<?php echo $this->session->userdata ( 'email' )?>";
	var user_type = "<?php echo $this->session->userdata('user_type')?>";
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	    acc[i].addEventListener("click", function() {
	        this.classList.toggle("active");
	        var panel = this.nextElementSibling;
	        if (panel.style.display === "block") {
	            panel.style.display = "none";
	        } else {
	            panel.style.display = "block";
	        }
	    });
	}

	$(function(){
	    $("ul.pagination a").addClass('page-link');
	});
	function sortByDate(e){
		window.location = company_url + '/training?sort=' + e.value;
	}

	$("#location").on('change',(function () {
	    window.location = company_url + '/training?location='+$("#location").val();
	}));


    $("#category_id").on('change',(function () {
        window.location = company_url + '/training?category='+$("#category_id").val();
    }));

    $("#standard_id").on('change',(function () {
        window.location =  company_url + '/training?standard=' + $("#standard_id").val();
    }));

	function viewcourse(course_id){
		window.location = company_url + '/demand/detail/' + course_id;	
	}

	function enroll(training_id,pay_type){
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 1){
				if(user_type != "Learner"){
					// window.location = "<?php echo VILT_URL?>"+id;
				}else{
					swal({
					  title: "You have to pay 99$ to take part in this course",
					  buttons: true
					}).then((willDelete) => {
					  if (willDelete) {
					  	$.ajax({
				            url: "<?php echo base_url() ?>learner/training/pay_training",
				            type: 'POST',
				            data: {'course_id':training_id},
				            dataType : 'json',
				            success: function(data){
				                if(data == 'success') {
				                	swal({
									  title: "You have successfully enroll this course. Please wait until course is started!",
									});
				     				window.location.reload();
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
		        			'course_id':training_id},
		            dataType : 'json',
		            success: function(data){
		                var cnt = data;
		                if(cnt == 1) {
		                	$.ajax({
					            url: "<?php echo base_url() ?>learner/training/pay_training",
					            type: 'POST',
					            data: {'course_id':training_id},
					            dataType : 'json',
					            success: function(data){
					                if(data == 'success') {
					                	swal({
										  title: "You have successfully enroll this course. Please wait until course is started!",
										});
										
										window.location.reload();
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

</script>