<?php
$logo=$_POST['logo'];
$logo_on=$_POST['logo_on'];
$group=$_POST['group'];
$favicon=$_POST['favicon'];

require_once('../../model/connection.php');
$db=new config();
$db->config();
$error=$db->UpdateLogo($logo,$logo_on,$favicon,$group);
$db->dis_connect();//ngat ket noi mysql	
$array=array("Error"=>"$header1"); 	
echo json_encode($array);
?>