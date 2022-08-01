<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['usermanagement']; ?></h2>
		<div class="right-wrapper">

		</div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">

                <form id="add-form" action="<?= base_url()?>fasi/user/employee" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <section class="card">
                        <header class="card-header">
                            <div class="card-actions">
                                <a class="btn btn-default" href="<?= base_url()?>fasi/user/employee"><i class="fas fa-table"></i> <?php echo $term['userlist']; ?></a>
                            </div>
                            <h2 class="card-title"><?php echo $term['form']; ?></h2>
                        </header>
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?php print $id?>">
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['usertype']; ?></label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control populate" id="user_type" name="user_type" readonly="readonly" value="Employee">
                                    </div>

                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['active']; ?></label>
                                <div class="col-sm-4">

                                    <select data-plugin-selectTwo class="form-control populate" id="active" name="active" >
                                        <option value=1 <?php $is_active==1?print 'selected':print ''?>><?php echo $term['on']; ?></option>
                                        <option value=0 <?php $is_active==0?print 'selected':print ''?>><?php echo $term['off']; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-lg-right pt-2"><?php echo $term['picture']; ?></label>
                                <div class="col-sm-4">
                                    <!--<input type="file" id="picture" name="picture" class="form-control"/>-->
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file">
                                                            <span class="fileupload-exists"><?php echo $term['change']; ?></span>
                                                            <span class="fileupload-new"><?php echo $term['selectfile']; ?></span>
                                                            <input type="file" id="picture" name="picture" src="<?php print $picture ?>"/>
                                                        </span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $term['remove']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['salutation']; ?></label>
                                <div class="col-sm-4">

                                    <select data-plugin-selectTwo class="form-control populate" id="salutation" name="salutation">
                                        <option value="Mr" <?php $salutation=='Mr'?print 'selected':print ''?>><?php echo $term['mr']; ?></option>
                                        <option value="Mrs" <?php $salutation=='Mrs'?print 'selected':print ''?>><?php echo $term['mrs']; ?></option>

                                    </select>
                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['language']; ?></label>
                                <div class="col-sm-4">

                                    <select data-plugin-selectTwo class="form-control populate" id="language" name="language">

                                        <?php foreach($lang_ar as $item){ ?>
                                            <option value="<?php echo $item['lang_code']; ?>" <?php $language==$item['lang_code']?print 'selected':print ''; ?>> <?php echo $item['lang_name']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['firstname']; ?><span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $first_name ?>" id="first_name" name="first_name" class="form-control" placeholder="Max" required>

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['lastname']; ?><span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $last_name ?>" id="last_name" name="last_name" class="form-control" placeholder="Mustermann" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['department']; ?></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $department ?>" id="department" name="department" class="form-control" placeholder="IT-Office">

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['companyname']; ?></label>
                                <div class="col-sm-4">


                                    <select data-plugin-selectTwo class="form-control populate" id="company_id" name="company_id">
                                        <?php foreach ($company_data as $data) {
                                            $str_selected = $data['id']==$company?'selected':'';
                                            print '<option value="'.$data['id'].'" '.$str_selected.'>'.$data['name'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['email']; ?><span class="required">*</span></label>
                                <div class="col-sm-4">

                                    <input type="email" value="<?php print $email ?>" id="email" name="email" class="form-control" placeholder="max.mustermann@8solutions.de" required>

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['password']; ?><span class="required">*</span></label>
                                <div class="col-sm-4">
                                    <input type="password" value="<?php print $password ?>" class="form-control" placeholder=""  id="password" name="password">
                                </div>
                            </div>
                            <div class="col-sm-6" style="text-align:right;color: red;font-weight: bold;"><?php echo $term['phonenumberhint']; ?></div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['phonenumber']; ?></label>
                                <div class="col-sm-4">
                                    <input type="text" value="<?php print $phone_number ?>" id="phone_number" name="phone_number" class="form-control" placeholder="4915119191919">
                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['notification']; ?></label>
                                <div class="col-sm-4">

                                    <select data-plugin-selectTwo class="form-control populate" id="notification_method" name="notification_method">
                                        <option value="Email" <?php $notification_method=='Email'?print 'selected':print ''?>>Email</option>
										<option value="SMS" <?php $notification_method=='SMS'?print 'selected':print ''?>>SMS</option>
                                        <option value="SMS_Email" <?php $notification_method=='SMS_Email'?print 'selected':print ''?>>SMS and Email</option>

                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['jobtitle']; ?></label>
                                <div class="col-sm-4">

                                    <input type="text" value="<?php print $job_title ?>" id="job_title" name="job_title" class="form-control" placeholder="Projekt Manager">

                                </div>
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['taskarea']; ?></label>
                                <div class="col-sm-4">

                                    <input type="text" id="task_area"  value="<?php print $task_area ?>" name="task_area" class="form-control" placeholder="Management">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['dateofbirth']; ?></label>
                                <div class="col-sm-4">
                                    <div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="fas fa-calendar-alt"></i>
															</span>
														</span>
                                        <input type="text"  value="<?php print $birthday ?>" data-plugin-datepicker class="form-control" id="birthday" name="birthday">
                                    </div>
                                </div>
                                <!-- <label class="col-sm-2 control-label text-lg-right pt-2" for="inputDefault"><?php echo $term['googletwofactor']; ?></label>
                                <div class="col-sm-4">
                                    <div class="switch switch-primary">
                                        <input type="checkbox" name="share" value="Y" data-plugin-ios-switch <?php echo ($share == 'Y') ? 'checked="checked"' :'';?> />
                                    </div>
                                </div> -->
                            </div>

                        </div>
                        <footer class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a id="sendBtn" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }"  class="btn btn-primary modal-add-confirm" style="color:white;    padding-left: 20px;padding-right: 20px;"><?php $id==0?print $term['add']:print $term['update']?></a>
                                    <button type="reset" class="btn btn-default"><?php echo $term['reset']; ?></button>
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
        $('[data-plugin-ios-switch]').each(function() {
            var $this = $( this );

            $this.themePluginIOS7Switch();
        });

        $('[data-plugin-datepicker]').each(function() {
            var $this = $( this );

            $this.themePluginDatePicker();
        });
        $('[data-plugin-selectTwo]').each(function() {
            var $this = $( this ),
                opts = {};

            var pluginOptions = $this.data('plugin-options');
            if (pluginOptions)
                opts = pluginOptions;

            $this.themePluginSelect2(opts);
        });
        $('[data-plugin-masked-input]').each(function() {
            var $this = $( this );

            $this.themePluginMaskedInput();
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

        if($('#add-form .modal-add-confirm').html().indexOf('<?php echo $term['add']; ?>') >= 0) {

            $.ajax({
                url: $('#base_url').val()+'fasi/user/add',
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
                    window.location.href= '<?php echo base_url() ?>instructor/user';
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
                url: $('#base_url').val()+'fasi/user/change',
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
                    window.location.href= '<?php echo base_url() ?>instructor/user';
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
