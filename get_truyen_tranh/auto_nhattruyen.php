<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
    $curl = new cURL();
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $site=$db->GetDomain_site(3);
    $url="http://".$site."/";
    $string = $curl->getContent($url);
    preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl00_divPager"#ismU', $string, $content);
    preg_match_all('#<a class="jtip".*href="(.*)">(.*)</a>#imsU', $content[1], $list_name);
    $list_manga = array_combine($list_name[1], $list_name[2]);
    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
   
    if($db->check_story_exist($nameStory,1,0)>0){   
         
    $html= $curl->getContent($url);
    preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
   
    if($html !=""){
        
    $parse = parse_url($url);
    preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
    $Name_Chapter=$db->GetNameStoryOFChap($nameStory,1,0);
    $posity= check_chap($list_chap[2],$Name_Chapter[0]);
	$e=0;
    for($i=$posity-1;$i>-1;$i--)
    {       
        
            preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
        	 $chap2=str_replace('Chapter','Chương',$chapter[0]);
       if($db->check_chap_exist($chap2,$Name_Chapter[1])<1){
        if($e<6){	 
        	$html1 = $curl->getContent($list_chap[1][$i]);
			if($html1 !=""){
				preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
				$dom = new DOMDocument;
				@$dom->loadHTML($list_chap_img[1][0]);
				$x = new DOMXPath($dom); 
				$arr_img=array();
				foreach($x->query("//img") as $node) 
				{
					$cover="";
					if (!preg_match('#http#i', $node->getAttribute("src"))) {
						$cover = 'http:' . $node->getAttribute("src");
					}else{
					  	$cover =  check_blogger($node->getAttribute("src"));  
					}
					if($cover !="")
					array_push($arr_img,$cover);
				}
				 $dateChap=date('Y-m-d H:i:s');
				 if($arr_img !=[] && $db->check_chap_exist($chap2,$Name_Chapter[1])<1){
				     $image1=implode(",",$arr_img);
    				 $db->AddChap($chap2,"","","Ẩn",$dateChap,$Name_Chapter[1],$image1,"","","",$parse["host"],"",$list_chap[1][$i]);
    				 $db->UpdateChapToStory($Name_Chapter[1],$chap2,$dateChap);	 
    				 $e++;
    				 
				 }
			   }
		  }else{
			  break;
		  }	
        }
           
           
        
        
    }
     
  
  }

 }
 
}
$db->dis_connect();//ngat ket noi mysql	
?>
