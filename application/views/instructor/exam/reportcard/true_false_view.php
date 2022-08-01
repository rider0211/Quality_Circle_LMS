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