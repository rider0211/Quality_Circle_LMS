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