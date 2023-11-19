<?php
   
	 $key=$_POST['key'];
	 $per_page=$_POST['per_page'];
	 $page=$_POST['page'];
	 $idStory=$_POST['idStory'];
	require_once('../../model/connection.php');
	$db=new config();
	$db->config();
	$num=$db->GetChapAdmin($key,$per_page,$page,1,$idStory);  
	$arr=$db->GetChapAdmin($key,$per_page,$page,0,$idStory);  
	$db->dis_connect();//ngat ket noi mysql	
    $array=array("totalRecords"=>"$num","arr"=>array($arr),"per_page"=>"$per_page","page"=>"$page","idStory"=>"$idStory");
     	
echo json_encode($array);
?>