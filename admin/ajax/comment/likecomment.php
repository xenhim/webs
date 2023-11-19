<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$c=$_POST['c'];
$id=$_POST['id'];
$like=$_POST['like'];
$temp=0;
if(isset($_SESSION['user'])==""){
	$_SESSION['user'] =array();
	array_push($_SESSION['user'],$like);
}else if(isset($_SESSION['user'])!=""){
	for($i=0;$i<count($_SESSION['user']);$i++){
		if($_SESSION['user'][$i]==$like){
			$temp=1;
			break;
		}
	}
	if($temp==0){
		array_push($_SESSION['user'],$like);
	}
}
		require_once('../../model/connection.php');
		$db=new config();
		$db->config();

	$b=0;
	if($temp==0){
		if($c=="c"){
			$b=$db->GetComment($id);	
			$db->LikeComment($b,$id);
		}else if($c=="r"){
			$b=$db->GetReplys($id);	
			$db->LikeReplys($b,$id);
		}
	}
$db->dis_connect();//ngat ket noi mysql	
$array=array("like"=>"$like","temp"=>"$temp","increase"=>"$b");
   	
echo json_encode($array);

?>