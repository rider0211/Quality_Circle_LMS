<?php
$image = '';
$image = $this->session->userdata('user_photo');
?>

<style>
    .datepicker> .datepicker-days{
        display: initial;
    }
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?php echo $term['myprofile']; ?></h2>

        <div class="right-wrapper">

        </div>
	</header>
    <input type="hidden" id="base_url" value="<?= base_url()?>">
	<!-- start: page -->
	<div class="row">
		<div class="col-sm-12 col-md-10">
            <div class="tabs">
                <ul class="nav nav-tabs">
                    <li class="nav-item overview <?= $msg == "active show"?"":""?>">
                        <a class="nav-link" href="#overview"  data-toggle="tab"><?php echo $term['overview']; ?></a>
                    </li>
                    <li class="nav-item edit <?= $msg == ""?"":"active show"?>">
                        <a class="nav-link" href="#edit" data-toggle="tab"><?php echo $term['edit']; ?></a>
                    </li>
                    <li class="nav-item edit ">
                        <a class="nav-link" href="#recent_login" data-toggle="tab">Recent Login</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="overview" class="tab-pane <?= $msg == "active show"?"":""?>">
                        <div class="form-group row">
                            <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['picture']; ?></label>
                            <div class="col-sm-3">
                                <img src="<?php print $this->session->userdata('user_photo') ?>" class="rounded img-fluid" alt="<?php print $this->session->userdata('name') ?>">
                            </div>
                            <input type="hidden" value="<?php print $this->session->userdata('user_id') ?>" class="form-control" id="id" name="id" readonly="readonly">
                        </div>
                         <div class="form-group row">
                         	<label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['phone']; ?></label>
                            <div class="col-sm-3">
                            <?php 
								$countrycode = $user->country_code;
								$phoneno = $user->phone;								
								$contact = '';
								if($countrycode != '' && $phoneno != ''){
									$contact = '+'.$countrycode.'-'.$phoneno;
								}
							?>
                                <input type="text" value="<?php print $contact; ?>" class="form-control" readonly="readonly">
                            </div>
                            <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['email']; ?></label>
                            <div class="col-sm-3">
                                <input type="text" value="<?php print $user->email ?>" class="form-control"  id="email" name="email" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['userrole']; ?></label>
                            <div class="col-sm-3">
                                <input type="text" value="<?php print $this->session->userdata('roleText') ?>" class="form-control" readonly="readonly">
                            </div>
                            <?php if($this->session->userdata('roleText') != 'Superadmin'){?>
                            <label class="col-sm-2 control-label text-sm-right pt-2"></label>
                            <div class="col-sm-3">                            
                                <?php if($company_active == 1):?>
                                <a href="<?=base_url()?>company/<?=$company_url?>" class="modal-with-form"><?= $company_name?></a>

                                <?php endif;?>
                                <?php if($company_active == 0):?>
                                <label style="color:red"><?php echo $term["contactsuperadmin"];?></label>
                                <a href="#" class="modal-with-form"><?= $company_name?></a>
                                <?php endif;?>
                            </div>
                            <?php }?>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-2 control-label text-sm-right pt-2">Sign</label>
                            <div class="card-body">                     
                                <div class="col-lg-6">
                                    <center>                                            
                                       <?php echo $sign ?>                                           
                                    </center>
                                </div>                                
                            </div>                            
                        </div>
                    </div>
                    <div id="edit" class="tab-pane <?= $msg == ""?"":"active show"?>">
                        <?php if ($msg != "") { ?>
                            <span><strong style="text-align:center"><h3 style = "color:red"><?= $msg?></h3></strong></span>
                            <span>For the safety of our website and the protection of your information we have instituted layers of protection
                                    to mitigate unwanted access to our site. As a result it is necessary for you to update the fields below to
                                    continue.
                                    Thanks for your cooperation and understanding.
                                    Have fun learning.
                                    From our happy team to you.
                                    Go Smart Academy </span>
                        <?php }?>
                        <form id="add-form" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                            <input type="hidden" value="<?php print $this->session->userdata('user_id') ?>" class="form-control" id="id" name="id">
                            <input type="hidden" id="base_url" value="<?= base_url()?>">
                            <input type="hidden" id="sign" name="sign">
                            <section class="card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-lg-right pt-2"><?php echo $term['picture']; ?></label>
                                        <div class="col-sm-3">
                                            <div class="p-4 border rounded text-center upload-file d-block" >
                                                <i class="fa fa-picture-o fa-2x"></i>
                                                <p class=""><small>Upload Image</small></p>
                                            </div>
                                            <input class="file-upload" name="picture" id="picture" type="file" accept="image/*"/>
                                        </div>
                                    </div>		
                                    <input type="hidden" id="sortname" name="sortname" value="<?php print $user->sortname; ?>"/>							
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Country Code <span style="color:red">*</span></label>
                                        <div class="col-sm-3">
                                            <select name="country_code" id="country_code" class="form-control" onchange="getCountryCode()">
												<?php if(isset($country_list) && !empty($country_list)){ 
                                                    foreach($country_list as $cKey => $country){
                                                ?>
                                                <option <?php if($country['sortname'] == $user->sortname){echo "selected";} ?> sortnameoption="<?php echo $country['sortname']; ?>" value="<?php echo $country['phonecode']; ?>"><?php echo $country['name'].' ('.$country['phonecode']; ?>)</option>
                                                <?php } } ?>
                                			</select>
                                        </div>
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Phone Number<span style="color:red">*</span></label>
                                        <div class="col-sm-3">
                                            <input type="text" maxlength="10" value="<?php print $user->phone ?>" placeholder = "4052838303" class="form-control"  id="phone" name="phone" >
                                        </div>
                                    </div>
                                    
				    				<div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['email']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?php print $user->email ?>" class="form-control"  id="email" name="email" >
                                        </div>
                                        <?php if($user->user_type == "Superadmin"){?> 
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['tax_rate']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?= $tax_rate ?>" class="form-control"  id="tax_rate" name="tax_rate" >
                                        </div>
                                        <?php } ?>
                                        <?php if($user->user_type == "Admin"){?> 
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['onetimepay']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="Number" value="<?= $onetime_pay ?>" class="form-control"  id="onetime_pay" name="onetime_pay" >
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php if($user->user_type == "Admin" || $user->user_type == "Superadmin") {?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['paypalpk']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?= $paypal_pk ?>" class="form-control"  id="paypal_client_id" name="paypal_client_id" >
                                        </div>
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['paypalsk']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?= $paypal_sk ?>" class="form-control"  id="paypal_secret_id" name="paypal_secret_id" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['stripepk']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?= $stripe_pk ?>" class="form-control"  id="stripe_client_id" name="stripe_client_id" >
                                        </div>
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['stripesk']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?= $stripe_sk ?>" class="form-control"  id="stripe_secret_id" name="stripe_secret_id" >
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['password']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="password" value="" class="form-control"  id="password" name="password" >
                                        </div>
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?php echo $term['confirm']; ?></label>
                                        <div class="col-sm-3">
                                            <input type="password" value="" class="form-control"  id="confirm" >
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term['userrole']?></label>
                                        <div class="col-sm-3">
                                            <input type="text" value="<?php print $user->role ?>" class="form-control"  id="role" name="role" readonly>
                                        </div>

                                        <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term['companyname']?></label>
                                        <div class="col-sm-3">
                                            <input type="hidden" value="<?php print $user->company_id ?>" class="form-control">
                                            <input type="text" value="<?php echo $company_name ?>" class="form-control" readonly >
                                        </div>
                                    </div>
                                    <?php if($user->user_type == "Admin") {?>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label text-sm-right pt-2"><?= $term['companysub']?></label>
                                            <div class="col-sm-3" style ="padding-top: 7px">
                                                <?php if($plan->id) {?>
                                                    <strong><?= $plan->name?></strong>
                                                <?php }else { ?>  
                                                    <strong>Trial</strong>
                                                <?php } ?>
                                            </div>

                                            <label class="col-sm-2 control-label text-sm-right pt-2"><?=$term['changeplan']?></label>
                                            <div class="col-sm-3"  style ="padding-top: 7px">
                                                <a href="<?=base_url()?>pricing" class="modal-with-form"><?= $term['upordown']?></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <label class="col-sm-2 control-label text-sm-right pt-2">Sign</label>
                                        <div class="card-body">                                            
                                            <div id="" class="row">
                                                <div class="col-lg-12">
                                                    <center>
                                                        <fieldset style="width: 500px;">
                                                            <div id="signaturePad" style="background-color:white; border: 1px solid #ccc; height: 250px; width: 500px;">
                                                            </div>
                                                            <div id="imgData"></div>
                                                        </fieldset>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">                                            
                                        </div>                                       
                                        <div class="col-sm-4" style="margin-top:10px">                                            
                                        </div>
                                        <div class="col-sm-4"> 
                                            <button class="btn btn-info" id="clearSig">Clear the signature</button>                                           
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-3">                                            
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary modal-add-confirm"><?php echo $term['update']; ?></button>
                                        </div>
                                        <div class="col-sm-3">
                                            <button type="reset" id="reset_btn" class="btn btn-default"><?php echo $term['reset']; ?></button>
                                        </div>
                                        <div class="col-sm-3"></div>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                    <div id="recent_login" class="tab-pane">
                        <div class="our-sco1"><h3><i>RECENT LOGIN</i></h3></div>
                        <table class="table table-borderless">
                          <thead>
                            <tr>
                              <th scope="col">LOGIN AREA</th>
                              <th scope="col">IP</th>
                              <th scope="col">LOGIN PLATFORM</th>
                              <th scope="col">LOGIN DEVICE</th>
                              <th scope="col">TIME</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(!empty($loginRes)) { foreach($loginRes as $res) { ?>
                                <tr>
                                  <th scope="row"><?= $res->area ?></th>
                                  <td><?= $res->ip_address ?></td>
                                  <td><?= $res->platform ?></td>
                                  <td><?= $res->device ?></td>
                                  <td><?= $res->crdate ?></td>
                                </tr>
                            <?php }} ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

		</div>
	</div>

	
	<!-- end: page -->
</section>

<script>
    $('.edit').click(function () {
        $('.overview').removeClass('active');
    }); 

    jQuery(document).ready(function() {

        $('[data-plugin-datepicker]').each(function () {
            var $this = $(this);

            $this.themePluginDatePicker();
        });
/** Set Canvas Size **/
            var canvasWidth = 498;
            var canvasHeight = 248;

            /** IE SUPPORT **/
            var canvasDiv = document.getElementById('signaturePad');
            canvas = document.createElement('canvas');
            canvas.setAttribute('width', canvasWidth);
            canvas.setAttribute('height', canvasHeight);
            canvas.setAttribute('id', 'canvas');
            canvasDiv.appendChild(canvas);
            if (typeof G_vmlCanvasManager != 'undefined') {
                canvas = G_vmlCanvasManager.initElement(canvas);
            }
            context = canvas.getContext("2d");

            var clickX = new Array();
            var clickY = new Array();
            var clickDrag = new Array();
            var paint;

            /** Redraw the Canvas **/
            function redraw() {
                canvas.width = canvas.width; // Clears the canvas

                context.strokeStyle = "#000000";

                context.lineWidth = 2;

                for (var i = 0; i < clickX.length; i++) {
                    context.beginPath();
                    if (clickDrag[i] && i) {
                        context.moveTo(clickX[i - 1], clickY[i - 1]);
                    } else {
                        context.moveTo(clickX[i] - 1, clickY[i]);
                    }
                    context.lineTo(clickX[i], clickY[i]);
                    context.closePath();
                    context.stroke();
                }
            }

            /** Save Canvas **/
            $("#saveSig").click(function saveSig() {
                swal({
                    title: "Are You Sure to Save Your Signature ?",
                    buttons: true
                })
                    .then((willDelete) => {
                        if (willDelete) {
                        var sigData = canvas.toDataURL("image/png");
                        var nicURI = base_url+"save_signature";
                        var A = new FormData();
                        A.append("id", id);
                        A.append("sign", sigData);
                        var C = new XMLHttpRequest();
                        C.open("POST", nicURI);
                        C.onload = function() {
                            var E;
                            E = C.responseText;
                            if (E.indexOf("SUCCESS") >= 0) {
                                location.href = base_url+"examResult/"+id;
                            }else{
                                $("#imgData").html('Sorry! Your signature was not saved');
                                return;
                            }
                        };
                        C.send(A);
                    } else {
                        return;
                    }
                });
            });

            $('#clearSig').click(
                function clearSig() {
                    clickX = new Array();
                    clickY = new Array();
                    clickDrag = new Array();
                    context.clearRect(0, 0, canvas.width, canvas.height);
                });

            /**Draw when moving over Canvas **/
            $('#signaturePad').mousemove(function (e) {
                this.style.cursor = 'pointer';
                if (paint) {
                    var left = $(this).offset().left;
                    var top = $(this).offset().top;

                    addClick(e.pageX - left, e.pageY - top, true);
                    redraw();
                }
            });

            /**Stop Drawing on Mouseup **/
            $('body').mouseup(function (e) {
                paint = false;
            });

            /** Starting a Click **/
            function addClick(x, y, dragging) {
                clickX.push(x);
                clickY.push(y);

                clickDrag.push(dragging);
            }

            $('#signaturePad').mousedown(function (e) {
                paint = true;

                var left = $(this).offset().left;
                var top = $(this).offset().top;

                addClick(e.pageX - left, e.pageY - top, false);
                redraw();
            });
    });


    $(document).on('click', '.modal-add-confirm', function (e) {
        e.preventDefault();
        var sigData = canvas.toDataURL("image/png");
        $('#sign').val(sigData);

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

            if($('#password').val() == $('#confirm').val())
                $.ajax({
                    url: $('#base_url').val()+'admin/user/change',
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
                    },
                    error: function(){
                        new PNotify({
                            title: '<?php echo $term['error']; ?>',
                            text: '<?php echo $term['thereissomeissuetryagainlater']; ?>',
                            type: 'error'
                        });
                    }
                });
            else
                new PNotify({
                    title: '<?php echo $term['error']; ?>',
                    text: '<?php echo $term['passwordnotmatch']; ?>',
                    type: 'error'
                });

        }

    });

    jQuery(document).ready(function() {
        $(".file-upload").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-file').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
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
    });

    $(function(){
        $('#reset_btn').click(function(){
            $('#verify_code').prop('disabled', '')
            $('#verify_btn').prop('disabled', '');
            $('.modal-add-confirm').prop('disabled', 'disabled');
        });

    });
	
	function getCountryCode(){
		var sortname = $("#country_code option:selected").attr("sortnameoption");
		$('#sortname').val(sortname);
	}
</script>
