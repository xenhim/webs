<?php
 $id=$_POST['id'];
require_once('../../model/connection.php');
$db=new config();
$db->config(); 
$db->UpdateNotiRelay($id);
 $tong=1;
 $db->dis_connect();//ngat ket noi mysql		 		    
 $array=array("tong"=>"$tong");  	
echo json_encode($array);

?>