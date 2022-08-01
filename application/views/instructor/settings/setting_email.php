<section role="main" class="content-body">
    <header class="page-header">
        <h2>Email Settings</h2>

        <div class="right-wrapper">

        </div>
    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
    
	<?php $this->load->view('admin/settings/settings_sidebar');?>
	<div class="inner-body">	
        <div class="col-lg-12">		
            <form id="add-form" action="<?=base_url()?>instructor/settings/saveemail" method="POST" novalidate="novalidate" enctype="multipart/form-data">
            <section class="card">
                <header class="card-header">

                    <h2 class="card-title">Global</h2>
                </header>
                <div class="card-body">					
                    <div class="form-group row">
                    	<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">Company Email <em class="red">*</em></label>  
                    	<div class="col-sm-4">                        	                      
                            <input type="email" required="required" class="form-control" value="<?php echo $company_email;?>" id="company_email" name="company_email"/>
                        </div>
                   </div>
                   <div class="form-group row">
                   		<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">Billing Email</label>
                        <div class="col-sm-4">            
                            <input type="text"  class="form-control" value="<?php echo $billing_email;?>" id="" name="billing_email"/>
                        </div>
                   </div>
                   <div class="form-group row">
                   		<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">Support Email <em class="red">*</em></label>
                        <div class="col-sm-4">                      
                            <input type="email" required="required" class="form-control" value="<?php echo $support_email;?>" id="" name="support_email"/>
                        </div>
                   </div>
                   <div class="form-group row">                        
                       <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">Email protocol <em class="red">*</em></label>                        
                       <div class="col-sm-4">       
                            <select class="form-control" name="type" required="required">
                            	<option value="">--Select--</option>
                            	<option value="phpmail" <?php echo ($type == 'phpmail') ? 'selected' : '';?>>PHP Mail</option>
                            	<option value="smtp" <?php echo ($type == 'smtp') ? 'selected' : '';?>>SMTP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                    	<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">SMTP-Host</label>
                    	<div class="col-sm-4"> 
                    		<input type="text"  class="form-control" value="<?php echo $smtp_host;?>" id="" name="smtp_host"/>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">SMTP-User</label>
                       <div class="col-sm-4"> 
                       		<input type="text"  class="form-control" value="<?php echo $smtp_user;?>" id="" name="smtp_user"/>
                       </div>
                    </div>
                    <div class="form-group row">
                    	<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">SMTP-Password</label>  
                    	<div class="col-sm-4">
                    		<input type="text"  class="form-control" value="<?php echo $smtp_password;?>" id="" name="smtp_password"/>
                    	</div>
                   	</div>
                   	<div class="form-group row">
                   		<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">SMTP-Port</label>
                   		<div class="col-sm-4">
                   			<input type="text"  class="form-control" value="<?php echo $smtp_port;?>" id="" name="smtp_port"/>
                   		</div>
                   	</div>
         			<div class="form-group row">
                   		<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">Email Encryption</label>
                    	<div class="col-sm-4">
                    		<select class="form-control" name="mail_ecription">
                    			<option value="">None</option>
                    			<option value="ssl" <?php echo ($mail_ecription == 'ssl') ? 'selected' : '';?>>SSL</option>
                    			<option value="tls" <?php echo ($mail_ecription == 'tls') ? 'selected' : '';?>>TLS</option>
                                <option value="starttls" <?php echo ($mail_ecription == 'starttls') ? 'selected' : '';?>>STARTTLS</option>
                    		</select>
                    	</div>
                    </div>                  
                </div>               
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-primary modal-add-confirm btn-sm">Save Changes</button>
                            <button type="reset" id="btn_reset" class="btn btn-default btn-sm">Reset</button>
                            <input type="hidden" name="editid" value="<?php echo $editid;?>" />
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

    }

});
</script>
