<?php
require_once('../library/get_html.php');
require_once('../model/connection.php'); 
require_once('../function/function.php'); 
$error=0;
$idStory=$_POST['idStory'];
$name=vn_str_filter($_POST['name']);
//function getChapqq($url,$IdStory,$name,$IdChap){

$db=new config();
$db->config(); 

date_default_timezone_set("Asia/Ho_Chi_Minh");
$info_link=$db->GetChapterLink($idStory);

		 $opts = [
			"http" => [
				"method" => "GET",
				"header" =>"Accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8\r\n".
				//"Accept-Encoding: gzip, deflate\r\n".
				"Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5,zh-CN;q=0.4,zh;q=0.3\r\n".
				"Referer: https://truyenqqvn.com/\r\n".
				"User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/99.0.92 Chrome/93.0.4577.92 Safari/537.36"
			  ]
		 ];	
		 
		 $context = stream_context_create($opts);
		 
if(count($info_link) !=0){
	$j=0;
	//
	
 foreach($info_link as $temp1){
	
		 $IdChap=tofloat($temp1["Name"]);
		 $url=$temp1["url1"];
		  
		 $IdChapter=$temp1["Name"];
		 $html = file_get_html($url,$context);	
	     $k=$html->find('div.story-see-content img');		
		 $arr_1a=array();
		 $i=0;	
	 	 foreach($k as $item1){			 
			     $gach_1= strrchr($item1->src, "/");
				 $cham_1= strpos($gach_1, "?");
				 $chuoi_1=substr($gach_1,1,$cham_1-1);	
                 
			   
				$char = '%';
				$pos = strpos($chuoi_1, $char);
				 if($pos!=""){
					 $type22=explode('.',$chuoi_1);
					 $type33=end($type22);
					 $chuoi_1=$i.".".$type33;
				 }

				 if (!file_exists('../upload/chap/manga/'.$name."/".$IdChap)) {
					mkdir('../upload/chap/manga/'.$name."/".$IdChap, 0777, true);											
				 }
				 $path1 = "upload/chap/manga/".$name."/".$IdChap."/".basename($chuoi_1);	
				 $path2 = "../".$path1;	
				 file_put_contents($path2, file_get_contents($item1->src,false,$context)); 
				 array_push($arr_1a,$path1);
				 //$error=$path2;
				$i++;				 
	     }
		 $db->UpdateChapters($idStory,$IdChapter,implode(',',$arr_1a));		
			if($j==0){
				 $nameChap=$temp1["Name"];
				 $dateChap=date('Y-m-d H:i:s');
				 $error=$dateChap;
				//$dateChap=$db->GetByDateChap($IdStory);
				$db->UpdateChapToStory($IdStory,$nameChap,$dateChap);
			}
$j=1;		 
//}
	$html->__destruct();
	unset($html);
	$html = null;
 }
}
		$db->dis_connect();//ngat ket noi mysql	
		$array=array("Error"=>"$error");
     	
echo json_encode($array);		 
?>