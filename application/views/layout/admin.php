<!DOCTYPE html>
<html class="fixed header-dark">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Trainning and Certification System</title>
		<meta name="keywords" content="LMS" />
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- vendor CSS -->
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap/css/bootstrap.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/animate/animate.css") ?>">

		<link rel="stylesheet" href="<?= site_url("assets/vendor/font-awesome/css/fontawesome-all.min.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/magnific-popup/magnific-popup.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css") ?>" />

		<!-- Specific Page vendor CSS -->
		<link rel="stylesheet" href="<?= site_url("assets/vendor/jquery-ui/jquery-ui.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/jquery-ui/jquery-ui.theme.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/jquery-multi-select/css/multi-select.css") ?>"/>
		<link rel="stylesheet" href="<?= site_url("assets/vendor/select2/css/select2.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/dropzone/basic.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/dropzone/dropzone.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/datatables/media/css/dataTables.bootstrap4.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/pnotify/pnotify.custom.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/morris/morris.css") ?>" />
		<link rel="stylesheet" href="<?= site_url("assets/vendor/elusive-icons/css/elusive-icons.css") ?>" />

		
		<!-- Theme CSS -->
		<link rel="stylesheet" href="<?= site_url("assets/css/theme.css") ?>">

		<!-- Skin CSS -->
		<link rel="stylesheet" href="<?= site_url("assets/css/skins/default.css") ?>" />

		<link rel="stylesheet" href="<?= site_url("assets/css/custom.css") ?>" />

		<!-- Head Libs -->
		<script src="<?= site_url("assets/vendor/modernizr/modernizr.js") ?>"></script>
		
		<script src="<?= site_url("assets/vendor/jquery/jquery.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/jquery-validation/jquery.validate.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js") ?>"></script>
		
		<script src="<?= site_url("assets/vendor/popper/umd/popper.min.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootbox/bootbox.min.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap/js/bootstrap.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/magnific-popup/jquery.magnific-popup.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/common/common.js") ?>"></script>		 
		<script src="<?= site_url("assets/vendor/nanoscroller/nanoscroller.js") ?>"></script>		
		<script src="<?= site_url("assets/vendor/jquery-placeholder/jquery-placeholder.js") ?>"></script>
		
		<!-- Specific Page vendor -->
		<script src="<?= site_url("assets/vendor/jquery-ui/jquery-ui.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/jquery-appear/jquery-appear.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap-timepicker/bootstrap-timepicker.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/jquery-maskedinput/jquery.maskedinput.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js") ?>"></script>

		<script src="<?= site_url("assets/vendor/morris/morris.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/fuelux/js/spinner.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/dropzone/dropzone.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/select2/js/select2.js") ?>"></script>		 
		<script src="<?= site_url("assets/vendor/jquery-multi-select/js/jquery.multi-select.js") ?>"></script>

		<script src="<?= site_url("assets/vendor/datatables/media/js/jquery.dataTables.min.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/datatables/media/js/dataTables.bootstrap4.min.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/pnotify/pnotify.custom.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/ios7-switch/ios7-switch.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js") ?>"></script>
		<script src="<?= site_url("assets/vendor/ckeditor/ckeditor.js") ?>" type="text/javascript" ></script>
		<script src="<?= site_url("assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js") ?>"></script>

		<script src="<?= site_url("assets/js/jscolor.js") ?>" type="text/javascript"></script>
		<script src="<?= site_url("assets/js/paint.js") ?>" type="text/javascript"></script>
		<script src="<?= site_url("assets/js/common.js") ?>"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="#" class="logo">
						<img src="<?= site_url("assets/img/logo.png") ?>" width="125" height="40" alt="LMS" />
					</a>
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: notifications -->
				<div class="header-right">
			
					<!-- <ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fas fa-tasks"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="float-right badge badge-default">3</span>
									Tasks
								</div>
			
								<div class="content">
									<ul>
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left">Generating Sales Report</span>
												<span class="message float-right text-dark">60%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left">Importing Contacts</span>
												<span class="message float-right text-dark">98%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
											</div>
										</li>
			
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left">Uploading something big</span>
												<span class="message float-right text-dark">33%</span>
											</p>
											<div class="progress progress-xs light mb-1">
												<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fas fa-envelope"></i>
								<span class="badge">4</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="float-right badge badge-default">230</span>
									Messages
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?= site_url("assets/img/") ?>!sample-user.jpg" alt="Joseph Doe Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joseph Doe</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?= site_url("assets/img/") ?>!sample-user.jpg" alt="Joseph Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?= site_url("assets/img/") ?>!sample-user.jpg" alt="Joe Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joe Junior</span>
												<span class="message">Lorem ipsum dolor sit.</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<figure class="image">
													<img src="<?= site_url("assets/img/") ?>!sample-user.jpg" alt="Joseph Junior" class="rounded-circle" />
												</figure>
												<span class="title">Joseph Junior</span>
												<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fas fa-bell"></i>
								<span class="badge">3</span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="float-right badge badge-default">3</span>
									Alerts
								</div>
			
								<div class="content">
									<ul>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fas fa-thumbs-down bg-danger text-light"></i>
												</div>
												<span class="title">Server is Down!</span>
												<span class="message">Just now</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fas fa-lock bg-warning text-light"></i>
												</div>
												<span class="title">User Locked</span>
												<span class="message">15 minutes ago</span>
											</a>
										</li>
										<li>
											<a href="#" class="clearfix">
												<div class="image">
													<i class="fas fa-signal bg-success text-light"></i>
												</div>
												<span class="title">Connection Restaured</span>
												<span class="message">10/10/2017</span>
											</a>
										</li>
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span> -->
			
					<div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
              <figure class="profile-picture">
                <img src="<?php print $this->session->userdata('user_photo') ?>" alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?php print $this->session->userdata('user_photo') ?>" />
              </figure>
              <div class="profile-info" data-lock-name="<?php print $this->session->userdata('name') ?>" data-lock-email="<?php print $this->session->userdata('email') ?>">
                <span class="name"><?php print $this->session->userdata('name') ?></span>
                <span class="role"><?php print $this->session->userdata('user_type') ?></span>
              </div>
      
              <i class="fa custom-caret"></i>
            </a>
      
            <div class="dropdown-menu">
              <ul class="list-unstyled mb-2">
                <li class="divider"></li>
                <li>
                  <a role="menuitem" tabindex="-1" href="#"><i class="fas fa-user"></i> My Profile</a>
                </li>
                <li>
                  <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fas fa-lock"></i> Lock Screen</a>
                </li>
                <li>
                  <a role="menuitem" tabindex="-1" href="<?php echo base_url();?>logout"><i class="fas fa-power-off"></i> Logout</a>
                </li>
              </ul>
            </div>
          </div>
				</div>
				<!-- end: notifications -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">

				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
						<div class="sidebar-header">
								<div class="sidebar-title">
										Navigation
								</div>
								<div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
										<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
								</div>
						</div>
				
						<div class="nano has-scrollbar">
								<div class="nano-content" tabindex="0"	style="right: -17px;">
										<nav id="menu" class="nav-main" role="navigation">

										  <ul class="nav nav-main">
                        <li>
              						<a href="<?= site_url("admin/home") ?>" class="nav-link">
              							<i class="fas fa-home" aria-hidden="true"></i>
              							<span >Dashboard</span>
              						</a>
                        </li>
                      </ul>
										</nav>
								</div>
				
								<script>
										// Maintain Scroll Position
										if (typeof localStorage !== 'undefined') {
												var initialPosition = localStorage.getItem('sidebar-left-position'),
													sidebarLeft = document.querySelector('#sidebar-left .nano-content');
														
												sidebarLeft.scrollTop = initialPosition;
												
										}
								</script>
								
						</div>
				
				</aside>
				<!-- end: sidebar -->
        <div class="row">
        	<table class="col-sm-12">
        		<tr>
        			<td width="25px">
        				<input type="radio" name="content[correct357771277]" checked value="0">
        			</td>
        			<td>
        				<input type="text" class="form-control input-sm" name="content[html][0]" value="True"/>
        			</td>
        			<td width="15px"></td>
        			<td width="25px">
        				<input type="radio" name="content[correct357771277]"	value="1">
        			</td>
        			<td>
        				<input type="text" class="form-control input-sm" name="content[html][1]" value="False"/>
        			</td>
        		</tr>
        	</table>
        </div>		
						</div>

				</section>

				<footer class="main-footer">
						<div class="pull-right hidden-xs">
							<b>Training and Certification System</b> Version 1.0
						</div>
						<strong>Copyright &copy; 2017-2018 <a href="<?php echo site_url();?>">admin.com</a>.</strong> All rights reserved.
				</footer>
		 
		<script src="<?= site_url("assets/js/theme.js") ?>"></script>

		<script>
				//theme = theme || {};

				theme.Skeleton.initialize();

		</script>

		</body>
</html>