<?php

	require_once('page/model/connection.php'); 

	$db=new config();
	$db->config();
	echo $db->test1("Từ Chức Nghiệp yếu nhất trở thành '' Thợ Rèn'' mạnh nhất");
	$db->dis_connect();//ngat ket noi mysql	
?>