<div class="form-row">
    <div class="form-group col-md-10">
        
    </div>
</div>
<div class="col-md-12" style="margin-bottom: 10px;">
Your Answer:
<?php 
echo implode(', ',$userAns['blank']);
?>
</div>
</div>
<div class="card-footer text-muted">
    <?php 
	if(empty($blank)){
		echo "Correct Answer(s): NA"; 
	} else {
		echo "Correct Answer(s): ".implode(', ', $blank);
	}
	$temp_count = 0;
	$part_count = 0;
	for ($i=0;$i<count($blank);$i++){
		$correct_answer = explode(";",$blank[$i]);
		for ($j=0;$j<count($correct_answer);$j++){
			if ($correct_answer[$j] == $userAns['blank'][$i]){
				$part_count++;
			}
		}
		if ($part_count < 1){
			$temp_count++;
		}
	}
	if($temp_count <= 0){
		echo '<div class="text-success float-right"><i class="fa fa-check"></i> <span>Correct Answer</span></div>';
	} else {
		echo '<div class="text-danger float-right"><i class="fa fa-close"></i> <span>Wrong Answer</span></div>';
	}
	?>
</div>


    