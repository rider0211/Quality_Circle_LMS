<?php $i=0; foreach($checkbox as $key=>$value):?>
    <?php $temp_count = 0;?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-check">
                <?php for ($i=0;$i<count($correctCheck);$i++){?>
                    <?php if ($correctCheck[$i] == $key  && (empty($total))):?>
                        <?php $temp_count++;?>
                        <input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $value;?>" <?php echo $this->session->userdata('user_type') != 'Learner'?'checked':''?> >
                    <?php endif;?>
                <?php }?>
                <?php if ($temp_count == 0):?>
                    <input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $value;?>">
                <?php endif;?>
                <label class="form-check-label" for="exampleRadios1">
                <?php echo empty($value)?'Option '. ++$i : $value; ?>
                </label>
            </div>
        </div>
    </div>
<?php endforeach;?>
