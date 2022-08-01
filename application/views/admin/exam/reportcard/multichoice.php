<ol>
<?php $i=0; foreach($checkbox as $key=>$value):?>
<li type="A">
    <div class="row">
        <div class="col-md-6">
           <div class="form-check">
              <label class="form-check-label" for="exampleRadios1">
                <?php echo empty($value)?'Option '. ++$i : $value; ?>
              </label>
            </div>
        </div>
    </div>
</li>
<?php endforeach;?>
</ol>
<div class="col-md-12" style="margin-bottom: 10px;">
Your Answer:
<?php
$last = $useranswer = '';
$mystring = $_SERVER['HTTP_REFERER'];
$reportStr = $_SERVER['REQUEST_URI'];
if(strpos($mystring, 'next') !== false){
	$last = end(explode('=', $mystring));
	$useranswer = 'multichoice'.$last;
}
if(strpos($reportStr, 'reportCard') !== false || strpos($reportStr, 'preview_history') !== false){
	$x = 0;	
	foreach($userAns as $keys=>$vals){
		if($x == 1){
			$useranswer = $keys;
			break;	
		}
		$x++;
	}
}
if(!empty($useranswer))
echo ($userAns[$useranswer]);
?>
</div>
</div>
<div class="card-footer text-muted">
    Correct Answer:
    <?php	
        $ans = '';
        if (isset($checkbox[$correctCheck[0]])) {
            echo $ans = $checkbox[$correctCheck[0]];
        } else {
            echo $ans = "N/A";
        }
		
        if(isset($userAns[$useranswer]))
		if($ans == $userAns[$useranswer]){
            echo '<div class="text-success float-right"><i class="fa fa-check"></i> <span>Correct Answer</span></div>';
        } else {
            echo '<div class="text-danger float-right"><i class="fa fa-close"></i> <span>Wrong Answer</span></div>';
        }

    ?>
</div>

