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
            <ul class="breadcrumb">
               <li><a href="<?php echo base_url($company['company_url'].'/demand') ?>">Catalog</a></li>
               <li><a href="<?php echo base_url($company['company_url'])?>/classes">VILT</a></li>
               <li><?php echo $course->title?></li>
               <div class="shareBox"><a href="#"><i class="fa fa-share"></i> Share</a></div>
            </ul>
            <!--breadcrumb-->
         </div>
         <!--col-12-->
         <div class="col-md-9">
            <div class="catalogBox catalogBox1">
               <div class="row">
                  <div class="col-md-12">
                     <h3 class="titleH4"><?php echo $course->title?></h3>
                     <h5><?php echo $course->subtitle?></h5>
                     <br>
                     <div class="row">
                        <div class="col-md-5 col-sm-5">
                           <div class="leftImgBox">
                           		<?php 
									$imgName = end(explode('/', $course->virtual_course_path));
									$ext = pathinfo($imgName, PATHINFO_EXTENSION);
									if($imgName != '' && file_exists(getcwd().'/'.$course->virtual_course_path) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){							
								?>
									<img src="<?php echo base_url($course->virtual_course_path); ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php }else{ ?>
									<img src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php } ?>                                
                           </div>
                           <!--leftImgBox-->
                        </div>
                        <!--col-4-->
                        <div class="col-md-7 col-sm-7 courseInfo">
                           <!-- <h5></h5> -->
                           <p><?php echo strip_tags($course->about)?></p>
                        </div>
                        <!--col-8-->
                     </div>
                     <!--row-->
                  </div>
                  <!--col-12-->
                  <h3 class="titleH3" style="padding-left: 5px;">Instructor</h3>
                  <div class="whitePanel _mt-0">
                     <div class="row">
                        <div class="col-md-2 col-sm-3">
                           <?php if($course->first_instructor->picture){?>
                           <div class="instPic" style="background-image:url('<?php echo base_url($course->first_instructor->picture)?>')">
                           </div>
                           <?php } else{?>
                           <div class="instPic" style="background-image:url('<?php echo base_url('assets/img/default_profile.png')?>')"></div>
                           <?php } ?>
                        </div>
                        <div class="col-md-10 col-sm-9">
                           <ul class="instInfo">
                              <li><?php echo $course->first_instructor->email?></li>
                              <li><i class="fa fa-map-marker"></i> United States</li>
                              <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $course->first_instructor->email?>">Contact Instructor</a></li>
                           </ul>
                           <!--checkList-->
                        </div>
                        <!--col-12-->
                     </div>
                     <!--row-->
                  </div>
                  <!--whitePanel-->
                  <h3 class="titleH3" style="padding-left: 5px;">Course Highlights</h3>
                  <div class="whitePanel _mt-0">
                     <div class="row">
                        <div class="col-md-10 col-sm-10">
                           <ul class="checkList">
                              <?php if(isset($course->highlights) && count(json_decode($course->highlights))>0){
									foreach(json_decode($course->highlights) as $keys => $highlight): ?>
                              <li><?php echo $highlight?></li>
                              <?php endforeach; }else{ ?>
                              	Not Available
                              <?php } ?>
                           </ul>
                           <!--checkList-->
                        </div>
                     </div>
                     <!--row-->
                  </div>
                  <div style="margin-top:15px;" class="col-sm-12 Objects">                           
                     <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Number</a>
                              </h4>
                           </div>
                           <div id="collapse1" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php if(isset($course->number) && !empty($course->number)){ ?>              
                                 <?php echo $course->number?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Learning Objective</a>
                              </h4>
                           </div>
                           <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php if(isset($course->objective) && !empty($course->objective)){ ?>                
                                 <?php echo nl2br($course->objective)?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>                           
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Who Should Attend</a>
                              </h4>
                           </div>
                           <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php if(isset($course->attend) && !empty(strip_tags($course->attend))){ ?>
                                 <?php echo strip_tags($course->attend) ?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Agenda</a>
                              </h4>
                           </div>
                           <div id="collapse4" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php if(isset($course->agenda) && !empty($course->agenda)){ ?>               
                                 <?php echo strip_tags($course->agenda) ?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Course Pre-Requisite</a>
                              </h4>
                           </div>
                           <div id="collapse5" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php if(isset($course->course_pre_requisite) && !empty(strip_tags($course->course_pre_requisite))){ ?>                
                                 <?php echo strip_tags($course->course_pre_requisite) ?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Category</a>
                              </h4>
                           </div>
                           <div id="collapse6" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <?php if(isset($course->category_id) && !empty($course->category_id)){ ?>       
                                 <?php echo getCategoryNameById($course->category_id); ?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Standard</a>
                              </h4>
                           </div>
                           <div id="collapse7" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <ul class="">
                                    <?php $explode = explode(',',$course->standard_id); ?>
                                 	<?php if(!empty($explode[0]) && $explode[0] != 'null'){ ?>
                                    <?php foreach($explode as $standard): 
                                       $standard = str_replace( array( '\'', '"', ',' , '[', ']' ), ' ', $standard);
                                       ?>
                                    <li><?php echo getStandardNameById($standard); ?></li>
                                    <?php endforeach;?>
                                    <?php }else{ ?>
                                        Not Available  
                                    <?php } ?>
                                 </ul>
                                 <!--checkList-->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--col-12-->
               </div>
               <!--row-->
            </div>
            <!--courseBox-->
         </div>
         <!--col-9-->
         <div class="col-md-3">
            <div class="catalogBox">
               <ul class="rightList">
                  <?php if(!empty($course->course_self_time)){ ?>
                  <li><i class="fa fa-dot-circle"></i> <?php echo $course->course_self_time?></li>
                  <?php } ?>
                  <li><i class="fa fa-check-square"></i> Enrollments: <?php echo $course->enroll_user_count ?></li>
                 
                  <li><i class="fa fa-language"></i> Languages: English</li>
                  
                  <li><i class="fa fa-calendar-alt"></i> Published: <?php echo $course->freg_date?></li> 
                  <?php
						$showDuration = $course->duration > 1 ? $course->duration. " Days" : $course->duration." Day";
						
						$duration = $course->duration - 1;
						$enddate = strtotime($course->start_at .'+'.$duration .'days');
					?>
					<li><i class="fa fa-calendar-alt"></i> Duration: <?php echo $showDuration; ?> </li>
					<li><i class="fa fa-calendar-alt"></i> Start Date: <?php echo date("M d, Y", strtotime($course->start_at));?></li>
					<li> <i class="fa fa-calendar-alt"></i> End Date: <?php echo date("M d, Y", $enddate);?></li>               
               </ul>
               <br>
               <br>
               <div class="Number">
                  <?php echo $course->pay_type == 0 ? 'Onsite Training' : '$'.$course->pay_price; ?>
               </div>
               <?php if($course->pay_type){
                  $pay = $course->pay_type;
                  }else{
                  $pay = '0';
                  }?>
               <?php if($this->session->userdata('user_type') == 'Instructor' || $this->session->userdata('user_type') == 'Admin'){?>						
               <a href="javascript:viewcourse(1,<?php echo $course->id ?>)" class="btnBlue">Start Course</a>						
               <?php }else{ ?>
               <?php if(is_null($course->is_pay['id'])){?>
               <?php
					$activev = 'No';
					$start_datev = strtotime($course->start_at);
					$currentDatevilt = time();
					if($currentDatevilt >= $start_datev && $currentDatevilt <= $enddate){
						$activev = 'Yes';
					}
					if($activev == 'Yes'){
				?>
               		<a href="javascript:enroll(<?php echo $course->id ?>,<?php echo $course->pay_type ?>,<?php echo $course->course_time_id ?>,<?php echo $course->course_id; ?>)" class="btnBlue">Enroll Now</a>
               <?php }else{ ?>
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
               
               
            </div>
            <div class="catalogBox" style="background: #f6f6f6">
               <b> UPCOMING EVENTS</b>
               <?php foreach ($upcoming_courses as $key => $value) {?>
               <hr style="border-top-color:#b5afaf">
               <blockquote class="success row">
                  <div class="col-sm-12" style="padding-right: 0px;padding-left: 0px;">
                     <div class="leftImgBox DateIcon">
                        <div class="DateBox">
                           <span class="MonthShow"><?php echo date_format(date_create($value->start_at),"n")?>/<?php echo date_format(date_create($value->start_at),"y")?></span><!--MonthShow-->
                           <span class="DateShow" style = "background-color: white;"><?php echo date_format(date_create($value->start_at),"j")?></span><!--DateShow-->
                        </div>
                        <!--DateShow-->
                     </div>
                     <!--leftImgBox-->
                  </div>
                  <!--col-4-->
                  <div class=" col-md-12">
                     <b style= "font-size:14px;"> <?php echo $value->title?></b><br>
                     <i class="fa fa-language"></i>  English
                  </div>
               </blockquote>
               <?php }?>					
            </div>
         </div>
         <!--col-3-->
      </div>
      <!--row-->
   </div>
   <!--container-->
</section>
<!--sectionBox-->
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
   
   $(document).ready(function() {
     $('.collapse.in').prev('.panel-heading').addClass('active');
     $('#accordion, #bs-collapse')
   	.on('show.bs.collapse', function(a) {
   	  $(a.target).prev('.panel-heading').addClass('active');
   	})
   	.on('hide.bs.collapse', function(a) {
   	  $(a.target).prev('.panel-heading').removeClass('active');
   	});
   });
      var company_url = "<?= base_url($company['company_url'])?>";
      var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
      var email = "<?php echo $this->session->userdata ( 'email' )?>";
      var user_type = "<?php echo $this->session->userdata('user_type')?>";
   
   function viewcourse(is_instructor,id,startAt){
	   
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
   }
   
   function enroll(id,pay_type,time_id,course_id){			
   	if(!isLogin){
   		showLogin();
   	}else{
   		if(pay_type == 1){
   			if(user_type !== "Learner"){
   				// window.location = "<?php echo VILT_URL?>"+id;
   			}else{
   				swal({
   				  title: "You have to pay $99 to take part in this course",
   				  buttons: true
   				}).then((willDelete) => {
   				  if (willDelete) {
   				  	$.ajax({
   			            url: "<?php echo base_url() ?>learner/live/pay_course",
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
   				  } else {
   				    // return;
   				  }
   				});
   
   			}
   		}else if(pay_type == 0){
   			$.ajax({
   	            url: "<?php echo base_url() ?>admin/inviteuser/get_Inviteuser",
   	            type: 'POST',
   	            data: {
   						'email':email,
   	        			'type':'1',
   	        			'course_id':id,
						'time_id':time_id
   					},
   	            dataType : 'json',
   	            success: function(data){
   	                var cnt = data;
   	                if(cnt == 1) {
   	                	$.ajax({
   				            url: "<?php echo base_url() ?>learner/live/pay_course",
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
   
</script>