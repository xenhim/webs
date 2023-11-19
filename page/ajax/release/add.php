<?php

	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
$idStory=$_POST['idStory'];
$date=$_POST['date'];
$time=$_POST['time'];
$nameChap=$_POST['nameChap'];
$type=$_POST['type'];
$db->AddRelease($idStory,$time,$nameChap,$type);
$db->dis_connect();//ngat ket noi mysql	
$error=1;
$array=array("Error"=>"$error");
echo json_encode($array);

?>