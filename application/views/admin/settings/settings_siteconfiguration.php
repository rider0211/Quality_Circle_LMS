<section role="main" class="content-body">
	<header class="page-header">
		<h2>Site Configuration</h2>	
	</header>
	<?php $verify = explode(',',$verify_by); ?>
	<!-- start: page -->
	<div class="row">		
		<div class="col-lg-12">
			<article class="card">
                <header class="card-header">		
                    <h2 class="card-title">Site Configuration</h2>
                </header>
                <div class="card-body">
                    <form id="add-form" action="settings/saveSiteConfigurationSetting" enctype="multipart/form-data" method="POST" novalidate="novalidate">
                        <input type="hidden" name="editid" id="editid" value="<?php echo $id; ?>">
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Verification Method<span class="required">*</span></label>
                            <div class="col-lg-6 col-sm-8" style="padding-top:10px;"> 
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" <?php if(in_array('email',$verify)){ ?>checked<?php } ?> name="verify_by[]" id="emailchkbox" value="email">By Email Address
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" <?php	 if(in_array('phone',$verify)){ ?>checked<?php } ?> name="verify_by[]" id="phonechkbox" value="phone">By Phone Number
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 control-label text-sm-right pt-2">Two factor verification(OTP)<span class="required">*</span></label>
                            <div class="col-lg-6 col-sm-8">
                                <select name="otp_login" id="otp_login" class="form-control">
                                    <option <?php if($otp_login == 1){echo "selected";} ?> value="1">Yes</option>
                                    <option <?php if($otp_login == 2){echo "selected";} ?> value="2">No</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-left">
                            <button type="button" class="btn btn-primary modal-add-confirm" id="btn_save">Save</button>
                            <button type="reset" onclick="location.reload()" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </footer>
            </article>			
		</div>						
	</div>	
	<!-- end: page -->
</section>

<script>
    $(document).on('click', '.modal-add-confirm', function(e){
		
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
		
		var formData = new FormData($('#add-form')[0]);
		$.ajax({
			url: '<?=site_url()?>admin/settings/saveSiteConfigurationSetting',
			type: 'POST',
			data: formData,
			processData:false,
			contentType: false,
			success: function (data, status, xhr){
				new PNotify({
					title: '<?php echo $term['success']; ?>',
					text: '<?php echo $term['succesfullyupdated']; ?>',
					type: 'success'
				});
				$('#otp_login').focus();
			},
			error: function(){
				new PNotify({
					title: '<?php echo $term['error']; ?>',
					text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
					type: 'error'
				});
			}
		});
	});
</script>