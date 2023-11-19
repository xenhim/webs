<?php

$name="";
$name2="";
$tempChap="";
$idStory="";
$chap_exist=1;
$num=0;
$idChap="";
if(isset($_POST['nameChap'])){
	$name=$_POST['nameChap'];
}
if(isset($_POST['tempChap'])){
	$tempChap=$_POST['tempChap'];
}

if(isset($_POST['idStory'])){
	$idStory=$_POST['idStory'];
}
if(isset($_POST['idChap'])){
	$idChap=$_POST['idChap'];
}
if(isset($_POST['type'])){
	
	
	require_once('../model/connection.php');
	require_once('../function/function.php');
	$db=new config();
	$db->config();
	
	$name1=tofloat($name);
	if($_POST['type']=="edit"){
		if($name1==0){
			$chap_exist=0;
		}else{
			$num=$db->check_chap_exist("Chương ".$name1,$idStory);
			$id=$db->get_chap_exist("Chương ".$name1,$idStory);
			
			if($num>0 && $id!=$idChap){
				$chap_exist=0;
			}
		}
	}else{
		if($name1==0){
			$chap_exist=0;
		}else{
			$num=$db->check_chap_exist("Chương ".$name1,$idStory);
			if($num>0){
				$chap_exist=0;
			}
		}
	}
	
	$db->dis_connect();//ngat ket noi mysql	
}
//////////////////////////////////////
$myfile2 = fopen($tempChap, "w") or die("Unable to open file!");
$txt1 = "";
fwrite($myfile2, $txt1);
fclose($myfile2);
///////////////////////////////////




$myfile = fopen($tempChap, "r") or die("Unable to open file!");
$myfile1 = fopen($tempChap, "w") or die("Unable to open file!");
$txt = $name;
fwrite($myfile1, $txt);
if (filesize($tempChap) != 0){
   $name2= fread($myfile,filesize($tempChap));
}

fclose($myfile1);
fclose($myfile);
$array=array("name"=>"$name2","chap_exist"=>"$chap_exist","num"=>"$num");
 echo json_encode($array);
?>