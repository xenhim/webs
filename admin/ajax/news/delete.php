<?php
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
	$id=$_POST['id'];
	$img=$_POST['img'];
	$db->DeleteNews($id);
	$db->dis_connect();//ngat ket noi mysql	
	$name=substr(strrchr($img,"/"),1);
	unlink("../../upload/news/".$name);

?>