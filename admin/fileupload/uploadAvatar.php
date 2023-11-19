<?php
require('resize_img.php');
$linkOption12=$_GET["linkOption12"];
$targetPath ="";
 if(isset($_FILES['file']['name'])){
	if (is_uploaded_file ( $_FILES ['file'] ['tmp_name'] )) {
		$sourcePath = $_FILES ['file'] ['tmp_name'];
		
		$type=explode('.',$_FILES ['file'] ['name']);
		$type=end($type);
		
		$targetPath = "upload/avatar/160x160/".uniqid(rand()).".jpg";
		move_uploaded_file($sourcePath,"../".$targetPath);
		//resize_image('max',"../".$targetPath,"../".$targetPath,160,160);
		resize_image('crop',"../".$targetPath,"../".$targetPath,160,160);
		// $imageFileType = pathinfo($targetPath,PATHINFO_EXTENSION);
		// $imageFileType = strtolower($imageFileType);
		
		/* Valid extensions */
		// $valid_extensions = array("jpg","jpeg","png","jfif","bmp","gif");
		// if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	// /* Upload file */
			// if(move_uploaded_file($_FILES['file']['tmp_name'],$targetPath)){
				// $t = $linkOption12.$targetPath;
				// //$obj = new Image_converter();
				// //$obj->upload_image($_FILES, 'uploads', 'fileToUpload');
			// }
	    // }
		//$db->UploadAvatarUser($id,$targetPath);
	}
}


$array=array("path"=>"$targetPath");
 echo json_encode($array);
?>