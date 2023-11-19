<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$idStory=$_POST['idStory'];
$IdUser=$_POST['idUser'];
$success=0;
$arrlike=array();
require_once('../../model/connection.php');
	$db=new config();
	$db->config();

	if(strlen($IdUser)<2){
		if(array_search($idStory,$_SESSION['like'])!=[]){
			$success=1;
			
		}else{
			array_push($_SESSION['like'],$idStory);
			$db->UpdateLikeStory($idStory,1);
		}
			
			
		

	}else{		
		$arrlike=$db->GetLike($IdUser);
		if($arrlike=="@"){
			
			$db->AddLike($IdUser,$idStory);
			$db->UpdateLikeStory($idStory,1);
			
		}else{
			if($arrlike=="")
			$arrlike=array();
			else		
			$arrlike=explode(",",$arrlike);
			if(array_search($idStory,$arrlike)!=[]){
				// unset($arrlike[array_search($idStory,$arrlike)]);
				// $arrlike2=implode(",",$arrlike);
				// $db->UpdateLike($IdUser,$arrlike2);
				$success=1;
			}else{
				
				array_push($arrlike,$idStory);
				$arrlike2=implode(",",$arrlike);
				$db->UpdateLike($IdUser,$arrlike2);
				$db->UpdateLikeStory($idStory,1);
				
			}
		}
		
	}
$db->dis_connect();//ngat ket noi mysql	
$array=array("success"=>"$success");
   	
echo json_encode($array);

?>