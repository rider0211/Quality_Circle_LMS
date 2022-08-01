<?php
$image = '';

if($id != 0){
    $image = base_url().$picture;
}

?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["usermanagement"]?></h2>

        <div class="right-wrapper">

        </div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
		<div class="col">
            <section class="card">
                <form class="form-group form-bordered" id="add-form"  method="POST" novalidate="novalidate" enctype="multipart/form-data">

                <header class="card-header">
                    <div class="card-actions">
                        <a class="btn btn-default btn_user_list" href="<?= base_url()?>superadmin/user/"><i class="fas fa-table"></i> <?=$term["userlist"]?></a>
                    </div>
                    <h2 class="card-title">FORM</h2>
                </header>
                <div class="card-body col-sm-12">

                    <input type="hidden" name="id" id="id" value="<?php print $id?>">

                    <div class="form-group row">

                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <div class="p-4 border rounded text-center upload-file d-block" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload" name="picture" type="file" accept="image/*"/>
                        </div>
                        <div class="col-sm-7">

                            <input type="hidden" name="id" id="id" value="<?php print $id?>">

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-5"><?=$term["firstname"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $first_name ?>" id="first_name" name="first_name" class="form-control"  placeholder="Max" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["lastname"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $last_name ?>" id="last_name" name="last_name" class="form-control" placeholder="Mustermann" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["email"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $email ?>" id="email" name="email" class="form-control" placeholder="timon@ols.com" required>
                                </div>
                            </div>
                            <div class="form-group row <?php //$id==0?print '':print 'hidden'?>">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["password"]?><?php $id==0?print '<span class="required">*</span>':print ''?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $password ?>" id="password" name="password" class="form-control" <?php $id==0?print 'required':print ''?>>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["company"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <select id="company_id" name="company_id" class="form-control mb3">
                                        <?php foreach($company_data as $item){ ?>
                                            <option value="<?php echo $item['id']; ?>" <?php $company_id==$item['id']?print 'selected':print ''; ?>> <?php echo $item['name']; ?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["usertype"]?></label>
                                <div class="col-sm-10">
                                    <select class="form-control mb3" id="user_type" name="user_type" >
                                        <option value='Admin' <?php $user_type=='Admin'?print 'selected':print ''?> ><?php echo 'Admin'; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["organization"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $organization ?>" id="organization" name="organization" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["manager"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $manager ?>" id="manager" name="manager" class="form-control">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["about_me"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $about_me ?>" id="about_me" name="about_me" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["address1"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $address1 ?>" id="address1" name="address1" class="form-control"d>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["address2"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $address2 ?>" id="address2" name="address2" class="form-control">
                                </div>
                            </div>
                            <input type="hidden" id="sortname" name="sortname" value="<?php print $sortname; ?>"/>
                            <div class="form-group row">
                            	<label class="col-sm-2 control-label text-sm-right pt-2">Country Code</label>
                                 <div class="col-sm-10">
                                <select name="country_code" id="country_code" class="form-control" required onchange="getCountryCode()">
                                	<option value="">Select Country Code</option>
                                    <?php if(isset($country_list) && !empty($country_list)){ 
                                        foreach($country_list as $cKey => $item){
                                    ?>
                                    <option <?php if($item['phonecode'] == $country_code){echo "selected";} ?> sortnameoption="<?php echo $item['sortname']; ?>" value="<?php echo $item['phonecode']; ?>"><?php echo $item['name'].' ('.$item['phonecode']; ?>)</option>
                                    <?php } } ?>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["phone"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $phone ?>" id="phone" required name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">Country</label>
                                <div class="col-sm-10">
                                    <select class="form-control" required onchange="getStateByCountryId(this.value)" id="country" name="country">
                                        <option value="" >Select</option>
                                        <?php foreach ($countries as $item){ ?>
                                            <option required <?php if($country == $item['id']){echo "selected";} ?> value=<?php echo $item['id']; ?>><?php echo $item['name']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">State</label>
                                <div class="col-sm-10">
                                    <select class="form-control" required onchange="getCityByStateId(this.value)" id="state" name="state">
                                        <option value="" >Select</option>
                                        <?php foreach ($states as $item){ ?>
                                            <option required <?php if($state == $item['id']){echo "selected";} ?> value=<?php echo $item['id']; ?>><?php echo $item['name']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2">City</label>
                                <div class="col-sm-10">
                                    <select class="form-control" required id="city" name="city">
                                        <option value="" >Select</option>
                                        <?php foreach ($cities as $item){ ?>
                                            <option required <?php if($city == $item['id']){echo "selected";} ?> value=<?php echo $item['id']; ?>><?php echo $item['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            

                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["active"]?></label>
                                <div class="col-sm-10">
                                    <div class="switch switch-primary">
                                        <input type="checkbox" name="active" id="active" data-plugin-ios-switch <?php echo $active==1?'checked="checked"':'';?> />
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["zip_code"]?></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $zip_code ?>" id="zip_code" name="zip_code" class="form-control">
                                </div>
                            </div>
                              <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term["subscription"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <select name="plan_id" id="plan_id" class="form-control">
                                        <option value="0">--No Plan--</option>
                                        <?php
                                        if(!empty($plans))
                                        {
                                            foreach($plans as $idx => $plan_rec)
                                            {
                                                ?>
                                                <option value="<?php echo $plan_rec->id;?>" <?php $plan_id==$plan_rec->id?print 'selected':print ''; ?>>
                                                    <?php 
                                                        if($plan_rec->price_type == 1 || $plan_rec->price_type == 2){
                                                            echo $plan_rec->name;
                                                        }else{
                                                            if($plan_rec->term_type == 0 ){
                                                                echo $plan_rec->name.' - MONTH' ;
                                                            }else{
                                                                echo $plan_rec->name.' - YEARLY';
                                                            }
                                                        }?>
                                                </option>
                                                <?php
                                            }
                                        }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>

                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a id="sendBtn" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }"  class="btn btn-primary modal-add-confirm" style="color:white;    padding-left: 20px;padding-right: 20px;"><?php $id==0?print $term["add"]:print $term["update"]?></a>
                            <button type="reset" id="btn_reset" class="btn btn-default"><?=$term["reset"]?></button>
                        </div>
                    </div>
                </footer>

                </form>
            </section>


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

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-file').css("background-image", "url("+e.target.result+")");
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(".file-upload").on('change', function(){
        readURL(this);
        $(".upload-file").children().hide();
    });

    $(".upload-file").on('click', function() {
        $(".file-upload").click();
    });

    <?php
    if(!empty($image)): ?>
    $(".upload-file").children().hide();
    $('.upload-file').css("background-image", "url(<?php echo $image; ?>)");

    <?php endif; ?>

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
                url: $('#base_url').val()+'superadmin/user/checkemailexist',
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
        //$("#sendBtn").trigger('loading-overlay:show');

        if($('#add-form .modal-add-confirm').html().indexOf('<?=$term["add"]?>') >= 0) {

            $.ajax({
                url: $('#base_url').val()+'superadmin/user/add',
                type: 'POST',
                data: formData,
                processData:false,
                contentType: false,
                success: function (data, status, xhr) {
                    if(data.success){
                        $("#sendBtn").trigger('loading-overlay:hide');
                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyupdated']; ?>',
                            type: 'success'
                        });
                    }else{
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: data.msg,
                            type: 'error'
                        });
                    }

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
                url: $('#base_url').val()+'superadmin/user/change',
                type: 'POST',
                data: formData,
                processData:false,
                contentType: false,
                success: function (data, status, xhr) {
                    if(data.success){
                        $("#sendBtn").trigger('loading-overlay:hide');
                        new PNotify({
                            title: '<?php echo $term['success']; ?>',
                            text: '<?php echo $term['succesfullyupdated']; ?>',
                            type: 'success'
                        });
                    }else{
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: data.msg,
                            type: 'error'
                        });
                    }

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
    function getStateByCountryId(CountryID){
       if(CountryID != ''){
           var appendrow = '';
           $('#state').html('<option value="">Select State</option>');
		   $('#city').html('<option value="">Select City</option>');
           $.ajax({
               url: "<?=base_url()?>admin/coursecreation/getStateById",
               type: 'POST',
               dataType: 'JSON',
               data: {'country': CountryID},
               success: function(data){
                   appendrow += '<option value="">Select State</option>';
                   $.each(data, function(index, value){
                       appendrow += '<option value="'+value.id+'">'+value.name+'</option>';
                   });
                   $('#state').html(appendrow);
   				}
           });
       }
   	}
	
	function getCityByStateId(StateID){
       if(StateID != ''){
           var appendrow2 = '';
           $('#city').html('<option value="">Select State</option>');
           $.ajax({
               url: "<?=base_url()?>admin/coursecreation/getCityById",
               type: 'POST',
               dataType: 'JSON',
               data: {'state': StateID},
               success: function(data){
                   appendrow2 += '<option value="">Select City</option>';
                   $.each(data, function(index, value){
                       appendrow2 += '<option value="'+value.id+'">'+value.name+'</option>';
                   });
                   $('#city').html(appendrow2);
   				}
           });
       }
   	}
	function getCountryCode(){
		var sortname = $("#country_code option:selected").attr("sortnameoption");
		$('#sortname').val(sortname);
	}
	
</script>
