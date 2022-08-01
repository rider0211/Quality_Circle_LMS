<?php
// PHP permanent URL redirection test
//header("Location: http://demo.aus-schulung.de/login", true, 301);
//exit();
?>
<!DOCTYPE html>
<html class=" w-mod-js"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style data-lo-component-tracker="true" type="text/css"></style>

    <link rel="shortcut icon" href="<?php echo base_url($site_theme['favicon']); ?>" />

    <title><?php echo $company_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="<?php echo base_url(); ?>assets/css/smarteru-new.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>assets/vendor/layerslider/css/layerslider.css" rel="stylesheet" type="text/css">
 
	<!-- External libraries: jQuery & GreenSock -->
	<script src="<?php echo base_url(); ?>assets/vendor/layerslider/js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/layerslider/js/greensock.js" type="text/javascript"></script>
	 
	<!-- LayerSlider script files -->
	<script src="<?php echo base_url(); ?>assets/vendor/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/vendor/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

<style>
	body, html {
		margin: 0;
		padding: 0;
		width: 100%;
		height: 100%;
		/*overflow: hidden;*/
		background: black !important;
	}
	.fixed-navbar {
		display: none !important;
	}
	.logo-block span {
		margin-left: 42px;
	}
	span.with {
		font-size: 1.1em;
		font-weight: 500;
	}
	.lixxx li {
		list-style-image: url(./img/icon.png);
		color: #000;
		font-size: 0.9em;
		line-height: 2em;
	}
	.footer {
		padding: 5px 3px;
		/*position: absolute;
    	bottom: 0px;*/
    	width: 100%;
    	text-align: center;
		background: black;
		z-index:999999999;
	}
	
	.policy a{
		text-decoration: none;
		font-size: 14px;
		margin-right: 20px;
	}
	.copyright{
		font-size: 14px;
		padding-top: 15px;
		color: #FFFFFF;
	}
	
	#slider-wrapper {
		position: absolute;
		top: 0px;
		width:100%;
		/*height: 100%;*/
	}
	.sidenav {
	    height: 100%;
	    width: 0;
	    position: fixed;
	    z-index: 1;
	    top: 0;
	    right: 0;
	    background-color: #111;
	    overflow-x: hidden;
	    transition: 0.5s;
	    padding-top: 60px;
	}

	.sidenav a {
	    padding: 8px 8px 8px 32px;
	    text-decoration: none;
	    font-size: 25px;
	    color: #818181;
	    display: block;
	    transition: 0.3s;
	}

	.sidenav a:hover {
	    color: #f1f1f1;
	}

	.sidenav .closebtn {
	    position: absolute;
	    top: 0;
	    right: 25px;
	    font-size: 36px;
	    margin-left: 50px;
	}

	@media screen and (max-height: 450px) {
	  .sidenav {padding-top: 15px;}
	  .sidenav a {font-size: 18px;}
	}
</style>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "200px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>    
</head>

<body cz-shortcut-listen="true">
    <div data-collapse="medium" data-animation="over-right" data-duration="400" data-doc-height="1" data-no-scroll="1" data-ix="show-fixed-menu" class="navbar w-nav">
        <div class="w-container">

        	<a href="#" class="logo-block w-nav-brand w--current">
                <?php if(!isset($site_theme['logo'])) { ?>
                    <img src="<?php echo base_url(); ?>assets/img/logo.png" width="100"  alt="LMS" />
                <?php } else{ ?>
                    <img src="<?php echo base_url($site_theme['logo']); ?>" width="100"  alt="LMS" />
                <?php } ?>
            </a>

            <div class="menu-button w-nav-button">
                <div class="icon-2 w-icon-nav-menu closebtn" onclick="openNav()"></div>
			</div>

			<div id="mySidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <a href="<?php echo site_url('login'); ?>"><?=$term["login"]?></a>
			</div>

			<div class="nav-right-block w-clearfix">
				<a href="#" title="Contact Us! - SmarterU LMS - Online Training Software" class="nav-icon-block w-inline-block">
					<div class="nav-icon-title icon"></div>
					<div class="nav-icon-title w-hidden-small w-hidden-tiny"><?=$term["contactus"]?></div>
				</a>
				<a href="tel:<?php echo $company_phone; ?>" title="Contact Us! - SmarterU LMS - Corporate Training" class="nav-icon-block phone-block w-inline-block">
					<div class="nav-icon-title small-title w-hidden-tiny"><?=$term["questioncallus"]?></div>
					<div class="nav-icon-title phone-number w-hidden-tiny"><?php echo $company_phone; ?></div>
					<div class="nav-icon-title icon w-hidden-main w-hidden-medium w-hidden-small"></div>
				</a>
			</div>
			<nav role="navigation" class="nav-menu mobile w-nav-menu">
				<a href="#" data-ix="show-nav-link-line" title="SmarterU LMS - Corporate Training" class="nav-link-block w-hidden-medium w-hidden-small w-hidden-tiny w-inline-block w--current" style="transition: color 0.2s ease 0s;">
					<div class="nav-link-title"><?=$term["home"]?></div>
					<div data-ix="hide-nav-link-line" class="nav-link-line" style="opacity: 0; width: 0px;"></div>
				</a>
			  
			   
				<a data-ix="show-nav-link-line" href="<?php echo site_url('login'); ?>" target="_blank" class="nav-link-block w-hidden-medium w-hidden-small w-hidden-tiny w-inline-block" style="transition: color 0.2s ease 0s;">
					<div title="Training Solutions by Industy - SmarterU LMS - Blended Learning" class="nav-link-title"><?=$term["login"]?></div>
					<div data-ix="hide-nav-link-line" class="nav-link-line" style="opacity: 0; width: 0px;"></div>
				</a>
			 </nav>
		</div>
		<div class="nav-login"></div>
		<div class="w-nav-overlay" data-wf-ignore=""></div>
    </div>
    <div data-collapse="all" data-animation="over-right" data-duration="400" data-ix="hide-fixed-menu" data-doc-height="1" data-no-scroll="1" class="fixed-navbar w-nav" style="opacity: 1; display: block; transition: opacity 200ms ease-in;">
        <div class="w-container"><a href="#" class="logo-block w-nav-brand w--current"><img src="<?php echo base_url(); ?>assets/img/2018-06-30.png" alt="" title="" class="logo fixed-logo"></a>
            <div class="fixed-menu-button w-clearfix w-nav-button">
                <div class="menu-icon w-icon-nav-menu"></div>
                <div class="menu-title w-hidden-tiny">Menu</div>
			</div>
			<div class="nav-right-block fixed-block w-clearfix">
				<a href="#" class="nav-icon-block small w-inline-block">
					<div class="nav-icon-title icon"></div><div class="nav-icon-title w-hidden-small w-hidden-tiny">Contact us</div>
				</a>
				<a href="tel:(855)885-2469" class="nav-icon-block phone-block w-inline-block">
					<div class="nav-icon-title small-title first-small-title w-hidden-tiny">Questions? Call us!</div>
					<div class="nav-icon-title phone-number smaller w-hidden-tiny">(855) 885-2469</div>
					<div class="nav-icon-title icon w-hidden-main w-hidden-medium w-hidden-small"></div>
				</a>
			</div>
		  
		</div>
		<div class="w-nav-overlay" data-wf-ignore=""></div>
    </div>
	
	<div id="slider-wrapper">
		<div id="layerslider" style="width: 100%; height: 790px;">

			<!-- slide one start -->

			<div class="ls-slide" data-ls="slidedelay: 7000;">

				<!-- slide background image -->

				<img src="<?php echo base_url(); ?>assets/img/back.jpg" class="ls-bg" alt="Slide background"/>
				
			</div>

			<!-- slide one end -->

			<!-- slide two start -->

			<div class="ls-slide" data-ls="slidedelay: 5000; transition2d: 5; timeshift: -1000;">

				<!-- slide background image -->

				<img src="<?php echo base_url(); ?>assets/img/back.jpg" class="ls-bg" alt="Slide background"/>

				<!-- layer one -->

			</div>

			<!-- slide two end -->

		</div>

		<!-- LayerSlider end -->
		<div class="footer">
			<div class="w-container">
				<div class="policy">
					<a href="#">Privacy Policy</a> <a href="#">Imprint</a>
				</div>	
				<div class="copyright"><p>Copyright © 2018 demo. All Rights Reserved.</p></div>
					
			 </div>
		</div>
	</div>
    
	<div class="hero">
        <div class="hero-overlay-block">
            <div class="container w-container">
                <div class="hero-content-block w-clearfix">
                    <h1 data-ix="fade-in-on-load" class="hero-title" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 800ms, transform 800ms;"><span class="highlight-header-title">Supercharge</span><br>&nbsp;Your Training!<br><span class="with">With LMS</span></h1>
                    <p data-ix="fade-in-on-load-2" class="hero-descritpion" style="opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 800ms, transform 800ms;">Beautiful &amp; powerful learning management system for corporation, franchises, and contract trainers.</p>
                    <a href="#" data-ix="fade-in-on-load-3" class="hero-lightbox w-inline-block w-lightbox" style="width:100%; opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 800ms, transform 800ms;">
                        <ul class="lixxx">
                            <li class="">SCORM/AICC/xAPI Compliant</li>
                            <li class="">Built-In Course Editor</li>
                            <li class="">Instructor-led Training</li>
                            <li class="">Built-In Course Editor</li>
                            <li class="">Much, much more</li>
                           
                        </ul>
                    </a>
                </div>
                <a href="#" data-ix="fade-in-on-load-3" class="hero-lightbox w-inline-block w-lightbox" style="width:100%; opacity: 1; transform: translateX(0px) translateY(0px) translateZ(0px); transition: opacity 800ms, transform 800ms;"></a>
                
            </div>
        </div>
    </div>

	<script>
		jQuery("#layerslider").layerSlider({
			pauseOnHover: false,
			skin: 'noskin',
			showCircleTimer: false,
			skinsPath: '<?php echo base_url(); ?>assets/vendor/layerslider/skins/'
		});
	</script>
</body></html>