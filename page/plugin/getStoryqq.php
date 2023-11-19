<?php
$error=0;
$idStory=$_POST['idStory'];
$url=$_POST['url'];
$name=$_POST['name'];
//function getStoryqq($url,$IdStory,$name){
require_once('../library/get_html.php');
require_once('../model/connection.php'); 
require_once('../function/function.php'); 
$db=new config();
$db->config(); 
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
		 //$context = stream_context_create($opts);
		  // $opts = [
			// "http" => [
				// "method" => "GET",
				// "header" =>"Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9\r\n".
				// "Accept-Encoding: gzip, deflate\r\n".
				// "Accept-Language: vi-VN,vi;q=0.9\r\n".
				// "Cache-Control: max-age=0\r\n".
				// "Connection: keep-alive\r\n".
				// "Cookie: QiQiSession=nm64fp7bl46tm7bro8rhge7is6; visit-read=6179209f4c34e-6179209f4c351; _ga=GA1.1.1710575207.1635328162; name_comment=hack; preload_ads=1; preload_banner=1; bet_top_pc=2; bet_top_pc_2=2; _ga_1W7VSZ38QC=GS1.1.1635341673.2.1.1635341676.0\r\n".
				// "Host: truyenqqtop.com\r\n".
				// "Referer: http://truyenqqtop.com/top-ngay.html\r\n".
				// "Upgrade-Insecure-Requests: 1\r\n".
				// "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36"
			  // ]
		 // ];
		 $context = stream_context_create($opts);
		 $html = file_get_html($url,$context);	
	         $k=$html->find('div.works-chapter-list div.works-chapter-item');
			 $arr_1a=array();		 
			 foreach($k as $item1){
						//echo $item1->find('a',0)->href;//link
						//echo $item1->find('div.text-right',0)->innertext;//date
						//echo tofloat($item1->find('a',0)->innertext).'<br>';//name chap 
						$link=$item1->find('a',0)->href;
						$date=$item1->find('div.text-right',0)->innertext;
						$numChap=tofloat($item1->find('a',0)->innertext);
					 if($db->check_chap_exist("Chương ".$numChap,$idStory)<1){							
							$chap="Chương ".$numChap;
							$db->AddChap($chap,"","","Ẩn",$date,$idStory,"","","","","","",$link);
							$nameChap=$db->GetByNameChap($idStory);
							$dateChap=$db->GetByDateChap($idStory);
							$db->UpdateChapToStory($idStory,$nameChap,$dateChap);							
					  }
			 }
			 //$error=1;
				 
//}
	
		//getStoryqq($url,$idStory,$name);

		$db->dis_connect();//ngat ket noi mysql	
		$array=array("Error"=>"$error");
     	
echo json_encode($array);		 
?>