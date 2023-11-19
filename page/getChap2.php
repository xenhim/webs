<?php
require_once('model/connection.php'); 
require_once('function/function.php'); 
require_once('library/get_html.php');
$db=new config();
$db->config();
$url = $db->GetUrl2($IdStory);

function clearStringNameChap($nameStory,$str){
	$str1=str_replace($nameStory,"",$str);
	$str1=str_replace("Chương ","",$str1);
	$str1=str_replace("chương ","",$str1);
	$str1=str_replace("Chương","",$str1);
	$str1=str_replace("chương","",$str1);
	$str1=str_replace("chuong","",$str1);
	$str1=str_replace("Chuong","",$str1);
	$str1=str_replace("chuong ","",$str1);
	$str1=str_replace("Chuong ","",$str1);	
	$str1=substr($str1,strrpos($str1,":")+2);
	return $str1;
}
if($url!="" && strrpos($url,"hotruyen")!=""){
	if($db->GetCountChapter($IdStory)<1){
	 $html = file_get_html($url);
	 //$html ->load($html ->save());
	 $k=$html->find('div.chapter');
		 date_default_timezone_set("Asia/Ho_Chi_Minh");			
	     $date=date('Y-m-d H:i:s');	
	foreach($k as $item1){
			$s1=substr($item1->onclick,0,strrpos($item1->onclick,"-"));
			$s2=substr($s1,strrpos($s1,"-")+1);
			
	   if($db->check_chap_exist("Chương ".$s2,$IdStory)<1){
		    $html1 = "https://hotruyen.com/".substr(rtrim($item1->onclick,"'"),25);
			$title=clearStringNameChap($nameStory,$item1->innertext);
			$chap="Chương ".$s2;
		    $db->AddChap($chap,"","","Ẩn",$date,$IdStory,"","","","","",$title,$html1);		   
	   }
	}	
	$html->clear();
	unset($html);
	}
	
}else if($url!="" && strrpos($url,"truyentranhtuan")!=""){
	 $html = file_get_html($url);
	$k=$html->find('span.chapter-name a');
	
			 date_default_timezone_set("Asia/Ho_Chi_Minh");			
	     $date=date('Y-m-d H:i:s');	
	 
	foreach($k as $item1){	
				$s1=substr($item1->innertext,strrpos($item1->innertext," ")+1);
		   if($db->check_chap_exist("Chương ".$s1,$IdStory)<1){
				$html1 = $item1->href;
				$title="";
				if($s1==0)
					$s1=0.1;
				$chap="Chương ".$s1;
				$db->AddChap($chap,"","","Ẩn",$date,$IdStory,"","","","","",$title,$html1);	
				//$db->UpdateChap3($chap,$IdStory,$html1);	
				
		   }
		   
		  
		
	}	
	$html->clear();
	unset($html);
}	
?>