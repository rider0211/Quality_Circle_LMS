
<section class="sectionBox ShopDetails">
	<div class="container">		
		<div class="row">
		
	      <div class="col-md-12">
	        <ul class="breadcrumb">
	          <li><a href="<?php echo base_url($company['company_url'].'/demand') ?>">Catalog</a></li>
	          <li><a href="<?php echo base_url($company['company_url'])?>/bookshop">Book Shop</a></li>
	          <li><?php echo $course->title?></li>
	        <div class="shareBox"><a href="#"><i class="fa fa-share"></i> Share</a></div>
	        </ul><!--breadcrumb-->
	      </div><!--col-12-->
			
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
									<div class="col-md-7 col-sm-12">
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
									<div class="col-md-5 col-sm-12 courseInfo">
									<?php $user_id = $this->session->get_userdata()['user_id']; ?>
										<h5><?php echo $course->title?></h5>
										<p><?php echo $course->description?></p>
										<div class="coursePrice">
											<div class="row">
												<div class="col-sm-9">
													<?php if($course->is_mybook):?>
														<a href="javascript:viewbook(<?php echo $course->library_id?>)" class="btnBlue">View Book</a>
													<?php endif;?>
													<?php if(!$course->is_mybook):?>
														<a id="<?php echo $course->wcm_pt_id; ?>" href="javascript:purchase(<?php echo $course->id?>)" class="btnBlue cartid">Purchase</a>
												<input type="hidden" class="" value="<?php echo $course->id ; ?>" id="bookshop_id"></input>
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
		
/*		.then((willDelete) => {
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