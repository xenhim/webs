<?php
$targetPath ="";
 if(isset($_FILES['upload_content']['name'])){
	
	/* Getting file name */
	$filename = $_FILES['upload_content']['name'];
	$type=explode('.',$filename);
	$name=current($type);
	$type1=end($type);
	/* Location */
	$location = "../../page/upload/banner/".$name."-".uniqid(rand()).".".$type1;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
    
	/* Valid extensions */
	$valid_extensions = array("jpg","jpeg","png","gif","webp");

	
	/* Check file extension */
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	if(move_uploaded_file($_FILES['upload_content']['tmp_name'],$location)){
	     	$targetPath = "page/".$location;
	   	}
	}
}
$array=array("path"=>"$targetPath");
 echo json_encode($array);
?>