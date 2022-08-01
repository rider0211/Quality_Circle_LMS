<style>
.common-block {
    width: 100%;
    box-shadow: 0 0px 12px rgb(255, 255, 255);
    min-height: 170px;
    max-width: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(to bottom, #33ccff 0%, #00aeef 100%);
    transition: transform .5s !important;
    -webkit-transition: transform .5s !important;
    -moz-transition: transform .5s !important;
    -ms-transition: transform .5s !important;
    -o-transition: transform .5s !important;
    border-radius: 20px;
    cursor: pointer;
    position: relative;
    margin: auto;
    margin-bottom: 30px;
    margin-top: 30px;
}
.common-block:hover{
	-webkit-transform: skew(-8deg) !important;
    transform: skew(-8deg) !important;
}
.common-block:hover .common-block p {
	-webkit-transform: skew(8deg) !important;
    transform: skew(8deg) !important;
}
.common-block p,.common-block a {
    margin: 0;
    padding: 15px;
    text-align: center;
    color: #fff;
    font-size: 25px;
    position: relative;
    z-index: 9;
    font-weight: bold;
}
.common-block img {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    border-radius: 20px;
    background-position: center;
    object-fit: cover;
    object-position: center;
}
.common-block .b-4{
	object-position: top center;
}
.headerHero {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: auto;
    padding: 50px 0;
}
.headerHero{
    background-image: url("https://dev.gosmartacademy.com/assets/images/test.jpg") !important;
}

.common-feature {
    margin-bottom: 20px;
    background: #fff;
    margin-top: 20px;
}
.logo-fea {
    width: 100%;
}
.con-fea {
    padding: 20px 15px 0 15px;
    border-top: 4px solid gray;
}
.con-fea-p {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 1px;
    margin: 0 0 15px 0;
}
.con-fea-p1 {
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 1px;
    margin: 0px 0 20px 0;
}
.common-feature .button {
        background: black;
    color: #fff;
    position: relative;
    height: 40px;
    width: 100%;
    border: 1px solid black;
    border-radius: 71px;
    margin: 0 0 20px 0;
}
.Featured {
    background: linear-gradient(to bottom, #72bae4 0%, #c0e0ec 100%);
    padding: 60px 0;
}
.logo-cart {
       position: absolute;
    right: 20px;
    top: 10px;
    max-width: 15px;
}
.col-lg-3.custom-width {
    width: 20%;
    float: left;
}
.common-bottom img {
    max-height: 50px;
}
.common-bottom {
    margin-bottom: 20px;
    background: #fff;
    margin-top: 20px;
    padding: 30px;
    text-align: center;
    transition: transform .5s !important;
    -webkit-transition: transform .5s !important;
    -moz-transition: transform .5s !important;
    -ms-transition: transform .5s !important;
    -o-transition: transform .5s !important;
    cursor: pointer;
}
.common-bottom:hover{
	-webkit-transform: skew(-8deg) !important;
    transform: skew(-8deg) !important;
}
p.bold-p {
    font-weight: bold;
    font-size: 22px;
    margin: 15px 0 10px 0;
}
p.unbold-p {
    margin: 0;
}
.space-top-bottom{
	padding-top: 40px;
}
h1.f-s {
    color: black;
    margin: 0 0 15px 0;
    font-size: 33px;
    letter-spacing: 1px;
}



@media (max-width: 991px){
	.headerHero{
		height: auto;
		padding-top: 50px;
		padding-bottom: 50px;
	}
	.col-lg-3.custom-width {
	    width: 33.33% !important;
	}

}
@media (max-width: 767px){
	.col-lg-3.custom-width {
    width: 100% !important;
}
}

img.logo-fea {
    min-height: 265px;
}
</style>
<section class="new-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="new-banner-left">
					<h1 class="new-banner-1">Free Learning <br> Management System</h1>
					<p class="new-banner-2">The best open source LMS for your eLearning Plateform</p>
					<!-- <button class="strat-now btn"> Start Now - It's Free</button> -->
					<button class="strat-now btn" onclick="location.href='<?php echo site_url('/pricing');?>'">Start Now - It's Free</button>
					<a href="https://dev.gosmartacademy.com/pricing"><p class="new-banner-3">Schedule a demo</p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="new-banner-right">
					<img src="assets/images/banner-girl.png">
				</div>
			</div>
		</div>
	</div>
</section>
  <section class="headerHero">
    <!--<div class="captionSlider">
        <h2>Quality Circle Virtual Academy</h2>
        <p>Where Technology meets Learning in the Global Parade Square</p>
    </div>
<img src="<?php echo base_url(); ?>assets/images/920BEA2BD0A38E62DE85B4919AF0409E.jpg">-->


	   <?php $user__id =$this->session->user_id; ?>
					
				
<div class="custom-block">
	<div class="container">
		<div class="row subscrib-flex">
			<div class="col-lg-3">
                <div class="button-subscrib">
                   <a href="#">Subscribe wih us</a>
                </div>      
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                    <a href="<?php echo base_url('company/'.$company_ob['url']); ?>">Academy</a>
                    <img src="assets/images/b-1.jpg">
                </div>
            </div>
            <div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                        <?php if(!isset($company['url'])) :?>
                            <?php if($this->session->userdata('isLoggedIn') == NULL):?>
                                <a href="<?php echo base_url('login');?>">Signup or Login</a>
                            <?php endif?>

                            <?php if($this->session->userdata('isLoggedIn')){?>

                                <?php
                                switch ($this->session->userdata('user_type')) {
                                    case "Superadmin": {
                                        $view_url = 'superadmin';
                                    }
                                        break;
                                    case "Admin": {
                                        $view_url = 'admin';
                                    }
                                        break;
                                    case "Instructor": {
                                        $view_url = 'instructor';
                                    }
                                        break;
                                    case "Learner": {
                                        $view_url = 'learner';
                                    }
                                        break;
                                }?>
                                <a href="<?php echo base_url().$view_url?>">Dashboard</a>
                            <?php }?>
                        <?php endif;?>
                        <?php if(isset($company['url'])) :?>
                            <?php if($this->session->userdata('isLoggedIn') == NULL):?>
                                    <a style="cursor: pointer" href="javascript:showLogin()">Signup or Login</a>
                            <?php endif?>
                            <?php if($this->session->userdata('isLoggedIn')){?>

                                <?php
                                switch ($this->session->userdata('user_type')) {
                                    case "Superadmin":{
                                        $view_url = 'superadmin';
                                    }
                                        break;
                                    case "Admin": {
                                        $view_url = 'admin';
                                    }
                                        break;
                                    case "Instructor": {
                                        $view_url = 'instructor';
                                    }
                                        break;
                                    case "Learner": {
                                        $view_url = 'learner';
                                    }
                                        break;
                                }?>
                                <!-- <li><a href="<?php echo base_url('logout');?>"><?php echo $term['logout']; ?></a></li> -->
                                <a href="<?php echo base_url().$view_url;?>">Dashboard</a>
                            <?php }?>
                        <?php endif;?>
                        <img src="assets/images/b-2.jpg">
                </div>
            </div>
            <!--<div class="col-lg-3 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                    <p>Users Dashboard </p>
                </div>
            </div>-->
            <div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                    <!-- <p>Course Catalog/List </p> -->
                    <a href="<?php echo base_url('company/'.$company_ob['url'].'/classes'); ?>">Course Catalog/List</a>
                    <img src="assets/images/b-3.jpg">
                </div>
            </div>
            <div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                    <a href="<?php echo base_url('company/'.$company_ob['url'].'/bookshop'); ?>">Book Store</a>
                    <img class="b-4" src="assets/images/b-4.jpg">
                </div>
            </div>
            <!--<div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block" >
                    <p>Signup for Company takes users to the subscription page </p>
                </div>
            </div>-->
            <div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                    <?php if(isset($company['url'])) :?>
                        <a href="<?php echo base_url($company['company_url']); ?>/about">Contact Us</a>
                    <?php endif;?>
                    <?php if(!isset($company['url'])) :?>
                        <a href="<?php echo base_url('contact') ?>">Contact Us</a>
                    <?php endif;?>
                    <img src="assets/images/b-5.jpg">
                </div>
            </div>
            <div class="col-lg-4 col-md-4" data-aos="flip-left" data-aos-duration="3000">
                <div class="common-block">
                    <a href="<?php echo base_url('company/'.$company_ob['url'].'/calendar'); ?>">Training Calendar</a>
                    <img src="assets/images/b-6.jpg">
                </div>
            </div>
                </div>
            </div>

		</div>
	</div>
</div>
    </section>


<!--<section class="sectionBox" <?php if(sizeof($demandCourses) == 0) echo 'style="display:none;"'; ?>>
    <div class="container">
        <h2 class="titleH2 text-center">On Demand</h2>
        <div class="row">       
            <?php foreach($demandCourses as $course): ?>
                
            <div class="col-md-4 col-sm-4 col-xs-6 col-full">
                <div class="courseBox">
                    <div class="courseImg">
                        <img style="cursor: pointer" src="<?php echo base_url($course['img_path']); ?>" onclick="javascript:view_course(<?php echo $course['id'] ?>)">
                    </div>
                    <div class="courseInfo">
                        <h5 style="cursor: pointer" onclick="javascript:view_course(<?php echo $course['id'] ?>)"><?php echo $course['title']?></h5>
                        <ul class="courseUl">
                            <li style="height:25px">
                                <a href="#"><?php echo $course['first_instructor']['email']?></a>
                            </li>

                            <li>
                            <?php echo $course['time_type'] == 0 ? 'Self paced' : 'Time restricted' ?>
                             ,Publish date: 
                             <?php echo $course['freg_date'];?>
                            </li>
                        </ul>
                    </div>
                    <div class="coursePrice">
                        <div class="row">
                            <div class="col-sm-6 col-xs-6">
                                <span class="price">
                                <?php echo $course['pay_type'] == 0 ? 'Free' : '$'.$course['pay_price']; ?>
                                </span>
                            </div>
                            <div class="col-sm-6 col-xs-6">
                                <?php if(is_null($course['is_pay']['id'])){?>
                                    <a href="javascript:enroll(<?php echo $course['id'] ?>,<?php echo $course['pay_type'] ?>)" class="btnBlue">Enroll Now</a>
                                <?php }else {?>
                                    <a href="javascript:view_course_detail(<?php echo $course['id'] ?>)" class="btnBlue">Continue</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>-->


<section class="sectionBox">
    <div class="container">
        <h2 class="titleH2 text-center">Current Courses</h2>
        <div class="row">
        <?php //echo "<pre>"; print_r($virtualCourses); exit; ?>           
        <?php foreach($virtualCourses as $course): ?>
                
            <div class="col-md-4 col-sm-4 col-xs-6 col-full">
                <div class="courseBox">
                    <div class="courseImg">
                        <img style="cursor: pointer" src="<?php echo base_url($course['img_path']); ?>" onclick="javascript:view_live(<?php echo $course['id'] ?>)">
                    </div><!--courseImg-->
                    <div class="courseInfo">
                        <h5 style="cursor: pointer" onclick="javascript:view_live(<?php echo $course['id'] ?>)"><?php echo $course['title']?></h5>
                        <ul class="courseUl">
                            <li><a href="#"><?php echo $course['first_instructor']['email']?></a></li>

                            <li>
                            <?php echo $course['time_type'] == 0 ? 'Self paced' : 'Time restricted' ?>
                             ,Publish date: 
                             <?php echo $course['freg_date'];?>
                            </li>
                        </ul>
                    </div><!--courseInfo-->
                    <div class="coursePrice">
                        <div class="row">
                            <div class="col-sm-6 col-xs-6">
                                <span class="price">
                                <?php echo $course['pay_type'] == 0 ? 'Free' : '$'.$course['pay_price']; ?>
                                </span>
                            </div>
                            <?php if($course['pay_type']){
                                $pay = $course['pay_type'];
                            }else{
                                $pay = '0';
                            }?>
                            <div class="col-sm-6 col-xs-6">
                                <a href="javascript:enroll_virtual(<?php echo $course['virtual_course_time_id'] ?>,<?php echo $pay; ?>,'<?php echo $course['url']?>')" class="enrollNow">Enroll Now</a>
                            </div>
                        </div><!--row-->
                    </div><!--coursePrice-->
                </div><!--courseBox-->
            </div><!--col-4-->
            <?php endforeach; ?>

             <?php foreach ($trainCourses as $course):?>
                <div class="col-md-4 col-sm-6 col-xs-6 col-full">
                    <div class="courseBox">
                        <div class="courseImg">
                            <img style="cursor: pointer" src="<?php echo base_url($course['img_path']); ?>" onclick="javascript:view_ILT_course(<?php echo $course['id'] ?>)">
                        </div> <!--courseImg-->

                        <div class="courseInfo">
                            <h5><?php echo $course['title']?></h5>
                            <ul class="courseUl">
                                <li><?php echo $course['about']?></li>
                            </ul>

                        </div><!--courseInfo-->
                        <div class="coursePrice">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <a href="<?php echo base_url($company_obb['company_url'].'/training/view/'.$course['course_time_id'])?>" class="enrollNow">View Details</a>
                                </div>
                            </div><!--row-->
                        </div>
                    </div><!--courseBox-->
                </div><!--col-4-->
            <?php endforeach?>
        </div><!--row-->
        <!--<div class="row">
            <div class="col-sm-12 text-center">
                <a href="<?php echo base_url($company_obb['company_url'])?>/classes" class="browseAll">Browse All</a>
            </div>
        </div>-->
        
    </div><!--container-->
</section><!--sectionBox-->





<!--<section class="Featured">
    <div class="container">
        <div class="row space-top-bottom">
        	<div class="col-md-3">
        		<div class="common-bottom">
        			<img src="assets/images/l-1.png">
        			<a href="<?php echo base_url('company/'.$company_ob['url'].'/classes'); ?>"><p class="bold-p">Course List</p></a>
        		</div>
        	</div>
        	<div class="col-md-3">
        		<div class="common-bottom">
        			<img src="assets/images/l-2.png">
        			
                    <a href="<?php echo base_url('company/'.$company_ob['url'].'/bookshop'); ?>"><p class="bold-p">FSPCA Bookstore</p></a>
        		</div>
        	</div>
        	<div class="col-md-3">
        		<div class="common-bottom">
        			<img src="assets/images/l-3.png">
                    <?php if(isset($company['url'])) :?>
                        <a href="<?php echo base_url($company['company_url']); ?>/about"><p class="bold-p">Contact Us</p></a>
                    <?php endif;?>
                    <?php if(!isset($company['url'])) :?>
                        <a href="<?php echo base_url('contact') ?>"><p class="bold-p">Contact Us</p></a>
                    <?php endif;?>
        		</div>
        	</div>
        	<div class="col-md-3">
        		<div class="common-bottom">
        			<img src="assets/images/l-4.png">
        			<p class="bold-p">FAQs</p>
        		</div>
        	</div>
        </div>
    </div>
</section>-->



<!--<section class="footer-custom">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="logo-footer">
					<img src="https://dev.gosmartacademy.com/assets/images/logo.png">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
				<div class="left-footer">
					<div class="row">
						<div class="col-sm-4">
							<div class="common-footer">
								<h3>Community</h3>
								<ul class="footer-ul">
									<li><a href="#">User Documentation Mailing Lists Forum</a></li>
									<li><a href="#">Elearn Platform</a></li>
									<li><a href="#">Write for Community</a></li>
								</ul>
							</div>
							<div class="common-footer">
								<h3>Develpers</h3>
								<ul class="footer-ul">
									<li><a href="#">Dev Documentation Github</a></li>
									<li><a href="#">Download Runbot Translations</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="common-footer">
								<h3>Services</h3>
								<ul class="footer-ul">
									<li><a href="#">Odoo Cloud Platform</a></li>
									<li><a href="#">Support Upgrade</a></li>
									<li><a href="#">Find a partner Become a partner</a></li>
									<li><a href="#">Education</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="common-footer">
								<h3>About Us</h3>
								<ul class="footer-ul">
									<li><a href="#">Academy</a></li>
									<li><a href="#">Pricing</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Dashboard</a></li>
								</ul>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-md-5">
				<div class="left-footer">
					<p class="left-footer1"><img src="assets/images/english.png">English</p>
					<p class="left-footer2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					<p class="left-footer2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
					<ul class="footer-social">
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
						<li><a href="#"><i class="far fa-envelope"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>-->

<!-- <div class="container"> -->
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
<!--   <button type="button" class="btn btn-info btn-lg" id="alertbox">Click here</button> -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <!-- <h4 class="modal-title">Modal Header</h4> -->
        </div>
        <div class="modal-body">
          <p id="error"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.alertbox').click(function(){
            var userID = "<?php echo $user__id; ?>";
            var wcm_pt_id = $(this).attr('id');
            if(userID == ""){
                showLogin();
            } else {
                window.location.href  = 'https://shop.gosmartacademy.com/?add-to-cart='+wcm_pt_id+'&user_id='+userID;
            }
        });
    });
</script>

<script type="text/javascript">
    var company_url = "<?= base_url($company_obb['company_url'])?>";
    var isLogin = "<?php echo $this->session->userdata ( 'isLoggedIn' )?>";
    var user_type = "<?php echo $this->session->userdata('user_type')?>";

    function enroll(id,pay_type){
        if(!isLogin){
            showLogin();
        }else{
            if(pay_type == 0){
                window.location = company_url + '/demand/detail/' + id; 
            }else if(pay_type == 1){
                swal({
                  title: "Are you sure?",
                  buttons: true
                })
                .then((willDelete) => {
                  if (willDelete) {
                    window.location = company_url + '/demand/detail/' + id; 
                  } else {
                    return;
                  }
                });
            }
        }
    }

    function view_course_detail(id){
        if(!isLogin){
            showLogin();
        }else{
            window.location = company_url + '/demand/detail/' + id;
        }
    }

    function enroll_virtual(id,pay_type,url){
        if(!isLogin){
            showLogin();
        }else{
            location.href = "<?php echo base_url($company_obb['company_url'].'/classes/view/')?>"+id;
            return;
            if(pay_type == 0){
                if(user_type !== "Learner"){
                    window.location = "<?php echo VILT_URL?>"+id;
                }else{
                    if(url == null || url == undefined || url == ''){
                        swal({
                            title: "VILT Url Error!",
                            text:"VILT is not available now. Please wait or contact your instructor"
                        });
                    }else{
                        window.location = url+id;
                    }
                }
            }else if(pay_type == 1){
                swal({
                  title: "Are you sure?",
                  buttons: true
                })
                .then((willDelete) => {
                  if (willDelete) {
                  //    window.location = company_url + '/classes/detail/' + id;    
                  } else {
                    return;
                  }
                });
            }
        }
    }
    function view_course(id){
        location.href = "<?php echo base_url($company_obb['company_url'].'/demand/view/')?>"+id;
    }
    function view_ILT_course(id){

        location.href = "<?php echo base_url($company_obb['company_url'].'/training')?>";
    }
    function view_live(id){
        location.href = "<?php echo base_url($company_obb['company_url'].'/classes/view/')?>"+id;
    }
</script>   





