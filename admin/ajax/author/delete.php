<?php
	require_once('../../model/connection.php');
	require_once('../../function/function.php');
	$db=new config();
	$db->config();
	$id=$_POST['id'];	
	$nameGenre=$_POST['nameAuthor'];	
	echo $nameGenre;
	foreach($db->GetListStoryForAuthor($nameGenre) as $muc){
			$array_Genre = explode(',',$muc["Author"]);
			$array_1=array();
			//$array_2=array();
			for($i=0;$i<count($array_Genre);$i++){
				if($array_Genre[$i]!=$nameGenre){					
					array_push($array_1,$array_Genre[$i]);
					//array_push($array_2,vn_str_filter($array_Genre[$i]));
				}
			}							
			$db->UpdateGenreForStory($muc["Id"],implode(",",$array_1));
	}
	$db->DeleteAuthorById($id);
	$db->dis_connect();//ngat ket noi mysql	

?>