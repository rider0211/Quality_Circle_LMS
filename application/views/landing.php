<style>
	.joining-sec .col-md-4:nth-child(3n+1) {
    clear: left;
}
</style>
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
    background-image: url("https://gosmartacademy.com/assets/images/test.jpg") !important;
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



	  .common-first-row img {
          max-width: 100%;
          margin: auto;
          display: block;
      }
      img.seprate-1 {
          margin-top: 120px;
      }
      img.seprate-4 {
          margin-top: 120px;
      }
      img.seprate-2 {
          margin-bottom: 30px;
      }
      img.seprate-5 {
          margin-top: -120px;
      }
      img.seprate-6 {
          margin-top: -120px;
      }
      img.seprate-7 {
          margin-top: 30px;
          margin-left: 160px;
      }
      img.seprate-8 {
          margin-top: 30px;
          margin-left: -160px;
      }
      p.main-div-p {
		    font-size: 35px;
		    text-align: center;
		    margin: 0 0 15px 0;
	        font-family: 'Poppins';
	        line-height: 30px;
		}
      p.main-div-p1 {
          font-size: 18px;
          text-align: center;
          margin: 0 0 40px 0;
              font-family: 'Poppins';
      }
      .main-div {
	    background: #fff;
	    padding: 30px 0;
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






	   img.seprate-1 {
          margin-top: 30px;
          margin-bottom: 30px;
      }
      img.seprate-4 {
          margin-top: 30px;
          margin-bottom: 30px;
      }
      img.seprate-2 {
          margin-top: 30px;
          margin-bottom: 30px;
      }
      img.seprate-5 {
          margin-top: 30px;
          margin-bottom: 30px;
      }
      img.seprate-6 {
          margin-top: 30px;
          margin-bottom: 30px;
      }
      img.seprate-7 {
         margin-top: 30px;
          margin-bottom: 30px;
          margin-left: auto;
      }
      img.seprate-8 {
          margin-top: 30px;
          margin-bottom: 30px;
          margin-left: auto;
      }
      p.main-div-p {
    font-size: 29px;
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
<section class="slider-landing">

  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <!--<div class="item">
         <div class="main-div">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="main-div-content">
              <p class="main-div-p">Harmonizing teams, systems and communications</p>
              <p class="main-div-p1">One platform. All customers. All reporting. All data. Fully interoperable</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-1" src="assets/images/sli-2.jpg"></a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-2" src="assets/images/sli-1.jpg"></a>
              <img class="seprate-3" src="assets/images/center-lo.jpg">
            </div>
          </div>
          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-4" src="assets/images/sli-3.jpg"></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-5" src="assets/images/sli-4.jpg"></a>
            </div>
          </div>

          <div class="col-md-4"></div>

          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-6" src="assets/images/sli-5.jpg"></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-7" src="assets/images/sli-6.jpg"></a>
            </div>
          </div>

          <div class="col-md-4"></div>

          <div class="col-md-4">
            <div class="common-first-row">
              <a href="#"><img class="seprate-8" src="assets/images/sli-7.jpg"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>-->

      <div class="item active">
        <img src="assets/images/sl-2.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <!-- <div class="item">
        <img src="assets/images/sl-3.jpg" alt="New york" style="width:100%;">
      </div> -->
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>



<section class="Join-today">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="main-join-today">
					<ul class="join-ul">
						<li><p class="today-p">Join today. </p></li>
						<li><button class="btn free-b" value="button"><a href="<?php echo base_url() ?>/pricing">Join Now</a></button></li>
						<li><p class="today-p1">Virtual Learning.</p><p class="today-p1">It is in the minds eye. It’s not with you it is in you!!!</p></li>
					</ul>
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
                   <a href="/pricing/">Subscribe wih us</a>
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
            <?php
              //echo '<pre>'; print_r($trainCourses); echo '</pre>';
            ?>
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




<section class="joining-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-1.png">
					<p class="jo-p">Library Function</p>
					<p class="jo-p1">Create and Store engaging learning content in a secure library . </p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-2.png">
					<p class="jo-p">Flip Book.</p>
					<p class="jo-p1">Present and view your course content in flip book format. </p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-3.png">
					<p class="jo-p">Certifications</p>
					<p class="jo-p1">Store advanced tests, see how many attempts lead to success and get your certificate auto downloaded after completion</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-4.png">
					<p class="jo-p">Create and Store your</p>
					<p class="jo-p1">learning content in a secure library </p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-5.png">
					<p class="jo-p"> Quizzes &.Exams</p>
					<p class="jo-p1">Create your own assessment with time and attempt logic.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-6.png">
					<p class="jo-p">Monitor Performance</p>
					<p class="jo-p1">Instructor can monitor continual assessment of students</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-7.png">
					<p class="jo-p">Participant assessment</p>
					<p class="jo-p1">Participants can assess the course online after the training.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-8.png">
					<p class="jo-p">Notification</p>
					<p class="jo-p1">Auto and manual notification about course and participant status</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-9.png">
					<p class="jo-p"> Digital Course Content</p>
					<p class="jo-p1">All content are stored and accessed in softcopy.</p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="common-join">
					<img src="assets/images/ic-9.png">
					<p class="jo-p"> VILT</p>
					<p class="jo-p1">Our presentation platform combines well with the LMS to provide interactive Virtual Instructor Led Trainings</p>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="play-video">
	<p class="watch-vd" onclick="openModal();currentSlide(1)">Watch the Video <img class="play-vd" src="assets/images/play-button.png"></p>
</section>

<section class="platform">
	<div class="container">
		<div class="row row-center">
			<div class="col-md-6">
				<div class="platform-common">
					<!-- <img class="plat-im" src="assets/images/.png"> -->
				</div>
			</div>
			<div class="col-md-6 center-pl">
				<div class="platform-common1">
					<p class="platform-p">Platform for everyone, anywhere, anytime</p>
					<p class="platform-p1">Take smartacademy everywhere with you.</p>
					<button class="btn free-b" value="button"><a href="<?php echo base_url() ?>/pricing">Join Now</a></button>
				</div>
			</div>
		</div>
	</div>
</section>

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

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#login">login</button> -->

<!-- Modal -->
<div id="login" class="modal fade custom-login-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="common-form-popup">
        	<div class="row">
        		<div class="col-lg-12">
        			<h1 class="commn-hed">Sign In</h1>
        		</div>
        		<div class="col-lg-12">
        			<div class="common-in">
        				 <input type="text" class="input-css" placeholder="User Name">
        			</div>
        		</div>
        		<div class="col-lg-12">
        			<div class="common-in">
        				 <input type="password" class="input-css" placeholder="Password">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<button class="btn val-bt">Sign In</button>
        		</div>
        		<div class="col-sm-6">
        			<div class="link-for">
        				<a href="#">New user? SignUp</a>
        				<a href="#">Forgot password?</a>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>

  </div>
</div>



<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#forgot">forgot</button> -->

<!-- Modal -->
<div id="forgot" class="modal fade custom-login-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="common-form-popup">
        	<div class="row">
        		<div class="col-lg-12">
        			<h1 class="commn-hed">Forgot Password</h1>
        		</div>
        		<div class="col-lg-12">
        			<div class="common-in">
        				 <input type="text" class="input-css" placeholder="Email">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<button class="btn val-bt">Send</button>
        		</div>
        		<div class="col-sm-6">
        			<div class="link-for">
        				<p>Remembered? </p>
        				<a href="#">Login</a>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>

  </div>
</div>



<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#signup">Sign Up</button> -->

<!-- Modal -->
<div id="signup" class="modal fade custom-login-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="common-form-popup">
        	<div class="row">
        		<div class="col-lg-12">
        			<h1 class="commn-hed">Sign Up</h1>
        		</div>
        		<div class="col-sm-6">
        			<div class="common-in">
        				 <input type="text" class="input-css" placeholder="First Name">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="common-in">
        				 <input type="text" class="input-css" placeholder="Last Name">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="common-in">
        				 <input type="text" class="input-css" placeholder="Your Organazation Name">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="common-in">
        				 <input type="text" class="input-css" placeholder="Email">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="common-in">
        				 <input type="Password" class="input-css" placeholder="Password">
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<div class="common-in">
        				 <input type="Password" class="input-css" placeholder="Confirm Password">
        			</div>
        		</div>
        		<div class="col-sm-12">
        			<div class="common-in">
        				<select name="cars" id="cars">
						  <option value="volvo">Volvo</option>
						  <option value="saab">Saab</option>
						  <option value="mercedes">Mercedes</option>
						  <option value="audi">Audi</option>
						</select>
        			</div>
        		</div>
        		<div class="col-sm-12">
        			<div class="common-in">
        				<input type="radio" id="male" name="gender" value="male">
						<label for="male">Learner</label><br>
						<input type="radio" id="female" name="gender" value="female">
						<label for="female">Company Administrator</label>
        			</div>
        		</div>
        		<div class="col-sm-12">
        			<div class="common-in">
        				<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
  						<label for="vehicle1"> I agree to the website's <a href="#">Privacy Policy.</a></label>
        			</div>
        		</div>
        		<div class="col-sm-6">
        			<button class="btn val-bt">Sign Up</button>
        		</div>
        		<div class="col-sm-6">
        			<div class="link-for signup-l">
        				<a href="#">Already Account. Sign In</a>
        			</div>
        		</div>
        	</div>
        </div>
      </div>
    </div>

  </div>
</div>




<section class="light-box">
	<div class="container">
	

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
       <iframe width="100%" height="500" src="https://www.youtube.com/embed/07d2dXHYb94?start=17&autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="true" allowfullscreen></iframe>
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
      <iframe width="100%" height="500" src="https://www.youtube.com/embed/1lo-8UWhVcg?start=17&autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="true" allowfullscreen></iframe>
    </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
      <iframe width="100%" height="500" src="https://www.youtube.com/embed/rqFE7JjptnU?start=17&autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="true" allowfullscreen></iframe>
    </div>
    
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>

    <div class="flex-col">
    	<div class="column">
    <a href="#" onclick="currentSlide(1)" class="video-thumb">Play</a>
     <iframe width="100%" height="315" src="https://www.youtube.com/embed/07d2dXHYb94?start=17&autoplay=1&enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="false" allowfullscreen></iframe>
    </div>
    <div class="column">
      <a href="#" onclick="currentSlide(2)" class="video-thumb">Play</a>
      <iframe width="100%" height="315" src="https://www.youtube.com/embed/1lo-8UWhVcg?start=17&enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="false" allowfullscreen></iframe>
    </div>
    <div class="column">
      <a href="#" onclick="currentSlide(3)" class="video-thumb">Play</a>
      <iframe width="100%" height="315" src="https://www.youtube.com/embed/rqFE7JjptnU?start=17&enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" autoplay="false" allowfullscreen></iframe>
    </div>
    </div>
    
  </div>
</div>
	</div>
</section>