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
if(!empty($userAns['checkbox']))
    echo implode(',', $userAns['checkbox']);
?>
</div>
</div>
<div class="card-footer text-muted">
    Correct Answer:

	<?php
    
    $correctAns = array();
    
    if(is_array($correctCheck)):
        for($j=0;$j<count($correctCheck);$j++){
            $correctAns[] = $checkbox[$correctCheck[$j]];
        }
    	echo implode(',', $correctAns);
    endif;

    if(!empty($userAns['checkbox']) && $userAns['checkbox'] === $correctAns){
        echo '<div class="text-success float-right"><i class="fa fa-check"></i> <span>Correct Answer</span></div>';
    } else {
        echo '<div class="text-danger float-right"><i class="fa fa-close"></i> <span>Wrong Answer</span></div>';
    }

	?>
</div>

