<link href="<?=site_url()?>/assets/css/demo.css?v=3" rel="stylesheet" />
<link href="<?=site_url()?>/assets/css/email-editor.bundle.min.css?<?php echo rand(10,1000)?>" rel="stylesheet" />
<link href="<?=site_url()?>/assets/css/colorpicker.css" rel="stylesheet" />

<link href="<?=site_url()?>/assets/css/editor-color.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=site_url()?>/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
<link href="<?=site_url()?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<style>
	.mce-content-body{
		margin-left: 0px !important;
		height: auto !important;
		min-height: 500px !important;
		max-height: 3500px !important;
	}
	.left-menu-container{
		position: relative;
		height: 900px;
		z-index: 1;
	}
	.editor-container .content .content-wrapper{
		position: relative;
		width: 100%;
		z-index: 1;
		margin-top: -75px;
	}
	.modal-header .close{
		top: 0;
		padding: 0;
		margin: 0;
		color: black;
		right: 0;
	}
	.popup_images .upload-images{
		display: none;
	}
	.popup_images .btn-upload{
		display: none;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Email Template Settings</h2>

        <div class="right-wrapper">

        </div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
    	<div class="card-body">
    		<div class="col-sm-12">
    			<section class="card">
	                <header class="card-header">	
	                    <h2 class="card-title">Email Template</h2>
	                </header>
	                <form class="form-horizontal form-bordered form-bordered" method="post" action="<?=base_url()?>instructor/settings/saveemailtemplate">
		                <div class="card-body">
		                	<div class="mailbox-compose">
		                		<div class="form-group ">
		                			<div class="col-md-4">
					                	<select class="form-control mt-3" id="tmp_chng">
					                		<!--<option value="">Choose Template</option>
					                		<option value="welcome_email" <?php echo ($this->input->get('email') == 'welcome_email') ? 'selected' : '';?>>Welcome email when account created</option>
					                		<option value="forgotten_password" <?php echo ($this->input->get('email') == 'forgotten_password') ? 'selected' : '';?>>Forgotten Password</option>
					                		<option value="password_reset" <?php echo ($this->input->get('email') == 'password_reset') ? 'selected' : '';?>>Password Reset</option>
					                		<option value="feedback_received" <?php echo ($this->input->get('email') == 'feedback_received') ? 'selected' : '';?>>Feedback received</option>
					                		<option value="exam_passed" <?php echo ($this->input->get('email') == 'exam_passed') ? 'selected' : '';?>>Exam passed successfully the certificate should be attached</option>
					                		<option value="exam_not_passed" <?php echo ($this->input->get('email') == 'exam_not_passed') ? 'selected' : '';?>>Exam not passed</option>
											<option value="assign_training" <?php echo ($this->input->get('email') == 'assign_training') ? 'selected' : '';?>>Assign Training</option>
											<option value="assign_exam" <?php echo ($this->input->get('email') == 'assign_exam') ? 'selected' : '';?>>Assign Exam</option>-->
                                            <option value="">Choose Template</option>
                                            <option value="welcome_email" <?php echo ($this->input->get('email') == 'welcome_email') ? 'selected' : '';?>>When users sign up for a course.</option>

                                            <option value="assign_course" <?php echo ($this->input->get('email') == 'assign_course') ? 'selected' : '';?>>Users are assigned a course by admin</option>
                                            <option value="complete_course" <?php echo ($this->input->get('email') == 'complete_course') ? 'selected' : '';?>>Users complete a course</option>
                                            <option value="success_certificate" <?php echo ($this->input->get('email') == 'success_certificate') ? 'selected' : '';?>>Users receive certificate successfully</option>
                                            <option value="fail_certificate" <?php echo ($this->input->get('email') == 'fail_certificate') ? 'selected' : '';?>>Users didn't receive certificate or failed exam</option>
                                            <option value="notice_date" <?php echo ($this->input->get('email') == 'notice_date') ? 'selected' : '';?>>Notices about course dates</option>
                                            <option value="IA_complete_course" <?php echo ($this->input->get('email') == 'IA_complete_course') ? 'selected' : '';?>>Instructor & Admin gets email when a course is completed</option>
                                            <option value="IA_complete_exam" <?php echo ($this->input->get('email') == 'IA_complete_exam') ? 'selected' : '';?>>Instructor & Admin gets notification of completion of exams</option>
                                            <option value="IA_enroll" <?php echo ($this->input->get('email') == 'IA_enroll') ? 'selected' : '';?>>Instructor & Admin gets notification when there is enrollment</option>
                                            <option value="signup_company" <?php echo ($this->input->get('email') == 'signup_company') ? 'selected' : '';?>>When company sign up for a course.</option>
                                            <option value="course_participation_filled" <?php echo ($this->input->get('email') == 'course_participation_filled') ? 'selected' : '';?>>Instructor & Admin gets email when a course participation gets filled</option>
                                            <option value="new_course_scheduled" <?php echo ($this->input->get('email') == 'new_course_scheduled') ? 'selected' : '';?>>Participants gets email when new course scheduled</option>
											<option value="new_course_arrival" <?php echo ($this->input->get('email') == 'new_course_arrival') ? 'selected' : '';?>>New Course Arrival Cron Job Mail</option>
											<option value="user_otp_login" <?php echo ($this->input->get('email') == 'user_otp_login') ? 'selected' : '';?>>User OTP Login</option>

										</select>
					                </div>

		                		</div>

								<div class="form-group form-group-invisible">
									<label class="col-sm-4 control-label bld" for="inputDefault">Subject</label>
									<div class="col-md-12 mailbox-compose-field">
										<input id="subject" name="subject" type="text" class="form-control" value="<?php echo $subject?>" autocomplete="off" required="required">
									</div>
								</div>
		                		<div class="form-group">
				                	<div class="col-md-12">
					                	<button id='save_btn' class="btn btn-success"><?=$term["save"]?></button>
				                	</div>
				            	</div>
								<div class="form-group">
									<div class="col-lg-12">
										<div class="elements-db" style="display:none">
											<div class="tab-elements element-tab active">
												<ul class="elements-accordion">
													<?php echo $_outputHtml ?>
												</ul>
											</div>
										</div>
										<div class="editor" style="width:100%;">
										</div>
										<div id="previewModal" class="modal fade" role="dialog">
											<div class="modal-dialog modal-lg">
												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Preview</h4>
													</div>
													<div class="modal-body">
														<div class="">
															<label for="">URL : </label> <span class="preview_url"></span>
														</div>
														<iframe id="previewModalFrame" width="100%" height="400px"></iframe>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>

											</div>
										</div>
										<div id="demp"></div>
									</div>
								</div>
							</div>
		                </div>
						<footer class="card-footer">
		                    <div class="row">
		                        <div class="col-md-12 text-center">
		                            <input type="hidden" id="editid" name="editid" value="<?php echo $editid;?>" />
		                            <input type="hidden" id="action" name="action" value="<?php echo $this->input->get('email');?>" />
		                        </div>
 		                        <?php if($this->input->get('email') == 'welcome_email' 
 		                        	  || $this->input->get('email') == 'notice_date'
 		                        		|| $this->input->get('email') == 'assign_course'
 		                        		|| $this->input->get('email') == 'success_certificate'
 		                        		|| $this->input->get('email') == 'fail_certificate'
 		                        		|| $this->input->get('email') == 'fail_certificate'){?>
                                    <div class="col-md-12">
                                        <strong>Template Tags</strong>
                                        <ul>
                                            <li>{USERNAME}</li>
                                            <li>{COURSE_NAME}</li>
                                            <li>{LOGO}</li>
                                            <li>{CATEGORY}</li>
                                            <li>{STANDARD}</li>
                                            <li>{LOCATION}</li>
                                        </ul>
                                    </div>
		                        <?php }?>
		                        <?php if($this->input->get('email') == 'IA_complete_course'
		                    			|| $this->input->get('email') == 'IA_complete_exam'
		                    			|| $this->input->get('email') == 'IA_enroll' || $this->input->get('email') == 'course_participation_filled'){?>
		                        	<div class="col-md-12">
                                        <strong>Template Tags</strong>
                                        <ul>
                                            <li>{ADMIN_USERNAME}</li>
                                            <li>{COURSE_NAME}</li>
                                            <li>{LEANER_NAME}</li>
                                            <li>{LOGO}</li>
                                            <li>{CATEGORY}</li>
                                            <li>{STANDARD}</li>
                                        </ul>
                                    </div>
                                <?php }?>
                                <?php if($this->input->get('email') == 'forgotten_password'){?>
                                    <div class="col-md-12">
                                        <strong>Template Tags</strong>
                                        <ul>
                                            <li>{FIRSTNAME}</li>
                                            <li>{LASTNAME}</li>
                                            <li>{PASS_KEY_URL}</li>
                                            <li>{SITE_NAME}</li>
                                        </ul>
                                    </div>
                                <?php }?>
                                <?php if($this->input->get('email') == 'password_reset'){?>
                                    <div class="col-md-12">
                                        <strong>Template Tags</strong>
                                        <ul>
                                            <li>{FIRSTNAME}</li>
                                            <li>{LASTNAME}</li>
                                            <li>{EMAIL}</li>
                                            <li>{PASSWORD}</li>
                                            <li>{SITE_NAME}</li>
                                        </ul>
                                    </div>
                                <?php }?>

                                <?php if($this->input->get('email') == 'feedback_received'){?>
                                    <div class="col-md-12">
                                        <strong>Template Tags</strong>
                                        <ul>
                                            <li>{FIRSTNAME}</li>
                                            <li>{LASTNAME}</li>
                                            <li>{SENDER}</li>
                                            <li>{MESSAGE}</li>
                                            <li>{SITE_NAME}</li>
                                        </ul>
                                    </div>
                                <?php }?>

                                <?php if($this->input->get('email') == 'new_course_scheduled'){?>
                                    <div class="col-md-12">
                                        <strong>Template Tags</strong>
                                        <ul>
                                            <li>{USERNAME}</li>
                                            <li>{COURSE_NAME}</li>
                                            <li>{CATEGORY_NAME}</li>
                                            <li>{START_DATE}</li>
                                            <li>{END_DATE}</li>
                                            <li>{LOGO}</li>
                                        </ul>
                                    </div>
                                <?php }?>  

		                    </div>
		                </footer>
	              	</form>
				</section>	    		
    		</div>					
		</div>
	</div>
	
	<!-- end: page -->
</section>
<script src="<?=site_url()?>/assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=site_url()?>/assets/vendor/jquery-nicescroll/dist/jquery.nicescroll.min.js"></script>
<!--for ace editor  -->
<script src="<?=site_url()?>/assets/js/ace.js" type="text/javascript"></script>
<script src="<?=site_url()?>/assets/js/theme-monokai.js" type="text/javascript"></script>
<!--for tinymce  -->
<script src="<?=site_url()?>/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?=site_url()?>/assets/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?=site_url()?>/assets/js/colorpicker.js"></script>
<script src="<?=site_url()?>/assets/js/email-editor-plugin.js?<?php echo rand(10,1000)?>"></script>
<!--for bootstrap-tour  -->
<script src="<?=site_url()?>/assets/vendor/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<style type="text/css">
    .colorpicker div{
        position: absolute!important;
    }
</style>
<script>

$(function(){
    if(!$("html").hasClass("sidebar-left-collapsed"))
    {
        $("html").addClass("sidebar-left-collapsed");
        $("html").removeClass("sidebar-left-opened");
    }

	$('#tmp_chng').on('change', function() {
		var val = $(this).val();
		window.location.href = '<?php echo base_url('instructor/settings/emailtemp/')?>?email='+val;
	});

	$('#save_btn').on('click',function(e){
		e.preventDefault();
		$.ajax({
			url: '<?=site_url()?>admin/settings/saveemailtemplate',
			type: 'POST',
			//dataType: 'json',
			data: {
				subject: $('#subject').val(),
				action: $('#action').val(),
				editid: $('#editid').val(),
				content:'<html>' + $('.content-wrapper .email-editor-elements-sortable').html() + '</html>'
			},
			success: function(data) {
				//  console.log(data);
				new PNotify({
					title: '<?php echo $term['success']; ?>',
					text: '<?php echo $term['successfullysaved']; ?>',
					type: 'success'
				});
				var val = $("#tmp_chng").val();
				window.location.href = '<?php echo base_url('instructor/settings/emailtemp/')?>?email='+val;
				if (data === 'ok') {
					$('#popup_save_template').modal('hide');

				} else {
					$('.input-error').text('Problem in server');
				}

			},
			error: function(error) {
				$('.input-error').text('Internal error');
			}
		});
	});

	//

	var _is_demo = true;

function loadImages() {
	/*$.ajax({
	 url: 'get-files.php',
	 type: 'GET',
	 dataType: 'json',
	 success: function(data) {
	 if (data.code == 0) {
	 _output = '';
	 for (var k in data.files) {
	 if (typeof data.files[k] !== 'function') {
	 _output += "<div class='col-sm-3'>" +
	 "<img class='upload-image-item' src='" + data.directory + data.files[k] + "' alt='" + data.files[k] + "' data-url='" + data.directory + data.files[k] + "'>" +
	 "</div>";
	 }
	 }
	 $('.upload-images').html(_output);
	 }
	 },
	 error: function() {}
	 });*/
}

var _templateListItems;

var  _emailBuilder=  $('.editor').emailBuilder({
	//new features begin

	showMobileView: false,
	onTemplateDeleteButtonClick:function (e,dataId,parent) {
		/*$.ajax({
		 url: 'delete_template.php',
		 type: 'POST',
		 data: {
		 templateId: dataId
		 },
		 dataType: 'json',
		 success: function(data) {
		 parent.remove();
		 },
		 error: function() {}
		 });*/
	},
	//new features end

	lang: 'en',
	elementsHTML: $('.elements-db').html(),
	langJsonUrl: '<?=base_url()?>assets/email_template/lang-1.json',
	loading_color1: 'red',
	loading_color2: 'green',
	showLoading: true,
	image_upload_url: '<?=site_url()?>instructor/library/upload_library_image',

	blankPageHtmlUrl: '<?=base_url()?>assets/email_template/template-blank-page.html',
	loadPageHtmlUrl: '<?=base_url()?>assets/email_template/template-load-page.html',

	//left menu
	showElementsTab: true,
	showPropertyTab: true,
	showCollapseMenu: true,
	showBlankPageButton: true,
	showCollapseMenuinBottom: true,

	//setting items
	showSettingsBar: true,
	showSettingsPreview: false,
	showSettingsExport: true,
	showSettingsImport: false,
	showSettingsSendMail: false,
	showSettingsSave: true,
	showSettingsLoadTemplate: false,

	//show context menu
	showContextMenu: true,
	showContextMenu_FontFamily: true,
	showContextMenu_FontSize: true,
	showContextMenu_Bold: true,
	showContextMenu_Italic: true,
	showContextMenu_Underline: true,
	showContextMenu_Strikethrough: true,
	showContextMenu_Hyperlink: true,

	//show or hide elements actions
	showRowMoveButton: true,
	showRowRemoveButton: true,
	showRowDuplicateButton: true,
	showRowCodeEditorButton: true,
	onSettingsExportButtonClick: function(e, getHtml) {
		var arr=[];
		var count=0;
		$('.content-main .sortable-row-content').each(function (i,item) {
			_dataId=$(this).attr('data-id');
			_html=$(this).html();
			arr[i]={id:_dataId,content:_html};
			if (_dataId!==undefined) {
				count++;
			}
		});
		if (count==0) {
			alert('Please add email blocks from the left menu, otherwise you cannot save');
			return false;
		}
		console.log('onSettingsExportButtonClick html');
		$.ajax({
			url: '<?=site_url()?>instructor/library/create_pdf',
			type: 'POST',
			data: {
				html: getHtml
			},
			dataType: 'json',
			success: function(data) {
				if (data.code == -5) {
					$('#popup_demo').modal('show');
				} else if (data.code == 0) {
					window.location.href = data.url;
				}
			},
			error: function() {}
		});
		//e.preventDefault();
	},
	onPopupSaveButtonClick: function() {
/*		var arr=[];
		var count=0;
		$('.content-main .sortable-row-content').each(function (i,item) {
			_dataId=$(this).attr('data-id');
			_html=$(this).html();
			arr[i]={id:_dataId,content:_html};
			if (_dataId!==undefined) {
				count++;
			}
		});
		if (count==0) {
			alert('Please add email blocks from the left menu, otherwise you cannot save');
			return false;
		}*/
	},
	onBeforeChangeImageClick: function(e) {
		console.log('onBeforeChangeImageClick html');
		loadImages();
	},
	//when u press load template button, u should show the list of templates
	onBeforeSettingsLoadTemplateButtonClick: function(e) {



	},
	//if u select an item of template list and press load button, u should get the html content of that template
	onBeforePopupSelectTemplateButtonClick: function(dataId) {
		$.ajax({
			url: 'get_template_blocks.php',
			type: 'POST',
			//dataType: 'json',
			data: {
				id: dataId
			},
			success: function(data) {
				data=JSON.parse(data);
				$('.content-wrapper .email-editor-elements-sortable').html('');
				for (var i = 0; i < data.blocks.length; i++) {
					_content='';
					_content += '<div class="sortable-row">' +
							'<div class="sortable-row-container">' +
							' <div class="sortable-row-actions">';

					_content += '<div class="row-move row-action">' +
							'<i class="fa fa-arrows-alt"></i>' +
							'</div>';


					_content += '<div class="row-remove row-action">' +
							'<i class="fa fa-remove"></i>' +
							'</div>';


					_content += '<div class="row-duplicate row-action">' +
							'<i class="fa fa-files-o"></i>' +
							'</div>';


					_content += '<div class="row-code row-action">' +
							'<i class="fa fa-code"></i>' +
							'</div>';

					_content += '</div>' +

							'<div class="sortable-row-content" data-id='+data.blocks[i].block_id+' data-types='+data.blocks[i].property+'  data-last-type='+data.blocks[i].property.split(',')[0]+'>' +
							data.blocks[i].content+
							'</div></div></div>';
					$('.content-wrapper .email-editor-elements-sortable').append(_content);

				}
				$('.content-wrapper').css('background-color',data.template.bg_color);

			},
			error: function(error) {
				$('.input-error').text('Internal error');
			}
		});
	}
});
_emailBuilder.setAfterLoad(function(e) {
	_emailBuilder.makeSortable();
	$('.elements-db').remove();

	setTimeout(function(){
		_emailBuilder.makeSortable();
		_emailBuilder.makeRowElements();


	$('.setting-item.save-template').on('click',function(e){
		e.preventDefault();
		$.ajax({
			url: '<?=site_url()?>instructor/settings/saveemailtemplate',
			type: 'POST',
			//dataType: 'json',
			data: {
				subject: $('#subject').val(),
				action: $('#action').val(),
				editid: $('#editid').val(),
				content:'<html>' + $('.content-wrapper .email-editor-elements-sortable').html() + '</html>'
			},
			success: function(data) {
				//  console.log(data);
				new PNotify({
					title: '<?php echo $term['success']; ?>',
					text: '<?php echo $term['successfullysaved']; ?>',
					type: 'success'
				});
				var val = $("#tmp_chng").val();
				window.location.href = '<?php echo base_url('instructor/settings/emailtemp/')?>?email='+val;
				if (data === 'ok') {
					$('#popup_save_template').modal('hide');

				} else {
					$('.input-error').text('Problem in server');
				}

			},
			error: function(error) {
				$('.input-error').text('Internal error');
			}
		});
	});
	$('.template-list').html('<div style="text-align:center">Loading...</div>');
	<?php if ($message != ""):?>
		$('.content-wrapper .email-editor-elements-sortable').html('<?=$message?>');
	<?php endif;?>
	},1000);
});
});


</script>