<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<style>
    .logo-container img{
        width: 150px;
        height: 40px;
    }
</style>
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
    
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<section class="card sectionBox">
				<header class="card-header">
					<h2 class="card-title"><?=$term["viewcourse"]?></h2>
				</header>
				<div style="margin-top: 20px;">
					<div class="row" style="width: 80%;">
						<div class="col-md-9">
							<div class="catalogBox">
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-lg-12" style="padding-bottom: 10px;">
												<h2 class="titleH2" style="text-align: left;margin-bottom: 0px;"><?php echo $course->title?></h2>
												<h4 style="text-align: left;"><?php echo $course->subtitle?></h4>
											</div>
											<div class="col-lg-5 col-md-5 col-sm-12">
												<div class="leftImgBox">
													<img src="<?php echo base_url($course->img_path); ?>">
												</div><!--leftImgBox-->
											</div><!--col-4-->
											<div class="col-lg-7 col-md-7 col-sm-12 courseInfo">
												<p><?php echo $course->about?></p>
											</div><!--col-8-->
										</div><!--row-->
									</div><!--col-12-->
								</div><!--row-->
							</div><!--courseBox-->
						</div><!--col-9-->
						<div class="col-md-3">
							<div class="catalogBox">
								<ul class="rightList">
									<li>
										<i class="fa fa-dot-circle"></i>
										<?php echo $course->time_type == 0 ? 'Self paced' : 'Time restricted' ?>
									</li>
									<li><i class="fa fa-check-square"></i> enrollments:<?php echo $course->enroll_users ?></li>
									<li><i class="fa fa-language"></i> Languages: English</li>
									<li><i class="fa fa-calendar-alt"></i> Published Date: <?php echo $course->freg_date?></li>
								</ul>
								<br>
								<br>
								<a href="<?=base_url()?>admin/coursecreation/edit_course/<?=$course->id?>" class="btnBlue"><?=$term["editcourse"]?></a>
								<a href="<?=base_url()?>admin/coursecreation/detail_course/<?=$course->id?>" class="btnBlue"><?=$term["preview"]?></a>
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
</script>