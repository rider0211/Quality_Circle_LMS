<section role="main" class="content-body th_s">

	<header class="page-header">
		<h2><i class="fas fa-cog"></i>Theme Settings</h2>
        <div class="right-wrapper">
        </div>
	</header>

    <input type="hidden" id="base_url" value="<?= base_url()?>">

	<!-- start: page -->

	<div class="row">
		<?php $this->load->view('instructor/settings/settings_sidebar');?>
    	<div class="inner-body">
			<div class="col-lg-12">
                <form id="add-form" action="<?=base_url()?>instructor/settings/savetheme" method="POST" novalidate="novalidate" enctype="multipart/form-data">

                    <section class="card">
                        <header class="card-header">
                            <h2 class="card-title"><i class="fas fa-sliders-h"></i> Theme</h2>
                        </header>

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Site Name</label>
                                <div class="col-sm-5">
                                    <input type="text"  class="form-control" value="<?= $site_name?>" id="site_name" name="site_name"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Login Title</label>
                                <div class="col-sm-5">
                                    <input type="text"  class="form-control" value="<?= $login_title?>" id="login_title" name="login_title"/>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Header Color</label>
                                <div class="col-sm-5">
                                	<div class="input-group color" data-plugin-colorpicker>
										<span class="input-group-prepend"><span class="input-group-text input-group-addon"><i></i></span></span>
										<input type="text" class="form-control" name="header_color" id="header_color" value="<?= $header_color?>" >

                                    </div>
                                </div>
                               <span style="font-weight: bold; color: red;">Put blank to use default color.</span>

                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Navigation Color</label>
                                <div class="col-sm-5">
                                	<div class="input-group color" data-plugin-colorpicker>
										<span class="input-group-prepend"><span class="input-group-text input-group-addon"><i></i></span></span>
										<input type="text" class="form-control" name="navigation_color" id="navigation_color" value="<?= $navigation_color?>" >
									</div>
                                </div>
                                <span style="font-weight: bold; color: red;">Put blank to use default color.</span>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Font Color</label>
                                <div class="col-sm-5">
                                	<div class="input-group color" data-plugin-colorpicker>
										<span class="input-group-prepend"><span class="input-group-text input-group-addon"><i></i></span></span>
										<input type="text" class="form-control" name="font_color" id="font_color" value="<?= $font_color?>" >
									</div>
                                </div>
                                <span style="font-weight: bold; color: red;">Put blank to use default color.</span>
                            </div>


                            <!--<div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"></label>
                                <div class="col-sm-3">
                                    <img src="<?php //print base_url() ?><? //echo $logo?>" width="50" height="50" class="rounded img-fluid">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"></label>

                                <div class="col-sm-3">

                                    <img src="<?php //print base_url() ?><? // echo $favicon?>" width="50" height="50" class="rounded img-fluid">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault"></label>

                                <div class="col-sm-3">

                                    <img src="<?php //print base_url() ?><? //echo $login_bg?>" width="50" height="50" class="rounded img-fluid">

                                </div>

                            </div>-->



                            <div class="form-group row">

                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Logo</label>

                                <div class="col-sm-8">

                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="input-append">

                                            <div class="uneditable-input">

                                                <i class="fas fa-file fileupload-exists"></i>

                                                <span class="fileupload-preview"></span>

                                            </div>

                                            <span class="btn btn-default btn-file">

                                                            <span class="fileupload-exists">Change</span>

                                                            <span class="fileupload-new">Select file</span>

                                                            <input type="file" id="logo" name="logo" src="<?= $logo?>"/>

                                                        </span>

                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            <?php if($logo) {?>											
			                                    <img src="<?php print base_url(). $logo?>" width="50" height="50" class="rounded img-fluid">
			                                <?php } else echo '<i class="fas fa-cloud-upload-alt"></i>';?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Favicon</label>

                                <div class="col-sm-8">

                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="input-append">

                                            <div class="uneditable-input">

                                                <i class="fas fa-file fileupload-exists"></i>

                                                <span class="fileupload-preview"></span>

                                            </div>

                                            <span class="btn btn-default btn-file">

                                                            <span class="fileupload-exists">Change</span>

                                                            <span class="fileupload-new">Select file</span>

                                                            <input type="file" id="favicon" name="favicon" src="<?= $favicon?>"/>

                                                        </span>

                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            <?php if($favicon) {?>											
			                                    <img src="<?php print base_url(). $favicon?>" width="50" height="50" class="rounded img-fluid">
			                                <?php } else echo '<i class="fas fa-cloud-upload-alt"></i>';?>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Login BG</label>

                                <div class="col-sm-8">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>

                                            <span class="btn btn-default btn-file">
                                            	<span class="fileupload-exists">Change</span>
												<span class="fileupload-new">Select file</span>
												<input type="file" id="login_bg" name="login_bg" src="<?= $login_bg?>"/>
											</span>

                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            <?php if($login_bg) {?>											
			                                    <img src="<?php print base_url(). $login_bg?>" width="50" height="50" class="rounded img-fluid">
			                                <?php } else echo '<i class="fas fa-cloud-upload-alt"></i>';?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary modal-add-confirm btn-sm">Save Changes</button>
									<input type="hidden" name="editid" value="<?= $id;?>" />
                                    <button type="reset" id="btn_reset" class="btn btn-default btn-sm">Reset</button>

                                </div>

                            </div>

                        </footer>

                    </section>

                </form>

			</div>

		</div>

	</div>

	

	<!-- end: page -->

</section>



<script>



    jQuery(document).ready(function() {

        $('[data-plugin-colorpicker]').each(function() {

            var $this = $( this );



            $this.themePluginColorPicker();

        });

    });



    $(document).on('click', '.modal-add-confirm', function (e) {

        e.preventDefault();

        var frm = $('#add-form');

        frm.validate({

            highlight: function( label ) {

                $(label).closest('.form-group').removeClass('has-success').addClass('has-error');

            },

            success: function( label ) {

                $(label).closest('.form-group').removeClass('has-error');

                label.remove();



            },

            errorPlacement: function( error, element ) {

                var placement = element.closest('.input-group');

                if (!placement.get(0)) {

                    placement = element;

                }

                if (error.text() !== '') {

                    placement.after(error);

                }

            }

        });



        if(frm.valid()) {



            $('#add-form').submit();

            //<?=base_url()?>instructor/settings/savetheme

            /*var formData = new FormData($('#add-form')[0]);

            $.ajax({

                url: $('#base_url').val()+'admin/settings/savetheme',

                type: 'POST',

                data: formData,

                processData:false,

                contentType: false,

                success: function (data, status, xhr) {



                    new PNotify({

                        title: 'Success!',

                        text: 'Save!',

                        type: 'success'

                    });



                    $('#add-form').submit();

                },

                error: function(){

                    new PNotify({

                        title: 'Error!',

                        text: 'Insert Fail! Retry!',

                        type: 'error'

                    });

                }

            });*/

        }



    });

</script>

