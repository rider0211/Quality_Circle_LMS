<?php
$title = "Write Essay";
$value = "";
$image = '';

$pass_mark = $qData['pass_mark'];
$max_mark = $qData['max_mark'];

if($qData['ques_title'] != ''){
    $title = $qData['ques_title'];
   
    if(isset($qData['ques_file']) && !empty($qData['ques_file']))
        $image = base_url().'assets/uploads/exam/quiz/'.$qData['ques_file'];
}

?>
<script type="text/javascript">
    //var base_url = '<?php echo BASE_URL;?>';
    var pass_mark = '<?php echo $pass_mark;?>';
    var max_mark = '<?php echo $max_mark;?>';

    $(document).ready(function() {
        //alert(pass_mark);
        $("#pass_mark").val(pass_mark);
        $("#max_mark").val(max_mark);
    });
    
</script>


<?php $this->load->view('admin/exam/header');?>
<main role="main" class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-11">
                <h4 class="mb-3">Essay</h4>
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
                            <textarea class="form-control form-control-lg" name="ques_title" id="checkbox" placeholder="Match The Following" rows="3" ><?php echo $title; ?></textarea>
                            <input type="hidden" name="que_type" value="essay">
                        </div>

                        <div class="form-group row">
                            <div class="col-md-2">
                                <small>Max Characters</small>
                                <select class="custom-select form-control-sm" name="max-length">
                                    <option>No Limit</option>
                                    <?php for($i = 50; $i <= 3000; $i = $i + 50):
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                        if($i == 1000 || $i == 2000) $i = $i + 950;
                                    endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="control-label text-lg-right pt-2">Pass Mark</label>                           
                                <div data-plugin-spinner="">
                                    <div class="input-group form-control-small">
                                    <input type="text" class="spinner-input form-control" name="pass_mark" id="pass_mark" maxlength="5" value="0">
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs btn-default">
                                                <i class="fas fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs btn-default">
                                                <i class="fas fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label text-lg-right pt-2">Maximum Mark</label>                           
                                <div data-plugin-spinner="">
                                    <div class="input-group form-control-small">
                                    <input type="text" class="spinner-input form-control" name="max_mark" id="max_mark" maxlength="5" value="0">
                                        <div class="spinner-buttons input-group-btn btn-group-vertical">
                                            <button type="button" class="btn spinner-up btn-xs btn-default">
                                                <i class="fas fa-angle-up"></i>
                                            </button>
                                            <button type="button" class="btn spinner-down btn-xs btn-default">
                                                <i class="fas fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

        <!--Feedback-->
<!--        <div class="row pb-5">-->
<!--            <div class="col-md-11">-->
<!--                    <div class="form-row">-->
<!--                        <div class="form-group col-md-11">-->
<!--                            <label class="text-primary" data-toggle="collapse" data-target="#feed" aria-expanded="false">Feedback <i class="fa"></i></label>-->
<!--                            <div id="feed" class="collapse">-->
<!--                                <textarea class="form-control" name="feedback" id="feedback" placeholder="Add explanation shown after question is attempted." rows="2"></textarea>-->
<!--                            </div>-->
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
<!--                        </div>-->
<!--                    </div>-->
                    <?php if(isset($qData)): ?>
                        <input type="hidden" name="edit" value="<?php echo $id; ?>">
                    <?php endif;?>
<!---->
<!--            </div>-->
<!--        </div>-->
        <!--Feedback-->

    </div>      
</main>
<?php $this->load->view('admin/exam/footer');?>

<script type="text/javascript">
    $(function(){
        if(!$("html").hasClass("sidebar-left-collapsed"))
        {
            $("html").addClass("sidebar-left-collapsed");
            $("html").removeClass("sidebar-left-opened");
        }
    });
<?php
    if(!empty($image)): ?>
        $(".upload-file").children().hide();
        $('.upload-file').css("background-image", "url(<?php echo $image; ?>)");

    <?php endif; ?>
</script>