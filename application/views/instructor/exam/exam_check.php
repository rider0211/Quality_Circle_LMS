<style>
	.table-bordered{
		text-align: center;
		color: black;
	}
	.table-bordered th, .table-bordered td {
		border: 1px solid #000000;
	}
	.green-td{
		background-color: #99CC15;
		font-size: 20px;
	}
	.yellow-td{
		background-color: #FCF317;
		/*font-size: 20px;*/
	}
	.thingreen-td{
		background-color: #CCFFCC;
	}
	td,th{
		vertical-align: middle !important;
	}
	.hover-td:hover{
		background-color: gray;
		cursor: pointer;
	}
</style>
<section role="main" class="content-body">
	<header class="page-header">
		<h2><?=$term["examcheck"]?></h2>
		<?php $user_id = $this->session->get_userdata()['user_id'];?>
	</header>

	<!-- start: page -->
	<div class="row">
		<div class="col-lg-12">
			<div class="tabs">
				<div class="tab-content">
					<div class="tab-pane active">
						<section class="card">
							<div class="card-body">
								<table class="table table-bordered">
									<tr>
										<th class="green-td" colspan="<?=$quiz_number*2+8?>"><?=$term["examiso"]?></th>
									</tr>
									<tr>
										<th class="yellow-td" width="15%"><?=$term["coursevenue"]?></th>
										<th width="50%" colspan="<?=$quiz_number*2+2?>">KingStone Jamaika</th>
										<th class="yellow-td" width="16%" colspan="2"><?=$term["observer"]?></th>
										<th width="19%" colspan="3"></th>
									</tr>
									<tr>
										<th class="yellow-td" width="15%"><?=$term["trainers"]?></th>
										<th width="%">1</th>
										<th width="%" colspan="<?=$quiz_number?>"></th>
										<th width="%">2</th>
										<th width="%" colspan="<?=$quiz_number?>"></th>
										<th class="yellow-td" width="16%" colspan="2"><?=$term["dates"]?></th>
										<th width="19%" colspan="3"></th>
									</tr>
									<tr>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["delegatename"]?></th>
										<th class="yellow-td" width="%" colspan="<?=$quiz_number?>"><?=$term["marker"]?>1<br><?=$term["examsection"]?></th>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["total"]?></th>
										<th class="yellow-td" width="%" colspan="<?=$quiz_number?>"><?=$term["marker"]?>2<br><?=$term["examsection"]?></th>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["total"]?></th>
										<th class="yellow-td" width="%" rowspan="2">% <?=$term["mark"]?></th>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["continualassessment"]?></th>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["indicatepass"]?></th>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["certificatenumber"]?></th>
										<th class="yellow-td" width="%" rowspan="2"><?=$term["dateissued"]?></th>
									</tr>
									<tr>
										<?php
											for ($i=0;$i<$quiz_number;$i++){
												echo '<th class="yellow-td" width="%">'.($i+1).'</th>';
											}
											for ($i=0;$i<$quiz_number;$i++){
												echo '<th class="yellow-td" width="%">'.($i+1).'</th>';
											}
										?>
									</tr>
									<?php $total_array = array();?>
									<?php foreach($exam_user as $user):?>
										<?php
											$total_mark1 = 0;
											$total_mark2 = 0;
											$temp_user_id = 0;
										?>
										<tr>
											<td class="thingreen-td"><?=$user->fullname?></td>
											<?php $temp_count = 0;?>
											<?php foreach($exam_history as $history):?>
												<?php if ($temp_count == 0){
													$temp_user_id = $history->user_id;
												}
												?>
												<?php if (($user->user_id == $history->user_id) && ($temp_user_id == $history->user_id)):?>
													<?php if ($user_id == $exam_info->marker1_id):?>
															<?php echo $exam_info->marker1_id;?>
														<td class="thingreen-td hover-td" onclick="change_mark(<?=$history->id?>,1)"><?=$history->mark1?></td>
													<?php else:?>
														<td class="thingreen-td"><?=$history->mark1?></td>
													<?php endif;?>
													<?php
														$total_mark1 += $history->mark1;
													?>
													<?php $temp_count++;?>
												<?php endif;?>
												<?php $temp_user_id = $history->user_id;?>
											<?php endforeach;?>
											<?php array_push($total_array,$total_mark1);?>
											<td class="thingreen-td"><?=$total_mark1?></td>
											<?php $temp_count = 0;$temp_user_id = 0;?>
											<?php foreach($exam_history as $history):?>
												<?php if ($temp_count == 0){
													$temp_user_id = $history->user_id;
												}
												?>
												<?php if (($user->user_id == $history->user_id) && ($temp_user_id == $history->user_id)):?>
													<?php if ($user_id == $exam_info->marker2_id):?>
														<?php echo $exam_info->marker2_id;?>
														<td class="thingreen-td hover-td" onclick="change_mark(<?=$history->id?>,2)"><?=$history->mark2?></td>
													<?php else:?>
														<td class="thingreen-td"><?=$history->mark2?></td>
													<?php endif;?>
													<?php
													$total_mark2 += $history->mark2;
													?>
													<?php $temp_count++;?>
												<?php endif;?>
												<?php $temp_user_id = $history->user_id;?>
											<?php endforeach;?>
											<?php array_push($total_array,$total_mark2);?>
											<td class="thingreen-td"><?=$total_mark2?></td>
											<td class="thingreen-td">0</td>
											<td class="thingreen-td"><?=$term["pass"]?></td>
											<td class="thingreen-td"><?=$user->exam_status?></td>
											<td class="thingreen-td"></td>
											<td class="thingreen-td"></td>
										</tr>
									<?php endforeach;?>
									<tr>
										<td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td><td class="thingreen-td"></td>
									</tr>
									<tr>
										<td class="yellow-td" width="%"><?=$term["markername"]?></td>
										<td width="%" colspan="<?=$quiz_number+1?>"><?=$markers->marker1?></td>
										<td width="%" colspan="<?=$quiz_number+1?>"><?=$markers->marker2?></td>
										<td width="%"></td>
										<td class="yellow-td" width="%"><?=$term["examused"]?></td>
										<td width="%"></td>
										<td class="yellow-td" width="%"><?=$term["version"]?></td>
										<td width="%"></td>
									</tr>
									<tr>
										<td class="yellow-td" width="%"><?=$term["numberattended"]?></td>
										<td class="yellow-td" width="%" colspan="2"><?=$term["passedca"]?></td>
										<td class="yellow-td" width="%" colspan="<?=$quiz_number-1?>"><?=$term["tookexam"]?></td>
										<td class="yellow-td" width="%" colspan="2"><?=$term["passedexam"]?></td>
										<td class="yellow-td" width="%" colspan="<?=$quiz_number?>"><?=$term["passedcourse"]?></td>
										<td class="yellow-td" width="%"><?=$term["coursefail"]?></td>
										<td class="yellow-td" width="%"><?=$term["lowest"]?> %</td>
										<td class="yellow-td" width="%"><?=$term["highest"]?> %</td>
										<td width="%"></td>
									</tr>
									<tr>
										<?php $pass_count = 0;$fail_count = 0;$lowest = 0;$highest = 0;?>
										<?php
											$lowest = $total_array[0];
											for($i=0;$i<count($total_array);$i++){
												if ($total_array[$i] > $highest){
													$highest = $total_array[$i];
												}else if ($total_array[$i] < $lowest){
													$lowest = $total_array[$i];
												}
											}
										?>
										<?php foreach($exam_user as $user):?>
											<?php if ($user->exam_status == "Pass"):?>
												<?php $pass_count++;?>
											<?php elseif ($user->exam_status == "Fail"):?>
												<?php $fail_count++;?>
											<?php endif;?>
										<?php endforeach;?>
										<td width="%"><?=count($exam_user)?></td>
										<td width="%" colspan="2"><?=count($exam_user)?></td>
										<td width="%" colspan="<?=$quiz_number-1?>"><?=count($exam_user)?></td>
										<td width="%" colspan="2"><?=$pass_count?></td>
										<td width="%" colspan="<?=$quiz_number?>"><?=$pass_count?></td>
										<td width="%" colspan="<?=$quiz_number-1?>"><?=$fail_count?></td>
										<td width="%"><?=$lowest?></td>
										<td width="%"><?=$highest?></td>
										<td width="%"></td>
									</tr>
									<tr>
										<td class="yellow-td" width="%"><?=$term["administrator"]?></td>
										<td  width="%" colspan="<?=$quiz_number*2+1?>"></td>
										<td class="yellow-td" width="%" colspan="2"><?=$term["date"]?></td>
										<td  width="%" colspan="4"></td>
									</tr>
								</table>
								<div class="col-sm-12">
									<div class="control-group" style="border-bottom: 1px solid #C2C2C2;" onclick = "exam_title_modal()">
										<label id="exam_title_label" class="control-label col-lg-12" style="font-size: 22px;color: black;" for="textinput-0"><?=$exam_info->title?></label>
										<?php if ($exam_info->image_path != ""):?>
											<img id="exam_image_div" class="col-lg-12" style="height: 10rem;width: auto;" src="<?=base_url()?>assets/uploads/exam/<?=$exam_info->image_path?>">
										<?php endif;?>
										<label id="exam_description_label" class="control-label col-lg-12" style="font-size: 15px;" for="textinput-0"><?=$exam_info->description?></label>
									</div>
									<div class="control-group">
										<?php $temp_count = 0;?>
										<?php foreach ($exam_quiz_info as $quiz):?>
											<?php $temp_count++;?>
											<label class="control-label col-lg-12" style="font-size: 15px;" for="textinput-0"><p style="font-size: 20px;float: left;"><?=$temp_count?>.&nbsp;&nbsp;</p><?=$quiz->description?></label>
											<?php if ($quiz->image_path != ""):?>
												<div class="col-lg-12"><img style="height: 10rem;width: auto;" src="<?=base_url()?>assets/uploads/exam/<?=$quiz->image_path?>"></div>
											<?php endif;?>
											<div class="col-lg-12"><textarea class="col-lg-6" rows="5" readonly></textarea></div>
											<label class="control-label col-lg-12" style="font-size: 15px;" for="textinput-0">Feedback:</label>
											<label class="control-label col-lg-12" style="font-size: 15px;" for="textinput-0"><p><?=$quiz->feedback?></p></label>
										<?php endforeach;?>
									</div>
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
<div id="Mark_modal" class="modal fade">
	<div class="modal-dialog" style = "width: 40%;max-width: 40%;">
		<div class="modal-content">
			<div class="modal-header bg-default">
				<h3 class="modal-title"><?=$term["updatemark"]?></h3>
			</div>
			<form id="mark_form" class="form-horizontal" method="post" action="<?=base_url()?>instructor/examhistory/change_mark">
				<input type="hidden" id="exam_id" name="exam_id" value="<?=$exam_info->id?>">
				<input type="hidden" id="mark_type" name="mark_type" value="0">
				<input type="hidden" id="history_id" name="history_id" value="0">
				<div class="modal-body">
					<div class="col-lg-12" style="display: flex;">
						<label class="col-lg-2 control-label text-sm-left pt-2"><?=$term["mark"]?></label>
						<input type="text" id="mark" name="mark" class="form-control col-lg-10" placeholder="<?=$term["mark"]?>" required value="0">
					</div>
				</div>
			</form>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" onclick="update_mark()">OK</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
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

	function change_mark(id,type) {
		$("#history_id").val(id);
		$("#mark_type").val(type);
		$("#Mark_modal").modal();
	}
	function update_mark(){
		$("#mark_form").submit();
	}
jQuery(document).ready(function() {
});
</script>