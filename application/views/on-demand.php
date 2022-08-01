<style type="text/css"></style>
<section class="sectionBox">
	<div class="container">		
		<div class="row">		
			<div class="col-md-12">
				<ul class="catalogTab">
					<li class="active"><a href="<?php echo base_url('company/gosmartacademy.com/demand')?>">On Demand</a></li>
					<li><a href="<?php echo base_url('company/gosmartacademy.com/classes')?>">VILT</a></li>
					<!-- <?php
						$userType = $this->session->userdata('user_type');
						$userID = $this->session->userdata('userId');
						if ($userType == 'Instructor' || $userType == 'Learner') { ?>
							<li><a href="https://webrtc.gosmartacademy.com/index.php?userID=<?php echo $userID ?>" target="_blank">VILT Room</a></li>
					<?php } ?> -->
					<li><a href="<?php echo base_url('company/gosmartacademy.com/training')?>">Instructor Led Training</a></li>
					<li><a href="<?php echo base_url('company/gosmartacademy.com/bookshop')?>">Book Shop</a></li>
				</ul><!--catalogTab-->
			</div><!--col-12-->
			
			<div class="col-md-12">
				<div class="catalogBox">
					<div class="row only-demand">
						<div class="col-sm-4">
							<div class="sortPanel">
	                            <label>Category</label>
	                            <select id="category_id" name="category_id">
	                                <option value="0"> All </option>
	                                <?php foreach($category as $item){ ?>
	                                    <option value="<?php echo $item['id']; ?>" <?php $category_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
	                                <?php }  ?>
	                            </select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="sortPanel">
	                            <label>Standard</label>
	                            <select id="standard_id" name="standard">
	                                <option value="0"> All </option>
	                                <?php foreach($standard as $stdS){ ?>
	                                    <option value="<?php echo $stdS->id; ?>" <?php $standard_id==$stdS->id?print 'selected':print ''; ?>> <?php echo $stdS->name; ?></option>
	                                <?php }  ?>
	                            </select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="sortPanel">
	                            <label>Title</label>
	                            <!--<select id="category_id" name="category_id">
	                                <option value="0"> All </option>
	                                <?php foreach($category as $item){ ?>
	                                    <option value="<?php echo $item['id']; ?>" <?php $category_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
	                                <?php }  ?>
	                            </select>-->
	                            <input type="text" placeholder="Enter Course Relavant Title Keywords" id="course_tt" name="course_tt" value="<?php echo $course_title; ?>" class="form-control">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
						<?php if(sizeof($courses) == 0){ ?>
                            <div style="font-size: 32px;text-align: center;margin: 60px;">
                                Not available On demand courses.
                            </div>
                        <?php } ?>
						<?php if($courses){?>
							<div class="col-sm-12 test-peding"><?php 
								foreach($courses as $course): ?>
									<div class="whitePanel">
										<div class="row">
											<div class="col-lg-4 col-md-5 col-sm-6">
												<div class="leftImgBox">
                                                	<?php
														$imgName = end(explode('/', $course->img_path));
														$ext = pathinfo($imgName, PATHINFO_EXTENSION);
														if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){								
													?>
														<img src="<?php echo base_url($course->img_path); ?>">
													<?php }else{ ?>
														<img src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>">                                		
													<?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-8 col-md-7 col-sm-6 courseInfo">
												<h5><?php echo ucfirst($course->title); ?></h5>
												<ul class="courseUl">
													<li>
														<a href="#"><?php echo $course->first_instructor['email']?></a>
													</li>
													<li>
													<?php echo $course->course_self_time; ?>													
													</li>
                                                    <li> Start Date: <?php echo date("M d, Y", strtotime($course->start_at));?></li>
             										<li> End Date: <?php echo date("M d, Y", strtotime($course->end_at));?></li>
												</ul>
												<h6 style="margin-bottom: 10px">
													<?php if ($course->course_type == 0){
														echo "ILT";
													}else if ($course->course_type == 1){
														echo "VILT";
													}else{
														echo "Demand";
													}?>
												</h6>                                                
		                                        <?php if(is_null($course->is_pay['id'])){?>
                                                	<?php
														$active = 'No';
														$start_at = strtotime($course->start_at);
														$end_at = strtotime($course->end_at);
														
														$currentDate = time();
														if($currentDate >= $start_at && $currentDate <= $end_at){
															$active = 'Yes';
														}
														if($active == 'Yes'){
													?>
												    <a href="javascript:enroll(<?php echo $course->id ?>,<?php echo $course->pay_type ?>)" class="btnBlue">Enroll Now</a>
                                                    <?php }else{ ?>
                                                    <?php $startdatetime = date('d, M Y h:i:sa',$start_at); ?>
                                                    <a href="javascript:void(0)" onclick='swal({title: "Please wait until course is started! Course start date time is: <?php echo $startdatetime ;?>"});' class="btnBlue">Enroll Now</a>
                                                    <?php } ?>
		                                        <?php }else {?>
		                                            <a href="javascript:view_course(<?php echo $course->id ?>)" class="btnBlue">Access Course</a>
		                                        <?php }?>
												<a href="<?php echo base_url('company/gosmartacademy.com/demand/view/'.$course->id)?>" class="btnBlue">View Course</a>
											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
								<?php endforeach; ?>
							</div><!--col-12-->
							<div class="col-sm-12 paginationBox">
	                            <?php echo $links ?>
							</div><!--col-12-->
						<?php } ?>
					</div><!--row-->
				</div><!--courseBox-->
			</div><!--col-12-->
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->
<script type="text/javascript">
    var company_url = "<?= base_url('company/gosmartacademy.com')?>";
    var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
    var email = "<?php echo $this->session->userdata ( 'email' )?>";
	var userId = "<?php echo $this->session->userdata('userId')?>";
	$(function(){
        $("ul.pagination a").addClass('page-link');
    });

    $("#category_id").on('change',(function () {
        window.location = company_url + '/demand/showCourseByCategory/' + $("#category_id").val();
    }));

    $("#standard_id").on('change',(function () {
        window.location =  company_url + '/demand?standard=' + $("#standard_id").val();
    }));

	$("#course_tt").blur(function(){
		if($("#course_tt").val() != "") {
			window.location =  company_url + '/demand?title=' + $("#course_tt").val();
		}
	});


	function enroll(id,pay_type){	
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 0){
				window.location = company_url + '/demand/detail/' + id;
			}else if(pay_type == 1){							
				$.ajax({
		            url: "<?php echo base_url() ?>admin/inviteuser/get_Inviteuser",
		            type: 'POST',
		            data: {'email':email,'type':'2','course_id':id, 'time_id':0},
		            dataType : 'JSON',
		            success: function(data){
		                var cnt = data;
		                if(cnt == 1) {
		                	window.location = company_url + '/demand/detail/' + id;
		                }else{
		                	swal({
							  title: "You have to pay $99 to take part in this course",
							  buttons: true
							}).then((willDelete) => {
							  if (willDelete) {
							  	//window.location = company_url + '/classes/detail/' + id;	
								window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+id+'&user_id='+userId;
							  } else {
							    return;
							  }
							});
		                }
		                		  
		            }
		        });
				
			}
		}
	}

    function view_course(id){
        if(!isLogin){
            showLogin();
        }else{
            window.location = company_url + '/demand/detail/' + id;
        }
    }
</script>