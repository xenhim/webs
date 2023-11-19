<?php

require_once('../model/connection.php'); 
 function slug($str)
    {

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", $str);
        $str = str_replace("_", "-", $str);
        $str = str_replace(".", "-", $str);
        $str = str_replace(":", "-", $str);
        $str = str_replace("/", "-", $str);
        $str = preg_replace('/[^A-Za-z0-9\-._]/', '', $str); // Removes special chars.
        $str = preg_replace('/-+/', '-', $str);

        $str = strtolower($str);
        return $str;
    }
	$db=new config();
	$db->config();
	
$targetPath ="";
$temp2="";
$name="";
if(isset($_GET["idStory"])){
	$idStory=$_GET["idStory"];
}
if(isset($_GET["nameStory"])){
	$name=$_GET["nameStory"];
}
 if(isset($_FILES['file']['name'])){
	$nameStory=$name;
	$filename = $_FILES['file']['name'];
	$type=explode('.',$filename);
	$type=end($type);
	$temp2="upload/story/190x247/".slug($nameStory)."-".uniqid(rand()).".".$type;
	$location = "../../page/".$temp2;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);
	$valid_extensions = array("jpg","jpeg","png");
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
	     	$targetPath = $location;
	   	}
	}
}
$array=array("path"=>"$targetPath","path2"=>"$temp2");
 echo json_encode($array);
?>