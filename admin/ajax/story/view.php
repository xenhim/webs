<?php
   
	 $id=$_POST['id'];
	 $className2=$_POST['className2'];
	
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
	$num=$db->UpdateHideViewStory($id,$className2);  
	
	$db->dis_connect();//ngat ket noi mysql	
    $array=array("totalRecords"=>"$num");  	
echo json_encode($array);
?>