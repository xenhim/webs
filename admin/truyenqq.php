<?php
//truyenqq
include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');
$curl = new cURL();
$db=new config();
$db->config();
$j=0;

$url=$_POST['link'];	
$country=$_POST['country'];	
$checkall=$_POST['checkall'];
$badge=$_POST['badge'];
//$content=$_POST['summarize'];
$waning=$_POST['waning'];
$checkimg=$_POST['checkimg'];
//$url    = 'http://truyenqqvip.com/truyen-tranh/anh-hung-xa-dieu-264';
//$url    = 'http://truyenqqvip.com/truyen-tranh/dao-hai-tac-128';
$html = $curl->getContent($url);
$header=array();
date_default_timezone_set("Asia/Ho_Chi_Minh");	
if (!preg_match('#<meta charset="utf-8">#imsU', $html)) {
    preg_match('#document.cookie="VinaHost-Shield=(.*)"#imsU', $html, $shield);
    $header = [
        'Cookie: VinaHost-Shield=' . $shield[1] . ';'
    ];
    $html = $curl->getContent($url, $header);
	
	
}
$parse = parse_url($url);
$opts                = array(
		'http' => array(
			'method' => "GET",
			'header' => "Accept-language: en\r\n" .
			"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
			"referer: http://".$parse["host"]."/",
		),
	);
$context_url = stream_context_create($opts);
$othername="";
$link_img="";
$status="";
$author="";
$genre1="";
$genre2="";
$dateUpload=date('Y-m-d H:i:s');	
$female=1;//truyện tranh
$male=0;//truyện trữ 
preg_match('#<h1 itemprop="name">(.*)</h1>#ismU', $html, $name);
$nameStory=$name[1];
if($db->check_story_exist($nameStory,1,0)<=0){
//thêm truyện mới	
preg_match('#<h2 class="other-name.*>(.*)</h2>#ismU', $html, $other_name);
preg_match('#class="list01">(.*)<ul class="story-detail-menu"#ismU', $html, $ge);
preg_match_all('#<li class="li03">(.*)</li>#imsU', $ge[1], $gen);
preg_match('#<div class="story-detail-info detail-content">(.*)</div>#imsU', $html, $content);
preg_match_all('#<li class="author.*>(.*)</li>#ismU', $html, $tac_gia);
preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
preg_match('#<li class="status.*>.*<p class="col-xs-9">(.*)</p>#imsU', $html, $m_status);
preg_match('#<div class="book_avatar" itemtype="https://schema.org/ImageObject"><img itemprop="image" alt="(.*)" src="(.*)"></div>#imsU', $html, $cover);
$arr_genre=array();
$arrGenreEn=array();
$arr_author=array();
$status=$m_status[1];
$othername="";
if(isset($other_name[1])){
 $othername= $other_name[1];
}
$arr_genre=array();
$arrGenreEn=array();
for($i=0;$i<count($gen[1]);$i++){	
	 preg_match_all('#<a.*>(.*)</a>#imsU', $gen[1][$i], $gen1);	
	
	 array_push($arr_genre,$gen1[1][0]);
     array_push($arrGenreEn, $curl->slug($gen1[1][0]));
}
foreach($authors[1] as $item){	
   
	array_push($arr_author,$item);
}
$genre1=implode(",",$arr_genre);		  
$genre2=implode(",",$arrGenreEn);
$author=implode(",",$arr_author);
$link_img=$cover[2];

$slug    = $curl->slug(trim($nameStory));
$path2 = "upload/story/190x247/";							
$path1 = $slug."-".uniqid(rand()).'.jpg';						  
$path3 = "../page/upload/story/190x247/";	
copy($link_img,$path3.$path1, $context_url);
$kq=$db->AddStory3($nameStory,$othername,$status,$content[1],$path2.$path1,$badge,$waning,$author,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);	

preg_match('#class="works-chapter-list">(.*)<input type="hidden"#imsU', $html, $list_chap);
preg_match_all('#<a.*href="(.*)">(.*)</a>#imsU', $list_chap[1], $list_chap1);

$chapterNumberZero = $list_chap1[2][0];
$list_chapter      = [];
$list_chapter[1]   = array_reverse($list_chap1[1]);
$list_chapter[2]   = array_reverse($list_chap1[2]);                                                                                                                                                     
//$myArray = array_combine($list_chapter[1], $list_chapter[2]);
for($i=0;$i<count($list_chapter[1]);$i++){
	  preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chapter[2][$i], $chapter);
  if($db->check_chap_exist($chapter[0],$kq)<1){
	 
	 $html1 = $curl->getContent($list_chapter[1][$i]);
	  preg_match_all('#class="chapter_content">(.*)<div class="clear"></div>#imsU', $html1, $list_chap_img);
	  preg_match_all('#<img class="lazy" src="(.*)"#imsU', $list_chap_img[0][0], $list_chap2);
	 //echo $list_chap2[1][2];
	 $arr_img=array();
	 foreach($list_chap2[1] as $item){
	    $cover=check_blogger($item);
	   	if($checkimg==1){
			    $ii++;
            	$upload_location = "upload/chap/manga/".$slug."/".tofloat($chapter[0]);
            	if (!file_exists("../page/".$upload_location)) {
            		mkdir("../page/".$upload_location, 0777, true);
            		 
            	}
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $cover=$upload_location."/".$ii.".jpg";
			}                                                                                                                                                                                                                                          
			
	     
	  array_push($arr_img,$cover);
 	 }
 	 if($arr_img !=[] && $db->check_chap_exist($chapter[0],$kq)<1){
	 $image1=implode(",",$arr_img);
	 $dateChap=date('Y-m-d H:i:s');
     $db->AddChap($chapter[0],"","","Ẩn",$dateChap,$kq,$image1,"","","",$parse["host"],"","");
	 $db->UpdateChapToStory($kq,$chapter[0],$dateChap);	 
 	 }
	$j=1;
  }
}
}else{
	$idStory=$db->GetStoryByLink($nameStory,1,0);
	if($checkall==1){
    	preg_match('#<h2 class="other-name.*>(.*)</h2>#ismU', $html, $other_name);
        preg_match('#class="list01">(.*)<ul class="story-detail-menu"#ismU', $html, $ge);
        preg_match_all('#<li class="li03">(.*)</li>#imsU', $ge[1], $gen);
        
        preg_match_all('#<li class="author.*>(.*)</li>#ismU', $html, $tac_gia);
        preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
        preg_match('#<li class="status.*>.*<p class="col-xs-9">(.*)</p>#imsU', $html, $m_status);
        preg_match('#<div class="book_avatar" itemtype="https://schema.org/ImageObject"><img itemprop="image" alt="(.*)" src="(.*)"></div>#imsU', $html, $cover);
	    $arr_genre=array();
        $arrGenreEn=array();
        $arr_author=array();
        $status=$m_status[1];
        $othername="";
        if(isset($other_name[1])){
         $othername= $other_name[1];
        }
        $arr_genre=array();
        $arrGenreEn=array();
        for($i=0;$i<count($gen[1]);$i++){	
        	 preg_match_all('#<a.*>(.*)</a>#imsU', $gen[1][$i], $gen1);	
        	
        	 array_push($arr_genre,$gen1[1][0]);
             array_push($arrGenreEn, $curl->slug($gen1[1][0]));
        }
        foreach($authors[1] as $item){	
           
        	array_push($arr_author,$item);
        }
		$genre1=implode(",",$arr_genre);		  
		$genre2=implode(",",$arrGenreEn);
		$author=implode(",",$arr_author);

		$link_img=$cover[2];

		$slug    = $curl->slug(trim($nameStory));
		$path2 = "upload/story/190x247/";							
		$path1 = $slug."-".uniqid(rand()).'.jpg';						  
		$path3 = "../page/upload/story/190x247/";	
		copy($link_img,$path3.$path1, $context_url);
		
$db->UpdateStory3($idStory[0],$nameStory,$othername,$status,$content,$path2.$path1,$badge,$waning,$author,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);	
$j=1;
		
	}
	
	
	
//update truyện	

preg_match('#class="works-chapter-list">(.*)<input type="hidden"#imsU', $html, $list_chap);
preg_match_all('#<a.*href="(.*)">(.*)</a>#imsU', $list_chap[1], $list_chap1);

$chapterNumberZero = $list_chap1[2][0];
$list_chapter      = [];
$list_chapter[1]   = array_reverse($list_chap1[1]);
$list_chapter[2]   = array_reverse($list_chap1[2]);
//$myArray = array_combine($list_chapter[1], $list_chapter[2]);
for($i=0;$i<count($list_chapter[1]);$i++){
	  preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chapter[2][$i], $chapter);
  if($db->check_chap_exist($chapter[0],$idStory[0])<1){
	 
	 $html1 = $curl->getContent($list_chapter[1][$i]);
	  preg_match_all('#class="chapter_content">(.*)<div class="clear"></div>#imsU', $html1, $list_chap_img);
	  preg_match_all('#<img class="lazy" src="(.*)"#imsU', $list_chap_img[0][0], $list_chap2);
	 //echo $list_chap2[1][2];
	 $arr_img=array();
	 foreach($list_chap2[1] as $item){	
	    $cover=check_blogger($item);
	    	if($checkimg==1){
			    $ii++;
            	$upload_location = "upload/chap/manga/".$slug."/".tofloat($chapter[0]);
            	if (!file_exists("../page/".$upload_location)) {
            		mkdir("../page/".$upload_location, 0777, true);
            		 
            	}
             
                copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $cover=$upload_location."/".$ii.".jpg";
			} 
	     
	  array_push($arr_img,$cover);
 	 }
 	  if($arr_img !=[] && $db->check_chap_exist($chapter[0],$idStory[0])<1){
    	 $image1=implode(",",$arr_img);
    	 $dateChap=date('Y-m-d H:i:s');
         $db->AddChap($chapter[0],"","","Ẩn",$dateChap,$idStory[0],$image1,"","","",$parse["host"],"","");
    	 $db->UpdateChapToStory($idStory[0],$chapter[0],$dateChap);	
 	  }
	$j=1;
  }	
 }
}
$j=1;
$db->dis_connect();//ngat ket noi mysql	

 $array=array("Error"=>"$j");

echo json_encode($array);
?>