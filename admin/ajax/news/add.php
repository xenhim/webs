<?php

require_once('../../model/connection.php');
	$db=new config();
	$db->config();
require_once('../../function/function.php');
$Content=$_POST['content'];

$Img="";
if(isset($_POST['path']))
$Img=$_POST['path'];

$Name=$_POST['name'];
$User=$_POST['user'];

$error="";
		
$error=$db->AddNews($Name,$Img,$Content,$User);
$db->dis_connect();//ngat ket noi mysql	
$array=array("Error"=>"$error");

	
echo json_encode($array);

?>