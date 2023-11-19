<?php
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
$Id=$_POST['id'];
$Name=$_POST['name'];
$Content=$_POST['content'];
$Img=$_POST['path'];
$User=$_POST['user'];

$error=$db->UpdateNews($Id,$Name,$Img,$Content,$User);
$db->dis_connect();//ngat ket noi mysql	

$array=array("Error"=>"$error");
echo json_encode($array);

?>