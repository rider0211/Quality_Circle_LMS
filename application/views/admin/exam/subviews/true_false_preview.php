<?php $i=0; foreach($tftext as $key=>$value):?>
    <div class="row">
        <div class="col-md-6">
           <div class="form-check">
               <?php if ($settrue[0] == $value  && (empty($total))):?>
                   <input class="form-check-input" type="radio" name="true_false[]" value="<?php echo $value; ?>" checked>
               <?php else:?>
                   <input class="form-check-input" type="radio" name="true_false[]" value="<?php echo $value; ?>">
               <?php endif;?>
              <label class="form-check-label" for="exampleRadios1">
                <?php echo empty($value) ? 'Option '. ++$i : $value; ?>
              </label>
            </div>
        </div>
    </div>
<?php endforeach;?>