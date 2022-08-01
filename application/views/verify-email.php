<!doctype html>

<html class="fixed sidebar-left-collapsed">

  <head>



    <!-- Basic -->

    <meta charset="UTF-8">



    <title>LMS | LOGIN</title>

    <meta name="keywords" content="Login" />

    <meta name="description" content="LMS Login page">

    <meta name="author" content="ping.net">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>



    <!-- Vendor CSS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">



    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />



    <!-- Specific Page Vendor CSS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris/morris.css" />



    <!-- Custom CSS -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css" />



    <script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>

	<style>

		html,body {

			height:100%;

			overflow-y: auto !important;

		}

		body {

			background-image: url(<?php echo base_url() ?>assets/img/login-back.jpg);

            background-size: 100%;

            overflow: auto;

            background-repeat: no-repeat;

            background-size: cover;



        }

		.body-sign {

			max-width: 100%;

      background:rgba(0, 0, 0, 0.5);

		}

		.body-sign .center-sign {

			vertical-align: top;

			max-width: 500px;

			margin: auto;

			display:block;

			margin-bottom:30px;

		}

		.body-sign .card-sign .card-body {

			border-radius: 0px 0 5px 5px;

		}

		.card-sign .mt-3 {

			background: rgba(255, 255, 255, 0.3) none repeat scroll 0% 0%;

			border-radius: 10px 10px 0px 0px;

			padding-top: 5px;

			color: #FFF;

			font-size: 0.8em;

			padding-left: 31px;

		}

		footer {

			position: fixed;

			bottom: 0;

			width: 100%;

			text-align: center;

			color:white;

		}

	</style>

  </head>

  <body>

    <section class="body-sign">

      <div class="center-sign">

        <div style="font-size: 42px; font-weight: bold; margin: 0;

  text-align: center; line-height: 45px; color: #fff;

  padding: 0 20px 2px 20px;">

          <img src="<?php echo site_url('assets/img/logo.png');?>" width="200" alt="LMS" />

        </div>

        <div class="panel card-sign">

          <div class="mt-3">

            <h2 class="title font-weight-bold m-0">Email Verified</h2>

          </div>

          <div class="card-body">

			<section class="LoginBox">
			   	<div class="LoginInner wow zoomIn">
				    <div class="form-group">
					     <div class="col-sm-12 LoginImg">
							  <!-- <img src="<?php echo base_url()?>assets/home/Images/userimg.png"> -->
							  <!-- <h5 class="content-group-lg">Email Verified</h5> -->
						 </div>
						<p style="font-size: 18px;" class="congrats-msg">CONGRATS! <br/> YOUR EMAIL IS VERIFIED</p>
						<p style="font-size: 18px;" class="thankyou-msg">THANK YOU FOR YOUR CHOICE</p>
					</div>
					<div class="row col-sm-12">
				    	<a href="<?= base_url(); ?>" class="btn btn-success hvr-bounce-in">Login</a>
				    </div>
			   </div>
			</section>


          </div>

        </div>



      </div>

    </section>

    <footer>© <?php echo $term['copyrightallright']; ?></footer>



    <!-- Vendor -->

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/common/common.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>

    

    

  </body>

</html>

