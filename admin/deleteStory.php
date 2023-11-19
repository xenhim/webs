<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();
	$id=$_GET['idStory'];	
	$arr_Story=$db->DeleteStory($id);
	echo $arr_Story;
	/*foreach($db->GetListStoryForGenre($nameGenre) as $muc){
			$array_Genre = explode(',',$muc["Genre"]);
			$array_1=array();
			$array_2=array();
			for($i=0;$i<count($array_Genre);$i++){
				if($array_Genre[$i]!=$nameGenre){					
					array_push($array_1,$array_Genre[$i]);
					array_push($array_2,vn_str_filter($array_Genre[$i]));
				}
			}							
			$db->UpdateGenreForStory($muc["Id"],implode(",",$array_1),implode(",",$array_2));
	}
	$db->DeleteStory($id);*/
	$db->dis_connect();//ngat ket noi mysql	

?>