<style type="text/css">
	.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
		color:#000!important;
	}
	.logo img{
		height: 40px;
	}
</style>
<!-- Bootstrap -->
<style type="text/css">
	.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
		color:#000!important;
	}
</style>
<!-- Bootstrap -->
<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png" />
<link href="<?php echo base_url(); ?>assets/css_company/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_company/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_company/owl.theme.default.min.css">
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<!--     <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
<link href="<?php echo base_url(); ?>assets/css_company/responsive.css" rel="stylesheet">


<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />

<script src="<?php echo base_url(); ?>assets/js_company/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/filterable.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/jquery.simplyscroll.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
<section class="sectionBox ShopDetails">
	<div class="content-body">		
		<div class="row">
			<div class="col-md-12">
				<div class="catalogBox">
					<div class="row">
						<div class="col-sm-12">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Sort By :</label>
									<select>
										<option>Price</option>
										<option>Top Rating</option>
										<option>Popular</option>
									</select>
								</div><!--sortSet-->
								<ul>
									<li>enrollments</li>
								</ul>
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->
					<div class="row">
						<div class="col-sm-12">
							<div class="whitePanel">
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="leftImgBox">
                                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
											  <!-- Wrapper for slides -->
											  <div class="carousel-inner">
												<div class="item active">
												  <img src="<?php echo base_url($course->picture1); ?>" alt="Chania">
												</div>

												<div class="item">
												  <img src="<?php echo base_url($course->picture2); ?>" alt="">
												</div>

												<div class="item">
												  <img src="<?php echo base_url($course->picture3); ?>" alt="">
												</div>

												<div class="item">
												  <img src="<?php echo base_url($course->picture4); ?>" alt="">
												</div>

												  <div class="item">
													  <img src="<?php echo base_url($course->picture5); ?>" alt="">
												  </div>
											  </div>
											 <!-- Indicators -->
											  <ol class="carousel-indicators">
												<li data-target="#myCarousel" data-slide-to="0" class="active"><img src="<?php echo base_url($course->picture1); ?>" alt=""></li>
												<li data-target="#myCarousel" data-slide-to="1"><img src="<?php echo base_url($course->picture2); ?>" alt=""></li>
												<li data-target="#myCarousel" data-slide-to="2"><img src="<?php echo base_url($course->picture3); ?>" alt=""></li>
												 <li data-target="#myCarousel" data-slide-to="3"><img src="<?php echo base_url($course->picture4); ?>" alt=""></li>
												 <li data-target="#myCarousel" data-slide-to="4"><img src="<?php echo base_url($course->picture5); ?>" alt=""></li>
											  </ol>
											</div>
                                 </div><!--leftImgBox-->
									</div><!--col-4-->
									<div class="col-md-6 col-sm-12 courseInfo">
										<h5><?php echo $course->title?></h5>
										<p><?php echo $course->description?></p>
										<div class="coursePrice">
											<div class="row">
												<div class="col-sm-9">
													<?php if(!$course->is_mybook): ?>
														<a id="<?php echo $course->wcm_pt_id; ?>" href = "javascript:enroll(<?php echo $course->id ?>)" class="btnBlue cartid">Purchase Now</a>
														<input type="hidden" class="" value="<?php echo $course->id ; ?>" id="bookshop_id"></input>
													<?php endif;
                                                     if($course->is_mybook):
													?>
														<a href="<?=base_url()?>learner/bookshop/view_book/<?php echo $course->id ?>" class="btnBlue" target="_blank">View Book</a>
													<?php endif;?>
												</div>
											</div><!--row-->
										</div><!--coursePrice-->
									</div><!--col-8-->
								</div><!--row-->
							</div><!--whitePanel-->
							

						</div><!--col-12-->
					</div><!--row-->
					
				</div><!--courseBox-->
			</div><!--col-12-->
			
			
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->


<script>
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
function enroll(id,pay_type){
	    var p_id = $('.cartid').attr('id');
		var user__id = "<?php echo $user_id; ?>";
		var bookshop_id = $('#bookshop_id').val();
		//alert(bookshop_id);
		window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+ p_id+'&user_id='+user__id+'&bookshop_id='+bookshop_id+'&is_admin=true';
/*	swal({
		title: "Are you sure?",
		buttons: true
	})
			.then((willDelete) => {
		if (willDelete) {
		swal({
			text: "Success Pay!",
			icon: "success"
		});
			window.open('<?=base_url()?>learner/bookshop/pay_book/' + id);
	} else {
		return;
	}
});*/
}
</script>