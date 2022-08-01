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
									$imgName = end(explode('/', $course->img_path));
									$ext = pathinfo($imgName, PATHINFO_EXTENSION);
									if($imgName != '' && file_exists(getcwd().'/'.$course->img_path) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){							
								?>
									<img src="<?php echo base_url($course->img_path); ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php }else{ ?>
									<img src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php } ?>                                
                           </div>
                           <!--leftImgBox-->
                        </div>
                        <!--col-4-->
                        <div class="col-md-7 col-sm-7 courseInfo">
                           <!-- <h5></h5> -->
                           <p><i class="fa fa-check-square"></i> Enrollments: <?php echo $course->enroll_user_count ?></p>
                           <?php
                              $showDuration = $course->duration > 1 ? $course->duration. " Days" : $course->duration." Day";												
                              $duration = $course->duration - 1;
                              $enddate = strtotime('+'.$duration .' days', strtotime($course->start_at. " " . $course->end_time));
                           ?>
                           <ul>
                              <li>Duration: <?php echo $showDuration; ?> </li>
                              <li>Start Date: <?= date("M d, Y h:i:sa", strtotime($course->start_at . " " . $course->start_time));?></li>                                       
                              <li>End Date: <?= date("M d, Y h:i:sa", $enddate);?></li>
                              <li> Price: $<?= $course->pay_price?></li>
                              <li> Discount: <?= $course->discount?>%</li>
                              <li> Cost: $<?= $course->amount?></li>
                           <ul>
                           <?php if($course->pay_type == 0) {?>
                              <p><i class="fa fa-university"></i>Company:<?= $company['name']?></p>
                           <?php } ?>
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
                  
                 
                  <li><i class="fa fa-language"></i> Languages: English</li>
                  
                  <li><i class="fa fa-calendar-alt"></i> Published: <?php echo $course->freg_date?></li> 
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
               <?php if(!$this->session->userdata ('isLoggedIn')) {?>
                  <a href="javascript:showAcademyLogin('')" class="btnBlue">Register Now</a>
               <?php }else if($this->session->userdata('user_type') == 'Instructor' || $this->session->userdata('user_type') == 'Admin'){ ?>
                  <a href="javascript:viewcourse(<?php echo $course->course_id ?>)" class="btnBlue">View Course</a>
               <?php }else{ switch ($status) {
                  case 'Enrolled':
                     echo ' <a href="javascript:viewcourse('.$course->course_id.')" class="btnBlue">View Course</a>';
                     break;
                  case 'Paid':
                     echo ' <a href="javascript:enroll('.$course->course_id .','. $course->id.')" class="btnBlue">Enroll Now</a>';
                     break;
                  case 'UnPaid':
                     echo ' <a href="'.base_url("pricing/payment/"). $course->course_id .'/course" class="btnBlue">Pay Now</a>';
                     break;
                  case 'Invited':
                     echo ' <a href="javascript:enroll('.$course->course_id .','. $course->id.')" class="btnBlue">Enroll Now</a>';
                     break;
                  case 'Uninvited':
                     echo ' <button class="btn btn-success" data-toggle="modal" data-target="#confirm">Contact Admin</button>';
                     break;
               } } ?>
               
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
<div class="modal" id="confirm" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Permission Restricted to Invited Users Only</h5>
      </div>
      <div class="modal-body">
        <p>This is a closed enrollment training by invitation only. It is not open for public enrollment. Please go back to the academy page and browse for an open-enrollment course or contact admin if you are invited to this course and cannot register. </p>
      </div>
      <div class="modal-footer">
        <a href="mailto:admin@qualitycircleint.com" class="btn btn-primary">Contact Admin</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
            beforeOpen: function(){
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
   function viewcourse(course_id,pay_type,time_id){
		window.location = company_url + '/demand/detail/' + course_id + '/?type=ilt&time_id='+ time_id;		
	}	
   
   function enroll(course_id, course_time_id) {
        $.ajax({
            url: '<?= base_url()?>learner/live/booknow',
            type: 'POST',
            data: {'course_time_id': course_time_id, 'course_id': course_id},
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
   
   
</script>