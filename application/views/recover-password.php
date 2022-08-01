<!doctype html>
<html class="fixed">
<head>
    <title>LMS</title>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">

    <!-- Head Libs -->
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
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">

        <div style="font-size: 42px; font-weight: bold; margin: 0;
  text-align: center; line-height: 45px; color: #fff;
  padding: 0 20px 2px 20px;">
            <?php if(!isset($site_theme['logo'])) { ?>
                <img src="<?php echo base_url(); ?>assets/img/logo.png" width="200"  alt="LMS" />
            <?php } else{ ?>
                <img src="<?php echo base_url($site_theme['logo']); ?>" width="200"  alt="LMS" />
            <?php } ?>
        </div>



        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> <?php echo $term['recoverpassword']; ?></h2>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <p class="m-0"><?php echo $term['enteryouremailbelowtosend']; ?></p>
                </div>

                <?php
                    $invalid = $this->session->flashdata('invalid');
                    if($invalid)
                    {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('invalid'); ?>                    
                    </div>
                <?php 
                    }
                ?> 

                <form action="<?php echo base_url()?>checkemail" method="post">
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <input name="email" id="email" type="email" placeholder="<?php echo $term['email']; ?>" class="form-control form-control-lg" required />
                            <span class="input-group-append">
                                <button class="btn btn-primary btn-lg" type="submit"><?php echo $term['send']; ?></button>
                            </span>
                        </div>
                    </div>

                    <?php
                        $reset_link = $this->session->userdata('reset_link');
                        if(!empty($reset_link))
                        {
                    ?>
                <!--    <div class="form-group mb-0">
                        <a href="<?php /*echo $reset_link; */?>"> Reset Password Link </a>
                    </div>-->
                    <?php 
                        }
                    ?>
                    <p class="text-center mt-3"><?php echo $term['remembered']; ?> <a href="<?php echo base_url(); ?>login"><?php echo $term['login']; ?></a></p>
                </form>
            </div>
        </div>

        <p style="color:white !important;" class="text-center text-muted mt-3 mb-3">&copy; <?php echo $term['copyrightallright']; ?></p>
    </div>
</section>
<!-- end: page -->

<!-- Vendor -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/popper/umd/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/common/common.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="<?php echo base_url(); ?>assets/js/theme.js"></script>


<!-- Theme Initialization Files -->
<script src="<?php echo base_url(); ?>assets/js/theme.init.js"></script>

</body>
</html>