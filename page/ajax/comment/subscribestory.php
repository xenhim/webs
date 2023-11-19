<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$idStory=$_POST['idStory'];
$IdUser=$_POST['idUser'];
$arrSubscribe=array();
$success=0;


	require_once('../../model/connection.php');
	$db=new config();
	$db->config();

	if(strlen($IdUser)<2){
		
		if(array_search($idStory,$_SESSION['subscribe'])!=[]){
			unset($_SESSION['subscribe'][array_search($idStory,$_SESSION['subscribe'])]);
			//subscribe-1
			$db->UpdateSubscribeStory($idStory,-1);
		}else{
			array_push($_SESSION['subscribe'],$idStory);
			$success=1;
			$db->UpdateSubscribeStory($idStory,1);
			//subscribe+1
		}

	}else{
		$subscribe=$db->GetSubscribe($IdUser);
		if($subscribe=="@"){
			$db->AddSubscribe($IdUser,$idStory);
			$db->UpdateSubscribeStory($idStory,1);
			$success=1;
		}else{
			if($subscribe=="")
			$subscribe=array();
			else		
			$subscribe=explode(",",$subscribe);
			if(array_search($idStory,$subscribe)!=[]){
				unset($subscribe[array_search($idStory,$subscribe)]);
				$subscribe2=implode(",",$subscribe);
				$db->UpdateSubscribeStory($idStory,-1);
				$db->UpdateSubscribe($IdUser,$subscribe2);
			}else{
				
				array_push($subscribe,$idStory);
				$subscribe2=implode(",",$subscribe);
				$db->UpdateSubscribe($IdUser,$subscribe2);
				$db->UpdateSubscribeStory($idStory,1);
				$success=1;
			}
		}
	}
$db->dis_connect();//ngat ket noi mysql	
$array=array("success"=>"$success");
   	
echo json_encode($array);

?>