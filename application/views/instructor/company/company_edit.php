<section role="main" class="content-body">
	<header class="page-header">
		<h2>User Manage</h2>
		<div class="right-wrapper">

		</div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">

                <form id="add-form" action="<?= base_url()?>fasi/company" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a class="btn btn-default" href="<?= base_url()?>fasi/company"><i class="fas fa-table"></i> Company List</a>
                            </div>
                            <h2 class="card-title">Form</h2>
                        </header>
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?php print $id?>">
                            <div class="form-group row">

                                <label class="col-sm-2 control-label text-sm-right pt-2">Active</label>
                                <div class="col-sm-4">
                                    <select data-plugin-selectTwo class="form-control populate" id="active" name="active" >
                                        <option value=1 <?php $active==1?print 'selected':print ''?>><?php echo $term['on']; ?></option>
                                        <option value=0 <?php $active==0?print 'selected':print ''?>><?php echo $term['off']; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Email Address<span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="email" value="<?php print $email ?>" id="email" name="email" class="form-control" required placeholder="max.mustermann@8solutions.de">

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2">Password<span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="password" value="<?php print $password ?>" id="password" name="password" class="form-control">

                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Name<span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $name ?>" id="name" name="name" class="form-control" required placeholder="8solutions.de - Internet Service Provider">

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2">Address</label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $address ?>" id="address" name="address" class="form-control" placeholder="Plato-Wild-Straße 39">

                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Zipcode</label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $zipcode ?>" id="zipcode" name="zipcode" class="form-control" placeholder="93053">

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2">City</label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $city ?>" id="city" name="city" class="form-control" placeholder="Regensburg">

                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-lg-right pt-2">Logo</label>
                                <div class="col-sm-4">
                                    <!--<input type="file" id="picture" name="picture" class="form-control"/>-->
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists">Change</span>
                                                            <span class="fileupload-new">Select file</span>
                                                            <input type="file" id="picture" name="picture" src="<?php print $logo_image ?>"/>
                                                        </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        </div>
                                    </div>
                                </div>
                                <label class="col-sm-2 control-label text-lg-right pt-2" for="inputDefault">Google two factor</label>
                                <div class="col-sm-4">
                                    <div class="switch switch-primary">
                                        <input type="checkbox" name="share" value="Y" data-plugin-ios-switch <?php echo ($share == 'Y') ? 'checked="checked"' :'';?> />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 control-label text-sm-right pt-2">FASI</label>
                                <div class="col-sm-4">
                                    <select data-plugin-selectTwo class="form-control populate" id="responsible_fasi_id" name="responsible_fasi_id">
                                        <?php foreach ($fasi_data as $data) {
                                            $str_selected = $data['id']==$responsible_fasi_id?'selected':'';
                                            print '<option value="'.$data['id'].'" '.$str_selected.'>'.$data['email'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2">Notifications</label>
                                <div class="col-sm-4">

                                    <select data-plugin-selectTwo class="form-control populate" id="receive_notifications" name="receive_notifications">
                                        <option value="Email" <?php $receive_notifications=='Email'?print 'selected':print ''?>>Email</option>
    									<option value="SMS" <?php $receive_notifications=='SMS'?print 'selected':print ''?>>SMS</option>
                                        <option value="SMS_Email" <?php $notification_method=='SMS_Email'?print 'selected':print ''?>>SMS and Email</option>

                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Country</label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $country ?>" id="country" name="country" class="form-control">

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2">Note</label>
                                <div class="col-sm-4">

                                    <textarea class="form-control" rows="3" id="note" name="note"><?php print $note ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                            <label class="col-sm-2 control-label text-sm-right pt-2">Language</label>
                            <div class="col-sm-4">

                                <select data-plugin-selectTwo class="form-control populate" id="language" name="language">

                                    <?php foreach($lang_ar as $item){ ?>
                                        <option value="<?php echo $item['lang_code']; ?>" <?php $language==$item['lang_code']?print 'selected':print ''; ?>> <?php echo $item['lang_name']; ?></option>
                                    <?php }  ?>
                                </select>
                            </div>

                            </div>
                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a id="sendBtn" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }"  class="btn btn-primary modal-add-confirm" style="color:white;    padding-left: 20px;padding-right: 20px;"><?php $id==0?print 'Add':print 'Update'?></a>
                                    <button type="reset" class="btn btn-default">Reset</button>
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
            $.ajax({
                url: $('#base_url').val()+'all/user/checkemailexist',
                type: 'POST',
                data: { 'id': $('#id').val(), email:$('#email').val()},

                success: function (data, status, xhr) {
                    if (!data.success){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo 'Email address already existing. Please register a new email address.'; ?>',
                            type: 'error'
                        });
                        return;
                    }
                    send_action(frm);
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

    });

    function send_action(frm){
        var formData = new FormData($('#add-form')[0]);
        $("#sendBtn").trigger('loading-overlay:show');

        if($('#add-form .modal-add-confirm').html().indexOf('Add') >= 0) {

            $.ajax({
                url: $('#base_url').val()+'fasi/company/add',
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
                    frm.submit();
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
                url: $('#base_url').val()+'fasi/company/change',
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
                    frm.submit();
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
