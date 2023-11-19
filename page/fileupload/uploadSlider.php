<?php
$targetPath ="";
 if(isset($_FILES['file']['name'])){
	if (is_uploaded_file ( $_FILES ['file'] ['tmp_name'] )) {
		$sourcePath = $_FILES ['file'] ['tmp_name'];
		
		$type=explode('.',$_FILES ['file'] ['name']);
		$type=end($type);
		
		$targetPath = "upload/slider/"."slider-".uniqid(rand()).".". $type;
		move_uploaded_file($sourcePath,"../".$targetPath);
		
		$imageFileType = pathinfo($targetPath,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);
		
		/* Valid extensions */
		$valid_extensions = array("jpg","jpeg","png","gif");
		if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
			if(move_uploaded_file($_FILES['file']['tmp_name'],$targetPath)){
				//$t = $linkOption12.$targetPath;
			}
	    }
		//$db->UploadAvatarUser($id,$targetPath);
	}
}
$array=array("path"=>"$targetPath");
 echo json_encode($array);
?>