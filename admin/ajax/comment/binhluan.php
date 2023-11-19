<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$Content=preg_replace('/\n/', '<br>', $_POST['Content']);
$Content_main=$Content;
$Avartar=$_POST['Avartar'];
$Name=$_POST['Name'];
$Title=$_POST['Title'];
$Likes=$_POST['Likes'];
$IdChap=$_POST['IdChap'];
$IdStory=$_POST['IdStory'];
$IdUser=$_POST['IdUser'];
$_SESSION['name_comment']=$Name;
		require_once('../../model/connection.php');
		require_once('../../function/function.php'); 	
		$db=new config();
		$db->config();
		$linkOption=siteURL();
		$linkOption1=$linkOption."page/";
		if($IdUser!="0"){
		$Avartar=$db->GetAvatarUser($IdUser);
		}
     date_default_timezone_set("Asia/Ho_Chi_Minh");
	 $DateComment=date('Y-m-d H:i:s');
	 $DateComment2= "<time itemprop='datePublished'>1 Phút Trước</time>";
	
		$arr = array();
		$arr=$db->GetListEmoji(0);			
		$Code=array();
		$Path=array();
		foreach($arr as $muc)
		{
			
			$Content=str_replace($muc['Code'],"<img src='".$linkOption1.$muc['Path']."' class='emoji_comment'>",$Content);	
		}
		$last_id =$db->AddComment($Content_main, $Avartar,$Name,$Title,$Likes,$DateComment,$IdChap,$IdStory,$IdUser);
		$Avartar1=$linkOption1.$Avartar;
		$db->dis_connect();//ngat ket noi mysql			
 $array=array("Id"=>"$last_id","Content"=>"$Content","Avartar"=>"$Avartar1","Name"=>"$Name","Title"=>"$Title","Likes"=>"$Likes","DateComment"=>"$DateComment2","IdChap"=>"$last_id","IdUser"=>"$IdUser");
     	
echo json_encode($array);

?>