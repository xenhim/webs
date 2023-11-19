<?php
$name="";
$name2="";
$tempChap="";
$story_exist=1;
if(isset($_POST['name'])){
	$name=$_POST['name'];
}
if(isset($_POST['tempStory'])){
	$tempStory=$_POST['tempStory'];
}
$myfile2 = fopen($tempStory, "w") or die("Unable to open file!");
$txt1 = "";
fwrite($myfile2, $txt1);
fclose($myfile2);
///////////////////////////////////
$type=$_POST['type'];
$idStory=$_POST['idStory'];
$Gender=$_POST['Gender'];
$male=0;
$female=0;
if($Gender=="Truyện Tranh"){
	$female=1;
}else if($Gender=="Truyện Chữ"){
	$male=1;	
}
	require_once('../model/connection.php');
	require_once('../function/function.php');
	$db=new config();
	$db->config();
	if($type=="edit"){
		$num=$db->check_story_exist($name,$female,$male);
			$id=$db->get_story_exist2($name,$female,$male);
			
			if($num>0 && $id!=$idStory){
				$story_exist=0;
			}
	}else{
		    $num=$db->check_story_exist($name,$female,$male);
			if($num>0){
				$story_exist=0;
			}
	}
	$db->dis_connect();//ngat ket noi mysql	
$myfile = fopen($tempStory, "r") or die("Unable to open file!");
$myfile1 = fopen($tempStory, "w") or die("Unable to open file!");
$txt = $name;
fwrite($myfile1, $txt);
if (filesize($tempStory) != 0){
   $name2= fread($myfile,filesize($tempStory));
}
fclose($myfile);
fclose($myfile1);

$array=array("name"=>"$name2","story_exist"=>"$story_exist");
 echo json_encode($array);
?>