<section class="sectionBox">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <ul class="breadcrumb">
               <li><a href="<?php echo base_url($company['company_url'].'/demand') ?>">Catalog</a></li>
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
									if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){								
								?>
									<img src="<?php echo base_url($course->img_path); ?>" class="rounded img-fluid" alt="learnerlearner">
								<?php }else{ ?>
									<img src="<?php echo base_url().'assets/uploads/on-demand-default'; ?>" class="rounded img-fluid" alt="learnerlearner">
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
                              <li><i class="fa fa-envelope"></i> <a href="mailto:<?php echo $course->first_instructor->email  ?>">Contact Instructor</a></li>
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
                              <?php foreach($course->highlights as $highlight): ?>
                              <li><?php echo $highlight->content?></li>
                              <?php endforeach;?>
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
                                 <?php echo $course->number ?>
                              	<?php }else{  ?>   
                                	Not Available
                                <?php } ?>
                              </div>
                           </div>
                        </div>                                                      
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Course Pre-Requisite</a>
                              </h4>
                           </div>
                           <div id="collapse3" class="panel-collapse collapse">
                              <div class="panel-body">
                              	<?php if(isset($course->prerequisite) && !empty(strip_tags($course->prerequisite))){ ?>          
                                 	<?php echo strip_tags($course->prerequisite) ?>
                                <?php }else{ ?>
                              		Not Available  
                                <?php } ?>
                              </div>
                           </div>
                        </div>                                                
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Learning Objective</a>
                              </h4>
                           </div>
                           <div id="collapse4" class="panel-collapse collapse">
                              <div class="panel-body">
                              	<?php if(isset($course->learning_objective) && !empty(strip_tags($course->learning_objective))){ ?>                
                                 	<?php echo strip_tags($course->learning_objective) ?>
                               	<?php }else{ ?>
                                	Not Available  
                                <?php } ?>
                              </div>
                           </div>
                        </div>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Who Should Attend</a>
                              </h4>
                           </div>
                           <div id="collapse5" class="panel-collapse collapse">
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
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Agenda</a>
                              </h4>
                           </div>
                           <div id="collapse6" class="panel-collapse collapse">
                              <div class="panel-body">
                              	<?php if(isset($course->agenda) && !empty(strip_tags($course->agenda))){ ?>              
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
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">Category</a>
                              </h4>
                           </div>
                           <div id="collapse7" class="panel-collapse collapse">
                              <div class="panel-body">
                              	<?php if(isset($course->category_id) && !empty($course->category_id)){ ?>      
                                 	<?php echo getCategoryNameById($course->category_id); ?>
                                <?php }else{ ?>
                              		Not Available  
                                <?php } ?>
                              </div>
                           </div>
                        </div>
                        <?php $explode = explode(',',$course->standard_id); ?>
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">Standard</a>
                              </h4>
                           </div>
                           <div id="collapse8" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <ul class="">
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
         <!--col-9-->
      </div>
      <div class="col-md-3">
         <div class="catalogBox">
            <ul class="rightList">
               <li>
                  <i class="fa fa-dot-circle"></i>
                  <?php echo $course->course_self_time; ?>
               </li>
               <li><i class="fa fa-check-square"></i> Enrollments:<?php echo $course->enroll_course_count_user ?></li>
               <li><i class="fa fa-language"></i> Languages: English</li>
               <li><i class="fa fa-calendar-alt"></i> Published Date: <?php echo $course->freg_date?></li>
               <li><i class="fa fa-calendar-alt"></i> Start Date : <?php echo date("M d, Y", strtotime($course->start_at));?></li>
               <li><i class="fa fa-calendar-alt"></i> End Date : <?php echo date("M d, Y", strtotime($course->end_at));?></li>
            </ul>
            <br>
            <br>                    
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
         </div>
      </div>
      <!--col-3-->		
   </div>
   <!--row-->
   </div><!--container-->
   <div style="display: none;" class="col-lg-6">
      <a class="mb-1 mt-1 mr-1 modal-with-zoom-anim ws-normal btn btn-default" href="#modalAnim">Open with fade-zoom animation</a>
   </div>
</section>
<!--sectionBox-->
<script type = "text/javascript" >
var company_url = "<?= base_url($company['company_url'])?>";
var isLogin = "<?php echo $this->session->userdata ('isLoggedIn')?>";
var userId = "<?php echo $this->session->userdata('userId')?>";

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
   
function enroll(id, pay_type) {
    if (!isLogin) {
        showLogin();
    }else{
        if(pay_type == 0) {
            window.location = company_url + '/demand/detail/' + id;
        }else if(pay_type == 1) {
            swal({
                title: "Are you sure?",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    //window.location = company_url + '/demand/detail/' + id;						
                    window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart=' + id + '&user_id=' + userId;
                } else {
                    return;
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