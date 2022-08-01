<?php
$title = "Type question here. Example: Practice makes you [Blank]";
if($qData['ques_title'] != ''){
    $title = $qData['ques_title'];

    if(isset($qData['ques_file']) && !empty($qData['ques_file']))
        $image = base_url().'assets/uploads/exam/quiz/'.$qData['ques_file'];
}

?>
<?php $this->load->view('instructor/exam/header');?>
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
                            <textarea class="form-control form-control-lg" id="checkbox" name="ques_title" placeholder="Type question here. Example: Practice makes you [Blank]" rows="3"><?php echo str_replace('__', '[Blank]', $title); ?></textarea>
                            <input type="hidden" name="que_type" value="fill-blank">
                        </div>
                    </div>
                </div>
                <div class="row float-right">
                	<div class="col-md-2">
	                    <div class="form-group">
	                       <button type="button" class="btn btn-default btn-sm" id="addBlankRow"><i class="fa fa-plus-circle"></i> Add Blank Row</button>
	                    </div>
	                </div>
            	</div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <input type="text" class="form-control" id="quiz_code" name="quiz_code" placeholder="Quiz Code" value="<?php echo $quiz_code; ?>">

            </div>

        </div>
        <!--Fill Blank-->
        <div class="row">
            <div class="col-md-11 mt-5">
                <div class="row">
                    <div class="col-md-12">
                        Add answers for blank space(s)
                    </div>
                </div>
                <div class="mt-3" autocomplete="on" id="sortable">
                    <?php if(isset($qData)): ?>
                    <?php $k=0; foreach ($qData['content']['blank'] as $key => $value): ?>
                    <div class="form-row form-count">
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control" name="blank[]" id="blank" placeholder="Type answer. Separate multiple correct answers by comma." autocomplete="off" value="<?php echo $value;?>">
                        </div>
                        <div class="form-group col-md-2 pt-2 text-info ui-state-default">
                           <i class="fa fa-arrows"></i>
                            <?php if ($k != 0):?>
                                <i class="fa fa-trash text-danger removeMe"></i>
                            <?php endif;?>
                        </div>  
                    </div>
                    <?php $k++; endforeach; ?>
                    <input type="hidden" name="edit" value="<?php echo $id; ?>">
                    <?php endif; ?>
                    <?php if(!isset($qData)): ?>
                    <div class="form-row form-count">
                        <div class="form-group col-md-10">
                            <input type="text" class="form-control" name="blank[]" id="blank" placeholder="Type answer. Separate multiple correct answers by comma." autocomplete="off" value="Blank1">
                        </div>
                        <div class="form-group col-md-2 pt-2 text-info ui-state-default">
                            <i class="fa fa-arrows"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--Fill Blank-->
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

<?php $this->load->view('instructor/exam/footer');?>

<script type="text/javascript">

$(document).ready(function(){
    var add = 1;
    $("#addBlankRow").click(function() {
        add = add + 1;
        $.post( "<?php echo base_url('instructor/exam/addBlankRow'); ?>", {count:add},function( data ) {
            $( "#sortable" ).append( data );
            var strAdd = $('#checkbox').summernote('code');
            strAdd = strAdd.replace('<p><br></p>', '');
            strAdd = strAdd.replace('<br>', '');
            strAdd = strAdd.replace('<p>', '');
            strAdd = strAdd.replace('</p>', '');

            var str = strAdd+'[Blank]';
        	
			$('#checkbox').summernote('code',str);
        });
    });
    $("#questionForm").submit(function(e) {
        var text = $('#checkbox').summernote('code');
        var str = text.split("[Blank]");
        if ($(".form-count").length != str.length-1){
            swal({
                text: "Please correct the following error(s):\nPlease add "+$(".form-count").length+" [Blank] in the question.",
                icon: "warning"
            });
            e.preventDefault();
            return false;
        }
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