<div class="form-row">
    <div class="form-group col-md-10">
        <textarea class="form-control" name="blank">
            <?php
            if(empty($blank)){
                echo "N/A";
            } else {
                echo implode(', ', $blank);
            }
            ?>
        </textarea>
    </div>
</div>



    