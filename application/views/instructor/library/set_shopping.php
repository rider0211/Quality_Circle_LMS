<?php
$image1 = '';
$image2 = '';
$image3 = '';
$image4 = '';
$image5 = '';

if($id != 0){


    $image1 = base_url().$picture1;
    $image2 = base_url().$picture2;
    $image3 = base_url().$picture3;
    $image4 = base_url().$picture4;
    $image5 = base_url().$picture5;
}

?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["setshopping"]?></h2>

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
                        <a class="btn btn-default btn_user_list" href="<?= base_url()?>instructor/library/"><i class="fas fa-table"></i> <?=$term["library"]?></a>
                    </div>
                    <h2 class="card-title">FORM</h2>
                </header>
                <div class="card-body col-sm-12">

                    <input type="hidden" name="id" id="id" value="<?php print $id?>">
                    <input type="hidden" name="library_id" id="library_id" value="<?php print $library_id?>">
                    <input type="hidden" name = "assign_user" id ="assign_user" value="<?php echo checkuser($library_id); ?>">
                    <div class="form-group row">

                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <div class="form-group row">
                                <label class="col-sm-2 control-label text-sm-right pt-5"><?=$term["title"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" value="<?php print $title ?>" id="title" name="title" class="form-control"  placeholder="physic" required>
                                </div>
                            </div>
                            <div class="form-group row" style="padding-bottom: 10px !important;">
                                <label class="col-sm-2 control-label text-sm-right pt-5"><?=$term["price"]?><span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <div data-plugin-spinner="" data-plugin-options="{ &quot;value&quot;:1, &quot;min&quot;: 1, &quot;max&quot;: 90 }">
                                        <div class="input-group" style="width:150px;">
                                            <input type="text" class="spinner-input form-control" value="<?php print $price ?>" id="price" name="price"  placeholder="10" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default spinner-up">
                                                    <i class="fas fa-angle-up"></i>
                                                </button>
                                                <button type="button" class="btn btn-default spinner-down">
                                                    <i class="fas fa-angle-down"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <textarea class="form-control" rows="3" id="description" name="description"><?php print $description ?></textarea>

                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            <div class="p-4 border rounded text-center upload-file d-block image1" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload picture1" name="picture1" type="file" accept="image/*"/>

                        </div>
                        <div class="col-sm-2">
                            <div class="p-4 border rounded text-center upload-file d-block image2" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload picture2" name="picture2" type="file" accept="image/*"/>

                        </div>
                        <div class="col-sm-2">
                            <div class="p-4 border rounded text-center upload-file d-block image3" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload picture3" name="picture3" type="file" accept="image/*"/>

                        </div>
                        <div class="col-sm-2">
                            <div class="p-4 border rounded text-center upload-file d-block image4" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload picture4" name="picture4" type="file" accept="image/*"/>

                        </div>
                        <div class="col-sm-2">
                            <div class="p-4 border rounded text-center upload-file d-block image5" >
                                <i class="fa fa-picture-o fa-2x"></i>
                                <p class=""><small>Upload Image</small></p>
                            </div>
                            <input class="file-upload picture5" name="picture5" type="file" accept="image/*"/>

                        </div>
                        <div class="col-sm-1"></div>

                    </div>
                </div>
                <footer class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a id="sendBtn" data-loading-overlay="" data-loading-overlay-options="{ 'startShowing': false }"  class="btn btn-primary modal-add-confirm" style="color:white;    padding-left: 20px;padding-right: 20px;"><?php $id==0?print $term["shopping"]:print $term["update"]?></a>
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


        $(".picture1").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image1').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".image1").children().hide();
        });


        $(".picture2").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image2').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".image2").children().hide();
        });


        $(".picture3").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image3').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".image3").children().hide();
        });


        $(".picture4").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image4').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".image4").children().hide();
        });


        $(".picture5").on('change', function(){
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image5').css("background-image", "url("+e.target.result+")");
                }

                reader.readAsDataURL(this.files[0]);
            }
            $(".image5").children().hide();
        });

        $(".image1").on('click', function() {
            $(".picture1").click();
        });
        $(".image2").on('click', function() {
            $(".picture2").click();
        });
        $(".image3").on('click', function() {
            $(".picture3").click();
        });
        $(".image4").on('click', function() {
            $(".picture4").click();
        });
        $(".image5").on('click', function() {
            $(".picture5").click();
        });


        <?php
        if(!empty($image1)): ?>
        $(".image1").children().hide();
        $('.image1').css("background-image", "url(<?php echo $image1; ?>)");

        <?php endif; ?>

        <?php
        if(!empty($image2)): ?>
        $(".image2").children().hide();
        $('.image2').css("background-image", "url(<?php echo $image2; ?>)");

        <?php endif; ?>

        <?php
        if(!empty($image3)): ?>
        $(".image3").children().hide();
        $('.image3').css("background-image", "url(<?php echo $image3; ?>)");

        <?php endif; ?>

        <?php
        if(!empty($image4)): ?>
        $(".image4").children().hide();
        $('.image4').css("background-image", "url(<?php echo $image4; ?>)");

        <?php endif; ?>

        <?php
        if(!empty($image5)): ?>
        $(".image5").children().hide();
        $('.image5').css("background-image", "url(<?php echo $image5; ?>)");

        <?php endif; ?>
    });


        $('#add-form .modal-add-confirm').click(function () {
            var formData = new FormData($('#add-form')[0]);
            $("#sendBtn").trigger('loading-overlay:show');

            if($('#add-form .modal-add-confirm').html().indexOf('<?=$term["shopping"]?>') >= 0) {

                $.ajax({
                    url: $('#base_url').val()+'instructor/library/set_price',
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
                    url: $('#base_url').val()+'instructor/library/update_price',
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
        })







</script>
