<?php

	require_once('../../model/connection.php');
	require_once('../../function/function.php');
	$db=new config();
	$db->config();
	$Name_Author=$_POST['Name_Author'];
	$Name_Author_en=vn_str_filter($Name_Author);
	//CheckNameGenre
	if($db->CheckNameAuthor($Name_Genre)<1){
	
	$db->AddAuthors($Name_Author,vn_str_filter($Name_Author));
	}
	$db->dis_connect();//ngat ket noi mysql	
	$error=1;
	$array=array("Error"=>"$error");
	echo json_encode($array);

?>