<?php
	//$html = $content[direction][html];
	$title = $quiz_title;
	$guide = $quiz_guide;
	$obj_path = $quiz_obj_path;
?>
<div class="row">

    <div class="col-md-8">
        <div class="quiz_title" style="font-size: 14px; font-weight: 700; color: #000; line-height: 27px;">
            <?= $title ?>
        </div>
        <span class="direction">
            <?= $guide ?>
        </span>
    </div>
    <?php if(isset($obj_path) && $obj_path != '') { ?>
    <div class="container col-md-4" style="padding-top: 35px;">
        <img class="thumbnail" style="width: 100%;" src="<?php echo base_url($obj_path);?>" />
        <a href="<?php echo base_url($obj_path);?>">Show Full Screen</a>
    </div>

        <script src="<?php echo base_url(); ?>assets/js/view-image.js"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery.viewImage({
                    'target': '.container img,.container a',
                    'delay': 300
                });
            });
        </script>
<?php } ?>
</div>