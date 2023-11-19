<?php
$idStory="";
$tempChap="";
if(isset($_GET["idStory"])){
	$idStory=$_GET["idStory"];
}
if(isset($_GET["tempChap"])){
	$tempChap="../temp/".$_GET["tempChap"];
}
require_once('../model/connection.php'); 
require_once('../function/function.php'); 
	$db=new config();
	$db->config();
	$nameStory=$db->GetNameStory2($idStory);
	$nameChap2="";
	
	$myfile = fopen($tempChap, "r") or die("Unable to open file!");

	if(filesize($tempChap) !=0){
		$nameChap2=fread($myfile,filesize($tempChap));
	}
	fclose($myfile);
	
	$countfiles = count($_FILES['files']['name']);
	
	// Upload directory
	$upload_location = "upload/chap/manga/".vn_str_filter($nameStory)."/".tofloat($nameChap2)."/";
	if (!file_exists("../".$upload_location)) {
		mkdir("../".$upload_location, 0777, true);
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
				if(move_uploaded_file($_FILES['files']['tmp_name'][$index],"../".$path)){
					$files_arr[] = $path;
				}
			
			}
		}
			   	
	}

echo json_encode($files_arr);
die;
?>