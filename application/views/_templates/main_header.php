<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quality Circle</title>
    <!-- Custom Style -->
    <style type="text/css">
        .navbar-inverse .navbar-nav>li>a:focus, .navbar-inverse .navbar-nav>li>a:hover{
            color:#000!important;
        }
    </style>
    <!-- Bootstrap -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />

    <link href="<?php echo base_url(); ?>assets/css_company/animate.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css_company/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_company/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css_company/owl.theme.default.min.css">
    <link href="<?php echo base_url(); ?>assets/css_company/all.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css_company/main-style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css_company/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
   
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/aos.css">
    <script src="<?php echo base_url(); ?>assets/js/aos.js"></script>

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
    <script src="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>assets/js_company/jquery-ui.js" ></script>


<style>
    input[type=checkbox]
    {
        /* Double-sized Checkboxes */
        -ms-transform: scale(2); /* IE */
        -moz-transform: scale(2); /* FF */
        -webkit-transform: scale(2); /* Safari and Chrome */
        -o-transform: scale(2); /* Opera */
        transform: scale(2);
        padding: 10px;
    }

    .help-tip{
        position: relative;
        /*top: 18px;
        right: 18px;*/
        text-align: center;
        background-color: #BCDBEA;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        font-size: 14px;
        line-height: 26px;
        cursor: default;
    }

    .help-tip:before{
        content:'?';
        font-weight: bold;
        color:#fff;
    }

    .help-tip:hover p{
        display:block;
        transform-origin: 100% 0%;

        -webkit-animation: fadeIn 0.3s ease-in-out;
        animation: fadeIn 0.3s ease-in-out;

    }

    .help-tip p {
        display: none;
        text-align: left;
        background-color: #1E2021;
        padding: 15px;
        width: 300px;
        position: absolute;
        border-radius: 3px;
        box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
        right: -4px;
        color: #FFF;
        font-size: 12px;
        line-height: 25px;
        z-index: 99;
    }

    .help-tip p:before{ /* The pointer of the tooltip */
        position: absolute;
        content: '';
        width:0;
        height: 0;
        border:6px solid transparent;
        border-bottom-color:#1E2021;
        right:10px;
        top:-12px;
    }

    .help-tip p:after{ /* Prevents the tooltip from being hidden */
        width:100%;
        height:40px;
        content:'';
        position: absolute;
        top:-40px;
        left:0;
    }

    /* CSS animation */

    @-webkit-keyframes fadeIn {
        0% { 
            opacity:0; 
            transform: scale(0.6);
        }

        100% {
            opacity:100%;
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        0% { opacity:0; }
        100% { opacity:100%; }
    }

    .form-group.float-right {
        float: right;
        margin: -72px 10px 0px 0px;
        position: relative;
        top: 37px;
    }
</style>

   

</head>

<body>
<header class="header-bg">
    <div class="navigationWrap">
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if(!isset($company['url'])) :?>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>welcome"><img src="<?php echo base_url(); ?>assets/images/logo.png"></a>
                    <?php endif?>
                    <?php if(isset($company['url'])) :?>
                        <a class="navbar-brand" href="<?php echo base_url($company['company_url']); ?>">
                            <img src="<?php echo base_url($company['logo_path']);?>">
                        </a>
                    <?php endif?>
                </div>
                <div class="searching">
                    <form action = "<?php echo base_url('/company/gosmartacademy.com/demand/showCourse')?>">
                        <div class="autocomplete" style="width:300px;">
                            <input id="search" type="text" name="sSearch" placeholder="Search for course and location">
                        </div>
                        <button aria-label="Search for course and location" class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right signupBorder">
                        <?php if(!isset($company['url'])) :?>
                            <?php if($this->session->userdata('isLoggedIn') == NULL):?>
                                <li class="<?php echo $menu_name == 'login' ? 'active': '' ?>"><a href="<?php echo base_url('login');?>">Signup or Login</a></li>
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
                                <li><a href="<?php echo base_url('logout');?>"><?php echo $term['logout']; ?></a></li>
                                <li><a href="<?php echo base_url().$view_url?>">Dashboard</a></li>
                            <?php }?>
                        <?php endif;?>
                        <?php if(isset($company['url'])) :?>
                            <?php if($this->session->userdata('isLoggedIn') == NULL):?>
                                <li>
                                    <a style="cursor: pointer" href="javascript:showLogin()">Signup or Login</a>
                                </li>
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
                                <li><a href="<?php echo base_url('logout');?>"><?php echo $term['logout']; ?></a></li>
                                <li><a href="<?php echo base_url().$view_url;?>">Dashboard</a></li>
                            <?php }?>
                        <?php endif;?>
                    </ul>
                    <ul class="nav navbar-nav  navbar-right">
                        <?php if(isset($company['url'])) :?>
                            <li class="<?php echo $menu_name == 'home' ? '': '' ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li class="<?php echo $menu_name == 'about' ? '': '' ?>"><a href="/about">About Us</a></li>
                            <li class="<?php echo $menu_name == 'pricing' ? 'active': '' ?>"><a href="<?php echo base_url('pricing'); ?>">Pricing</a></li>
                            <li class="<?php echo $menu_name == 'catalog' ? 'active': '' ?>"><a href="<?php echo base_url($company['company_url']); ?>/demand">Catalog</a></li>
                            <li class="<?php echo $menu_name == 'contactus' ? 'active': '' ?>"><a href="<?php echo base_url($company['company_url']); ?>/about">Contact Us</a></li>
                        <?php endif;?>
                        <?php if(!isset($company['url'])) :?>
							<li class="<?php echo $menu_name == 'home' ? '': '' ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
							<li class="<?php echo $menu_name == 'about' ? '': '' ?>"><a href="/about">About Us</a></li>
                            <li class="<?php echo $menu_name == 'home' ? '': '' ?>"><a href="<?php echo base_url('company/'.$company_ob['url']); ?>">Academy</a></li>
                            <li class="<?php echo $menu_name == 'pricing' ? 'active': '' ?>"><a href="<?php echo base_url('pricing'); ?>">Pricing</a></li>
                            <li class="<?php echo $menu_name == 'contactus' ? 'active': '' ?>"><a href="<?php echo base_url('contact') ?>">Contact Us</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
<!-- Modal -->
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <ul class="nav nav-tabs" style="padding:10px;margin-bottom:0!important;">
                <li class="signin-tab active" style="text-align:center;width:50%;font-size:23px"><a data-toggle="tab" href="#company_signin">Sign In</a></li>
                <li class="signout-tab" style="text-align:center;width:50%;font-size:23px"><a data-toggle="tab" href="#company_signout">Sign Up</a></li>
            </ul>
            <div class="tab-content">
                <p id="title"></p>
                <input type="hidden" id="falg" value="0"/>
                <div id="company_signin" class="tab-pane fade in active">
                    <?php echo form_open(base_url($company['company_url'].'/loginuser'),['id'=>'company_login_frm']);?>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="loginWrap">
                                <div class="login_errMsg"></div>
                                <div class="loginRow">
                                    <input type="text" name="email" placeholder="Email" class="loginFeild">
                                </div>
                                <div class="loginRow">
                                    <input type="password" id="password" data-toggle="password" name="password" placeholder="Password" class="loginFeild">
                                </div>
                                <div class="loginRow">
                                    <div id="recaptcha1"></div>
                                    <div id="errormessage" style="color: red; margin: 5px 0 0 0px"></div> 
                                </div>
                                <div class="g-recaptcha" data-sitekey="6LfFAvsgAAAAAAjak90G1MG8y0W6HwOcSOYNH5z1"></div> 
                                <div style="float: right; font-size: 14px; font-weight: 500;">
                                    <a href="<?php echo base_url(); ?>forgotPassword" style="color: #03a9f4;">Forgot password?</a>
                                </div>
                                <div class="loginRow">
                                    <button type="button" class="signin" style="outline:none!important">Sign In</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
                <div id="company_signout" class="tab-pane fade">
                    <?php echo form_open(base_url($company['company_url'].'/signup'),['id'=>'company_signup_frm']);?>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="loginWrap">
                                <div class="signup_errMsg"></div>
                                <div class="loginRow">
                                    <div class="login50 paddR5">
                                        <input type="text" name="firstname" placeholder="First Name" class="loginFeild">
                                    </div>
                                    <div class="login50 paddL5">
                                        <input type="text" name="lastname" placeholder="Last Name" class="loginFeild">
                                    </div>
                                </div>
                                <div class="loginRow">
                                    <input type="text" name="organization" placeholder="Your Organazation Name" class="loginFeild">
                                </div>
                                <div class="loginRow">
                                    <input type="text" name="email" placeholder="Email" class="loginFeild">
                                </div>
                                <div class="loginRow">
                                    <input type="password" name="password" placeholder="Password" class="loginFeild">
                                    <div class="form-group float-right">
                                        <div class="help-tip">
                                            <p>Must include at least 8 chracters <br/>Must include at least 1 uppercase letter(A-Z) <br/>Must include at least 1 lowercase letter(a-z) <br/>Must include at least 1 numeric digit(0-9) <br/>Must include at least 1 special character(!@#$%^*)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="loginRow">
                                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="loginFeild">
                                </div>
                                <div class="loginRow">
                                    <div id="recaptcha2"></div>
                                    <div id="errormessage1" style="color: red; margin: 5px 0 0 0px"></div> 
                                </div>
                                <div class="loginRow">
                                    <button type="button" class="signin" style="outline:none!important">
                                        <i id="loadingSpan1" style="display:none;" class="fa fa-spinner fa-spin"></i>
                                        Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>


<script>
  var url = "";
  var recaptcha1;
  var recaptcha2;
  var myCallBack = function() {
    //Render the recaptcha1 on the element with ID "recaptcha1"
    recaptcha1 = grecaptcha.render('recaptcha1', {
      'sitekey' : '6LfFAvsgAAAAAAjak90G1MG8y0W6HwOcSOYNH5z1', //Replace this with your Site key
      'theme' : 'light'
    });
    
    //Render the recaptcha2 on the element with ID "recaptcha2"
    recaptcha2 = grecaptcha.render('recaptcha2', {
      'sitekey' : '6LfFAvsgAAAAAAjak90G1MG8y0W6HwOcSOYNH5z1', //Replace this with your Site key
      'theme' : 'light'
    });
  };
</script>




<script>
    $('#company_login_frm .signin').on('click', function(e){
        var flag =  $("#flag").val();
        e.preventDefault();
        if(grecaptcha.getResponse(recaptcha1) == "") { 
            $("#errormessage").text("Please Fill The Google Captcha");
            return false;
        } else {
            var formdata    = $('#company_login_frm').serialize();
            var formAction  = $('#company_login_frm').attr('action');
            var msg         = $('.login_errMsg');
            $.ajax({
                url : formAction,
                type : 'post',
                data : formdata,
                success : function(res) {
                    if(res.type == 1){
                        if(res.msg){
                            if(url== ""){
                                location.reload();
                            }else{
                                window.location.href = "<?=base_url()?>"+ url;
                            }
                        }
                    }
                    else
                        msg.html('<div class="alert alert-danger"><p class="m-0">'+res.msg+'</p></div>');
                }
            });
        }

    });

    $('#company_signup_frm .signin').on('click', function(e) {
        e.preventDefault();
        console.log('#company_signup_frm .signin');
        if(grecaptcha.getResponse(recaptcha2) == "") { 
            $("#errormessage1").text("Please Fill The Google Captcha");
            return false;
        } else {
            var formdata    = $('#company_signup_frm').serialize();
            var formAction  = $('#company_signup_frm').attr('action');
            var msg         = $('.signup_errMsg');

            $("#loadingSpan1").css("display","inline-block");
            $("#loadingSpan1").attr("disabled","1");

            $.ajax({
                url : formAction,
                type : 'post',
                data : formdata,
                success : function(res) {
                    $("#loadingSpan1").css("display","none");
                    $("#loadingSpan1").removeAttr("disabled","1");

                    

                    if(res.type == 1){
                        //location.reload();
                    }else{
                        if(res.errors)
                            msg.html('<div class="alert alert-danger"><p class="m-0">'+res.errors+'</p></div>');
                        if(res.msg){
                            msg.html('<div class="alert alert-success"><p class="m-0">'+res.msg+'</p></div>');
                            $('form#company_signup_frm')[0].reset();
                        }
                    }
                },
                error: function(res){
                    $("#loadingSpan1").css("display","none");
                    $("#loadingSpan1").removeAttr("disabled","1");

                    //location.reload();
                    if(res.type == 1){

                    }else{
                        if(res.errors)
                            msg.html('<div class="alert alert-danger"><p class="m-0">'+res.errors+'</p></div>');
                        if(res.msg){
                            msg.html('<div class="alert alert-success"><p class="m-0">'+res.msg+'</p></div>');
                        }
                    }
                }

            });
        }
    });

    function showLogin(){
        $("#title").text("");
        $('.signin-tab').addClass('active');
        $("#flag").val("1");
        $('.signout-tab').removeClass('active');
        $('#company_signin').addClass('active in');
        $('#company_signout').removeClass('active in');
        $('.login_errMsg').html('');
        $('.signup_errMsg').html('');
        $('#company_signup_frm')[0].reset();
        $('#loginModal').modal('show');
    }
    function showAcademyLogin(path){
        url = path;
        $('.signin-tab').addClass('active');
        $("#title").text("Thank you for choosing Quality Circle’s Learning Academy. Please signup if you are not a registered member of the academy,  then sign-in and register for the course. If you are a registered member please sign-in to register for the course.");
        $("#flag").val("0");
        $('.signout-tab').removeClass('active');
        $('#company_signin').addClass('active in');
        $('#company_signout').removeClass('active in');
        $('.login_errMsg').html('');
        $('.signup_errMsg').html('');
        $('#company_signup_frm')[0].reset();
        $('#loginModal').modal('show');
    }

    $('.signin-tab').on('click',function(){
        $('.login_errMsg').html('');
        $('.signup_errMsg').html('');
    });

    $('.signout-tab').on('click',function(){
        $('.login_errMsg').html('');
        $('.signup_errMsg').html('');
    });
</script>
<script type="text/javascript">

    $(function() {
        // $( "#search" ).autocomplete({
        //     source: '<?php echo base_url("contact/search");?>',
        // });
    });
</script>
<style>
* {
  box-sizing: border-box;
}

/*body {
  font: 16px Arial;  
}*/

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

</style>