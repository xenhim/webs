<?php
$targetPath ="";
 if(isset($_FILES['upload_logo']['name'])){
	
	/* Getting file name */
	$filename = $_FILES['upload_logo']['name'];
	$type=explode('.',$filename);
	$name=current($type);
	$type1=end($type);
	/* Location */
	$location = "../../page/frontend/images/"."logo.".$type1;
	$location1 = "frontend/images/"."logo.".$type1;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
    
	/* Valid extensions */
	$valid_extensions = array("png");

	
	/* Check file extension */
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	if(move_uploaded_file($_FILES['upload_logo']['tmp_name'],$location)){
	     	$targetPath =$location1;
			
	   	}
	}
	
}

//echo $targetPath;
$array=array("path"=>"$targetPath");
 echo json_encode($array);
?>