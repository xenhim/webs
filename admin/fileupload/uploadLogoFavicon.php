<?php
$targetPath ="";
 if(isset($_FILES['upload_favicon']['name'])){
	
	/* Getting file name */
	$filename = $_FILES['upload_favicon']['name'];
	$type=explode('.',$filename);
	$name=current($type);
	$type1=end($type);
	/* Location */
	$location = "../frontend/images/"."favicon.".$type1;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
    
	/* Valid extensions */
	$valid_extensions = array("ico");

	
	/* Check file extension */
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	if(move_uploaded_file($_FILES['upload_favicon']['tmp_name'],$location)){
	     	$targetPath = "page/".$location;
	   	}
	}
}
$array=array("path"=>"$targetPath");
 echo json_encode($array);
?>