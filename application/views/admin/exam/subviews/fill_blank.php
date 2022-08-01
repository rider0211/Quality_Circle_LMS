<div class="form-row">
    <div class="form-group col-md-10">
        <input type="text" class="form-control" name="blank">
    </div>
</div>
<?php 
if(empty($blank)){
	echo "Possible Answer(s): NA";
} else {
	echo "Possible Answer(s): ".implode(', ', $blank);
}
?>


    