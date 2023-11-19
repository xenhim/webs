<?php
$idStory="";
$nameChap="";
if(isset($_GET["idStory"])){
	$idStory=$_GET["idStory"];
}
if(isset($_GET["nameChap"])){
	$nameChap=$_GET["nameChap"];
}

require_once('../model/connection.php'); 
require_once('../function/function.php'); 
	$db=new config();
	$db->config();
	$nameStory=$db->GetNameStory2($idStory);

	
	$countfiles = count($_FILES['files']['name']);
	
	// Upload directory
	$upload_location = "upload/chap/manga/".vn_str_filter($nameStory)."/".tofloat($nameChap)."/";
	if (!file_exists("../../page/".$upload_location)) {
		mkdir("../../page/".$upload_location, 0777, true);
	}
	
	
// To store uploaded files path
$files_arr = array();

// Loop all files
	for($index = 0;$index < $countfiles;$index++){

		if(isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != ''){

    	// File name
    	$filename = $_FILES['files']['name'][$index];

    	// Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg");

        // Check extension
        if(in_array($ext, $valid_ext)){

        	// File path
        	$path = $upload_location.$filename;

            // Upload file
				if(move_uploaded_file($_FILES['files']['tmp_name'][$index],"../../page/".$path)){
					$files_arr[] = $path;
				}
			
			}
		}
			   	
	}

echo json_encode($files_arr);
?>