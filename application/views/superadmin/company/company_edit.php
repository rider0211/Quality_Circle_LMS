<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["companymanagement"]?></h2>
		<div class="right-wrapper">

		</div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <?php $verify = explode(',',$verify_by); ?>
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">

                <form id="add-form" action="<?= base_url()?>superadmin/company" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a class="btn btn-default" href="<?= base_url()?>superadmin/company"><i class="fas fa-table"></i> <?=$term["companylist"]?></a>
                            </div>
                            <h2 class="card-title"><?=$term["form"]?></h2>
                        </header>
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?php print $id?>">
                            
                            <?php if($id > 0){ ?>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Verification Method<span class="required">*</span></label>
                                <div class="col-lg-4" style="padding-top:10px;"> 
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" <?php if(in_array('email',$verify)){ ?>checked<?php } ?> name="verify_by[]" id="emailchkbox" value="email">By Email Address
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" <?php if(in_array('phone',$verify)){ ?>checked<?php } ?> name="verify_by[]" id="phonechkbox" value="phone">By Phone Number
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Two factor verification(OTP)<span class="required">*</span></label>
                                <div class="col-lg-4">
                                    <select name="otp_login" id="otp_login" class="form-control">
                                        <option <?php if($otp_login == 1){echo "selected";} ?> value="1">Yes</option>
                                        <option <?php if($otp_login == 2){echo "selected";} ?> value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <hr />
                        	<?php } ?>
                        
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["active"]?></label>
                                <div class="col-sm-2">
                                    <div class="switch switch-primary">
                                        <input type="checkbox" name="active" id="active" data-plugin-ios-switch <?php echo $active==1?'checked="checked"':'';?> />
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["enrollstatus"]?></label>
                                <div class="col-sm-2">
                                    <div class="switch switch-primary">
                                        <input type="checkbox" name="status" id="status" data-plugin-ios-switch <?php echo $status==1?'checked="checked"':'';?> />
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["discount"]?>(%)</label>
                                <div class="col-sm-2">
                                    <div class="switch switch-primary">
                                        <input type="number" name="discount" id="discount"  class="form-control" value="<?= $discount?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["name"]?><span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $name ?>" id="name" name="name" class="form-control" placeholder="company name"required>

                                </div>

                                <label class="col-sm-2 control-label text-sm-right pt-2">Url<span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $url ?>" id="url" name="url" class="form-control" placeholder="company name"required>

                                </div>


                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-lg-right pt-2"><?=$term["logo"]?></label>
                                <div class="col-sm-4">
                                    <!--<input type="file" id="picture" name="picture" class="form-control"/>-->
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists"><?=$term["change"]?></span>
                                                            <span class="fileupload-new"><?=$term["selectfile"]?></span>
                                                            <input type="file" id="picture" name="picture" src="<?php print $logo_path ?>"/>
                                                        </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?=$term["remove"]?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a id="sendBtn" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }"  class="btn btn-primary modal-add-confirm" style="color:white;    padding-left: 20px;padding-right: 20px;"><?php $id==0?print $term["add"]:print $term["update"]?></a>
                                    <button type="reset" class="btn btn-default"><?=$term["reset"]?></button>
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

    jQuery(document).ready(function() {

        $('[data-plugin-ios-switch]').each(function () {
            var $this = $(this);

            $this.themePluginIOS7Switch();
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
            send_action(frm);
        }

    });

    function send_action(frm){
        var formData = new FormData($('#add-form')[0]);
		
		<?php if($id > 0){ ?>
		
		var otp_login = $('#otp_login').val();
		if(otp_login == 1){
			var checkbox1 = checkbox2 = null;
			if($("#emailchkbox").is(':checked')){
				checkbox1 = $("input[id='emailchkbox']").val();	
			}
			if($("#phonechkbox").is(':checked')){
				checkbox2 = $("input[id='phonechkbox']").val();	
			}			
			if($('#otp_login').val() == '1'){
				if(checkbox1 == null && checkbox2 == null){
					new PNotify({
						title: '<?php echo $term['error']; ?>',
						text: 'Please choose atleast one verification method.',
						type: 'error'
					});
					return false;
				}
			}
		}
		
		<?php } ?>

        $("#sendBtn").trigger('loading-overlay:show');

        if($('#add-form .modal-add-confirm').html().indexOf('<?=$term["add"]?>') >= 0) {

            $.ajax({
                url: $('#base_url').val()+'superadmin/company/insert',
                type: 'POST',
                data: formData,
                processData:false,
                contentType: false,
                success: function (data, status, xhr) {
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo $term['succesfullyadded']; ?>',
                        type: 'success'
                    });
                    location.reload();
                },
                error: function(){
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        } else {
            $.ajax({
                url: $('#base_url').val()+'superadmin/company/update',
                type: 'POST',
                data: formData,
                processData:false,
                contentType: false,
                success: function (data, status, xhr) {
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['success']; ?>',
                        text: '<?php echo $term['succesfullyupdated']; ?>',
                        type: 'success'
                    });
                    location.reload();
                },
                error: function(){
                    $("#sendBtn").trigger('loading-overlay:hide');
                    new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                        type: 'error'
                    });
                }
            });
        }
    }
</script>
