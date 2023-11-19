<?php
   
	 $key=$_POST['key'];
	 $per_page=$_POST['per_page'];
	 $page=$_POST['page'];
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
	$num=$db->GetReleaseAdmin($key,$per_page,$page,1);  
	$arr=$db->GetReleaseAdmin($key,$per_page,$page,0);  
	$db->dis_connect();//ngat ket noi mysql	
    $array=array("totalRecords"=>"$num","arr"=>array($arr),"per_page"=>"$per_page","page"=>"$page");
     	
echo json_encode($array);
?>