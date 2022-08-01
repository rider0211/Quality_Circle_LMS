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
               <li><a href="<?php echo base_url($company['company_url'])?>/training">Instructor Led Training</a></li>
               <li><?php echo $course->title?></li>
               <div class="shareBox"><a href="#"><i class="fa fa-share"></i> Share</a></div>
            </ul>
            <!--breadcrumb-->
         </div>
         <!--col-12-->
         <div class="col-md-9">
            <div class="catalogBox catalogBox1">
               <div class="row">
                  <div class="col-sm-12">
                     <h3 class="titleH4"><?php echo $course->title?></h3>
                     <br>
                     <div class="row">
                        <div class="col-md-5 col-sm-5">
                           <div class="leftImgBox">
                           		<?php 
									$imgName = end(explode('/', $course->course_img_path));
									$ext = pathinfo($imgName, PATHINFO_EXTENSION);
									if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){								
								?>
									<img src="<?php echo base_url($course->course_img_path); ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php }else{ ?>
									<img src="<?php echo base_url().'assets/uploads/ilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php } ?>
                           </div>
                           <!--leftImgBox-->
                        </div>
                        <!--col-4-->
                        <div class="col-md-7 col-sm-7 courseInfo">
                        
                        	<?php
								$showDuration = $course->duration > 1 ? $course->duration. " Days" : $course->duration." Day";								
								$duration = $course->duration - 1;
								$enddate = strtotime(date('Y-m-d',$course->date_str) .'+'.$duration .'days');
							?>
							<p><i class="fa fa-user"></i> Enrollments: <?php echo $course->count_enroll_users; ?> </p>
                            <p><i class="fa fa-calendar-alt"></i> Duration: <?php echo $showDuration; ?> </p>
							<p><i class="fa fa-calendar-alt"></i> Start Date: <?php echo date("M d, Y", $course->date_str);?></p>
							<p> <i class="fa fa-calendar-alt"></i> End Date: <?php echo date("M d, Y", $enddate);?></p>
                           	<p><i class="fa fa-map-marker"></i> Location: <?php echo $course->location?></p>
                        </div>
                        <!--col-8-->
                     </div>
                     <!--row-->
                  </div>
                  <div class="col-md-12">
                     <p><?php echo strip_tags($course->description);?></p>
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
                  <!--whitePanel-->
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
                                 <?php if(isset($course->objective) && !empty(strip_tags($course->objective))){ ?>        
                                 <?php echo strip_tags($course->objective)?>  
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?>
                              </div>
                              <?php if($course->objective_img){ ?>
                              <div class="trainingPic" style="background-image:url('<?php echo base_url($course->objective_img)?>')">
                              </div>
                              <?php }else{ ?>
                              <div class="trainingPic" style="background-image:url('<?php echo base_url('assets/uploads/company/course/no-preview-available.jpg')?>')"></div>
                              <?php } ?>
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
                              <?php if($course->attend_img){?>
                              <div class="trainingPic" style="background-image:url('<?php echo base_url($course->attend_img)?>')">
                              </div>
                              <?php }else{ ?>
                              <div class="trainingPic" style="background-image:url('<?php echo base_url('assets/uploads/company/course/no-preview-available.jpg')?>')"></div>
                              <?php } ?>
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
                                 <?php if(isset($course->agenda) && !empty(strip_tags($course->agenda))){ ?>        
                                 <?php echo strip_tags($course->agenda) ?>
                                 <?php }else{ ?>
                                 Not Available
                                 <?php } ?> 
                              </div>
                              <?php if($course->agenda_img){ ?>
                              <div class="trainingPic" style="background-image:url('<?php echo base_url($course->agenda_img)?>')">
                              </div>
                              <?php }else{ ?>
                              <div class="trainingPic" style="background-image:url('<?php echo base_url('assets/uploads/company/course/no-preview-available.jpg')?>')"></div>
                              <?php } ?>
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
                                 <?php if(isset($course->category) && !empty($course->category)){ ?>        
                                 <?php echo getCategoryNameById($course->category); ?>
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
                     <!--row-->
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="catalogBox">
               <p><?php echo $course->course_self_time?></p>
               <h2 class="titleH4" style="font-size:21px;margin-bottom:0px;">Schedule & Purchase</h2>
               <ul class="rightList rightList1">
                  <li>
                     <i class="fa fa-bus" aria-hidden="true"></i>
                     <span class="DeliveryTitle">Delivery Option</span>
                     <p class="DeliverySuboption">Choose your preferrred delivery method</p>
                  </li>
                  <li>
                     <i class="fa fa-envelope"></i><a href="mailto:admin@qualitycircleint.com"><span class="RequestQuote">Request a quote for...</span></a>
                     <p class="DeliverySuboption">
                        <label class="radioBox">On-Site Training 
                        <input type="radio" checked="checked" name="radio">
                        <span class="checkmark"></span>
                        </label>
                     </p>
                  </li>
               </ul>
               <br>
               <br>
               <?php if($this->session->userdata('user_type') == 'Instructor' || $this->session->userdata('user_type') == 'Admin'){?>
               <a href="javascript:viewcourse(<?php echo $course->course_id ?>)" class="btnBlue">View Course</a>
               <?php }else{?>
               <?php if(is_null($course->is_pay['id'])){?>
               <?php
					$active = 'No';
					$start_date = $course->date_str;
					$currentDate = time();
					if($currentDate >= $start_date && $currentDate <= $enddate){
						$active = 'Yes';
					}
					if($active == 'Yes'){
				?>               
               <a href="javascript:enroll(<?php echo $course->training_course_id ?>,<?php echo $course->pay_type ?>,<?php echo $course->course_id ?>,<?php echo $course->id ?>)" class="btnBlue">Enroll Now</a>
               <?php }else{ ?>
               	<?php $startdatetime = date('d, M Y h:i:sa',$course->date_str); ?>
               	<a href="javascript:void(0)" onclick='swal({title: "Please wait until course is started! Course start date time is: <?php echo $startdatetime ;?>"});' class="btnBlue">Enroll Now</a>
               <?php } ?>
               <?php }else {?>
               <?php if($course->expired == 'yes'){?>
               <a href="javascript:" class="btnGray">View Course</a>
               <?php }else if($course->expired == 'no') {?>
               <a href="javascript:viewcourse(<?php echo $course->course_id ?>,<?php echo $course->pay_type ?>,<?php echo $course->id ?>)" class="btnBlue">View Course</a>
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
                           <span class="MonthShow"><?php echo $value->month?> / <?php echo $value->year?></span><!--MonthShow-->
                           <span class="DateShow" style = "background-color: white;"><?php echo $value->sday?></span><!--DateShow-->
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
   </div>
</section>
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
   
   	function viewcourse(course_id,pay_type,time_id){
		window.location = company_url + '/demand/detail/' + course_id + '/?type=ilt&time_id='+ time_id;		
	}	
   
   function enroll(training_id,pay_type,course_id,time_id){
       if(!isLogin){
           showLogin();
       }else{
           if(pay_type == 1){
               if(user_type != "Learner"){
                   // window.location = "<?php echo VILT_URL?>"+id;
               }else{
                   swal({
                     title: "You have to pay $99 to take part in this course",
                     buttons: true
                   }).then((willDelete) => {
                     if (willDelete) {
                       $.ajax({
                           url: "<?php echo base_url() ?>learner/training/pay_training",
                           type: 'POST',
						   data: {'course_id':training_id,'time_id':time_id,'ilt_course_id':course_id},
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
                    data: {'email':email,'type':'0','course_id':training_id,'time_id':time_id},
                   dataType : 'json',
                   success: function(data){
                       var cnt = data;
                       if(cnt == 1) {
                           $.ajax({
                               url: "<?php echo base_url() ?>learner/training/pay_training",
                               type: 'POST',
                               data: {'course_id':training_id,'time_id':time_id,'ilt_course_id':course_id},
                               dataType : 'json',
                               success: function(data){
                                   if(data == 'success'){
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
   
   // function booknow(id){
   //   var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
   //   if(!isLogin){
   //     showLogin();
   //   }else{
   //     swal({
   //       title: "Are you sure?",
   //       buttons: true
   //     })
   //     .then((willDelete) => {
   //       if (willDelete) {
   //             swal({
   //               text: "Success Pay!",
   //               icon: "success"
   //             });
   //             $.ajax({
   //             url : company_url + '/training/pay/' + id,
   //             type : 'post',
   //             success : function(res) {
   //                   if(res.type == 1){
   //                         swal({
   //                           text: "You pay successfully!",
   //                           icon: "success"
   //                         });
   //                   }else{
   //                       if(res.msg){
   //                           swal({
   //                             text: res.msg,
   //                             icon: "warning",
   //                             dangerMode: true
   //                           });
   //                       }
   //                   }
   //               }
   //           });
   //       } else {
   //         return;
   //       }
   //     });
   //   }
   // }
</script>