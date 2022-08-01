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
		<h2><?=$term["instructorledtraining"]?></h2>
	
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
												<h2 class="titleH2" style="text-align: left;margin-bottom: 0px;"><?=ucfirst($course_list->title); ?></h2>
											</div>
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="leftImgBox">
                                                	<?php
														$imgName = end(explode('/', $course_list->course_img_path));
														if($imgName != '' && file_exists(getcwd().'/assets/uploads/company/course/'.$imgName)){
													?>
														<img src="<?php echo base_url($course_list->course_img_path); ?>">
												   	<?php }else{ ?>
														<img src="<?php echo base_url().'assets/uploads/ilt-default.png'; ?>">      		
												   	<?php } ?>
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-7 col-md-7 col-sm-12 courseInfo">
												<p>
                                                	<?php 
														if(!empty($course_list->description)){ 
															echo nl2br($course_list->description);
														}
													?>
                                                </p>
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
													if(!empty($course_list->location)){ 
														echo nl2br($course_list->location);
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
                                                <h2 class="card-title"><?=nl2br($term["learningobjectives"]) ?></h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php 
													if(!empty($course_list->objective)){ 
														echo nl2br($course_list->objective);
													}else{
														echo 'Not Available';
													}
												?>
                                            </div>
                                        </section>
                                    </div>
                                    <div class="col-lg-12" data-plugin-portlet id="portlet-2">
                                        <section class="card mb-4" id="card-2">
                                            <header class="card-header" style="background-color:#cbcede">                
                                                <h2 class="card-title"><?=$term["whoshouldattend"]?></h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php 
													if(!empty($course_list->attend)){ 
														echo nl2br($course_list->attend);
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
													if(!empty($course_list->course_pre_requisite)){ 
														echo nl2br($course_list->course_pre_requisite);
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
                                                <h2 class="card-title"><?=$term["agenda"]?></h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php 
													if(!empty($course_list->agenda)){ 
														echo nl2br($course_list->agenda);
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
                                            <div class="card-body item_details_single">
                                                <?php
													if(isset($course_list->instructor_emails[0]) && !empty($course_list->instructor_emails[0])){
														foreach($course_list->instructor_emails as $key => $iemail){
															$serial = $key+1;
															echo '('.$serial.') '.$iemail.'<br>';
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
                                                <h2 class="card-title">Highlights</h2>
                                            </header>
                                            <div class="card-body item_details_single" >
                                                <?php
													
													if(isset($course_list->highlights) && count(json_decode($course_list->highlights))>0){
														foreach(json_decode($course_list->highlights) as $keys => $highlight){
															$serials = $keys+1;
															echo '('.$serials.') '.$highlight.'<br>';
														}
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
                                                	if(!empty($course_list->category)){ 
														echo getCategoryNameById($course_list->category);
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
                                                	if(!empty($course_list->standard_id)){ 
														$explode = explode(',',$course_list->standard_id);
														if(isset($explode[0]) && !empty($explode[0]) && $explode[0] != 'null'){
															foreach($explode as $skey => $svalue){
																$svalue = str_replace( array( '\'', '"', ',' , '[', ']' ), ' ', $svalue);
																$serials = $skey+1;
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
								</div><!--row-->
							</div><!--courseBox-->
						</div><!--col-9-->
						<div class="col-md-3">
							<div class="catalogBox">
								<ul class="rightList">
                                    <?php if($course_list->course_self_time != ''){ ?>
									<li>
										<i class="fa fa-dot-circle"></i>
										<?php echo $course_list->course_self_time; ?>
									</li>
                                    <?php } ?>                                    
                                    <?php
										$showDuration = $course_list->duration > 1 ? $course_list->duration. " Days" : $course_list->duration." Day";										
										$duration = $course_list->duration - 1;
										//$enddate = strtotime(date('Y-m-d',$course_list->date_str) .'+'.$duration .'days');
										$enddate = strtotime('+'.$duration .' days', $course_list->date_str);
									?>                            
                                    <li><i class="fa fa-check-square"></i> 
                                    Enrollments: <?php echo $course_list->enroll_users_counts; ?></li>
									<li><i class="fa fa-language"></i> Languages: English</li>
									<li><i class="fa fa-calendar-alt"></i> Class Duration: <?php echo $showDuration; ?></li>
                                    <li><i class="fa fa-calendar-alt"></i> Published Date: <?php echo $course_list->reg_date; ?></li> 
                                    <li><i class="fa fa-calendar-alt"></i> Start Date: <?php echo date("M d, Y h:i:sa", $course_list->date_str);?></li> 
                                    <?php if($duration > 0){ ?>
                                        <li><i class="fa fa-calendar-alt"></i> End Date: <?php echo date("M d, Y h:i:sa", $enddate);?></li>
                                    <?php }else{ ?>
                                        <li><i class="fa fa-calendar-alt"></i> End Date: <?php echo date("M d, Y", $enddate).' 11:59:59pm';?></li>
                                    <?php } ?>
								</ul>
								<br>
								<br>
								<a class="btnBlue" href="javascript:booknow(<?=$course_list->course_id?>,<?=$course_list->ids?>)" >
                                    <?=$term["enrollnow"]?>
                                </a>
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
	
    function booknow(course_id,id) {
        $.ajax({
            url: $('#base_url').val()+'learner/training/booknow',
            type: 'POST',
            data: {'course_time_id': id, 'course_id': course_id},
            success: function (data, status, xhr) { 
                if(data){
                    new PNotify({
                        title: 'Success',
                        text: 'Success Book Now',
                        type: 'success'
                    });
                }else{
                    new PNotify({
						title: '<?php echo $term['error']; ?>',
						text: '<?php echo $term['alreadybooking']; ?>',
						type: 'error'
					});
                }
            },
            error: function(data){
                new PNotify({
                    title: '<?php echo $term->error; ?>',
                    text: '<?php echo $term['alreadybooking']; ?>',
                    type: 'error'
                });
            }
        });
    }

</script>

