<section role="main" class="content-body">
	<header class="page-header">
		<h2>Theme Settings</h2>

        <div class="right-wrapper">

        </div>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">

                <form id="add-form" action="" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a class="btn btn-default" href="/user/"><i class="fas fa-table"></i> User List</a>
                            </div>
                            <h2 class="card-title">Admin Add Form</h2>
                        </header>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-sm-1 control-label text-sm-right pt-2">Site Name</label>
                                <div class="col-sm-3">
                                    <input type="text"  class="form-control" value="" id="" name=""/>
                                </div>
                                <label class="col-sm-1 control-label text-sm-right pt-2">Login Title</label>
                                <div class="col-sm-3">
                                    <input type="text"  class="form-control" value="" id="" name=""/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-1 control-label text-sm-right pt-2">Header Color</label>
                                <div class="col-sm-3">
                                    <input type="text" data-plugin-colorpicker class="colorpicker-default form-control" value="#8fff00"/>
                                </div>
                                <label class="col-sm-1 control-label text-sm-right pt-2">Navigation Color</label>
                                <div class="col-sm-3">
                                    <input type="text" data-plugin-colorpicker class="colorpicker-default form-control" value="#8fff00"/>
                                </div>
                                <label class="col-sm-1 control-label text-sm-right pt-2">Font Color</label>
                                <div class="col-sm-3">
                                    <input type="text" data-plugin-colorpicker class="colorpicker-default form-control" value="#8fff00"/>
                                </div>
                            </div>

                            

                            <div class="form-group row">
                                <label class="col-sm-1 control-label text-lg-right pt-2">Logo</label>
                                <div class="col-sm-3">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists">Change</span>
                                                            <span class="fileupload-new">Select file</span>
                                                            <input type="file" id="" name="" src=""/>
                                                        </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-1 control-label text-lg-right pt-2">Favicon</label>
                                <div class="col-sm-3">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists">Change</span>
                                                            <span class="fileupload-new">Select file</span>
                                                            <input type="file" id="" name="" src=""/>
                                                        </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-1 control-label text-lg-right pt-2">Login BG</label>
                                <div class="col-sm-3">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists">Change</span>
                                                            <span class="fileupload-new">Select file</span>
                                                            <input type="file" id="" name="" src=""/>
                                                        </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary modal-add-confirm">Save</button>
                                    <button type="reset" id="btn_reset" class="btn btn-default">Reset</button>
                                </div>
                            </div>
                        </footer>
                    </section>
                </form>

		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
    /*
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {

        $('[data-plugin-colorpicker]').each(function() {
            var $this = $( this );

            $this.themePluginColorPicker()
        });
        var dz = new Dropzone('#dzuploadfile', {
            url: 'uploadfile',
            addRemoveLinks: true,
            uploadMultiple: false,
            autoQueue: false,
            acceptedFiles: "image/jpeg, image/png",
            params: {}
        });

    });
    */
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


            var formData = new FormData($('#add-form')[0]);
            if($('#add-form .modal-add-confirm').html() == 'Add') {
                $.ajax({
                    url: '/user/add',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {

                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyadded']; ?>',
                            type: 'success'
                        });

                        $('#btn_reset').trigger('click');
                        $('#first_name').focus();
                        //$.magnificPopup.close();
                    },
                    error: function(){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'error'
                        });
                    }
                });
            } else {
                $.ajax({
                    url: '/user/change',
                    type: 'POST',
                    data: formData,
                    processData:false,
                    contentType: false,
                    success: function (data, status, xhr) {

                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyupdated']; ?>',
                            type: 'success'
                        });
                        $.magnificPopup.close();
                    },
                    error: function(){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'error'
                        });
                    }
                });
            }

        }

    });
</script>
