<script type="text/javascript">
  var settrue= '<?php echo $settrue ?>';  
</script>

<?php $i=0; foreach($tftext as $key=>$value):?>
<script type="text/javascript">
  var key= '<?php echo $key ?>';  
</script>
    <div class="row">
        <div class="col-md-6">
           <div class="form-check">
               <?php if ($settrue == $key  && (empty($total))):?>
                   <input class="form-check-input" type="radio" name="true_false[]<?php echo $id; ?>" value="<?php echo $value; ?>"  <?php echo $this->session->userdata('user_type') != 'Learner'?'checked':''?> >
               <?php else:?>
                   <input class="form-check-input" type="radio" name="true_false[]<?php echo $id; ?>" value="<?php echo $value; ?>">
               <?php endif;?>
              <label class="form-check-label" for="exampleRadios1">
                <?php echo empty($value) ? 'Option '. ++$i : $value; ?>
              </label>
            </div>
        </div>
    </div>
<?php endforeach;?>