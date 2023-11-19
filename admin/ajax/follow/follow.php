<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$idStory=$_POST['idStory'];
$IdUser=$_POST['IdUser'];
$success=0;
		require_once('../../model/connection.php');
		$db=new config();
		$db->config();


	if(strlen($IdUser)<2){
		
		if(array_search($idStory,$_SESSION['subscribe'])!=[]){
			unset($_SESSION['subscribe'][array_search($idStory,$_SESSION['subscribe'])]);
			$db->UpdateSubscribeStory($idStory,-1);
			$success=1;
		}

	}else{
		    $subscribe=$db->GetSubscribe($IdUser);		
			$subscribe=explode(",",$subscribe);
			if(array_search($idStory,$subscribe)!=[]){
				unset($subscribe[array_search($idStory,$subscribe)]);
				$subscribe2=implode(",",$subscribe);
				$db->UpdateSubscribeStory($idStory,-1);
				$db->UpdateSubscribe($IdUser,$subscribe2);
				$success=1;
			}
	}

$db->dis_connect();//ngat ket noi mysql	
$array=array("success"=>"$success");
   	
echo json_encode($array);

?>