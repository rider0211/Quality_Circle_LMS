<!doctype html>
<html class="fixed js flexbox flexboxlegacy no-touch csstransforms csstransforms3d no-overflowscrolling webkit chrome win js no-mobile-device custom-scroll">
  <head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title><?php echo $company_name; ?></title>
    <meta name="keywords" content="LMS" />
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

    <!-- Specific Page vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-multi-select/css/multi-select.css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/basic.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/dropzone/dropzone.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables/media/css/dataTables.bootstrap4.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris/morris.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.checkboxes.css"  />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-markdown.min.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/codemirror/lib/codemirror.css" />
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/codemirror/theme/monokai.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/elusive-icons/css/elusive-icons.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css">
    <?php if (empty($edit_course)):?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
	
    
    <?php endif;?>
<!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css_company/main-style.css">-->

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Head Libs -->
    <script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery-validation/jquery.validate.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/popper/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootbox/bootbox.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/common/common.js"></script>     
    <script src="<?php echo base_url(); ?>assets/vendor/nanoscroller/nanoscroller.js"></script>    
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-placeholder/jquery-placeholder.js"></script>
    
    <!-- Specific Page vendor -->

    <script src="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-appear/jquery-appear.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/morris/morris.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/fuelux/js/spinner.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/dropzone/dropzone.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/select2/js/select2.js"></script>     
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-multi-select/js/jquery.multi-select.js"></script>

      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-markdown/js/markdown.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
      <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>

      <script src="<?php echo base_url(); ?>assets/vendor/codemirror/lib/codemirror.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/dataTables.checkboxes.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/ios7-switch/ios7-switch.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/ckeditor/ckeditor.js" type="text/javascript" ></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>

    <script src="<?php echo base_url(); ?>assets/vendor/jquery-appear/jquery-appear.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/flot.tooltip/flot.tooltip.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/flot/jquery.flot.categories.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/morris/morris.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/uploaders/fileinput/plugins/purify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/uploaders/fileinput/plugins/sortable.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/uploaders/fileinput/fileinput.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/form-render.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jscolor.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/paint.js" type="text/javascript"></script>

    <script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.min.js"></script> 
    
    
      <style>
          .logo{
              font-size: 20px;
              color: #adbece;
              font-weight: bold;
          }
          .logo:hover{
              color: white;
              text-decoration: none;
          }
          html.dark .header, html.header-dark .header{
              background: <?php echo $site_theme['header_color']; ?>;
              border-bottom-color: #161a1e;
              border-top-color: <?php echo $site_theme['header_color']; ?>;

          }
          html.no-overflowscrolling .sidebar-left .nano{
              background: <?php echo $site_theme['navigation_color']; ?>;
          }
          .sidebar-left .sidebar-header .sidebar-title{
              background: <?php echo $site_theme['navigation_color']; ?>;
          }
          ul.nav-main li a{
              color: <?php echo $site_theme['font_color']; ?>;
          }
		  .logo-div{
			      position: absolute;
    background: #fff;
    width: 13.7%;
    padding: .3% 3%;
	}
	@media only screen and (max-width: 767px) {
		.logo-div{
			          position: absolute;
    background: #fff;
    width: 32.7%;
    padding: .3% 0%;
	}
	}
      </style>
  </head>
  
  <!-- Matomo -->
<script type="text/javascript">
  var _paq = _paq || [];
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="https://analytics.8solutions.de/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '74']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<!-- End Matomo Code -->
  <body data-loading-overlay>
    <section class="body">

      <!-- start: header -->
      <header class="header">
        <div style="position:relative" class="logo-container">
          <div class="logo-div">
          <a href="<?=base_url()?>" class="logo">
              <?php if(!isset($site_theme['logo'])) { ?>
                    <img src="<?php echo base_url(); ?>assets/images/new-logo-nitam.jpg" style="width:90px" alt="OLS" />
              <?php } else{ ?>
                  <img src="<?php echo base_url($site_theme['logo']); ?>" width="200" height="40" alt="OLS" />
              <?php } ?>
          </a>
          </div>
          <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
          </div>

        </div>
      
        <!-- start: notifications -->
        <div class="row">
          
        
            <?php if($this->session->userdata('country_code') == '' || $this->session->userdata('phone') == ''){ ?>
              <div class="col-md-8 col-sm-5" style="display: inline-block;list-style: none;margin: 15px -10px 0 0;padding: 0;vertical-align: middle;text-align:center;">
                <span style="margin:20px auto;padding:20px;text-shadow: 0px 1px 1px #4d4d4d;color:red;">Please complete your profile details. <a href="<?=base_url()?>profile">click here!</a></span>
              </div>
            <?php } ?>
            
            <div class="col-md-4 col-sm-5 header-right" style = "text-align:right">
          
              <span class="separator"></span> 
          
              <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                  <figure class="profile-picture">
                    <img <?php if ($this->session->userdata('user_photo') != base_url()):?>src="<?php print $this->session->userdata('user_photo') ?>"<?php else:?> src = "<?=base_url("assets/img/default_profile.png")?>"<?php endif;?> alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?php print $this->session->userdata('user_photo') ?>" />
                  </figure>
                  <div class="profile-info" data-lock-name="<?php print $this->session->userdata('name') ?>" data-lock-email="<?php print $this->session->userdata('email') ?>">
                    <span style="max-width: 120px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" class="name"><?php print $this->session->userdata('name') ?></span>
                    <span class="role"><?php print $this->session->userdata('user_type') ?></span>
                  </div>
                  <i class="fa custom-caret"></i>
                </a>
                <div class="dropdown-menu">
                  <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                      <a role="menuitem" tabindex="-1" href="<?php echo base_url()?>profile"><i class="fas fa-user"></i> <?php echo $term['myprofile']; ?></a>
                    </li>
                    <li>
                      <a role="menuitem" tabindex="-1" href="<?php echo base_url();?>logout"><i class="fas fa-power-off"></i> <?php echo $term['logout']; ?></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- end: notifications -->
          </header>
      <!-- end: header -->
      </div>
      <div class="inner-wrapper">

        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">
        
            <div class="sidebar-header">
                <div class="sidebar-title">
                    <?php echo $term['navigation']; ?>
                </div>
                <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle" >
                    <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>
        
            <div class="nano has-scrollbar">
                <div class="nano-content" tabindex="0"  style="right: -17px;">
                    <nav id="menu" class="nav-main" role="navigation">

                    <?php print $sidebar; ?>

                    </nav>
                </div>
        
                <script>
                    // Maintain Scroll Position
                    if (typeof localStorage !== 'undefined') {
                        var initialPosition = localStorage.getItem('sidebar-left-position'),
                          sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                            
                        sidebarLeft.scrollTop = initialPosition;
                        
                        if(localStorage.getItem('sidebar-left-opened')=='true') {
                          $( 'html' ).removeClass('sidebar-left-collapsed');
                          $( 'html' ).addClass('sidebar-left-opened');
                        } else {
                          $( 'html' ).addClass('sidebar-left-collapsed');
                          $( 'html' ).removeClass('sidebar-left-opened');
                        }
                    }
                </script>
                
            </div>
        
        </aside>
        <!-- end: sidebar -->
