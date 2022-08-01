<section role="main" class="content-body">
    <header class="page-header">
        <h2>Notification Settings</h2>

        <div class="right-wrapper">

        </div>
    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
    
	<?php $this->load->view('admin/settings/settings_sidebar');?>
	<div class="inner-body">	
        <div class="col-lg-12">		
            <form id="add-form" action="<?=base_url()?>admin/settings/savenotification" method="POST" novalidate="novalidate" enctype="multipart/form-data">
            <section class="card">
                <header class="card-header">

                    <h2 class="card-title">Notifications</h2>
                </header>
                <div class="card-body">					
                    <div class="form-group row">
                    	<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">SMS Active</label>  
                    	<div class="col-sm-4">                        	                      
                            <div class="switch switch-primary">
								<input type="checkbox" name="actve" value="Y" data-plugin-ios-switch <?php echo ($sms_active == 'Y') ? 'checked="checked"' :'';?> />
							</div>
                        </div>
                   </div>
                   
                   <div class="form-group row">                        
                       <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">Provider</label>                        
                       <div class="col-sm-4">       
                            <select class="form-control" name="provider">
                            	<option value="">--Select--</option>
                            	<option value="Plivio" <?php echo ($provider == 'Plivio') ? 'selected' : '';?>>Plivio SMS Gateway</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    	<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault">API URL</label>
                       <div class="col-sm-4"> 
                       		<input type="text"  class="form-control" value="<?php echo $api_url;?>" id="" name="api"/>
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
(function($) {

	'use strict';

	if ( typeof Switch !== 'undefined' && $.isFunction( Switch ) ) {

		$(function() {
			$('[data-plugin-ios-switch]').each(function() {
				var $this = $( this );

				$this.themePluginIOS7Switch();
			});
		});

	}

}).apply(this, [jQuery]);
</script>