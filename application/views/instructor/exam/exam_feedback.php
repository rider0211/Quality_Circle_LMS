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
                                    <div class="control-group">
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            1. What I learned most from this course was:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer1?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            2. What I still need to learn more about is:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer2?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            3. I will apply the following in my organization:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer3?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            4. I will have difficulty applying the following to my organization:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer4?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            5. My overall feeling about the course is:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer5?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            6. The course might have been more effective if:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer6?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            7. Please rate and comment on the following:
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">1=Poor 2=Fair 3=Average 4=Good 5=Excellent<br>Course Content 1 2 3 4 5<br>&nbsp;Comments:</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_content)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Methods 1 2 3 4 5<br>&nbsp;Comments:</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_method)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Materials 1 2 3 4 5<br>&nbsp;Comments:</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_material)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Trainer __________ 1 2 3 4 5<br>&nbsp;Comments: (Name)</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_trainer1)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Trainer __________ 1 2 3 4 5<br>&nbsp;Comments: (Name)</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_trainer2)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Course Organization 1 2 3 4 5<br>&nbsp;Comments: (including length, daily hours, etc)</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_organ)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Facilities 1 2 3 4 5<br>&nbsp;Comments: (including length, daily hours, etc)</label>
                                        <span class="starReviewBox" style="font-size: 14px;padding: 10px;padding-left: 30px;">
                                            <?php for($i = 1; $i<6; $i++) {
                                                if($i <= intval($feedback->answer7_facilities)){?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip" style="color:#ffba00"></i></a>
                                                <?php }else{?>
                                                    <a><i class="fa fa-star" data-toggle="tooltip"></i></a>
                                                <?php }
                                            }?>
									    </span>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0">Pre course organization/communication, advertising<br>&nbsp;Comments: (including length, daily hours, etc)</label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 0px;padding-left: 50px;" for="textinput-0"><?=$feedback->answer7_com?></label>
                                        <label class="control-label col-lg-12" style="font-size: 18px;" for="textinput-0">
                                            8. Any other comments: (use additional paper as necessary)
                                        </label>
                                        <label class="control-label col-lg-12" style="font-size: 14px;padding: 10px;padding-left: 30px;" for="textinput-0"><?=$feedback->answer8?></label>
                                    </div>
									<a type="button" class="btn btn-default btn-sm" style="margin: 10px;margin-bottom: 0px;width: 100px;" onclick="window.history.back()">Back</a>
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
	var $fasi_table = $('#datatable_fasi_assign');

	function deleteAssign(id) {
		(new PNotify({
            title: "<?php echo $term['confirmation']; ?>",
            text: "<?php echo $term['areyousuretodelete']; ?>",
			type: 'primary',
			confirm: {
				confirm: true
			},
			button: {
				closer: false,
				sticker: false
			},
			addclass: 'stack-modal',
			stack: {
				'dir1': 'down',
				'dir2': 'right',
				'modal':true
			}
		})).get().on('pnotify.confirm', function(){
			$.ajax({
                url: '<?php echo base_url();?>all/trainingassign/delete_assign',
                type: 'POST',
                data: {'id': id},
                success: function (data, status, xhr) {	
                	$fasi_table.DataTable().ajax.reload('', false);	
				},
				error: function(){
					new PNotify({
                        title: '<?php echo $term['error']; ?>',
                        text: '<?php echo $term['youcantdeletethisitem']; ?>',
						type: 'error'
					});		
				}
			});	
		});		
	}

	function changeAssign(id) {
		$frm_fasi = $('#form_fasi_assign');
		$('#fasi_row_id').val(id);
		$frm_fasi.submit();
	}
jQuery(document).ready(function() {
});
</script>