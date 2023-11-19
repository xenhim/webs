<?php
	require_once('../../model/connection.php');
	require_once('../../function/function.php');
	$db=new config();
	$db->config();
	$id=$_POST['Id'];	

	$db->DeleteGenreById($id);
	$db->dis_connect();//ngat ket noi mysql	

?>