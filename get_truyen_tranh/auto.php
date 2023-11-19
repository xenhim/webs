<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
    $curl = new cURL();
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $site=$db->GetDomain_site(2);
    $url="http://".$site."/";
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
    $string = $curl->getContent($url);
    preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl00_divPager"#ismU', $string, $content);
    preg_match_all('#<a class="jtip".*href="(.*)">(.*)</a>#imsU', $content[1], $list_name);
    $list_manga = array_combine($list_name[1], $list_name[2]);
    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
    //if($url=="http://www.nettruyengo.com/truyen-tranh/lung-dua-nui-lon-dung-vung-c-vi-41223"){
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
        	
       if($db->check_chap_exist($chap2,$Name_Chapter[1] )<1){
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
				 if($arr_img !=[] && $db->check_chap_exist($chap2,$Name_Chapter[1] )<1){
				     $image1=implode(",",$arr_img);
				    // $chap2;
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
   // }
 }else{
         $country="Nhật Bản";	
        $badge="Hot";
        $waning="Thường";
        $female=1;//truyện tranh
        $male=0;//truyện trữ 
        preg_match('#<h2 class="other-name.*>(.*)</h2>#ismU', $html, $other_name);
        preg_match('#<li class="kind.*>(.*)</li>#imsU', $html, $the_loai);
        preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);
        preg_match_all('#<li class="author.*>(.*)</li>#ismU', $html, $tac_gia);
        preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
        preg_match('#<li class="status.*>.*<p class="col-xs-8">(.*)</p>#imsU', $html, $m_status);
        preg_match('#class="detail-content">.*<p>(.*)</p>#imsU', $html, $desc);
        preg_match('#col-image">.*src="(.*)".*>#ismU', $html, $cover); 
        $arr_authors=array();
        $arr_genres=array();
        $arrGenreEn=array();
        foreach($authors[1] as $item){
         array_push($arr_authors,$item);	
        	
        }
        foreach($genres[1] as $item){
         array_push($arr_genres,$item);	
         array_push($arrGenreEn, $curl->slug($item));	
        }
        $status=$m_status[1];
        $authors1=implode(",",$arr_authors);
        $genre1=implode(",",$arr_genres);
        $genre2=implode(",",$arrGenreEn);
        $othername="";
        if(isset($other_name[1]))
        $othername= $other_name[1];
        $content=$desc[1];
        $slug    = $curl->slug(trim($nameStory));
        $path2 = "upload/story/190x247/";							
        $path1 = $slug."-".uniqid(rand()).'.jpg';						  
        $path3 = "../page/upload/story/190x247/";
        
        if (!preg_match('#http#i', $cover[1])) {
        	$cover[1] = 'http:' . $cover[1];
        }
        
        
        $link_img=$cover[1];
        copy($link_img,$path3.$path1, $context_url);
        $kq=$db->AddStory3($nameStory,$othername,$status,$content,$path2.$path1,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);	
        
        preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);

    for($i=count($list_chap[1])-1;$i>-1;$i--){
	preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
	 $chap2=str_replace('Chapter','Chương',$chapter[0]);
	 if($db->check_chap_exist($chap2,$kq)<1){
	$html1 = $curl->getContent($list_chap[1][$i]);	 
	preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
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
					if($cover !="")
					array_push($arr_img,$cover);
	}
	 if($arr_img !=[] && $db->check_chap_exist($chap2,$kq)<1){
	 $image1=implode(",",$arr_img);

	 //echo $image1;
	 $dateChap=date('Y-m-d H:i:s');
	 
     $db->AddChap(str_replace('Chapter','Chương',$chapter[0]),"","","Ẩn",$dateChap,$kq,$image1,"","","",$parse["host"],"",$list_chap[1][$i]);
	 $db->UpdateChapToStory($kq,str_replace('Chapter','Chương',$chapter[0]),$dateChap);	 
	
	 }
	  $j=1;
  }
 }
 }
}
$db->dis_connect();//ngat ket noi mysql	
?>
