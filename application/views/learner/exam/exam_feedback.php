<style>
</style>

<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["examfeedback"]?></h2>
			
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<div class="tabs">
				<div class="tab-content">
					<div class="tab-pane active">
						<section class="card">
							<div class="card-body">
                                <div class="col-sm-12">
                                <form class="form-group form-bordered" id="add-form" action="<?php echo base_url($company['company_url'])?>learner/demand/save_exam_feedback/<?php echo $exam_history->id;?>" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                                        <input type="hidden" id="exam_id" name="exam_id" value="<?php echo $exam_history->exam_id;?>">
                                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $exam_history->user_id;?>">
                                        <div class="control-group">
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                1. What I learned most from this course was:
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer1" name="answer1"><?php echo $feedback->answer1;?></textarea>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                2. What I still need to learn more about is:
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer2" name="answer2"><?php echo $feedback->answer2;?></textarea>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                3. I will apply the following in my organization:
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer3" name="answer3"><?php echo $feedback->answer3;?></textarea>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                4. I will have difficulty applying the following to my organization:
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer4" name="answer4"><?php echo $feedback->answer4;?></textarea>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                5. My overall feeling about the course is:
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer5" name="answer5"><?php echo $feedback->answer5;?></textarea>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                6. The course might have been more effective if:
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer6" name="answer6"><?php echo $feedback->answer6;?></textarea>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                7. Please rate and comment on the following:
                                            </label></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">1=Poor 2=Fair 3=Average 4=Good 5=Excellent<br>Course Content 1 2 3 4 5<br></label></br>
                                            <!--<input type="text" id="answer7_content" name="answer7_content" class="col-lg-12 form-control control-text"></br>-->
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_content)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
                                            
									    </span>
                                            <input type="hidden" id="answer7_content" name="answer7_content" value="<?php echo $feedback->answer7_content;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Methods 1 2 3 4 5<br></label></br>
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_method)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                            <input type="hidden" id="answer7_method" name="answer7_method" value="<?php echo $feedback->answer7_method;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Materials 1 2 3 4 5<br></label></br>
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_material)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                            <input type="hidden" id="answer7_material" name="answer7_material" value="<?php echo $feedback->answer7_material;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Trainer __________ 1 2 3 4 5<br></label></br>
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_trainer1)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                            <input type="hidden" id="answer7_trainer1" name="answer7_trainer1" value="<?php echo $feedback->answer7_trainer1;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Trainer __________ 1 2 3 4 5<br></label></br>
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_trainer2)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                            <input type="hidden" id="answer7_trainer2" name="answer7_trainer2" value="<?php echo $feedback->answer7_trainer2;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Organization 1 2 3 4 5<br></label></br>
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_organ)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                            <input type="hidden" id="answer7_organ" name="answer7_organ" value="<?php echo $feedback->answer7_organ;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Facilities 1 2 3 4 5<br></label></br>
                                            <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                             <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_facilities)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                            <input type="hidden" id="answer7_facilities" name="answer7_facilities" value="<?php echo $feedback->answer7_facilities;?>" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Pre course organization/communication, advertising<br>&nbsp;Comments: (including length, daily hours, etc)</label></br>
                                            <input type="text" id="answer7_com" value="<?php echo $feedback->answer7_com;?>" name="answer7_com" class="col-lg-12 form-control control-text"></br>
                                            <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                                8. Any other comments: (use additional paper as necessary)
                                            </label></br>
                                            <textarea class="col-lg-12 form-control control-text" rows="3" id="answer8" name="answer8"><?php echo $feedback->answer8;?></textarea>
                                        </div>
                                        <button type="submit" class="btn" style="margin: 10px;margin-bottom: 0px;width: 100px;">Save</button>
                                        </form>
                                </div>
                                
							</div>
						</section>	
					</div>					
				</div>
			</div>
		</div>
	</div>
	
	<!-- end: page -->
</section>

<script>
    $('body').imagesLoaded().always(function () {
        change_parent_height();
    });

    $(document).ready(function() {

        $(".starReviewBox a").click(function () {
            $(this).parents('.starReviewBox').find('i').css('color', '');
            var siblings = $(this).prevAll('a');
            $(this).find('i').css('color', '#ffba00');
            siblings.find('i').css('color', '#ffba00');
            $(this).parents('.starReviewBox').next().val(siblings.length + 1);
        });
    });

    function change_parent_height() {
        var height = $('#iframe_body').height() + 50;
        $(window.top.document.getElementById('course_container')).height(height);
    }
</script>