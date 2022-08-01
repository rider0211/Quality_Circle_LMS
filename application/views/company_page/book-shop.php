
<section class="sectionBox">
	<div class="container">		
		<div class="row">
		
			<div class="col-md-12">
				<ul class="catalogTab">
					<li><a href="<?php echo base_url($company['company_url'])?>/demand">On Demand</a></li>
					<li><a href="<?php echo base_url($company['company_url'])?>/classes">VILT</a></li>
					<!--<?php
						$userType = $this->session->userdata('user_type');
						$userID = $this->session->userdata('userId');
						if ($userType == 'Instructor' || $userType == 'Learner') { ?>
							<li><a href="https://webrtc.gosmartacademy.com/index.php?userID=<?php echo $userID ?>" target="_blank">VILT Room</a></li>
					<?php } ?>-->
					<li><a href="<?php echo base_url($company['company_url'])?>/training">Instructor Led Training</a></li>
					<li class="active"><a href="<?php echo base_url($company['company_url'])?>/bookshop">Book Shop</a></li>
				</ul><!--catalogTab-->
			</div><!--col-12-->
			
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
							<?php 
							$user_id = $this->session->get_userdata()['user_id'];
							if($courses){
							 	foreach($courses as $course){ ?>
									<div class="whitePanel">
										<div class="row">
											<div class="col-md-5 col-sm-12">
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
											<div class="col-md-7 col-sm-12 courseInfo">
												<h5><?php echo $course->title?></h5>
												<p><?php echo $course->description?></p>
												<div class="coursePrice">
													<div class="row">
														<div class="col-sm-3 col-xs-3">
															<span class="price">$ <?php echo $course->price?></span>
														</div>
														<div class="col-sm-9 col-xs-9">
															<?php if($course->is_mybook):?>
																<a href="javascript:viewbook(<?php echo $course->library_id?>)" class="btnBlue">View Book</a>

															<?php endif;?>
															<?php if(!$course->is_mybook):?>
																<a id="<?php echo $course->wcm_pt_id; ?>" href="javascript:purchase(<?php echo $course->id?>)"  class="btnBlue cartid">Purchase</a>
																<input type="hidden" class="" value="<?php echo $course->id ; ?>" id="bookshop_id"></input>
															<?php endif;?>
															<a href="<?php echo base_url($company['company_url'].'/bookshop/view/'.$course->id)?>" class="btnBlue">View Details</a>
														</div>
													</div><!--row-->
												</div><!--coursePrice-->

											</div><!--col-8-->
										</div><!--row-->
									</div><!--whitePanel-->
							
							<?php }}else{?>
								<div class="whitePanel">
									<div class="row">
										<div class="col-md-12 col-sm-12" style="text-align: center;">
											<h3>No Books Available.</h3>
										</div>
									</div>
								</div>
							<?php } ?>
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
var company_url = "<?= base_url($company['company_url'])?>";
var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
function viewbook(id){
	location.href = company_url + '/bookshop/viewbook/' + id;
}
function purchase(id){
	if(isLogin){
		/*swal({
		  title: "Are you sure?",
		  buttons: true

		})*/
		var p_id = $('.cartid').attr('id');
		var user__id = "<?php echo $user_id; ?>";
		var bookshop_id = $('#bookshop_id').val();
		//alert(bookshop_id);

		window.location = 'https://shop.gosmartacademy.com/shop/?add-to-cart='+ p_id+'&user_id='+user__id+'&bookshop_id='+bookshop_id;
		

	/*	.then((willDelete) => {
		  if (willDelete) {
		        $.ajax({
	        url : company_url + '/bookshop/pay/' + id,
	        type : 'post',
	        success : function(res) {
	                if(res.type == 1){
	                    swal({
	                      text: "You pay successfully!",
	                      icon: "success"
	                    })
	                    .then((willDelete) =>{
	                    	if(willDelete)
	                    		location.reload();
	                    });
	                }else{
	                    if(res.msg){
	                        swal({
	                          text: res.msg,
	                          icon: "warning",
	                          dangerMode: true
	                        });
	                    }
	                }
	            }
	        });
		  } else {
		    return;
		  }
		});*/
	}else{
		showLogin();
	}

}
</script>