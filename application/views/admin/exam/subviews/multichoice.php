<?php $i=0; foreach($checkbox as $key=>$value):?>
    <div class="row">
        <div class="col-md-6">
           <div class="form-check">
               <?php if (($correctCheck[0] == $key) && (empty($total))):?>
                   <input class="form-check-input" type="radio" name="multichoice<?php echo $id; ?>" value="<?php echo $value; ?>"  <?php echo $this->session->userdata('user_type') != 'Learner'?'checked':''?> >
               <?php else:?>
                   <input class="form-check-input" type="radio" name="multichoice<?php echo $id; ?>" value="<?php echo $value; ?>">
               <?php endif;?>
               <label class="form-check-label" for="exampleRadios1">
               <?php echo empty($value)?'Option '. ++$i : $value; ?>
               </label>
           </div>
        </div>
    </div>
<?php endforeach;?>