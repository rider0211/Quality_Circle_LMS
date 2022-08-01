<?php
$zip = new ZipArchive;
$res = $zip->open('3.0.2.zip');
echo '<pre>';
 	print_r($res);
echo '</pre>'; 
if ($res === TRUE) {
  $zip->extractTo('3.0.2');
  $zip->close();
  

  echo 'woot!';
} else {
  echo 'doh!';
}
?>