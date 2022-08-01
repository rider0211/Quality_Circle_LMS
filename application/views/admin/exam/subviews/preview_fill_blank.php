<?php
$input_str = ' <input type="text" class="form-control" name="blank[]" style="width:20%;margin-left: 10px;margin-right: 5;"> ';
$title = str_replace('__', $input_str, $title);
if (empty($title)) {
    echo 'Title is not provided';
} else {
    echo '<div class="form-row">'.$title.'</div>';
}
?>


    