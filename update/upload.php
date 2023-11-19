<?php
$targetPath ="";
if(!file_exists("temp"))
 mkdir("temp");
function xcopy($source, $dest, $permissions = 0755)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest, $permissions);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
        xcopy("$source/$entry", "$dest/$entry", $permissions);
    }

    // Clean up
    $dir->close();
    return true;
}
function unzip($location,$newLocation,$key){
        $zipArchive = new ZipArchive();
	  // $error=0;
	// open zip file
	if ($zipArchive->open($location)) {
		// Extracts to current directory
		//$zipArchive->setPassword($key);
	
		$zipArchive->extractTo($newLocation);
	} else {
		//$error=1;
		exit;
	}
	// Close ZipArchive
	$zipArchive->close();
	//return $error;
}
function remove_dir($dir = null) {
	if (is_dir($dir)) {
	$objects = scandir($dir);
	foreach ($objects as $object) {
	if ($object != "." && $object != "..") {
	if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
	else unlink($dir."/".$object);
	}
	}
	reset($objects);
	rmdir($dir);
	}
}
function getSizeTheme($path) {
	$totalSize = 0;
	foreach (new DirectoryIterator($path) as $file) {
		if ($file->isFile()) {
			$totalSize += $file->getSize();
		}
	}
	if($totalSize==0)
	 return "key";
	else
		return $totalSize;
}

 if(isset($_FILES['upload_theme']['name'])){
	
	/* Getting file name */
	$filename = $_FILES['upload_theme']['name'];
	$type=explode('.',$filename);
	$name=current($type);
	$type1=end($type);
	/* Location */
	$location = "temp/".$name.".".$type1;
	$location1 = "temp/";
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
    
	/* Valid extensions */
	$valid_extensions = array("zip");
	$myfile = fopen("key/key.txt", "r") or die("Unable to open file!");
	$key= fread($myfile,"100");
	
	/* Check file extension */
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	if(move_uploaded_file($_FILES['upload_theme']['tmp_name'],$location)){
	     	$targetPath=$location;
			 			
	   	}
	}
		
	unzip($location,"./temp",$key);
	// if(!file_exists("temp/readme.txt"))
	// $targetPath="key";	
	if(is_file($location))
	unlink($location);
	xcopy("temp/", "../");
	fclose($myfile);
	
}

//$targetPath=getSizeTheme($location1);
$dir = 'temp/';
remove_dir($dir);
$array=array("path"=>"$targetPath");
 echo json_encode($array);
?>