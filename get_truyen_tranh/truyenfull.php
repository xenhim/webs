<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
   
    
    $url=$_POST['link'];	
    $Country=$_POST['country'];		
    $checkall=$_POST['checkall'];
    $Badge=$_POST['badge'];
    $Waning=$_POST['waning'];
    $curl = new cURL();
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    //$url    = 'https://truyenfull.vn/ca-cua-toi-trai-rong-toan-tinh-te/';
    $URL2=$url;
    $page="trang-1000/";
    $numPage=1;
    
    $j=0;
    $string = $curl->getContent($url.$page);
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
           //$list_story=$html->find('div.list-truyen div.row div.col-xs-7');
 if($string !=""){      
            preg_match('#<h3 class="title" itemprop="name">(.*)</h3>#imsU', $string, $nameSt);
            $nameStory=$nameSt[1];
   if($db->check_story_exist($nameSt[1],0,1)<=0){
           	preg_match('#class="info">(.*)<div class="col-xs-12 col-sm-8 col-md-8 desc">#imsU', $string, $info);
preg_match('#class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">(.*)<div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">#imsU', $string, $conten);
 preg_match_all('#<div class="desc-text desc-text-full" itemprop="description">(.*)</div>#imsU', $conten[0], $conten1);
            preg_match_all('#<a itemprop="author" href="(.*)" title="(.*)">(.*)</a>#imsU', $info[1], $auth);
            preg_match_all('#<a itemprop="genre" href="(.*)" title="(.*)">(.*)</a>#imsU', $info[1], $genr);
            preg_match_all('#<span class="text-primary">(.*)</span>#imsU', $info[1], $text_pri);
            preg_match_all('#<span class="text-success">(.*)</span>>#imsU', $info[1], $text_succe);
            preg_match('#<div class="book"><img src="(.*)" alt="(.*)" itemprop="image"></div>#imsU', $string, $book);
            	$status="Đang tiến hành";
                if(count($text_succe)>0){
                    	$status="Hoàn thành";
                }

               
                $Genre="";
				$NameEncodeGenres="";				
				$Country="";
				//$Status=$status;
				//$Waning="Thường"; 
				$NameOther="";
				$female=0;//truyện tranh
				$male=1;//truyện trữ
				
				$URL1="";
				$Content=$conten1[1][0];
				$Author="";
				$path1="";
				$arr_author=array();
				$arr_genre=array();
				$arrGenreEn=array();
				//$arr_genre=array();	
				//$status="Đang tiến hành";
				$str_content="";
				$text_primary="";
				$str_author="";
				$str_genre="";		
                foreach ($auth[2] as $author) {
						array_push($arr_author,$author);
						//$db->AddAuthors($author, $curl->slug($author));
				}
				foreach ($genr[2] as $genre) {						
						array_push($arr_genre,$genre);
						array_push($arrGenreEn, $curl->slug($genre));
					    //$db->AddGenres($genre,$curl->slug($genre));
				}
				$str_author=implode(",",$arr_author);
				$str_genre=implode(",",$arr_genre);	
				$NameEncodeGenres=implode(",",$arrGenreEn);
				$DateUpload=date('Y-m-d H:i:s');
				$slug    = $curl->slug(trim($nameStory));
                $path2 = "upload/story/190x247/";							
                $path1 = $slug."-".uniqid(rand()).'.jpg';						  
                $path3 = "../page/upload/story/190x247/";

                $link_img=$book[1];
                copy($link_img,$path3.$path1, $context_url);
$idStory=$db->AddStory3($nameStory,$NameOther,$status,$Content,$path2.$path1,$Badge,$Waning,$str_author,$str_genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL2,$female,$male);
   
   
    preg_match('#<ul class="pagination pagination-sm.*><li class="active"><span>(.*)<span class="sr-only"#imsU', $string, $pagination);
    
    if(count($pagination)>0)
     $numPage= $pagination[1];
	for($w=1;$w<=$numPage+1;$w++){
	    
			$html = $curl->getContent($url."trang-".$w."/");
        	preg_match('#class="list-chapter">(.*)<input id="truyen-id" type="hidden"#imsU', $html, $list_chap);
            preg_match_all('#<a.*href="(.*)" title="(.*)">(.*)</a>#imsU', $list_chap[1], $list_chap1);
            
            //echo count($list_chap1[1]);
             for($i=0;$i<count($list_chap1[1]);$i++){
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
                    $html2 = $curl->getContent($list_chap1[1][$i]);
                    preg_match_all('#class="chapter-c">(.*)<hr class="chapter-end"#imsU', $html2, $list_chap_text);
    			    $text_chapter="";
    				foreach($list_chap_text[1] as $item2){
    					
    					 $text_chapter.=$item2;
    				}
    				$date=date('Y-m-d H:i:s');
					$db->AddChap($NameChap,$text_chapter,"","Ẩn",$date,$idStory,"","","","","",$title6,$list_chap1[1][$i]);
					$db->UpdateChapToStory($idStory,$NameChap,$date);
					
                 }
			    $j=1;
            }
		   
	}
   }else{
       
       $idStory_arr=$db->GetStoryByLink($nameSt[1],0,1);
       $idStory=$idStory_arr[0];
     preg_match('#<ul class="pagination pagination-sm.*><li class="active"><span>(.*)<span class="sr-only"#imsU', $string, $pagination);
    if(count($pagination) >0){
        $numPage= $pagination[1];
    }
    
	for($w=1;$w<=$numPage+1;$w++){
	    
			$html = $curl->getContent($url."trang-".$w."/");
          
        	preg_match('#class="list-chapter">(.*)<input id="truyen-id" type="hidden"#imsU', $html, $list_chap);
            preg_match_all('#<a.*href="(.*)" title="(.*)">(.*)</a>#imsU', $list_chap[1], $list_chap1);
          
             for($i=0;$i<count($list_chap1[1]);$i++){
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
                    $html2 = $curl->getContent($list_chap1[1][$i]);
                    preg_match_all('#class="chapter-c">(.*)<hr class="chapter-end"#imsU', $html2, $list_chap_text);
    			    $text_chapter="";
    				foreach($list_chap_text[1] as $item2){
    					
    					 $text_chapter.=$item2;
    				}
    				$date=date('Y-m-d H:i:s');
					$db->AddChap($NameChap,$text_chapter,"","Ẩn",$date,$idStory,"","","","","",$title6,$list_chap1[1][$i]);
					$db->UpdateChapToStory($idStory,$NameChap,$date);
					
                 }
                 $j=1;
               }
	        }
          
        }  
   }
   
$db->dis_connect();//ngat ket noi mysql	
 $array=array("Error"=>"$j");

echo json_encode($array);
?>
