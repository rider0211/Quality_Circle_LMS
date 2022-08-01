<section class="companyhomeBanner"></section>
<div class="cover-text" style="margin-top: 70px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 bannerTextBox">
                <h1>Quality Circle Virtual Academy</h1>
                <p>Where Technology meets Learning in the Global Parade Square</p>
            </div>
            <div class="col-md-12 bannerTextBox">
                <p>Virtual Learning;</p>
                <p>It is in the minds eye. It’s not with you it is in you!!!</p>
            </div>
        </div><!--row-->
    </div><!--container-->
</div>
<section class="sectionBox">
	<div class="container"> 
		<h2 class="titleH2 text-center">On Demand Training</h2>
		<div class="row">
		<?php if(!empty($demandCourses)){ ?>	
			<?php foreach($demandCourses as $course){ ?>
			<div class="col-md-4 col-sm-4 col-xs-6 col-full">
				<div class="courseBox">
					<div class="courseImg">
                    	<?php
							$imgName = end(explode('/', $course['img_path']));
							$ext = pathinfo($imgName, PATHINFO_EXTENSION);
							if($imgName != '' && file_exists(getcwd().'/'.$course['img_path']) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){
						?>
							<img style="cursor: pointer" src="<?= base_url($course['img_path']); ?>" onclick="view_course(<?= $course['id'] ?>)">
					   	<?php }else{ ?>
							<img style="cursor: pointer" src="<?= base_url().'assets/uploads/on-demand-default.png'; ?>" onclick="view_course(<?= $course['id'] ?>)">
               			<?php } ?>
					</div><!--courseImg-->
					<div class="courseInfo">
						<h5 style="cursor: pointer" onclick="view_course(<?= $course['id'] ?>)"><?= ucfirst($course['title'])?></h5>
						<ul class="courseUl">
							<li style="height:25px">
								<a href="#"><?= $course['first_instructor']['email']?></a>
							</li>
							<li><?= $course['course_self_time']; ?></li>
							<li> Type: <?= $course['pay_type'] == 0 ?'Close Enrollment Course': 'Open Enrollment Course'?></li>
                            <li> Start Date: <?= date("M d, Y", strtotime($course['start_at'])) ?></li>
             				<li> End Date: <?= date("M d, Y", strtotime($course['end_at']));?></li>
							<li> Price: $<?= $course['pay_price']?></li>
							<li> Discount: <?= $course['discount']?>%</li>
							<li> Cost: $<?= $course['amount']?></li>
						</ul>
					</div><!--courseInfo-->
					<div class="coursePrice">
						<div class="row">
							<div class="col-sm-9 col-xs-9">
                                <?php if(is_null($course['is_pay']['id'])){ ?>
									<a href="<?=base_url($company['company_url'].'/demand/view/'.$course['id'])?>" style="margin-left:10px"class="btnBlue">View Detail</a>
                                <?php }else {?>
                                    <a href="javascript:view_course_detail(<?= $course['id'] ?>,0)" class="btnBlue">View Course</a>
                                <?php }?>
							</div>
						</div><!--row-->
					</div><!--coursePrice-->
				</div><!--courseBox-->
			</div><!--col-4-->
			<?php } } else{ ?>
				<div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
                            <img style="cursor: pointer" src="<?= base_url().'assets/uploads/on-demand-default.png'; ?>">
                            <?php /*?><h2 style=" color:#666;margin-top: 94px;text-align: center;">No Record Found!</h2><?php */?>
                        </div> <!--courseImg-->                      
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } ?>
		</div><!--row-->
		<div class="row">
			<div class="col-sm-12 text-center">
				<a href="<?= base_url($company['company_url'])?>/demand" class="browseAll">Browse All</a>
			</div>
		</div>	
	</div><!--container-->
</section><!--sectionBox-->

<section class="sectionBox">
    <div class="container">
        <h2 class="titleH2 text-center">Instructor Led Training</h2>
        <div class="row">
		<?php if(!empty($trainCourses)){ ?>
            <?php foreach ($trainCourses as $course){ ?>
                <div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
							<?php
                                $imgName = end(explode('/', $course['img_path']));
								$ext = pathinfo($imgName, PATHINFO_EXTENSION);
                                if($imgName != '' && file_exists(getcwd().'/'.$course['img_path']) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){							
                            ?>
                                <img style="cursor: pointer" src="<?= base_url($course['img_path']); ?>" onclick="view_ILT_course(<?= $course['time_id'] ?>)">
                            <?php }else{ ?>
                                <img style="cursor: pointer" src="<?= base_url().'assets/uploads/ilt-default.png'; ?>" onclick="view_ILT_course(<?= $course['time_id'] ?>)">                                		
                            <?php } ?>
                        </div> <!--courseImg-->

                        <div class="courseInfo">
                            <h5 style="padding-bottom: 15px;"><?= ucfirst($course['title'])?></h5>                    
                            <ul class="courseUl">
                            	<li style="height:25px"><a href="#"><?= $course['first_instructor']['email']?></a></li>
                                <li>                            
                                	<?= $course['course_self_time']; ?>
                                </li>
                                <?php
									$showDuration = $course['duration'] > 1 ? $course['duration']. " Days" : $course['duration']." Day";
									$duration = $course['duration'] - 1;
									$enddate = strtotime('+'.$duration .' days', strtotime($course['start_day']. " " . $course['end_time']));
								?>
								<li> Type: <?= $course['pay_type'] == 0 ?'Close Enrollment Course': 'Open Enrollment Course'?></li>
                                <li> Duration: <?= $showDuration; ?> </li>
                                <li> Start Date: <?= date("M d, Y h:i:sa", strtotime($course['start_day'] . " " . $course['start_time']));?></li>
								<li> End Date: <?= date("M d, Y h:i:sa", $enddate);?></li>
                                <li> Price: $<?= $course['pay_price']?></li>
								<li> Discount: <?= $course['discount']?>%</li>
								<li> Cost: $<?= $course['amount']?></li>
                            </ul>
						</div>
						<div class="row coursePrice">
							<?php if($course['pay_type']){
									$pay = $course['pay_type'];
								}else{
									$pay = '0';
								}
							?>
							<div class="col-sm-9 col-xs-9">
								<a href="<?= base_url($company['company_url'].'/training/view/'.$course['time_id']) ?>" style="margin-left:10px" class="btnBlue">View Detail</a>
							</div>
						</div><!--row-->
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } } else{ ?>
				<div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
                        	<?php /*?><h2 style=" color:#666;margin-top: 94px;text-align: center;">No Record Found!</h2><?php */?>
                            <img style="cursor: pointer" src="<?= base_url().'assets/uploads/ilt-default.png'; ?>"> 
                        </div> <!--courseImg-->                      
                    </div><!--courseBox-->
                </div><!--col-4-->
		<?php } ?>
        </div><!--row-->

        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="<?= base_url($company['company_url'])?>/training" class="browseAll">Browse All</a>
            </div>
        </div>

    </div><!--container-->
</section><!--sectionBox-->

<section class="sectionBox">
	<div class="container">
		<h2 class="titleH2 text-center">Virtual Instructor Led Training</h2>
		<div class="row">	
		<?php if(!empty($virtualCourses)) {  ?>		
		<?php foreach($virtualCourses as $course){?>				
			<div class="col-md-4 col-sm-4 col-xs-6 col-full">
				<div class="courseBox">
					<div class="courseImg">
                    	<?php
							$imgName = end(explode('/', $course['img_path']));
							$ext = pathinfo($imgName, PATHINFO_EXTENSION);							
							if($imgName != '' && file_exists(getcwd().'/'.$course['img_path']) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){
							?>
                            	<img style="cursor: pointer" src="<?= base_url($course['img_path']); ?>" onclick="view_live(<?= $course['time_id'] ?>)">
                            <?php }else{ ?>
                            	<img style="cursor: pointer" src="<?= base_url().'assets/uploads/vilt-default.png'; ?>" onclick="view_live(<?= $course['time_id'] ?>)">
                            <?php } ?>
					</div><!--courseImg-->
					<div class="courseInfo">
						<h5 style="cursor: pointer" onclick="view_live(<?= $course['time_id'] ?>)"><?= ucfirst($course['title'])?></h5>
						<ul class="courseUl">
							<li style="height:25px"><a href="#"><?= $course['first_instructor']['email']?></a></li>
							<li>                            
							<?= $course['course_self_time']; ?>
                            </li>
                            <?php									
								$showDuration = $course['duration'] > 1 ? $course['duration']. " Days" : $course['duration']." Day";
								$duration = $course['duration'] - 1;
								$enddate = strtotime('+'.$duration .' days', strtotime($course['start_at']. " " . $course['end_time']));
							?>
							<li> Type: <?= $course['pay_type'] == 0 ?'Close Enrollment Course': 'Open Enrollment Course'?></li>
							<li> Duration: <?= $showDuration; ?> </li>
							<li> Start Date: <?= date("M d, Y h:i:sa", strtotime($course['start_at'] . " " . $course['start_time']));?></li>
							<li> End Date: <?= date("M d, Y h:i:sa", $enddate);?></li>
							<li> Price: $<?= $course['pay_price']?></li>
							<li> Discount: <?= $course['discount']?>%</li>
							<li> Cost: $<?= $course['amount']?></li>
						</ul>
					</div><!--courseInfo-->
					<div class="coursePrice">
						<div class="row">
							<?php if($course['pay_type']){
									$pay = $course['pay_type'];
								}else{
									$pay = '0';
								}
							?>
							<div class="col-sm-9 col-xs-9">
								<a href = "<?= base_url($company['company_url'].'/classes/view/'.$course['time_id'])?>" style="margin-left:10px" class="btnBlue">View Detail</a>
							</div>
						</div><!--row-->
					</div><!--coursePrice-->
				</div><!--courseBox-->
			</div><!--col-4-->
		<?php } } else {  ?>
			<div class="col-md-4 col-sm-6 col-xs-6 col-full">
				<div class="courseBox">
					<div class="courseImg">
						<img style="cursor: pointer" src="<?= base_url().'assets/uploads/vilt-default.png'; ?>">
						<?php /*?><h2 style=" color:#666;margin-top: 94px;text-align: center;">No Record Found!</h2><?php */?>
					</div> <!--courseImg-->                      
				</div><!--courseBox-->
			</div><!--col-4-->
		<?php } ?>
		</div><!--row-->
		<div class="row">
			<div class="col-sm-12 text-center">
				<a href="<?= base_url($company['company_url'])?>/classes" class="browseAll">Browse All</a>
			</div>
		</div>
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
	var company_url = "<?= base_url($company['company_url'])?>";
    var isLogin = "<?= $this->session->userdata ( 'isLoggedIn' )?>";
	var email = "<?= $this->session->userdata ( 'email' )?>";
    var user_type = "<?= $this->session->userdata('user_type')?>";
	var userId = "<?= $this->session->userdata('userId')?>";
	
    function view_course_detail(id){
        if(!isLogin){
            showLogin();
        }else{
            window.location = company_url + '/demand/detail/' + id;
        }
    }
	function view_course(id){
		location.href = "<?= base_url($company['company_url'].'/demand/view/')?>"+id;
	}
    function view_ILT_course(id){
        location.href = "<?= base_url($company['company_url'].'/training/view/')?>"+id;
    }
	function view_live(id){
		location.href = "<?= base_url($company['company_url'].'/classes/view/')?>"+id;
	}
</script>