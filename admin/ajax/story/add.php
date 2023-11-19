<?php
$Gender=$_POST['Gender'];
$URL=$_POST['URL'];
$URL1="";
$male=0;
$female=0;
if($Gender=="Truyện Tranh"){
	$female=1;
}else if($Gender=="Truyện Chữ"){
	$male=1;	
}
require_once('../../model/connection.php');
	$db=new config();
	$db->config();
require_once('../../function/function.php');
$Content=$_POST['Content'];

$Avatar="";
if(isset($_POST['Avatar']))
$Avatar=$_POST['Avatar'];

$Name=$_POST['Name'];
$NameOther=$_POST['NameOther'];
$Badge=$_POST['Badge'];
$Waning=$_POST['Waning'];
$Author=$_POST['Author'];
$Genre=$_POST['Genre'];
$g1=explode(",",$_POST['Genre']);
$g2=array();
for($i=0;$i<count($g1);$i++){
	
	array_push($g2,vn_str_filter($g1[$i]));
}
$NameEncodeGenres= implode(",",$g2);


$au1=$_POST['Author'];
for($i=0;$i<count($au1);$i++){	
	if($db->GetIdAuthor($au1[$i])==""){
		$db->AddAuthors($au1[$i],vn_str_filter($au1[$i]));
	}
}
	$Country=$_POST['Country'];
	$Status=$_POST['Status'];
	$error="";
		
    date_default_timezone_set("Asia/Ho_Chi_Minh");
	$DateUpload=date('Y-m-d h:i:s');
	

$error=$db->AddStory($Name,$NameOther,$Status,$Content,$Avatar,$Badge,$Waning,implode(",",$Author),$Genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL,$female,$male);
$db->dis_connect();//ngat ket noi mysql	
$array=array("Error"=>"$error");

	
echo json_encode($array);

?>