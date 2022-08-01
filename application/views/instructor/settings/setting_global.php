<section role="main" class="content-body">
    <header class="page-header">
        <h2><?=$term["globalsettings"]?></h2>

        <div class="right-wrapper">

        </div>

    </header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
    <!-- start: page -->
    <div class="row">
    	<?php $this->load->view('admin/settings/settings_sidebar');?>
    	<div class="inner-body">
	        <div class="col-lg-12">
			
	            <form id="add-form" action="<?=base_url()?>instructor/settings/savegeneral" method="POST" novalidate="novalidate" enctype="multipart/form-data">
	            <section class="card">
	                <header class="card-header">
	                    <h2 class="card-title"><?=$term["globalsettings"]?></h2>
	                </header>
	                <div class="card-body">
	
	                    <div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["companyname"]?> <em class="red">*</em></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?=$term["companyname"]?>" id="company_name" name="company_name" required="required"/>
	                        </div>                        
	                    </div>

						<div class="form-group row">
							<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["companyaddress"]?> <em class="red">*</em></label>
	                        <div class="col-sm-5">
	                            <textarea rows="6" class="form-control" id="company_address" name="company_address" required="required"><?= $company_address?></textarea>
	                        </div>
						</div>

	                    <div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["zipcode"]?></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?= $zip_code?>" id="zip_code" name="zip_code"/>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["city"]?></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?= $city?>" id="city" name="city"/>
	                        </div>
	                    </div>
	                    <div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["state"]?></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?= $state?>" id="state" name="state"/>
	                        </div>                        
	                    </div>
						<div class="form-group row">
							<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["country"]?></label>
	                        <div class="col-sm-5">
	                        	<select name="country" data-plugin-selectTwo class="form-control populate">
	                        		<?php 
	                        		//echo '<option value="">-- Select --</option>';
	                        		if($country) {
		                        		echo '<optgroup label="Selected Country">';
		                        		echo '<option value="'.$country.'" >'.$country.'</option>';
		                        		echo '</optgroup>';
	                        		}
    								echo '<optgroup label="Other Countries">';
	                        		foreach (Country::getCountryList() as $k=>$cn):	                        			
		                        		echo '<option value="'.$k.'" '.$selected.'>'.$cn.'</option>';
		                        	endforeach;
		                        	echo '</optgroup>';
	                        		?>
	                        	</select>
	                        </div>
						</div>
	                    <div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["email"]?></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?= $company_email_address?>" id="company_email_address" name="company_email_address"/>
	                        </div>
	                    </div>
						<div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["companyphone"]?> <em class="red">*</em></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?= $company_phone?>" id="company_phone" name="company_phone"/>
	                        </div>
						</div>
	                    <div class="form-group row">
	                        <label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["metadescription"]?></label>
	                        <div class="col-sm-5">
	                        	<textarea rows="6" class="form-control" name="meta_description"><?= $meta_description?></textarea>
	                        </div>                        
	                    </div>
						 <div class="form-group row" style="display: none;">
							<label class="col-sm-3 control-label text-lg-right pt-2 bld" for="inputDefault"><?=$term["addressandphone"]?></label>
	                        <div class="col-sm-5">
	                            <input type="text"  class="form-control" value="<?= $address_phone?>" id="address_phone" name="address_phone"/>
	                        </div>
						</div>
	
	
	                </div>
	                <footer class="card-footer">
	                    <div class="row">
	                        <div class="col-md-12 text-center">
	                            <button class="btn btn-primary modal-add-confirm btn-sm"><?=$term["change"]?></button>
	                            <button type="reset" id="btn_reset" class="btn btn-default btn-sm"><?=$term["reset"]?></button>
	                            <input type="hidden" name="mode" value="<?= $mode; ?>" />
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

        }

    });
    (function($) {

    	'use strict';

    	if ( $.isFunction($.fn[ 'select2' ]) ) {

    		$(function() {
    			$('[data-plugin-selectTwo]').each(function() {
    				var $this = $( this ),
    					opts = {};

    				var pluginOptions = $this.data('plugin-options');
    				if (pluginOptions)
    					opts = pluginOptions;

    				$this.themePluginSelect2(opts);
    			});
    		});

    	}

    }).apply(this, [jQuery]);
</script>
