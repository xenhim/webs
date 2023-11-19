<?php

require_once('../model/connection.php'); 
require_once('../function/function.php'); 
	$db=new config();
	$db->config();
	
$targetPath ="";
$temp2="";
if(isset($_GET["idStory"])){
	$idStory=$_GET["idStory"];
}
if(isset($_GET["tempStory"])){
	$tempStory="../temp/".$_GET["tempStory"];
}



	$myfile = fopen($tempStory, "r") or die("Unable to open file!");

	if(filesize($tempStory) !=0){
		$name=fread($myfile,filesize($tempStory));
	}
	fclose($myfile);

 if(isset($_FILES['file']['name'])){
	$nameStory=$name;
	/* Getting file name */
	$filename = $_FILES['file']['name'];
	$type=explode('.',$filename);
	$type=end($type);
	/* Location */
	
	$temp2="upload/story/190x247/".vn_str_filter($nameStory)."-".uniqid(rand()).".".$type;
	$location = "../".$temp2;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
    
	/* Valid extensions */
	$valid_extensions = array("jpg","jpeg","png");

	
	/* Check file extension */
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
	     	$targetPath = "page/".$location;
	   	}
	}
}
$array=array("path"=>"$targetPath","path2"=>"$temp2");
 echo json_encode($array);
?>