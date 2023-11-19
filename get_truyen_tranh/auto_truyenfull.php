<?php
    require_once('model/conn1.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
   

    $curl = new cURL();
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $page="trang-1000/";
    $site=$db->GetDomain_site(4);
    $url="http://".$site."/";
    $html_1 = $curl->getContent($url);
    
   
   preg_match('#class="list list-truyen list-new col-xs-12 col-sm-12 col-md-8 col-truyen-main">(.*)<div class="col-md-4 col-truyen-side"#imsU', $html_1, $list_story);
   preg_match_all('#<h3 itemprop="name"><a href="(.*)" title="(.*)" itemprop="url">(.*)</a></h3>#imsU', $list_story[1], $list_story1);
   
   for($j=0;$j<count($list_story1[1]);$j++){
   //foreach($list_story1[1] as $item2){
    $numPage=1; 
    $string = $curl->getContent($list_story1[1][$j].$page);
          
 if($string !=""){      
            //preg_match('#<h3 class="title" itemprop="name">(.*)</h3>#imsU', $string, $nameSt);
            $nameStory=$list_story1[2][$j];
        
   if($db->check_story_exist($nameStory,0,1)>0){
      
         $idStory_arr=$db->GetStoryByLink($nameStory,0,1);
         $idStory=$idStory_arr[0];    
          $Name_Chapter=$db->GetNameStoryOFChap($nameStory,0,1);
          preg_match('#<ul class="pagination pagination-sm.*><li class="active"><span>(.*)<span class="sr-only"#imsU', $string, $pagination);
            if(count($pagination) >0)
            $numPage= $pagination[1];
            
            
        	for($w=1;$w<=$numPage+1;$w++){
	        //echo $numPage;
			$html = $curl->getContent($list_story1[1][$j]."trang-".$w."/");
          
        	preg_match('#class="list-chapter">(.*)<input id="truyen-id" type="hidden"#imsU', $html, $list_chap);
            preg_match_all('#<a.*href="(.*)" title="(.*)">(.*)</a>#imsU', $list_chap[1], $list_chap1);
                 $Name_Chapter=$db->GetNameStoryOFChap($nameStory,0,1);
                 $posity= check_chap($list_chap1[2],$Name_Chapter[0]);
             	 $e=0;
             	 
             for($i=$posity-1;$i<count($list_chap1[1]);$i++){
               //for($i=0;$i<count($list_chap1[1]);$i++){
                $result = rtrim($list_chap1[1][$i], "/");
                $pos = strrpos($result, '/');
                $p1=str_replace('phan-','',substr($result,$pos+1));
                $p2=str_replace('-chuong','',$p1);
                $p3=str_replace('quyen-','',$p2);
                $p4=str_replace('-chuong','',$p3);
                $p5=str_replace('chuong-','',$p4);
                 $numChapter=tofloat(str_replace_first('-','.',$p5));
                  $NameChap="Chương ".$numChapter;
                    $title1=str_replace('Chương','',$list_chap1[2][$i]);
					$title2=str_replace($numChapter,'',$title1);
					$title5=str_replace(($numChapter-1),'',$title2);	
					$title5_1=str_replace(($numChapter+1),'',$title5);							
					$title4=str_replace($nameStory." - ",'',$title5_1);
					$title3=str_replace(':','',$title4);
					$title6="";
					if(str_replace(' ','',$title3)!="")
							$title6=$title3;
              
                 if($db->check_chap_exist($NameChap,$idStory)<1){
                   if($e<6){  
                    $html2 = $curl->getContent($list_chap1[1][$i]);
                    preg_match_all('#class="chapter-c">(.*)<hr class="chapter-end"#imsU', $html2, $list_chap_text);
    			    $text_chapter="";
    				foreach($list_chap_text[1] as $item2){
    					
    					 $text_chapter.=$item2;
    				}
    				$date=date('Y-m-d H:i:s');
					$db->AddChap($NameChap,$text_chapter,"","Ẩn",$date,$idStory,"","","","","",$title6,$list_chap1[1][$i]);
					$db->UpdateChapToStory($idStory,$NameChap,$date);
					$e++;
                   }
                 }
                 
               }
	        }
          }    
   
  }
}  
$db->dis_connect();//ngat ket noi mysql	
?>
