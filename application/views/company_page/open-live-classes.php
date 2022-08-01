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
				<ul class="catalogTab">
					<li><a href="<?php echo base_url($company['company_url'])?>/demand">On Demand</a></li>
					<li class="active"><a href="<?php echo base_url($company['company_url'])?>/classes">VILT</a></li>
					<!-- <?php
						$userType = $this->session->userdata('user_type');
						$userID = $this->session->userdata('userId');
						if($userType == 'Instructor' || $userType == 'Learner') { ?>
							<li><a href="https://webrtc.gosmartacademy.com/index.php?userID=<?php echo $userID ?>" target="_blank">VILT Room</a></li>
					<?php } ?> -->
					<li><a href="<?php echo base_url($company['company_url'])?>/training">Instructor Led Training</a></li>
					<li><a href="<?php echo base_url($company['company_url'])?>/bookshop">Book Shop</a></li>
				</ul><!--catalogTab-->
			</div><!--col-12-->
			
			<div class="col-md-3">				
				<div class="catalogBox">					
					<ul class="filtersLeft">
						<li>
						<h3 class="titleH3 _mt-0"><i class="fa fa-align-left"></i> Filters</h3>
							<button class="accordion">Class Type</button>
							<div class="panel" style="display:block">
							  <label class="radioBox">Upcoming
								  <input onclick="sortByDate(this)" type="radio" <?php echo $check_value=='upcoming' ? 'checked' : ''?> value="upcoming" name="radio">
								  <span class="checkmark"></span>
							  </label>
							  <label class="radioBox">Past
								  <input onclick="sortByDate(this)" id="past_radio" type="radio" <?php echo $check_value=='past' ? 'checked' : ''?>  value="past" name="radio">
								  <span class="checkmark"></span>
							  </label>
							</div>
						</li>						
					</ul><!--filtersLeft-->
				</div>
			</div><!--col-3-->
			
			<div class="col-md-9">
				<div class="catalogBox">
					<div class="row">
						<div class="col-sm-6">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Category</label>
		                            <select id="category_id" name="category_id">
		                                <option value="0"> All </option>
		                                <?php foreach($category as $item){ ?>
		                                    <option value="<?= $item->id ?>" <?= $category_id==$item->id?'selected':''; ?>> <?= $item->name; ?></option>
		                                <?php }  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Standard</label>
		                            <select id="standard_id" name="standard_id">
		                                <option value="0"> All </option>
		                                <?php foreach($standard as $item){ ?>
											<option value="<?php echo $item->id; ?>" <?php $standard_id==$item->id?print 'selected':print ''; ?>> <?php echo $item->name; ?></option>
		                                <?php }  ?>
		                            </select>
								</div>
							</div>
						</div>
					</div>		
					<div class="row">
						<div class="col-sm-12">
							<?php foreach($courses as $course): ?>
							<div class="whitePanel">
								<div class="row">
									<div class="col-md-5 col-sm-4">
										<div class="leftzBox">
                                        	<?php
												$imgName = end(explode('/', $course->virtual_course_path));
												$ext = pathinfo($imgName, PATHINFO_EXTENSION);											
												if($imgName != '' && file_exists(getcwd().'/'.$course->virtual_course_path) && ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'PNG' || $ext == 'JPG')){
											?>
												<img src="<?php echo base_url($course->virtual_course_path); ?>">
											<?php }else{ ?>
												<img src="<?php echo base_url().'assets/uploads/vilt-default.png'; ?>">                                		
											<?php } ?>
										</div><!--leftImgBox-->
									</div><!--col-4-->
									<div class="col-md-7 col-sm-8 courseInfo">
										<h5><?php echo $course->title?></h5>
										<ul class="courseUl">
											<a href="#"><?php echo $course->first_instructor['email']?></a>
                                            
                                            <li><?php echo $course->course_self_time; ?>, Publish date: <?php echo date("M d, Y", strtotime($course->reg_date));?></li>
											<li> Type: <?= $course->pay_type == 0 ?'Close Enrollment Course': 'Open Enrollment Course'?></li>
                                            <?php
												$showDuration = $course->duration > 1 ? $course->duration. " Days" : $course->duration." Day";												
												$duration = $course->duration - 1;
												$enddate = strtotime('+'.$duration .' days', strtotime($course->start_at. " " . $course->end_time));
											?>
											<li>Duration: <?php echo $showDuration; ?> </li>
											<li>Start Date: <?= date("M d, Y h:i:sa", strtotime($course->start_at . " " . $course->start_time));?></li>                                       
											<li>End Date: <?= date("M d, Y h:i:sa", $enddate);?></li>
											<li> Price: $<?= $course->pay_price?></li>
											<li> Discount: <?= $course->discount?>%</li>
											<li> Cost: $<?= $course->amount?></li>
										</ul>
										<div class="coursePrice _plr-0">
											<div class="row">
												<div class="col-lg-4 col-md-12 col-sm-4 col-xs-4 col-full">
													<!-- <?php echo $course->pay_type == 0 ? 'Onsite Training' : '$'.$course->pay_price; ?> -->
												</div>
												<?php if($check_value != 'past') {  ?>
													<div class="col-lg-8 col-md-12 col-sm-8 col-xs-8 col-full">
														<a href="<?php echo base_url($company['company_url'].'/classes/view/'.$course->time_id)?>" class="btnBlue">View Details</a>
													</div>
												<?php } ?>
											</div><!--row-->
										</div><!--coursePrice-->
									</div><!--col-8-->
								</div><!--row-->
							</div><!--whitePanel-->
							<?php endforeach; ?>
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
	let searchParams = new URLSearchParams(window.location.search);
	$('.alert-modal').magnificPopup({
        type: 'inline',
        preloader: false,
        callbacks: {
            beforeOpen: function() {
            }
        }
    });

    $('.modal-dismiss').on('click',function(){
    	 $.magnificPopup.close();
    })

	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	    acc[i].addEventListener("click", function() {
	        this.classList.toggle("active");
	        var panel = this.nextElementSibling;
	        if (panel.style.display === "block") {
	            panel.style.display = "none";
	            panel.style.display = "none";
	        } else {
	            panel.style.display = "block";
	        }
	    });
	}
    var company_url = "<?= base_url($company['company_url'])?>";
    // var isLogin = "<?php echo $this->session->userdata ('isLoggedIn')?>";
    // var email = "<?php echo $this->session->userdata ('email')?>";
    // var user_type = "<?php echo $this->session->userdata('user_type')?>";
	$(function(){
        $("ul.pagination a").addClass('page-link');
    });

	$("#category_id").on('change',(function(){
		var ctsort = 'upcoming';
		if(searchParams.has('sort')){
			ctsort = searchParams.get('sort');
		}
        window.location = company_url + '/classes?category='+$("#category_id").val()+'&sort='+ctsort;
    }));

    $("#standard_id").on('change',(function(){
		var ctsort = 'upcoming';
		if(searchParams.has('sort')){
			ctsort = searchParams.get('sort');
		}
        window.location =  company_url + '/classes?standard=' + $("#standard_id").val()+'&sort='+ctsort;
    }));
	function sortByDate(e){
		window.location = company_url + '/classes?sort=' + e.value;
	}
</script>