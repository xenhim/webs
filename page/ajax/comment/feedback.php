<?php
$content=$_POST['Content'];
$idStory=$_POST['IdStory'];
$idchap=$_POST['IdChap'];
$success=0;


	require_once('../../model/connection.php');
	$db=new config();
	$db->config();

	$k=$db->AddFeedback($content,$idStory,$idchap);
$db->dis_connect();//ngat ket noi mysql	
$array=array("success"=>"$k");
   	
echo json_encode($array);

?>