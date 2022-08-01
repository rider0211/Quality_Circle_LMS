<table class="table table-responsive-md table-striped table-hover mb-0 dataTable no-footer" id="datatable_examlist" role="grid" style="width: 1563px;">
  <thead style="background-color:#1D2127; color:#FFF">
  <td><b>S.No.</b></td>
    <td><b>Course Title</b></td>
    <td><b>Course Type</b></td>
    <td><b>Total Count</b></td>
    <td><b>Action</b></td>
    </thead>
  <tbody>
    <?php if(isset($data) && !empty($data)){ ?>
    <?php foreach($data as $mkey => $myenroll){
		if($myenroll['type'] == 0){
			$course_type = 'ILT';
		}elseif($myenroll['type'] == 1){
			$course_type = 'VILT';
		}else{
			$course_type = 'Demand';
		}
	?>
    <tr role="row" class="odd">
      <td class="center sorting_<?php $myenroll['no']  ?>"><?php echo $myenroll['no'] ?></td>
      <td class="text-left"><?php echo $myenroll['title'] ?></td>
      <td class="text-left"><?php echo $course_type; ?></td>
      <td class="text-left"><?php echo $myenroll['count'] ?></td>
      <?php if($myenroll['type'] == 2){ ?>
      <td class=" text-left"><a style="background-color:#1D2127; color:#FFF; border:0px;" target="_blank" class="btn btn-default btn-sm" id="append_view_<?php echo $myenroll['id'] ?>" href="<?= base_url()?>instructor/examhistory/enrolled_course_users/<?php echo $myenroll['id'] ?>/0">View</a></td>
      <?php }else{ ?>
      <td class=" text-left"><a style="background-color:#1D2127; color:#FFF; border:0px;" class="btn btn-default btn-sm" id="append_view_<?php echo $myenroll['id'] ?>" href="javascript:void(0)" onclick="getEnrolled(<?php echo $myenroll['id'] ?>)">View</a></td>
      <?php } ?>
    </tr>
    <?php $course_times = getCourseDetail($myenroll['id'],$myenroll['type']); 
		if($course_times != ''){							
	?>
    <tr style="display:none;" role="row" class="odd" id="sub_tr_<?php echo $myenroll['id'] ?>">
      <td colspan="5"><table width="100%">
          <thead style="background-color:#1D2127; color:#FFF">
          <td><b>S.No.</b></td>
            <td><b>Course Title</b></td>
            <td><b>Schedule Date</b></td>
            <td><b>Total Count</b></td>
            <td><b>Action</b></td>
            </thead>
            <?php foreach($course_times as $keys => $courseSchedule){ 

				$totalEnCount = getScheTotalCount($myenroll['id'],$courseSchedule['time_id']); 
			?>
          <tr role="row" class="odd">
            <td><?php echo $keys+1; ?></td>
            <td class="text-left"><?php echo $courseSchedule['title'] ?></td>
            <?php if($myenroll['type'] == 1){ 
				$stringDate = strtotime($courseSchedule['start_at']);
			?>
            <td class="text-left"><?php echo date('F d,Y',strtotime($courseSchedule['start_at'])) ?></td>
            <?php } ?>
            <?php if($myenroll['type'] == 0){ 
				$stringDate = $courseSchedule['date_str'];
				if($courseSchedule['date_str'] != ''){
			?>
            <td class="text-left"><?php echo date('F d,Y',$courseSchedule['date_str']) ?></td>
            <?php } else{ ?>
            <td class="text-left">Not Available</td>
            <?php } } ?>
            <td class="text-left"><?php echo $totalEnCount;?></td>
            <td class="text-left"><a target="_blank" class="btn btn-default btn-sm" id="append_view_<?php echo $courseSchedule['id'] ?>" href="<?= base_url()?>instructor/examhistory/enrolled_course_users/<?php echo $myenroll['id'] ?>/<?php echo $courseSchedule['time_id'] ?>/<?php echo $stringDate;?>">View</a></td>
          </tr>
          <?php } ?>
        </table></td>
    </tr>
    <?php }}}else{ ?>
    	 <tr role="row" class="odd">
            <td colspan="5" class="text-center">No Record Found.</td>
         </tr>
    <?php } ?>
  </tbody>
</table>
