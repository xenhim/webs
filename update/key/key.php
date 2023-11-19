<?php
$key=$_POST['key'];
$myfile = fopen("key.txt", "w");
fwrite($myfile, $key);
fclose($myfile);
?>