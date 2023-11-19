<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$Content=preg_replace('/\n/', '<br>', $_POST['Content']);
$Content_main=$Content;
$Avartar=$_POST['Avartar'];
$Name=$_POST['Name'];
$Title=$_POST['Title'];
$Likes=$_POST['Likes'];
$DateRelay=$_POST['DateRelay'];
$NameRelay1=$_POST['NameRelay1'];
$IdComment=$_POST['IdComment'];
$id2=$_POST['id2'];
$IdUser=$_POST['IdUser'];
$IdUserMain=$_POST['IdUserMain'];
$IdReply=$_POST['IdReply'];
$IdStory=$_POST['IdStory'];
//$_SESSION['email_comment']=$Name;
$_SESSION['name_comment']=$Name;
	require_once('../../model/connection.php');
	require_once('../../function/function.php'); 	
	$db=new config();
	$db->config();
	
	
            $tempChap="../../upload/comment/data.txt";
        	$myfile = fopen($tempChap, "r") or die("Unable to open file!");
        	$data="";
            if (filesize($tempChap) != 0){
               $data= fread($myfile,filesize($tempChap));
            }
            fclose($myfile);
		$result=explode(",",$data);
        $matches  = preg_grep('/'.$Content.'/i', $result);
        //echo count($matches);
        if(count($matches)<=0){
           
        
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	if($IdUserMain!="0"){
		$Avartar=$db->GetAvatarUser($IdUserMain);
		}
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$DateRelay=date('Y-m-d H:i:s');
	$DateRelay2= "<time itemprop='datePublished'>1 Phút Trước</time>";	
	$arr = array();
	$arr=$db->GetListEmoji(0);
	$Code=array();
	$Path=array();
	foreach($arr as $muc)
	{
		$Content=str_replace($muc['Code'],"<img src='".$linkOption1.$muc['Path']."' class='emoji_comment'>",$Content);	
	}
	$last_id =$db->AddReplys($Content_main,$Avartar,$Name,$Title,$Likes,$DateRelay,$NameRelay1,$id2,$IdUser,$IdUserMain,$IdReply);	
	//echo $IdUser;
	$flag_1=0;
	if($IdUser!="0"){
	  $db->AddNotify($Name,$IdStory,$IdUser,$IdUserMain,$DateRelay);	
		$flag_1=1;	  
	}
	if($flag_1==0){
		if($IdUserMain!="0"){
		  $db->AddNotify($Name,$IdStory,$IdUser,$IdUserMain,$DateRelay);				
		}
	}
 }else{
     $Title="";
     
 }
$db->dis_connect();//ngat ket noi mysql		
$Avartar1=$linkOption1.$Avartar;


$array=array("Id"=>"$last_id","Content"=>"$Content","Avartar"=>"$Avartar1","Name"=>"$Name","Title"=>"$Title","Likes"=>"$Likes","DateRelay"=>"$DateRelay2","NameRelay1"=>"$NameRelay1","IdComment"=>"$IdComment","id2"=>"$id2","IdUser"=>"$IdUser");
   	
echo json_encode($array);

?>