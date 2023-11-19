<?php
require_once('../../model/connection.php');
require_once('../../function/function.php');
$db=new config();
$db->config();
$id=$_POST['Id'];
$Level=$_POST['Level'];
$db->UpdateAdminUser($id,$Level);
$db->dis_connect();//ngat ket noi mysql	
$error="Thành công";
$array=array("Error"=>"$error");
echo json_encode($array);
?>