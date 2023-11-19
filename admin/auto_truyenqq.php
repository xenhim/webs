<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
    $curl = new cURL();
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $site=$db->GetDomain_site(4);
    $url="http://".$site."/truyen-moi-cap-nhat.html";
	$string = $curl->getContent($url);
	$header=array();
	if (!preg_match('#<meta charset="utf-8">#imsU', $string)) {
		preg_match('#document.cookie="VinaHost-Shield=(.*)"#imsU', $string, $shield);
		$header = [
			'Cookie: VinaHost-Shield=' . $shield[1] . ';'
		];
		$string = $curl->getContent($url, $header);
	}
	preg_match_all('#class="story-item">.*href="(.*)" title="(.*)">#imsU', $string, $list_url);
	$list_manga = array_combine($list_url[1], $list_url[2]);
    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
     
    if($db->check_story_exist($nameStory,1,0)>0){   
         //echo $nameStory.'<br>'; 
    $html= $curl->getContent($url);
   
   
    if($html !=""){
        
    $parse = parse_url($url);
    preg_match('#class="works-chapter-list">(.*)<input type="hidden"#imsU', $html, $content);
    preg_match_all('#<a.*href="(.*)">(.*)</a>#imsU', $content[1], $list_chap);
    $Name_Chapter=$db->GetNameStoryOFChap($nameStory,1,0);
    $posity= check_chap($list_chap[2],$Name_Chapter[0]);
	$e=0;
    for($i=$posity-1;$i>-1;$i--)
    {       
        
            preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
        	 $chap2=str_replace('Chapter','Chương',$chapter[0]);
       if($db->check_chap_exist($chap2,$Name_Chapter[1])<1){
        if($e<6){	 
        	$html1 = $curl->getContent($list_chap[1][$i],$header);
			if($html1 !=""){
				 preg_match_all('#class="story-see-content">(.*)<div class="box"#imsU', $html1, $list_chap_img);
				 preg_match_all('#<img class="lazy" src="(.*)"#imsU', $list_chap_img[0][0], $list_chap2);		
				 $arr_img=array();
				 foreach($list_chap2[1] as $item){	
				  array_push($arr_img,$item);
				  //echo $item;
				 }
				 if($arr_img !=[] && $db->check_chap_exist($chap2,$Name_Chapter[1])<1){
    				  $image1=implode(",",$arr_img);
    				  $dateChap=date('Y-m-d H:i:s');
    				 
    				  $db->AddChap($chap2,"","","Ẩn",$dateChap,$Name_Chapter[1],$image1,"","","",$parse["host"],"","");
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
