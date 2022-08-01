<?php $current = $count + 1; ?>
<div class="form-row">
    <div class="form-group col-md-5">
        <input type="text" class="form-control" name="choice[]" id="choice<?php echo $current; ?>" placeholder="Choice <?php echo $current; ?>">
    </div>
    <div class="form-group col-md-5">
        <input type="text" class="form-control" name="match[]" id="match<?php echo $current; ?>" placeholder="Match <?php echo $current; ?>">
    </div>
    <div class="form-group col-md-2 pt-2 text-info ui-state-default">
       <i class="fa fa-arrows"></i>
       <i class="fa fa-trash text-danger removeMe"></i>
    </div>
</div>