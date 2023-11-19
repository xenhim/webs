<?php
if(isset($_FILES['upload']['name']))
{
	$nameChap="";
	$nameStory="";
	if(isset($_GET["nameStory"]) && isset($_GET["nameChap"])){
		$nameChap=$_GET["nameChap"];
		$nameStory=$_GET["nameStory"];
	}
	if (!file_exists('upload/chap/manga/'.$str1."/".$IdChap)) 
	{
		mkdir('upload/chap/manga/'.$str1."/".$IdChap, 0777, true);
	}
 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand() . '.' . $extension;
 chmod('upload', 0777);
 $allowed_extension = array("jpg", "gif", "png");
 if(in_array($extension, $allowed_extension))
 {
  move_uploaded_file($file, 'upload/chap/' . $new_image_name);
  $url = 'upload/chap/' . $new_image_name;
  $message = '';
  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('$url', '$message');</script>";
 }
}

?>