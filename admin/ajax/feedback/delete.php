<?php
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
	$id=$_POST['id'];
	$img=$_POST['img'];
	$db->DeleteFeedbackById($id);
	$db->dis_connect();//ngat ket noi mysql	
	

?>