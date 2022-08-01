<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/elusive-icons/css/elusive-icons.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <?php if (empty($edit_course)):?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
    <?php endif;?>
    <!--    <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/css_company/main-style.css">-->

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/default.css" />

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css" />
    <script src="<?php echo base_url(); ?>assets/js_company/sweetalert.js"></script>

    <title>Question</title>
</head>
<style>
    .sidenav .closebtn {
        position: relative !important;
        float: right;
    }
    html .bg-light, html .background-color-light {
        background-color: #f8f9fa!important;
    }
    .card-title {
        text-transform: none;
        margin-bottom: 0.75rem;
    }
    .card-body{
        padding: 2.25rem;
    }
    .mt-5{
        border-color: #FAFAFA !important;
        border: 1px dotted !important;
        margin-top: 3rem !important;
    }
    .card-footer{
        padding-top:10px;
    }
    .card-footer div{
        padding-top:10px;
    }
    ol{
        padding-bottom: 10px;
    }
</style>

<body id="iframe_body" style="height: auto;">

	<!-- start: page -->

    <div class="row">
		<div class="col-lg-12">
			<div class="tabs">
				<div class="tab-content">
					<div class="tab-pane active">
						<section class="card">
							<div class="card-body">
								<div class="col-sm-12">
                                    <form class="form-group form-bordered" id="add-form" action="<?php echo base_url($company['company_url'])?>/demand/save_exam_feedback" method="POST" novalidate enctype="multipart/form-data">
                                    <input type="hidden" id="exam_id" name="exam_id" value="<?php echo $exam_id?>">
                                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id?>">
									<div class="control-group">
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											1. What I learned most from this course was:
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer1" name="answer1"></textarea>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											2. What I still need to learn more about is:
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer2" name="answer2"></textarea>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											3. I will apply the following in my organization:
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer3" name="answer3"></textarea>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											4. I will have difficulty applying the following to my organization:
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer4" name="answer4"></textarea>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											5. My overall feeling about the course is:
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer5" name="answer5"></textarea>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											6. The course might have been more effective if:
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer6" name="answer6"></textarea>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											7. Please rate and comment on the following:
										</label></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">1=Poor 2=Fair 3=Average 4=Good 5=Excellent<br>Course Content 1 2 3 4 5<br></label></br>
										<!--<input type="text" id="answer7_content" name="answer7_content" class="col-lg-12 form-control control-text"></br>-->
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_content" name="answer7_content" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Methods 1 2 3 4 5<br></label></br>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_method" name="answer7_method" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Materials 1 2 3 4 5<br></label></br>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_material" name="answer7_material" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Trainer __________ 1 2 3 4 5<br></label></br>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_trainer1" name="answer7_trainer1" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Trainer __________ 1 2 3 4 5<br></label></br>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_trainer2" name="answer7_trainer2" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Organization 1 2 3 4 5<br></label></br>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_organ" name="answer7_organ" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Facilities 1 2 3 4 5<br></label></br>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Poor"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Fair"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Average"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Good"></i></a>
                                            <a><i class="fa fa-star" data-toggle="tooltip" title="Excellent"></i></a>
									    </span>
                                        <input type="hidden" id="answer7_facilities" name="answer7_facilities" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Pre course organization/communication, advertising<br>&nbsp;Comments: (including length, daily hours, etc)</label></br>
										<input type="text" id="answer7_com" name="answer7_com" class="col-lg-12 form-control control-text"></br>
										<label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
											8. Any other comments: (use additional paper as necessary)
										</label></br>
                                        <textarea class="col-lg-12 form-control control-text" rows="3" id="answer8" name="answer8"></textarea>
									</div>
                                </div>
                                <button type="submit" class="btn" style="margin: 10px;margin-bottom: 0px;width: 100px;">Save</button>

							</div>
						</section>	
					</div>					
				</div>
			</div>
		</div>
	</div>
</body>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.js"></script>
<script src="<?php echo base_url(); ?>assets/js/imagesloaded.pkgd.min.js"></script>

<script>
    $('body').imagesLoaded().always(function () {
        change_parent_height();
    });

    $(document).ready(function() {

        $(".starReviewBox a").click(function () {
            $(this).parents('.starReviewBox').find('i').css('color', '');
            var siblings = $(this).prevAll('a');
            $(this).find('i').css('color', '#ffba00');
            siblings.find('i').css('color', '#ffba00');
            $(this).parents('.starReviewBox').next().val(siblings.length + 1);
        });
    });

    function change_parent_height() {
        var height = $('#iframe_body').height() + 50;
        $(window.top.document.getElementById('course_container')).height(height);
    }
</script>