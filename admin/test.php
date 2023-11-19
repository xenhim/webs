<?php
//nettruyen
include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
// Chức năng để tải lên hình ảnh lên Cloudflare thông qua API
function uploadToCloudflare($imageUrl) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        //'file' => new CURLFile($filePath),
		'url' => $imageUrl,
        'metadata' => '{"key":"value"}',
        'requireSignedURLs' => 'false'
    ]);

    $headers = array();
    $headers[] = 'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    // Trả về kết quả từ Cloudflare, bạn có thể xử lý nó tùy thuộc vào yêu cầu của bạn
    return json_decode($result, true);
}*/
// Function to execute the cURL request to Cloudflare
$ii = 1;
function uploadToCloudflare($imageUrl, $url) {
	global $ii;
    $prefix = "https://www.nettruyenus.com/truyen-tranh/";
    $slug = str_replace($prefix, "", $url);
    echo $slug."-".uniqid(rand())."-".$ii."\n";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers = array();
    $headers[] = 'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $postData = array(
        'url' => $imageUrl,
        'id' => $slug."-".uniqid(rand())."-".$ii,
        'metadata' => json_encode(array('key' => 'value')),
        'requireSignedURLs' => 'false'
    );
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    $ii++;
	
    return $result;
}


$curl = new cURL();
$db=new config();
$db->config();
$j=0;
date_default_timezone_set('Asia/Ho_Chi_Minh');
//$url=$_POST['link'];
$url="https://www.nettruyenus.com/truyen-tranh/het-nhu-han-quang-gap-nang-gat/";
$urlproxy="https://withered-fog-1976.jimmybarker4.workers.dev/?url=";
$country=$_POST['country'];
$checkall=$_POST['checkall'];
$badge=$_POST['badge'];
$waning=$_POST['waning'];
$checkimg=$_POST['checkimg'];
$html = $curl->getContent($urlproxy.$url);
$parse = parse_url($urlproxy.$url);
$opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept-language: en\r\n" .
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
            "referer: https://www.nettruyenus.com/",
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
preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
$nameStory=$name[1];
$slug = ""; // Initialize with an empty string or a default value
if($db->check_story_exist($nameStory,1,0)<=0){
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
if(isset($other_name[1]))
$othername= $other_name[1];
$content=$desc[1];
$slug    = $curl->slug(trim($nameStory));
$path2 = "upload/story/190x247/$slug/";
//$path4 = "https://projectxemtruyens3bucket.s3.ap-southeast-1.amazonaws.com";
//$path5 = "https://projectxemtruyens3bucket.s3.ap-southeast-1.amazonaws.com/story/190x247/$slug/";
$path1 = $slug."-".uniqid(rand())."-".$cover.'.jpg';
$path3 = "../page/upload/story/190x247/$slug/";
$path4 = "../page/upload/chap/manga/$slug/";

    //$response = uploadToCloudflare($imagePath);

if (!preg_match('#http#i', $cover[1])) {
    $cover[1] = 'http:' . $cover[1];
}

if (!file_exists("../page/".$path2)) {
	 mkdir("../page/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$imageUrl = "https://withered-fog-1976.jimmybarker4.workers.dev/?url=$link_img";
echo $imageUrl."\n";
$responseJson = uploadToCloudflare($imageUrl, $url);
$response = json_decode($responseJson, true);
// Kiểm tra nếu tải lên thành công
if (isset($response['success']) && $response['success'] === true) {
    // Xóa tệp tại vị trí tạm thời sau khi tải lên thành công
    unlink($path3 . $path1);
}
// Giả sử $response chính là kết quả phản hồi từ hàm uploadToCloudflare

if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
    $uploadedImageUrl = $response['result']['variants'][0];
    // Lúc này, $uploadedImageUrl chính là URL của hình ảnh bạn đã tải lên
    echo $uploadedImageUrl."\n"; // In ra hoặc bạn có thể lưu vào cơ sở dữ liệu hoặc xử lý tiếp theo nhu cầu của bạn
}

$kq=$db->AddStory3($nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);

//print_r($kq)."\n";
//echo $kq."\n";

         
preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
for($i=count($list_chap[1])-1;$i>-1;$i--){
    preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
     $chap2=str_replace('Chapter','Chương',$chapter[0]);
     if($db->check_chap_exist($chap2,$kq)<1){
    $html1 = $curl->getContent($urlproxy.$list_chap[1][$i]);
    preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
    $dom = new DOMDocument();
    @$dom->loadHTML($list_chap_img[1][0]);
    $x = new DOMXPath($dom);
    //print_r($x);
    $arr_img=array();
    $ii=0;
    foreach($x->query("//img") as $node)
    {
        $cover="";
        if (!preg_match('#http#i', $node->getAttribute("src"))) {
            
            $cover = 'http:' . $node->getAttribute("src");
            if($checkimg==1){
                $ii++;
                $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                }
             
                copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                $cover=$upload_location."/".$ii.".jpg";
            }
        }else{
            $cover =  check_blogger($node->getAttribute("src"));
            if($checkimg==1){
                $ii++;
                $upload_location = "upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                     
                }
             
                copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                $cover=$upload_location."/".$ii.".jpg";
            }
        }
        
        array_push($arr_img,$cover);
    }

		 //print_r($arr_img)."\n";
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
foreach ($arr_img as $img) {
    $imgs = 'https://withered-fog-1976.jimmybarker4.workers.dev/?url=';
    $imageUrl = $imgs.$img;
    $responseJson = uploadToCloudflare($imageUrl, $url);
    echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

    // Check if the upload was successful and the variants key exists
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    }
}

// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
echo $ImageUrls."\n";

//var_dump($ImageUrls)."\n";
$dateChap=date('Y-m-d H:i:s');

$db->AddChap(str_replace('Chapter','Chương',$chapter[0]),"","","Ẩn",$dateChap,$kq,$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
     $db->UpdateChapToStory($kq,str_replace('Chapter','Chương',$chapter[0]),$dateChap);
     }
      $j=1;
  }
 }else{
	
$prefix = "https://www.nettruyenus.com/truyen-tranh/";
$slug = str_replace($prefix, "", $url);
if($checkall==1){
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
if(isset($other_name[1]))
$othername= $other_name[1];
$content=$desc[1];
$slug    = $curl->slug(trim($nameStory));
$path2 = "upload/story/190x247/$slug/";
$path1 = $slug."-".uniqid(rand()).'.jpg';
$path3 = "../page/upload/story/190x247/$slug/";
$path4 = "../page/upload/chap/manga/$slug/";
//echo $path4."\n";
var_dump($path4);

if (!preg_match('#http#i', $cover[1])) {
    $cover[1] = 'http:' . $cover[1];
}

if (!file_exists("../page/".$path2)) {
	 mkdir("../page/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$imageUrl = "https://withered-fog-1976.jimmybarker4.workers.dev/?url=$link_img";
echo $imageUrl."\n";
$responseJson = uploadToCloudflare($imageUrl, $url);
$response = json_decode($responseJson, true);
// Kiểm tra nếu tải lên thành công
if (isset($response['success']) && $response['success'] === true) {
    // Xóa tệp tại vị trí tạm thời sau khi tải lên thành công
    unlink($path3 . $path1);
}
// Giả sử $response chính là kết quả phản hồi từ hàm uploadToCloudflare

if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
    $uploadedImageUrl = $response['result']['variants'][0];
    // Lúc này, $uploadedImageUrl chính là URL của hình ảnh bạn đã tải lên
    echo $uploadedImageUrl."\n"; // In ra hoặc bạn có thể lưu vào cơ sở dữ liệu hoặc xử lý tiếp theo nhu cầu của bạn
}
	
$db->UpdateStory3($idStory[0],$nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);
$j=1;	
}
    
    
preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
for($i=count($list_chap[1])-1;$i>-1;$i--){
	preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
	$chap2=str_replace('Chapter','Chương',$chapter[0]);
	 if($db->check_chap_exist($chap2,$idStory[0])<1){
	$html1 = $curl->getContent($urlproxy.$list_chap[1][$i]);	 
	preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
	$dom = new DOMDocument();
	@$dom->loadHTML($list_chap_img[1][0]);
	$x = new DOMXPath($dom);
	//echo $path4."\n";
	$arr_img=array();
	foreach($x->query("//img") as $node) 
	{
        $cover="";
        if (!preg_match('#http#i', $node->getAttribute("src"))) {
            
            $cover = 'http:' . $node->getAttribute("src");
            if($checkimg==1){
                $ii++;
                $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                     
                }
             
                copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                $cover=$upload_location."/".$ii.".jpg";
            }
        }else{
            $cover =  check_blogger($node->getAttribute("src"));
            if($checkimg==1){
                $ii++;
                $upload_location = "upload/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../page/".$upload_location)) {
                    mkdir("../page/".$upload_location, 0777, true);
                     
                }
             
                copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
               // echo $data."\n";
                $cover=$upload_location."/".$ii.".jpg";
            }
        }
        array_push($arr_img,$cover);
    }
		// echo $path4."\n";
if ($arr_img !=[] && $db->check_chap_exist($chapter[0],$idStory[0])<1) {
    $imageArr = array_map(function($img) {
        //$newImg = str_replace('upload/chap/manga/'.$slug.'/','manga/'.$slug.'/',$img);
        return $img;
    }, $arr_img);
	
    $image1 = implode(",", $imageArr);
    //echo $image1."\n";


$uploadedImageUrls = []; // Mảng này sẽ chứa tất cả các URL đã tải lên thành công

// Iterate over each image and upload it
foreach ($arr_img as $img) {
    $imgs = 'https://withered-fog-1976.jimmybarker4.workers.dev/?url=';
    $imageUrl = $imgs.$img;
    $responseJson = uploadToCloudflare($imageUrl, $url);
    echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

    // Check if the upload was successful and the variants key exists
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    }
}

// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
echo $ImageUrls."\n";
		 /*
	 if($arr_img !=[] && $db->check_chap_exist(str_replace('Chapter','Chương',$chapter[0]),$idStory[0])<1){
	 $image1=implode(",",$arr_img);
*/
	 //echo $image1;
	 $dateChap=date('Y-m-d H:i:s');
	 
$db->AddChap(str_replace('Chapter','Chương',$chapter[0]),"","","Ẩn",$dateChap,$idStory[0],$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
	 $db->UpdateChapToStory($idStory[0],str_replace('Chapter','Chương',$chapter[0]),$dateChap);
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
