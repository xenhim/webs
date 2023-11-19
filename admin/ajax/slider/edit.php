<?php
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
$id=$_POST['id'];
$idStory=$_POST['idStory'];
$path=$_POST['path'];
$db->UpdateSlider($id,$idStory,$path);
$db->dis_connect();//ngat ket noi mysql	
$error=1;
$array=array("Error"=>"$id");
echo json_encode($array);

?>