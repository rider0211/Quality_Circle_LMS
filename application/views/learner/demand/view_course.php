<style type="text/css">
	.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
		color:#000!important;
	}
	.logo img{
		height: 40px;
	}
</style>
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["course"]?></h2>
	
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="<?php echo base_url(); ?>home">
						<i class="fas fa-home"></i>
					</a>
				</li>
			</ol>

		</div>
	</header>
    
    <input type="hidden" id="base_url" value="<?= base_url()?>">
         
	<!-- start: page -->
	<div class="row viewcourse-page">
		<div class="col-lg-12">
			<section class="card sectionBox">
				<header class="card-header">
					<h2 class="card-title">About the course</h2>
				</header>
				<div style="margin-top: 20px;">
					<div class="row" style="width: 80%;">
						<div class="col-md-9">
							<div class="catalogBox">
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-lg-12" style="padding-bottom: 10px;">
												<h2 class="titleH2" style="text-align: left;margin-bottom: 0px;"><?=ucfirst($course->title); ?></h2>
                                                <span style="text-align: left;margin-bottom: 0px;"><?=ucfirst($course->subtitle); ?></span>
											</div>
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="leftImgBox">
                                                	<?php
														$imgName = end(explode('/', $course->img_path));
														if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){
													?>
														<img src="<?php echo base_url($course->img_path); ?>">
												   	<?php }else{ ?>
														<img src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>">      		
												   	<?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-7 col-md-7 col-sm-12 courseInfo">
												<p><?=nl2br($course->about)?></p>
											</div><!--col-8-->
										</div><!--row-->
									</div><!--col-12-->
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-1">
                                        <section class="card mb-4" id="card-1">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Location</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->location)){
														echo nl2br($course->location);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-1">
                                        <section class="card mb-4" id="card-1">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Number</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->number)){ 
														echo $course->number;
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-1">
                                        <section class="card mb-4" id="card-1">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Number of participants</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->number_of_participants)){ 
														echo $course->number_of_participants;
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>                                                                                                         
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Instructors</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php													
													if(isset($course->first_instructor->email) && !empty($course->first_instructor->email)){
															echo $course->first_instructor->email.'<br><br>';
													}else{
														echo 'Not Available';	
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Highlights</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
													if(isset($course->highlights) && !empty($course->highlights)){
														foreach($course->highlights as $keys => $highlight){
															$serials = $keys+1;
															echo '('.$serials.') '.$highlight->content.'<br>';
														}
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Assessment end course</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->assesment_end_course_date)){ 
														echo $course->assesment_end_course_date;
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Learning Objective</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->learning_objective)){ 
														echo nl2br($course->learning_objective);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Who Should Attend</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->attend)){ 
														echo nl2br($course->attend);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Agenda</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->agenda)){ 
														echo nl2br($course->agenda);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Course Pre-Requisite</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->prerequisite)){ 
														echo nl2br($course->prerequisite);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-1">
                                        <section class="card mb-4" id="card-1">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Category</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->category_id)){ 
														echo getCategoryNameById($course->category_id);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>  
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-1">
                                        <section class="card mb-4" id="card-1">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Standard</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
                                                	if(!empty($course->standard_id)){ 
														$explode = explode(',',$course->standard_id);
														if(isset($explode[0]) && !empty($explode[0]) && $explode[0] != 'null'){
															foreach($explode as $skey => $svalue){
																$serials = $skey+1;
																$svalue = str_replace( array( '\'', '"', ',' , '[', ']' ), ' ', $svalue);
																echo '('.$serials.') '.getStandardNameById($svalue).'<br>';
															}
														}else{
															echo 'Not Available';	
														}
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div> 
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-3">
                                        <section class="card mb-4" id="card-3">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title">Status</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
													$status = ['Draft','Active','Inactive'];
                                                	if(!empty($course->active)){
														echo $status[$course->active];
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
								</div><!--row-->
							</div><!--courseBox-->
						</div><!--col-9-->
						<div class="col-md-3">
							<div class="catalogBox">
								<ul class="rightList">
                                    <?php if($course->course_self_time != ''){ ?>
									<li>
										<i class="fa fa-dot-circle"></i>
										<?php echo $course->course_self_time ?>
									</li>
                                    <?php } ?>
									<li><i class="fa fa-check-square"></i> 
                                    Enrollments: <?php echo $course->enroll_users ?></li>
									<li><i class="fa fa-language"></i> Languages: English</li>
                                    <li><i class="fa fa-calendar-alt"></i> Published Date: <?php echo $course->freg_date ?></li>
                                    <li><i class="fa fa-calendar-alt"></i> Start Date: <?php echo date("M d, Y", strtotime($course->start_at));?></li>
                                    <li><i class="fa fa-calendar-alt"></i> End Date: <?php echo date("M d, Y", strtotime($course->end_at));?></li>
								</ul>
								<br>
								<br>
                                <?php if(is_null($course->is_pay['id'])){?>
                                    <a href="javascript:enroll(<?php echo $course->id ?>,<?php echo $course->pay_type ?>,0)" class="btnBlue">Enroll Now</a>
                                <?php }else {?>
                                    <a href="javascript:view_course(<?php echo $course->id ?>,0)" class="btnBlue">Access Course</a>
                                <?php }?>
							</div>
						</div><!--col-3-->
					</div>
				</div>
			</section>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
	var isLogin = "<?php echo $this->session->userdata ('isLoggedIn')?>";
	var email = "<?php echo $this->session->userdata ('email')?>";
	var userId = "<?php echo $this->session->userdata('userId')?>";
	function enroll(id,pay_type,time_id){
		if(!isLogin){
			showLogin();
		}else{
			if(pay_type == 0){
				window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/'+time_id;
			}else if(pay_type == 1){						
				$.ajax({
		            url: "<?php echo base_url() ?>admin/inviteuser/get_Inviteuser",
		            type: 'POST',
		            data: {'email':email,'type':'2','course_id':id},
		            dataType : 'JSON',
		            success: function(data){
		                var cnt = data;
		                if(cnt == 1) {
		                	window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/'+time_id;
		                }else{
		                	swal({
							  title: "You have to pay $99 to take part in this course",
							  buttons: true
							}).then((willDelete) => {
							  if (willDelete) {
							  	//window.location = company_url + '/classes/detail/' + id;	
								window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+id+'&user_id='+userId;
							  }else{
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
    	window.location = '<?=base_url()?>learner/demand/detail_course/' + id+'/0';
    }
</script>