<section role="main" class="content-body">
	<header class="page-header">
		<h2>SMS Template Settings</h2>

        <div class="right-wrapper">

        </div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
		<?php $this->load->view('admin/settings/settings_sidebar');?>
    	<div class="inner-body">
			<div class="col-lg-12">
                <form id="add-form" action="<?=base_url()?>instructor/settings/savesmstemp" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <section class="card">
                        <header class="card-header">

                            <h2 class="card-title">SMS Template</h2>
                        </header>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-lg-3 control-label text-lg-right pt-2" for="textareaAutosize">SMS</label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" rows="3" id="sms_template" name="sms_template" required="required" data-plugin-textarea-autosize><?= $sms_template?></textarea>
                                </div>
                            </div>



                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-primary modal-add-confirm btn-sm">Save</button>
                                    <button type="reset" id="btn_reset" class="btn btn-default btn-sm">Reset</button>
                                    <input type="hidden" name="editid" value="<?= $editid; ?>" />
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
