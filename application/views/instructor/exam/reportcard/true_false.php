<?php $i=0; foreach($tftext as $key=>$value):?>
    <div class="row">
        <div class="col-md-6">
           <div class="form-check">
              
              <label class="form-check-label" for="exampleRadios1">
                <?php echo empty($value) ? 'Option '. ++$i : $value; ?>
              </label>
            </div>
        </div>
    </div>
<?php endforeach;?>
<div class="col-md-12" style="margin-bottom: 10px;">
Your Answer:
<?php 
if (isset($userAns['true_false'][0])) {
  echo $userAns['true_false'][0];
}

?>
</div>
</div>
<div class="card-footer text-muted">
    Correct Answer:
	<?php
    if (isset($tftext[$settrue])) {
        print_r($tftext[$settrue]);

        if($userAns['true_false'][0] == $tftext[$settrue]){
            echo '<div class="text-success float-right"><i class="fa fa-check"></i> <span>Correct Answer</span></div>';
        } else {
            echo '<div class="text-danger float-right"><i class="fa fa-close"></i> <span>Wrong Answer</span></div>';
        }
    }

	
	?>
</div>