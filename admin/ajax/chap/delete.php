<?php
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
	$id=$_POST['id'];
	
	$db->DeleteChapter($id);
	$db->dis_connect();//ngat ket noi mysql	
	//$name=substr(strrchr($img,"/"),1);
	//unlink("../../upload/slider/".$name);

?>