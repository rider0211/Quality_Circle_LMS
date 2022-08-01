<!doctype html>
<html class="fixed sidebar-left-collapsed">
  <head>
    <meta charset="UTF-8">
    <title>LMS | LOGIN</title>
    <meta name="keywords" content="Login" />
    <meta name="description" content="LMS Login page">
    <meta name="author" content="ping.net">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery-ui/jquery-ui.theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/morris/morris.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.css" />
   
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
        <div style="font-size: 42px; font-weight: bold; margin: 0;text-align: center; line-height: 45px; color: #fff;padding: 0 20px 2px 20px;">
          <img src="<?php echo site_url('assets/img/logo.png');?>" width="200" alt="LMS" />
        </div>
        <div class="panel card-sign">
          <div class="mt-3">
            <h2 class="title font-weight-bold m-0"><?php echo $term['googletwofactorauthentication']; ?></h2>
          </div>
          <div class="card-body">
              <input type="hidden"  name="email" value="<?php echo $email; ?>" />
              <div class="form-group mb-3">
                <div style="text-align:center">
                  <h1>Verify your email to proceed</h1>
                  Please check your email and click on the link provided to verify your address. If you don’t get code  please resend
                </div>
              </div>
              <div class="row">                
                <div class="col-sm-12 text-center">
                  <button type="button" onclick="sendVerification('<?= $email?>')" class="btn btn-danger mt-2 mb-6 pb-6">Resend verification email</button>
                </div>
              </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </section>
    <footer>© <?php echo $term['copyrightallright']; ?></footer>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/common/common.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/pnotify/pnotify.custom.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/modernizr/modernizr.js"></script>
    <script>
      function sendVerification(email){
        $.ajax({
          url: '<?= base_url()?>login/resend_verification',
          type: 'POST',
          data: {'email': email},
          success: function (data, status, xhr) {
					if(data.success){
            new PNotify({
              title: 'Success!',
              text: data.msg,
              type: 'success'
            });
          }
				},
				error: function(){
					new PNotify({
            title: '<?php echo $term['error']; ?>',
            text: '<?php echo $term['youcantdeletethisitem']; ?>',
						type: 'error'
					});
				}
			});
      }
    </script>
  </body>
</html>