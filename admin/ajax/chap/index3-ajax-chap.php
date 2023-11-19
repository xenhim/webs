<?php

require_once('../../model/conn.php');
require_once('../../function/function.php');

$db=new config();
$db->config();
$idStory=$_POST['id'];

$info_link=$db->GetChapterLink($idStory);
$arr_1a=array();
 foreach($info_link as $temp1){
	 
	  $IdChap=tofloat($temp1["Name"]);
	   array_push($arr_1a,tofloat($temp1["Name"]));		
 }
			$error=implode(",",$arr_1a);
 			$array=array("Error"=>"$error");
 $db->dis_connect();//ngat ket noi mysql	    	
echo json_encode($array);
?>