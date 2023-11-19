<?php
require_once('../../model/connection.php');
require_once('../../function/function.php');
$db=new config();
$db->config();
$id=$_POST['idGenre'];
$Name_Genre=$_POST['Name_Genre'];
$Name_Genre_old=$_POST['Name_Genre_old'];
$Title_Genre=$_POST['Title_Genre'];

foreach($db->GetListStoryForGenre($Name_Genre_old) as $muc){
			$array_Genre = explode(',',$muc["Genre"]);
			$array_1=array();
			$array_2=array();
			for($i=0;$i<count($array_Genre);$i++){
				if($array_Genre[$i]!=$Name_Genre_old){					
					array_push($array_1,$array_Genre[$i]);
					array_push($array_2,vn_str_filter($array_Genre[$i]));
				}
			}			
			array_push($array_1,$Name_Genre);
			array_push($array_2,vn_str_filter($Name_Genre));
				
			$db->UpdateGenreForStory($muc["Id"],implode(",",$array_1),implode(",",$array_2));
}

$db->UpdateGenre($id,$Name_Genre,vn_str_filter($Name_Genre),$Title_Genre,"");
//NameEncodeGenres


$db->dis_connect();//ngat ket noi mysql	
$error=1;
$array=array("Error"=>"$id");
echo json_encode($array);
?>