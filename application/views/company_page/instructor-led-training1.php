
<section class="sectionBox">
	<div class="container">		
		<div class="row">
		
			<div class="col-md-12">
				<ul class="catalogTab">
					<li><a href="<?php echo base_url($company['company_url'])?>/demand">On Demand</a></li>
					<li><a href="<?php echo base_url($company['company_url'])?>/classes">Open Live Classes</a></li>
					<?php
						$userType = $this->session->userdata('user_type');
						$userID = $this->session->userdata('userId');
						if ($userType == 'Instructor' || $userType == 'Learner') { ?>
							<li><a href="https://webrtc.gosmartacademy.com/index.php?userID=<?php echo $userID ?>" target="_blank">VILT Room</a></li>
					<?php } ?>
					<li class="active"><a href="<?php echo base_url($company['company_url'])?>/training">Instructor Led Training</a></li>
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
						<div class="col-sm-12">
							<div class="sortPanel">
								<div class="sortSet">
									<label>Location</label>
                                    <select id="location" name="location">
                                        <option value="all"> All </option>
                                        <?php foreach($location as $item){ ?>
                                            <option value="<?php echo $item['location']; ?>" <?php $location_name==$item['location']?print 'selected':print ''; ?>> <?php echo $item['location']; ?></option>
                                        <?php }  ?>
                                    </select>
								</div><!--sortSet-->
							</div><!--sortPanel-->
						</div><!--col-12-->
					</div><!--row-->
					<?php foreach($courses as $course): ?>
                    <div class="row">
						<div class="col-sm-12">
							<div class="whitePanel">
								<div class="row">
									<div class="col-md-2 col-sm-3 col-xs-6">
										<div class="leftImgBox DateIcon">
											<div class="DateBox">
                                             <span class="MonthShow"><?php echo $course->mreg_date?></span><!--MonthShow-->
                                             <span class="DateShow"><?php echo $course->dreg_date?></span><!--DateShow-->
                                            </div><!--DateShow-->
										</div><!--leftImgBox-->
									</div><!--col-4-->
									<div class="col-md-10 col-sm-9 col-xs-12 courseInfo">
										<h5><?php echo $course->title?></h5>
										<ul class="courseUl">
										  <li><?php echo $course->description?></li>
										</ul>
										
										<div class="row">
											<div class="col-sm-12 coursePrice">
												<a href="javascript:enroll(<?php echo $course->course_id ?>)" class="btnBlue">Enroll Now ..</a>
												<a href="<?php echo base_url($company['company_url'].'/training/view/'.$course->training_course_id) ?>" class="btnBlue">View Details</a>
											</div>
										</div><!--row-->

									</div><!--col-8-->
								</div><!--row-->
							</div><!--whitePanel-->
						</div><!--col-12-->

					</div><!--row-->
					<?php endforeach;?>
                    
					<div class="col-sm-12 paginationBox">
                        <?php echo $links ?>
					</div><!--col-12-->
					
				</div><!--courseBox-->
			</div><!--col-12-->
		</div><!--row-->
	</div><!--container-->
</section><!--sectionBox-->

<script>
var company_url = "<?= base_url($company['company_url'])?>";
var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
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
function sortByDate(e){
	window.location = company_url + '/training?sort=' + e.value;
}

$("#location").on('change',(function () {
    window.location = company_url + '/training?location='+$("#location").val();
}));

function enroll(course_id){
	if(!isLogin){
		showLogin();
	}else{			
			swal({
			  title: "Are you sure?",
			  buttons: true
			})
			.then((willDelete) => {
			  if (willDelete) {
			  	window.location = company_url + '/demand/detail/' + course_id;	
			  } else {
			    return;
			  }
			});
		}
	}

function booknow(id){
	var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
	if(!isLogin){
		showLogin();
	}else{
		swal({
		  title: "Are you sure?",
		  buttons: true
		})
		.then((willDelete) => {
		  if (willDelete) {
			swal({
				text: "Success Pay!",
				icon: "success"
			});
  	        $.ajax({
            url : company_url + '/training/pay/' + id,
            type : 'post',
            success : function(res) {
	                if(res.type == 1){
                        swal({
                          text: "You pay successfully!",
                          icon: "success"
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
		});
	}
}
</script>