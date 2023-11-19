<?php

	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
$id=$_POST['idStory'];
$path=$_POST['path'];
$db->AddSlider($id,$path);
$db->dis_connect();//ngat ket noi mysql	
$error=1;
$array=array("Error"=>"$error");
echo json_encode($array);

?>