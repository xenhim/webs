<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');
   
$ii = 1;
function uploadToCloudflare($imageUrl, $url, $ii, $NameChap) {
	global $ii;
    $prefix = "https://truyenfull.com/";
    $slug = str_replace($prefix, "", $url);
	$chap = str_replace("Chương ", "Chuong-", $NameChap);
    //echo $slug."-".$chap."-".$ii."\n";
	

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $imageUrl;
$sungs = $slug."-".$chap."-".uniqid(rand())."-".$ii;
$datasave = base64_decode("Y3VybCAtLXJlcXVlc3QgUE9TVCBcCiAtLXVybCBodHRwczovL2FwaS5jbG91ZGZsYXJlLmNvbS9jbGllbnQvdjQvYWNjb3VudHMvNzkyYzJmZDdlOTc3YWM1MTkyZWE0NDRlZDlhOTY4MTYvaW1hZ2VzL3YxIFwKIC0taGVhZGVyICdBdXRob3JpemF0aW9uOiBCZWFyZXIg");
$datasave .= $ids.base64_decode("JyBcCiAtLWZvcm0gJ3VybD1odHRwczovL3dvcmtlci1yYXBpZC1idXR0ZXJmbHktM2YzYS54ZW1pbmluZy53b3JrZXJzLmRldi8/dXJsPQ==");
$datasave .= $datapost.base64_decode("JyBcCiAtLWZvcm0gJ21ldGFkYXRhPXsia2V5IjoidmFsdWUifScgXAogLS1mb3JtICdpZD0=");
$datasave .= $sungs.base64_decode("JyBcCiAtLWZvcm0gJ3JlcXVpcmVTaWduZWRVUkxzPWZhbHNlJw==");
//echo $datasave."\n";
$result = shell_exec($datasave);
//echo $result."\n";

    $ii++;
    return $result;
}

    
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
	$proxu="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
    $URL2=$proxu.$url;
    $page="trang-1000/";
    $numPage=1;
	//echo $url;
    
    $j=0;
    $string = $curl->getContent($proxu.$url.$page);
	//echo $string;
    $parse = parse_url($url);
    $opts = array(
		'http' => array(
			'method' => "GET",
			'header' => "Accept-language: en\r\n" .
			"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
			"referer: http://".$parse["host"]."/",
		),
	);
$context_url = stream_context_create($opts);
//echo $context_url;

           //$list_story=$html->find('div.list-truyen div.row div.col-xs-7');
 if($string !=""){
            preg_match('#<h3 class="title" itemprop="name">(.*)</h3>#imsU', $string, $nameSt);
            $nameStory=$nameSt[1];
if($db->check_story_exist($nameSt[1],0,1)<=0){
           	//preg_match('#class="info">(.*)<div class="col-xs-12 col-sm-8 col-md-8 desc">#imsU', $string, $info);
           	preg_match('#class="info">(.*)<div class="rate">#imsU', $string, $info);
           	//preg_match('#class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">(.*)<div class="visible-md-block visible-lg-block col-md-3 text-center col-truyen-side">#imsU', $string, $conten);
           	preg_match('#class="col-xs-12 col-sm-12 col-md-9 col-truyen-main">(.*)<div class="col-md-3 text-center col-truyen-side">#imsU', $string, $conten);
           	//preg_match('#<div class="desc-text desc-text-full" itemprop="description">(.*)<div class="showmore" style="height: 0px;">#imsU', $string, $conten);
           	preg_match_all('#<div class="desc-text desc-text-full" itemprop="description">(.*)</div>#imsU', $conten[0], $conten1);
           	preg_match_all('#<div class="desc-text" itemprop="description">(.*)</div>#imsU', $conten[0], $conten2);
            preg_match_all('#<a itemprop="author" href="(.*)" title="(.*)">(.*)</a>#imsU', $info[1], $auth);
            preg_match_all('#<a itemprop="genre" href="(.*)" title="(.*)">(.*)</a>#imsU', $info[1], $genr);
            preg_match_all('#<span class="text-primary">(.*)</span>#imsU', $info[1], $text_pri);
            preg_match_all('#<span class="text-success">(.*)</span>>#imsU', $info[1], $text_succe);
            preg_match('#<div class="book"><img src="(.*)" alt="(.*)" itemprop="image".*></div>#imsU', $string, $book);
            	$status="Đang tiến hành";
                if(count($text_succe)>0){
                    	$status="Hoàn Thành";
                }

                $conten1 = str_replace("http://truyenfull.com", "", $Content);

                $Genre="";
				$NameEncodeGenres="";				
				$Country="";
				//$Status=$status;
				//$Waning="Thường"; 
				$NameOther="";
				$female=0;//truyện tranh
				$male=1;//truyện trữ
				
				$URL1="";
				$Content="";
				if(count($conten1[1][0]) !=0)
				$Content=$conten1[1][0];
				else
				$Content=$conten2[1][0];
				$Author="";
				$path1="";
				$arr_author=array();
				$arr_genre=array();
				$arrGenreEn=array();
				//$arr_genre=array();	
				//$status="Đang tiến hnh";
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
$imageUrl = $link_img;
echo $imageUrl."\n";

$responseJson = uploadToCloudflare($imageUrl, $url, $ii, $NameChap);
echo $responseJson."\n";

$response = json_decode($responseJson, true);
// Kiểm tra nếu tải lên thành công
if (isset($response['success']) && $response['success'] === true) {
    // Xóa tệp tại vị trí tạm thời sau khi tải lên thành công
    //unlink($path3 . $path1);
}
// Giả sử $response chính là kết quả phản hồi từ hàm uploadToCloudflare

if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
    $uploadedImageUrl = $response['result']['variants'][0];
    // Lúc này, $uploadedImageUrl chính là URL của hình ảnh bạn đã tải lên
    //echo $uploadedImageUrl."\n"; // In ra hoặc bạn có thể lưu vào cơ sở dữ liệu hoặc xử lý tiếp theo nhu cầu của bạn
}
                //copy($link_img,$path3.$path1, $context_url);
$idStory=$db->AddStory3($nameStory,$NameOther,$status,$Content,$uploadedImageUrl,$Badge,$Waning,$str_author,$str_genre,$NameEncodeGenres,$Country,$DateUpload,$URL1,$URL2,$female,$male);
   
   
    preg_match('#<ul class="pagination pagination-sm.*><li class="active"><span>(.*)<span class="sr-only"#imsU', $string, $pagination);
    
    if(count($pagination)>0)
     $numPage= $pagination[1];
	for($w=1;$w<=$numPage+1;$w++){
	    
			$html = $curl->getContent($proxu.$url."trang-".$w."/");
        	//preg_match('#class="list-chapter">(.*)<input id="truyen-id" type="hidden"#imsU', $html, $list_chap);
        	preg_match('#class="list-chapter">(.*)<ul class="pagination pagination-sm"#imsU', $html, $list_chap);
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
                    $html2 = $curl->getContent($proxu.$list_chap1[1][$i]);
                    //print_r($html2);
					// Sử dụng DOMDocument để phân tích nội dung HTML
					$doc = new DOMDocument();
					libxml_use_internal_errors(true);  // Ẩn cảnh báo
					$doc->loadHTML($html2);
					$node = $doc->getElementById('chapter-c');
					if (!$node) {
						die("Không tìm thấy nội dung chương!");
					}

					$noidung = $node->innerText;
					//echo $noidung;

					$noidungs = $node->nodeValue;
					echo $noidung;
					 
                    //preg_match_all('class="chapter-c" itemprop="articleBody"><div class="visible-md visible-lg ads-responsive incontent-ad" id="ads-chapter-pc-top" align="center" style="height:90px"></div>"(.*)</div><div id="ads-chapter-google-bottom" align="center" style="margin-bottom: 10px;margin-top: 10px;"></div><hr class="chapter-end">', $html2, $list_chap_text);
					 //print_r($list_chap_text);
					 //echo $list_chap_text;
					 //echo $list_chap_text[1];
					 
    			    /*$text_chapter="";
    				foreach($list_chap_text[1] as $item2){
    					 $text_chapter.=$item2;
    				}*/
					//echo $text_chapter;
					$re = '/. -/m';
					$str = "$noidung";
					// Sử dụng biểu thức chính quy để thay thế như trước
					$subst = ".\r\r\n\n-";
					$result = preg_replace($re, $subst, $str);
					$re = '/: -/m';
					$str = $result;
					$subst = ".\r\r\n\n-";
					$result = preg_replace($re, $subst, $str);
					$re = '/[\x2e] /m';
					$str = $result;
					$subst = ".\r\r\n\n";
					$result = preg_replace($re, $subst, $str);
					$re = '/Biên tập: .+/m';
					$str = $result;
					$subst = " ";
					$result = preg_replace($re, $subst, $str);
					$re = '/Editor: .+/m';
					$str = $result;
					$subst = " ";
					$result = preg_replace($re, $subst, $str);
					// Chia chuỗi thành mảng các dòng
					$lines = explode("\n", $result);
					// Thêm thẻ <p> và </p> cho mỗi dòng
					$lines = array_map(function($line) {
					    return "<p>" . trim($line) . "</p>";
					}, $lines);
					// Ghép lại thành một chuỗi duy nhất
					$output = implode("\n", $lines);
					$chapzq = str_replace("Nguồn: http://truyenfull.com", "", $output);
					$chapc = str_replace("http://truyenfull.com", "", $chapzq);
					$chapg = str_replace("https://truyenfull.com", "", $chapc);
					$chape = str_replace("Bạn đang đọc truyện tại Truyện FUL.", "", $chapg);
					$chapq = str_replace("Bạn đang đọc truyện tại.", "", $chape);
					$chapz = str_replace("www.Truyện FULL", "", $chapq);
					$chaps = str_replace("Nguồn: http://truyenfull.vn", "", $chapz);
					$chapxs = str_replace("http://truyenfull.vn", "", $chaps);
					$chapx = str_replace("https://truyenfull.vn", "", $chapxs);
					$chapw = str_replace(":- ", "\r- ", $chapx);
					$chapt = str_replace(".- ", "\r- ", $chapw);
					$chapp = str_replace("*Chương này có nội dung ảnh, nếu bạn không thấy nội dung chương, vui lòng bật chế độ hiện hình ảnh của trình duyệt để đọc.", "", $chapt);
					$chap = str_replace("<p></p>", "<br>", $chapp);
					echo $chap;
					//echo $output;

    				$date=date('Y-m-d H:i:s');
					$db->AddChap($NameChap,$chap,"","Ẩn",$date,$idStory,"","","","","",$title6,$list_chap1[1][$i]);
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
	    
			$html = $curl->getContent($proxu.$url."trang-".$w."/");
          
        	//preg_match('#class="list-chapter">(.*)<input id="truyen-id" type="hidden"#imsU', $html, $list_chap);
        	preg_match('#class="list-chapter">(.*)<ul class="pagination pagination-sm"#imsU', $html, $list_chap);
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
                    $html2 = $curl->getContent($proxu.$list_chap1[1][$i]);
					 					// print_r($html2);
					// Sử dụng DOMDocument để phân tích nội dung HTML
					$doc = new DOMDocument();
					libxml_use_internal_errors(true);  // Ẩn cảnh báo
					$doc->loadHTML($html2);
					$node = $doc->getElementById('chapter-c');
					//print_r($node); 

					if (!$node) {
						die("Không tìm thấy nội dung chương!");
					}

					$noidung = $node->innerText;
					//echo $noidung;

					$noidung = $node->nodeValue;
					echo $noidung;
                    //preg_match_all('class="chapter-c"(.*)<hr class="chapter-end">', $html2, $list_chap_text);
					 //print_r($list_chap_text);					 
                    //preg_match_all('#class="chapter-c">(.*)<hr class="chapter-end"#imsU', $html2, $list_chap_text);
					// print_r($list_chap_text);
    			    /*$text_chapter="$noidung";
    				foreach($list_chap_text[1] as $item2){
    					 $text_chapter.=$item2;
    				}*/
					//echo $text_chapter;
					$re = '/. -/m';
					$str = "$noidung";
					// Sử dụng biểu thức chính quy để thay thế như trước
					$subst = ".\r\r\n\n-";
					$result = preg_replace($re, $subst, $str);
					$re = '/: -/m';
					$str = $result;
					$subst = ".\r\r\n\n-";
					$result = preg_replace($re, $subst, $str);
					$re = '/[\x2e] /m';
					$str = $result;
					$subst = ".\r\r\n\n";
					$result = preg_replace($re, $subst, $str);
					$re = '/Biên tập: .+/m';
					$str = $result;
					$subst = " ";
					$result = preg_replace($re, $subst, $str);
					$re = '/Editor: .+/m';
					$str = $result;
					$subst = " ";
					$result = preg_replace($re, $subst, $str);
					// Chia chuỗi thành mảng các dòng
					$lines = explode("\n", $result);
					// Thêm thẻ <p> và </p> cho mỗi dòng
					$lines = array_map(function($line) {
					    return "<p>" . trim($line) . "</p>";
					}, $lines);
					// Ghép lại thành một chuỗi duy nhất
					$output = implode("\n", $lines);
					$chapzq = str_replace("Nguồn: http://truyenfull.com", "", $output);
					$chapc = str_replace("http://truyenfull.com", "", $chapzq);
					$chapg = str_replace("https://truyenfull.com", "", $chapc);
					$chape = str_replace("Bạn đang đọc truyện tại Truyện FUL.", "", $chapg);
					$chapq = str_replace("Bạn đang đọc truyện tại.", "", $chape);
					$chapz = str_replace("www.Truyện FULL", "", $chapq);
					$chaps = str_replace("Nguồn: http://truyenfull.vn", "", $chapz);
					$chapxs = str_replace("http://truyenfull.vn", "", $chaps);
					$chapx = str_replace("https://truyenfull.vn", "", $chapxs);
					$chapw = str_replace(":- ", "\r- ", $chapx);
					$chapt = str_replace(".- ", "\r- ", $chapw);
					$chapp = str_replace("*Chương này có nội dung ảnh, nếu bạn không thấy nội dung chương, vui lòng bật chế độ hiện hình ảnh của trình duyệt để đọc.", "", $chapt);
					$chap = str_replace("<p></p>", "<br>", $chapp);
					echo $chap;
    				$date=date('Y-m-d H:i:s');
					$db->AddChap($NameChap,$chap,"","Ẩn",$date,$idStory,"","","","","",$title6,$list_chap1[1][$i]);
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
