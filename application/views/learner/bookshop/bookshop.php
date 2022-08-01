<style type="text/css">
	.navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
		color:#000!important;
	}
	.logo img{
		height: 40px;
	}
</style>
<!-- Bootstrap -->
<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png" />
<link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css_company/responsive.css" rel="stylesheet">
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
<script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
<section class="sectionBox">
	<div class="content-body">
		<div class="row">
			<div class="col-md-12">
				<div class="catalogBox">
					<div class="row">
						<div class="col-sm-12">
							<div class="sortPanel">
								<div class="sortSet">
<!--									<label>Sort By :</label>-->
<!--									<select>-->
<!--										<option>Price</option>-->
<!--										<option>Top Rating</option>-->
<!--										<option>Popular</option>-->
<!--									</select>-->
								</div><!--sortSet-->
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->
					
					<div class="row">
						<div class="col-sm-12">
							<?php $count = 0;?>
							<?php foreach($courses as $course): ?>
								<?php if ($course->is_mybook == '0'):?>
								<?php $count++;?>
								<div class="whitePanel">
									<div class="row">
										<div class="col-md-4 col-sm-12">
											<div class="leftImgBox">
                                            	<?php
													$imgName = end(explode('/', $course->picture1));
													if($imgName != '' && file_exists(getcwd().'/assets/uploads/bookshop/photo/'.$imgName)){								
												?>
													<img src="<?php echo base_url($course->picture1); ?>">
											   <?php }else{ ?>
													<img src="<?php echo base_url().'assets/uploads/on-demand-default.png'; ?>">                                		
											   <?php } ?>
											</div><!--leftImgBox-->
										</div><!--col-4-->
										<div class="col-md-8 col-sm-12 courseInfo">
											<h5><?php echo $course->title?></h5>
											<p><?php echo $course->description?></p>
											<div class="coursePrice">
												<div class="row">
													<div class="col-sm-3 col-xs-3">
														<span class="price">$ <?php echo $course->price?></span>
													</div>
													<div class="col-sm-9 col-xs-9">
														<?php if ($menu == "bookshop"):?>
															<a id="<?php echo $course->wcm_pt_id; ?>" href = "javascript:enroll(<?php echo $course->id ?>)" class="btnBlue cartid">Purchase</a>
															<input type="hidden" class="" value="<?php echo $course->id ; ?>" id="bookshop_id"></input>
														<?php else:?>
															<a href="<?=base_url()?>learner/bookshop/view_book/<?php echo $course->id ?>" class="btnBlue">View Book</a>
														<?php endif;?>
														<?php if ($menu == "bookshop"):?>
															<a href="<?=base_url()?>learner/bookshop/view/<?=$course->id?>" class="btnBlue">View Details</a>
														<?php else:?>
															<a href="<?=base_url()?>learner/bookshop/my_view/<?=$course->id?>" class="btnBlue">View Details</a>
														<?php endif;?>
													</div>
												</div><!--row-->
											</div><!--coursePrice-->

										</div><!--col-8-->
									</div><!--row-->
								</div><!--whitePanel-->
							<?php endif;?>
							<?php endforeach;?>
							<?php if ($count == 0):?>
								<h1 style="padding-left: 1rem">No Books.</h1>
							<?php endif;?>
						</div><!--col-12-->
						
						<div class="col-sm-12 paginationBox">
                            <?php echo $links ?>
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
$(function(){
	$("ul.pagination a").addClass('page-link');
});
function enroll(id){
	var p_id = $('.cartid').attr('id');
		var user__id = "<?php echo $user_id; ?>";
		var bookshop_id = $('#bookshop_id').val();
		//alert(bookshop_id);
		window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+ p_id+'&user_id='+user__id+'&bookshop_id='+bookshop_id+'&is_admin=true';
		/*swal({
			title: "Are you sure?",
			buttons: true
		})
				.then((willDelete) => {
			if (willDelete) {
		swal({
			text: "Success Pay!",
			icon: "success"
		});
			location.href = "<?=base_url()?>learner/bookshop/mybooks";
			window.open('<?=base_url()?>learner/bookshop/pay_book/' + id);
		} else {
			return;
		}
	});*/
}
</script>