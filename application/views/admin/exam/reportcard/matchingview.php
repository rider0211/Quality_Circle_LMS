<ol>
<?php $i=0; foreach($content as $key=>$value):?>
<li type="A">
    <div class="row">
        <div class="col-md-6">
            <?php echo empty($value)?'Option '. $i : $value; ?>
        </div>
    </div>
</li>
<?php endforeach;?>

</ol>
<div class="col-md-12" style="margin-bottom: 10px;">
Your Answer:
<?php 
echo implode(', ', $userAns['matching']);
?>
</div>
</div>