<?php $current = $count + 1; ?>
<div class="form-row">
    <input class="form-check-input" type="radio" name="correctCheck[]" value="<?php echo $count; ?>">
    <input type="hidden" name="order[]" value="<?php echo $count; ?>">
    <div class="form-group col-md-9">
        <input type="text" class="form-control" name="checkbox[]" placeholder="Option <?php echo $current; ?>">
    </div>
    <div class="form-group col-md-2 pt-2 text-info ui-state-default">
       <i class="fa fa-arrows"></i>
       <i class="fa fa-trash text-danger removeMe"></i>
    </div>
</div>