<?php $i=0; foreach($content as $key=>$value):?>
    <ul>
        <li style="list-style: none;">
            <div class="row">
                <div class="col-md-6">
                    <?php echo ++$i.". "; ?>
                    <?php echo empty($value)?'Option '. $i : $value; ?>
                </div>

                <div class="col-md-6">
                   <div class="form-group row">
                        <label for="sort" class="col-sm-1 control-label"> <?php echo $i; ?>. </label>
                        <div class="col-sm-8">
                            <select class="form-control form-control-sm" name="matching[]">
                                <?php $j = 0; foreach ($match as $k=>$val): ?>
                                    <option value="<?php echo $val;?>" <?php if ($val == $answers[$i]):?>selected<?php endif;?>><?php echo empty($val)?'Option '. ++$j : $val; ?></option>
                                <?php endforeach;?>
                            </select>
                         </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
<?php endforeach;?>