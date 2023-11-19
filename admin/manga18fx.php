<?php
//nettruyen
include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');

//$ii = 1;
function uploadToCloudflare($imageUrl, $url, $chap2, $ii) {
	//global $ii;
    $prefix = "https://manhwa18.cc/webtoon/";
    $slug = str_replace($prefix, "", $url);
	$chap = str_replace("Chương ", "chapter-", $chap2);
    //echo $slug."-".$chap."-".$ii."\n";
	

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $imageUrl;
$sungs = $slug."-".$chap."-".uniqid(rand())."-".$ii;
$datasave = base64_decode("Y3VybCAtLXJlcXVlc3QgUE9TVCBcCiAtLXVybCBodHRwczovL2FwaS5jbG91ZGZsYXJlLmNvbS9jbGllbnQvdjQvYWNjb3VudHMvNzkyYzJmZDdlOTc3YWM1MTkyZWE0NDRlZDlhOTY4MTYvaW1hZ2VzL3YxIFwKIC0taGVhZGVyICdBdXRob3JpemF0aW9uOiBCZWFyZXIg");
$datasave .= $ids.base64_decode("JyBcCiAtLWZvcm0gJ3VybD1odHRwczovL3dvcmtlci1yYXBpZC1idXR0ZXJmbHktM2YzYS54ZW1pbmluZy53b3JrZXJzLmRldi8/dXJsPQ==");
$datasave .= $datapost.base64_decode("JyBcCiAtLWZvcm0gJ21ldGFkYXRhPXsia2V5IjoidmFsdWUifScgXAogLS1mb3JtICdpZD0=");
$datasave .= $sungs.base64_decode("JyBcCiAtLWZvcm0gJ3JlcXVpcmVTaWduZWRVUkxzPWZhbHNlJw==");
echo $datasave."\n";
$result = shell_exec($datasave);
//echo $result."\n";

    //$ii++;
    return $result;
}


$curl = new cURL();
$db=new config();
$db->config();
$j=0;
date_default_timezone_set('Asia/Ho_Chi_Minh');
//$url=$_POST['link'];
$url="https://manhwa18.cc/webtoon/young-boss-raw";
$urlproxy="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
$urlprox="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=https://manhwa18.cc";
//$country=$_POST['country'];
$country='all';
//$checkall=$_POST['checkall'];
$checkall=0;
//$badge=$_POST['badge'];
$badge='Hot';
//$waning=$_POST['waning'];
$waning='Thường';
//$checkimg=$_POST['checkimg'];
$checkimg=1;
$html = $curl->getContent($urlproxy.$url);
//echo $html."\n";
$parse = parse_url($urlproxy.$url);
$opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept-language: en\r\n" .
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
            "referer: https://manga18fx.com/",
        ),
    );
$context_url = stream_context_create($opts);
//echo $path1."\n";

$othername="";
$link_img="";
$status="";
$author="";
$genre1="";
$genre2="";
$dateUpload=date('Y-m-d H:i:s');
$female=1;//truyện tranh
$male=0;//truyện trữ
preg_match('#<div class="post-title">(.*)</div>#imsU', $html, $name);
preg_match('#<div class="summary_image">(.*)<div class="summary_content_wrap">#imsU', $html, $summary_image);
preg_match('#<ul class="row-content-chapter wleft">(.*)</ul>#imsU', $html, $summary_chapter);
//print_r($summary_chapter);

//preg_match_all('#<h1>(.*)</h1>#imsU', $name[1], $nameStory);
$nameStory=$name[1];
$slug = ""; // Initialize with an empty string or a default value
if($db->check_story_exist($nameStory,1,0)<=0){
preg_match('#<div class="summary-content">(.*)</div>#ismU', $html, $other_name);
preg_match('#<div class="genres-content">(.*)</div>#imsU', $html, $the_loai);
preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);
preg_match_all('#<div class="author-content">(.*)</div>#ismU', $html, $tac_gia);
preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
preg_match('#<div class="summary-content" style="text-align: right">(.*)</div>#imsU', $html, $m_status);
preg_match('#<div class="dsct">.*<p>(.*)</p></div>#imsU', $html, $desc);
preg_match('#<img class="img-loading".*src="(.*)".*>#ismU', $html, $cover);
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
if(isset($other_name[1]))
$othername= $other_name[1];
$content=$desc[1];
$slug    = $curl->slug(trim($nameStory));
$path2 = "upload/story/190x247/$slug/";
//$path4 = "https://projectxemtruyens3bucket.s3.ap-southeast-1.amazonaws.com";
//$path5 = "https://projectxemtruyens3bucket.s3.ap-southeast-1.amazonaws.com/story/190x247/$slug/";
$path1 = $slug."-".uniqid(rand())."-".$ii.'.jpg';
$path3 = "../page/upload/story/190x247/$slug/";
$path4 = "../page/upload/chap/manga/$slug/";

    //$response = uploadToCloudflare($imagePath);

if (!preg_match('#http#i', $cover[1])) {
    //$cover[1] = 'http:' . $cover[1];
	$cover[1] = $cover[1];
}
	print_r($cover[1]."\n");

if (!file_exists("../page/".$path2)) {
	 mkdir("../page/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$imageUrl = $link_img;
//echo $imageUrl."\n";
$responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
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

$kq=$db->AddStory3($nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);

//print_r($kq)."\n";
//echo $kq."\n";

         
preg_match_all('#<a class="chapter-name text-nowrap".* href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
print_r($list_chap."\n");
//print_r($list_chap[1])."\n";
//$list_chap='https://manga18fx.com' . $list_chap[1];
//echo $list_chap."\n";
//print_r($list_chap)."\n";
for($i=count($list_chap[1])-1;$i>-1;$i--){
    preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
     $chap2=str_replace('Chapter','Chương',$chapter[0]);
     if($db->check_chap_exist($chap2,$kq)<1){
    $html1 = $curl->getContent($urlprox.$list_chap[1][$i]);
		//print_r($html1)."\n";
    preg_match_all('#<div class="read-content wleft tcenter">(.*)</div>#imsU', $html1, $list_chap_img);
	print_r($list_chap_img."\n");
	//preg_match_all('#<img class=".*" data-src=.*" src=".*" alt="(.*)">#imsU', $list_chap_img, $listchap_img);
	//print_r($listchap_img)."\n";
    $dom = new DOMDocument();
    @$dom->loadHTML($list_chap_img[1][0]);
    $x = new DOMXPath($dom);
	//print_r($x."\n");
	//echo $x."\n";
    $arr_img=array();
	var_dump($arr_img."\n");
    
    foreach($x->query("//img") as $node)
    {
        $cover="";
        if (!preg_match('#http#i', $node->getAttribute("src"))) {
            $cover = 'https:' . $node->getAttribute("src");
			print_r($cover."\n");	 
            if($checkimg==1){
               //$ii++;
                $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                //$data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }else{
            $cover =  check_blogger($node->getAttribute("src"));
            if($checkimg==1){
                //$ii++;
                $upload_location = "upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                     
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                //$data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }
        //$ii++;  // Increase the counter after processing each image
        array_push($arr_img,$cover);
    }

		 //print_r($cover);

		 //print_r($cover)."\n";
         //echo $cover."\n";
		 
		 
if ($arr_img !=[] && $db->check_chap_exist($chap2,$kq)<1) {
			// print_r($arr_img)."\n";

    $imageArr = array_map(function($img) {
        return $img;
    }, $arr_img);

    $image1 = implode(",", $imageArr);
   // echo $image1."\n";
	//print_r($image1)."\n";
}
		// print_r($arr_img)."\n";
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

// Iterate over each image and upload it
$ii=0;
foreach ($arr_img as $img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    $imageUrl = $img;
    $responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
    echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

    // Check if the upload was successful and the variants key exists
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
	$ii++;	
	//if(isset($response['success']) && $response['success'] === false) {
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    }else if(isset($response['success']) && $response['success'] === false){
		$ii++;
                $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                }
                copy($imageUrl,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$imageUrl,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                echo $data."\n";
                $uploadedImageUrl="https://xemtruyen.xyz/page".$upload_location."/".$ii.".jpg";
				$uploadedImageUrls[] = $uploadedImageUrl;
            }
	 }


// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
//echo $ImageUrls."\n";

//var_dump($ImageUrls)."\n";
$dateChap=date('Y-m-d H:i:s');

$db->AddChap(str_replace('Chapter','Chương',$chapter[0]),"","","Ẩn",$dateChap,$kq,$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
     $db->UpdateChapToStory($kq,str_replace('Chapter','Chương',$chapter[0]),$dateChap);
     }
      $ii++;
  }
 }else{
$idStory=$db->GetStoryByLink($nameStory,1,0);
$prefix = "https://manhwa18.cc/webtoon/";
$slug = str_replace($prefix, "", $url);
if($checkall==1){
preg_match('#<div class="summary-content">(.*)</div>#ismU', $html, $other_name);
preg_match('#<div class="genres-content">(.*)</div>#imsU', $html, $the_loai);
preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);
preg_match_all('#<div class="author-content">(.*)</div>#ismU', $html, $tac_gia);
preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
preg_match('#<div class="summary-content" style="text-align: right">(.*)</div>#imsU', $html, $m_status);
preg_match('#<div class="dsct">.*<p>(.*)</p></div>#imsU', $html, $desc);
preg_match('#img-loading">.*src="(.*)".*>#ismU', $html, $cover);
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
if(isset($other_name[1]))
$othername= $other_name[1];
$content=$desc[1];
$slug    = $curl->slug(trim($nameStory));
$path2 = "upload/story/190x247/$slug/";
$path1 = $slug."-".uniqid(rand()).'.jpg';
$path3 = "../page/upload/story/190x247/$slug/";
$path4 = "../page/upload/chap/manga/$slug/";
//echo $path4."\n";
//var_dump($path4);

if (!preg_match('#http#i', $cover[1])) {
    $cover[1] = 'http:' . $cover[1];
}

if (!file_exists("../page/".$path2)) {
	 mkdir("../page/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$imageUrl = $link_img;
//echo $imageUrl."\n";
$responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
$response = json_decode($responseJson, true);
// Kiểm tra nếu tải lên thành công
if (isset($response['success']) && $response['success'] === true) {
    // Xóa tệp tại vị trí tạm thời sau khi tải lên thành công
   // unlink($path3 . $path1);
}
// Giả sử $response chính là kết quả phản hồi từ hàm uploadToCloudflare

if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
    $uploadedImageUrl = $response['result']['variants'][0];
    // Lúc này, $uploadedImageUrl chính là URL của hình ảnh bạn đã tải lên
    //echo $uploadedImageUrl."\n"; // In ra hoặc bạn có thể lưu vào cơ sở dữ liệu hoặc xử lý tiếp theo nhu cầu của bạn
}
	
$db->UpdateStory3($idStory[0],$nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);
$j=1;	
}
    
    
preg_match_all('#<a class="chapter-name text-nowrap".* href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
for($i=count($list_chap[1])-1;$i>-1;$i--){
	preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
	$chap2=str_replace('Chapter','Chương',$chapter[0]);
	 if($db->check_chap_exist($chap2, $idStory[0]) < 1) {
	$html1 = $curl->getContent($urlprox.$list_chap[1][$i]);
    preg_match_all('#<div class="read-content wleft tcenter">(.*)<div class="chapchange">#imsU', $html1, $list_chap_img);
	$dom = new DOMDocument();
	@$dom->loadHTML($list_chap_img[1][0]);
	$x = new DOMXPath($dom);
	$arr_img=array();
	    $ii = 1;  // Reset the counter for each new chapter
        foreach($x->query("//img") as $node) {
        $cover="";
        if (!preg_match('#http#i', $node->getAttribute("src"))) {
            $cover = 'http:' . $node->getAttribute("src");
            if($checkimg==1){
                //$ii++;  // Increase the counter after processing each image
                $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                     
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }else{
            $cover =  check_blogger($node->getAttribute("src"));
            if($checkimg==1){
                //$ii++;
                $upload_location = "upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                     
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
               // echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }
		//$ii++;  // Increase the counter after processing each image	
        array_push($arr_img,$cover);
    }
		// echo $path4."\n";
//if ($arr_img !=[] && $db->check_chap_exist($chapter[0],$idStory[0])<1) {
if($arr_img !=[] && $db->check_chap_exist(str_replace('Chapter','Chương',$chapter[0]),$idStory[0])<1) {
    $imageArr = array_map(function($img) {
        return $img;
    }, $arr_img);

    $image1 = implode(",", $imageArr);
   // echo $image1."\n";
	//print_r($image1)."\n";
}
		// print_r($arr_img)."\n";
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

// Iterate over each image and upload it
$ii=0;
foreach ($arr_img as $img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    $imageUrl = $img;
    $responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
    echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

    // Check if the upload was successful and the variants key exists
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
		$ii++;
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    }else if(isset($response['success']) && $response['success'] === false){
		$ii++;
                $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                }
                copy($imageUrl,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$imageUrl,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                echo $data."\n";
                $uploadedImageUrl="https://xemtruyen.xyz/page".$upload_location."/".$ii.".jpg";
				$uploadedImageUrls[] = $uploadedImageUrl;
            }
	 }


// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
//echo $ImageUrls."\n";
		 /*
	 if($arr_img !=[] && $db->check_chap_exist(str_replace('Chapter','Chương',$chapter[0]),$idStory[0])<1){
	 $image1=implode(",",$arr_img);
*/
	 //echo $image1;
	 $dateChap=date('Y-m-d H:i:s');
	 
$db->AddChap(str_replace('Chapter','Chương',$chapter[0]),"","","Ẩn",$dateChap,$idStory[0],$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
	 $db->UpdateChapToStory($idStory[0],str_replace('Chapter','Chương',$chapter[0]),$dateChap);
  }
     //$ii++;
     }
  }

  
$j=1;
$db->dis_connect();//ngat ket noi mysql

 $array=array("Error"=>"$j");

echo json_encode($array);

?>