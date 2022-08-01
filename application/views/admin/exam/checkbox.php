<?php

$title = "Select The Once You Like";
$image = '';
if($qData['ques_title'] != ''){
    $title = $qData['ques_title'];

    if(isset($qData['ques_file']) && !empty($qData['ques_file']))
        $image = base_url().'assets/uploads/exam/quiz/'.$qData['ques_file'];
}

?>
<?php $this->load->view('admin/exam/header');?>
<main role="main" class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-2">
                        <div class="p-4 border rounded text-center upload-file d-block" >
                            <i class="fa fa-picture-o fa-2x"></i>
                            <p class=""><small>Upload Image</small></p>
                        </div>
                        <input class="file-upload" name="userfile" type="file" accept="image/*"/>
                    </div>

                    <div class="col-md-1">

                    </div>
                    <div class="col-md-9">
                        <div class="form-group editArea">
                            <textarea class="form-control form-control-lg" id="checkbox" name="ques_title" placeholder="Match The Following" rows="3" ><?php echo $title; ?></textarea>
                            <input type="hidden" name="que_type" value="checkbox">
                        </div>
                    </div>
                </div>

            </div>

            <hr class="mb-4">
                  
        </div>
        <div class="row">

            <div class="col-md-6">
                <input type="text" class="form-control" id="quiz_code" name="quiz_code" placeholder="Quiz Code" value="<?php echo $quiz_code; ?>">

            </div>

        </div>

        <!--Matching-->
        <div class="row">
            <div class="col-md-11">
                <div class="mt-3" autocomplete="on" id="sortable">
                    <?php if(isset($qData)): ?>
                    <?php $k=0; foreach ($qData['content']['checkbox'] as $key => $value): ?>
                        <?php $temp_count = 0;?>
                        <div class="form-row">
                            <?php for ($i=0;$i<count($qData['content']['correctCheck']);$i++){?>
                                <?php if ($qData['content']['correctCheck'][$i] == $key):?>
                                    <?php $temp_count++;?>
                                    <input class="form-check-input" type="checkbox" name="correctCheck[]" value="<?php echo $k; ?>" <?php echo $this->session->userdata('userrole') != 'Learner'?'checked':''?>>
                                <?php endif;?>
                            <?php }?>
                            <?php if ($temp_count == 0):?>
                                <input class="form-check-input" type="checkbox" name="correctCheck[]" value="<?php echo $k; ?>">
                            <?php endif;?>
                            <input type="hidden" name="order[]" value="<?php echo $k; ?>">
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" name="checkbox[]" id="checkbox1" placeholder="Option <?php echo $k+1; ?>" autocomplete="off" value="<?php echo empty($value) ? '' : $value;?>">
                            </div>
                            <div class="form-group col-md-2 pt-2 text-info ui-state-default">
                               <i class="fa fa-arrows"></i>
                               <?php if($k !=0) :?>
                                    <i class="fa fa-trash text-danger removeMe"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php $k++; endforeach; ?>
                    <input type="hidden" name="edit" value="<?php echo $id; ?>">
                    <?php endif; ?>
                    <?php if(!isset($qData)): ?>
                    <div class="form-row">
                        <input class="form-check-input" type="checkbox" name="correctCheck[]" value="0">
                        <input type="hidden" name="order[]" value="0">
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" name="checkbox[]" id="checkbox1" placeholder="Option 1" autocomplete="off">
                        </div>
                        <div class="form-group col-md-2 pt-2 text-info ui-state-default">
                           <i class="fa fa-arrows"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <input class="form-check-input" type="checkbox" name="correctCheck[]" value="1">
                        <input type="hidden" name="order[]" value="1">
                        <div class="form-group col-md-9">
                            <input type="text" class="form-control" name="checkbox[]" id="checkbox2" placeholder="Option 2">
                        </div>
                        <div class="form-group col-md-2 pt-2 ui-state-default">
                           <i class="fa fa-arrows text-info"></i>
                           <i class="fa fa-trash text-danger removeMe"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2 pt-2 text-dark">
                       <i class="fa fa-plus-circle fa-2x" id="addMatchingRow"></i>
                    </div>
                </div>
            </div>
        </div>
        <!--Matching-->


        <!--Feedback-->
<!--        <div class="row pb-5">-->
<!--            <div class="col-md-11">-->
<!--                -->
<!--                <div class="mt-3">-->
<!--                    <div class="form-row">-->
<!--                        <div class="form-group col-md-11">-->
<!--                            <label class="text-primary" data-toggle="collapse" data-target="#feed" aria-expanded="false">Feedback <i class="fa"></i></label>-->
<!--                            <div id="feed" class="collapse">-->
<!--                                <textarea class="form-control" id="feedback" name="feedback" placeholder="Add explanation shown after question is attempted." rows="2"></textarea>-->
<!--                            </div>-->
<!--                            -->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-row">-->
<!--                        <div class="form-group col-md-11">-->
<!--                            <p>-->
<!--                                <button type="button" class="btn brn-light text-primary" data-toggle="collapse" data-target="#tags" aria-expanded="false">Tags <i class="fa"></i></button>-->
<!--                            </p>-->
<!--                            <div id="tags" class="collapse">-->
<!--                                <input type="text" name="tags" placeholder="Comma Seprated" class="form-control">-->
<!--                            </div>-->
<!--                            -->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
        <!--Feedback-->



    </div>      
</main>
<?php $this->load->view('admin/exam/footer');?>

<script type="text/javascript">

$(document).ready(function(){
    var add = 1;
    $("#addMatchingRow").click(function() {
        add = add + 1;
        $.post( "<?php echo base_url('admin/exam/addCheckboxRow'); ?>", {count:add},function( data ) {
            $( "#sortable" ).append( data );
        });
    });

    $( "body" ).delegate( ".removeMe", "click", function() {
        $(this).closest('.form-row').remove();
    });

    <?php
    if(!empty($image)): ?>
        $(".upload-file").children().hide();
        $('.upload-file').css("background-image", "url(<?php echo $image; ?>)");

    <?php endif; ?>

});

</script>

