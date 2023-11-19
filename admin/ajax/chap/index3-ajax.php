<?php
require_once('../../class.cURL.php');
require_once('../../model/conn.php');
require_once('../../function/function.php');
$name=$_POST['name'];
$idStory=$_POST['id'];
$from=$_POST['from'];
$link_chap=$_POST['link_chap'];
$curl = new cURL();
$slug    = $curl->slug(trim($name));
$error=0;
$IdChapter="Chương ".$from;
$parse = parse_url($link_chap);
	$db=new config();
	$db->config();
//$info_link=$db->GetChapterLink2($idStory,$from,$to);
// $db->UpdateChapters($idStory,$IdChapter,implode(',',$arr_1a),$dateChap,$parse["host"]);
function removeAllFile($dir){
    if (is_dir($dir))
    {
        $structure = glob(rtrim($dir, "/").'/*');
        if (is_array($structure)) {
            foreach($structure as $file) {
                if (is_dir($file)) recursiveRemove($file);
                else if (is_file($file)) @unlink($file);
            }
        }
    }
}
removeAllFile('../../../page/upload/chap/manga/'.$slug.'/'.$from); // xóa hết hình trong folder a
$html = $curl->getContent($link_chap);	
if(strpos($link_chap, "nettruyen")!==false || strpos($link_chap, "nhattruyen")!==false){
     
	 
	preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html, $list_chap_img);
	
	$dom = new DOMDocument();
	@$dom->loadHTML($list_chap_img[1][0]);
	
	$x = new DOMXPath($dom); 
	$arr_img=array();
    $ii=0;
	foreach($x->query("//img") as $node) 
	{
		$cover="";
		if (!preg_match('#http#i', $node->getAttribute("src"))) {
		    
			$cover = 'http:' . $node->getAttribute("src");
			
		}else{
			$cover =  check_blogger($node->getAttribute("src"));  
		
		}
		
		array_push($arr_img,$cover);
	}
	 if($arr_img !=[] && $db->check_chap_exist($IdChapter,$idStory)>0){
    	 $image1=implode(",",$arr_img);
    	 $dateChap=date('Y-m-d H:i:s');
         $db->UpdateChapters($idStory,$IdChapter,$image1,$dateChap,$parse["host"]);
    	$error=1;
	 }
    
  
    

}else if(strpos($link_chap, "truyenqq")!==false){
    
	 
	  preg_match_all('#class="chapter_content">(.*)<div class="clear"></div>#imsU', $html, $list_chap_img);
	  preg_match_all('#<img class="lazy" src="(.*)"#imsU', $list_chap_img[0][0], $list_chap2);
	 //echo $list_chap2[1][2];
	 $arr_img=array();
	 foreach($list_chap2[1] as $item){
	    $cover=check_blogger($item);
	   
	     
	  array_push($arr_img,$cover);
 	 }
 	 if($arr_img !=[] && $db->check_chap_exist($IdChapter,$idStory)>0){
    	 $image1=implode(",",$arr_img);
    	 $dateChap=date('Y-m-d H:i:s');
         $db->UpdateChapters($idStory,$IdChapter,$image1,$dateChap,$parse["host"]);
         $error=1;
 	 }
}else if(strpos($link_chap, "truyenfull")!==false){
    preg_match_all('#class="chapter-c">(.*)<hr class="chapter-end"#imsU', $html, $list_chap_text);
    $text_chapter="";
	foreach($list_chap_text[1] as $item2){
		
		 $text_chapter.=$item2;
	}
	$date=date('Y-m-d H:i:s');
	if($db->check_chap_exist($IdChapter,$idStory)>0){
    	$db->UpdateChaptersNoel($idStory,$IdChapter,$text_chapter);
	} 
	//$db->AddChap($NameChap,$text_chapter,"","Ẩn",$date,$idStory,"","","","","",$title6,$list_chap1[1][$i]);

	$error=1;

}
$db->dis_connect();//ngat ket noi mysql	
$array=array("Error"=>"$error" ,"idchap"=>"$IdChapter","idstory"=>"$idStory");
echo json_encode($array);	
?>