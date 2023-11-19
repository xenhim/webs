<?php
	$content=$_POST['content'];
	$tempChap="../page/googleAnalytics.php";
    $myfile2 = fopen($tempChap, "w") or die("Unable to open file!");
    
    fwrite($myfile2, $content);
    fclose($myfile2);	
	$error=1;
	$array=array("Error"=>"$error");
	echo json_encode($array);

?>