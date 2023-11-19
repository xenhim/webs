<?php
//nettruyen
include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');

//$ii = 1;
function uploadViCloudflare($imageUrl, $slug, $chap3, $ii) {
	//global $ii;
    //$prefix = "https://archive.org/download/.*_(.*)/";
    //$slug = preg_replace($prefix, "", $url);
	//echo $chap3."\n";
	$chap = preg_replace('/^/m', "chapter-", $chap3);
	echo $slug."-".$chap."-".$ii."\n";
    //echo $slug."-".$chap."-".$ii."\n";
	

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $imageUrl;
$sungs = $slug."-".$chap."-".uniqid(rand())."-".$ii;
$chapgs = str_replace("https://hhhkungfu.tv/", "", $sungs);
$datasave = base64_decode("Y3VybCAtWCBQT1NUIFwKICAtZCAneyJ1cmwiOiI=");
$datasave .= $datapost.base64_decode("IiwibWV0YSI6eyJuYW1lIjoi");
$datasave .= $sungs.base64_decode("In19JyBcCiAgLUggIkF1dGhvcml6YXRpb246IEJlYXJlciBLd1lRU3pUWU04bVFjQjJNRVAzSlhyc3BRQi1ucmk1dU1feE5hR25QIiBcCiAgaHR0cHM6Ly9hcGkuY2xvdWRmbGFyZS5jb20vY2xpZW50L3Y0L2FjY291bnRzLzc5MmMyZmQ3ZTk3N2FjNTE5MmVhNDQ0ZWQ5YTk2ODE2L3N0cmVhbS9jb3B5");
//$datasave .= $sungs.base64_decode("JyBcCiAtLWZvcm0gJ3JlcXVpcmVTaWduZWRVUkxzPWZhbHNlJw==");
echo $datasave."\n";
$result = shell_exec($datasave);
//echo $result."\n";

    //$ii++;
    return $result;
}

function uploadToCloudflare($imageUrl, $slug, $chap3, $ii) {
	$chap = preg_replace('/^/m', "chapter-", $chap3);
	echo $slug."-".$chap."-".$ii."\n";
	

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
$url="https://hhhkungfu.tv/tinh-than-bien-phan-4";
$urlproxy="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
$urlprox="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=https://manhwa18.cc";
//$country=$_POST['country'];
$country='all';
//$checkall=$_POST['checkall'];
$checkall=0;
//$badge=$_POST['badge'];
$badge='Anime';
//$waning=$_POST['waning'];
$waning='Thường';
//$checkimg=$_POST['checkimg'];
$checkimg=1;
$html3 = $curl->getContent($urlproxy.$url);
//echo $html."\n";
$parse = parse_url($urlproxy.$url);
$opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept-language: en\r\n" .
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
            "referer: https://hhhkungfu.tv/hanh-trinh-di-gioi-cua-ta",
        ),
    );
$context_url = stream_context_create($opts);
$sum = 0;
for($i = 1; $i<=10; $i++) {
    $sum = $sum + $i;
}
//echo $desc."\n";
$dom = new DOMDocument();
//$dom->loadHTML($html);
@$dom->loadHTML($html3);

$xpath = new DOMXPath($dom);

$query = '//*[@class="halim-list-eps"]/li[*]/a';
//$queryname = '//*[@id="content"]/div/div[6]/div[2]';
$queryname = '//*[@id="listsv-1"]/li[*]/a';
$links = $xpath->query($query);
//$desc = $xpath->query($queryname);
//echo $links."\n";
// Loop through the selected <a> elements and extract the href attribute
if($links){
foreach ($links as $link) {
    $href = $link->getAttribute('href');
    $title = $link->getAttribute('title');
   // echo "Title: $title, Link: $href\n";

$othername="";
$link_img="";
$status="";
$author="";
$genre1="";
$genre2="";
$dateUpload=date('Y-m-d H:i:s');
$female=1;//truyện tranh
$male=0;//truyện trữ
$html1 = $curl->getContent($urlproxy.$href);
//echo $html1."\n";
//$slug=$title;
preg_match('#<h1 class="entry-title">(.*)</h1>#imsU', $html3, $name);
print_r($name[1]."\n");

preg_match('#<img class="movie-thumb" src="(.*)" alt=".*">#imsU', $html3, $summary_image);
preg_match('#<meta property="og:url" content="(.*)">#imsU', $html3, $slug);
//print_r($slug[1]."\n");
//print_r($summary_image."\n");

//preg_match_all('#<h1>(.*)</h1>#imsU', $name[1], $nameStory);
$nameStory=$name[1];
//print_r($nameStory."\n");
$slug = ""; // Initialize with an empty string or a default value
if($db->check_story_exist($nameStory,1,0)<=0){
preg_match('#<div class="summary-content">(.*)</div>#ismU', $html3, $other_name);
preg_match('#<p class="category">Thể Loại: (.*)</p>#imsU', $html3, $the_loai);
preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);

preg_match_all('#<div class="author-content">(.*)</div>#ismU', $html, $tac_gia);
preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
preg_match('#<div class="summary-content" style="text-align: right">(.*)</div>#imsU', $html, $m_status);
preg_match('#<meta property="og:description" content="(.*)" />#imsU', $html3, $desc);
//$desx=$desc[1];
//print_r($desx);

preg_match('#<meta property="og:image" content="(.*)" />#ismU', $html3, $cover);
print_r($cover[1]."\n");

	
//$chapter = 'Chương-'.$title."\n";
//echo $chapter."\n";
	
$arr_authors=array();
$arr_genres=array();
$arrGenreEn=array();
foreach($authors[1] as $item){
 array_push($arr_authors,$item);
}
/*
foreach($genres[1][0] as $item){
 array_push($arr_genres,$item);
 array_push($arrGenreEn, $curl->slug($item));
}*/

$status=$m_status[1];
$authors1=implode(",",$arr_authors);
$genre1=implode(",",$arr_genres);
$genre2=implode(",",$arrGenreEn);
if(isset($other_name[1]))
$othername= $other_name[1];
$content=$desc[1];
$slug    = $curl->slug(trim($nameStory));
echo $slug."\n";
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
	//var_dump($cover[1]."\n");
	

if (!file_exists("../page/".$path2)) {
	 mkdir("../page/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$imageUrl = $link_img;
//echo $imageUrl."\n";
$responseJson = uploadToCloudflare($imageUrl, $slug, $chap3, $ii);
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

//preg_match_all('#.*<ul id="listsv-1" class="halim-list-eps">(.*)</ul><div.*#imsU', $html, $list_chap);
preg_match_all('#<li class="halim-episode halim-episode-.*"><a href="(.*)" title=".*"><span class="halim-info-.* box-shadow halim-btn" data-post-id=".*" data-server="1"  data-episode-slug=".*>(.*)</span></a>#imsU', $html3, $list_chap);

$i = 0;
while( $i < 5000 )
{
  sleep(0.85);
  echo '.';
  $i++;
}
echo 'done'."\n";
for($i=count($list_chap[1])-1;$i>-1;$i--){
    $chap2=preg_replace('/^/m','Chương ',$list_chap[2][$i]);
	//$chap2='Tap-'.$title;
    print_r($chap2."\n");
	
     if($db->check_chap_exist($chap2,$kq)<1){

		 $html2 = $curl->getContent($urlproxy.$list_chap[1][$i]);
		 //echo $html2."\n";
		 preg_match_all('#.* data-subsv-id="1" data-link="(.*)">Link 1</span>#imsU', $html2, $listcap_video);
		 echo "The result of the substitution is -> ".$listcap_video[1][0]."\n";
		 



		 $linkvideo="https://archive.org/".$listchap_video;
		 $html4 = $curl->getContent($urlproxy.$listcap_video[1][0]);
		 //echo $html4."\n";
		 //print_r($html4)."\n";
		 preg_match('#<video class="jw-video jw-reset" tabindex="-1" disableremoteplayback="" webkit-playsinline="" playsinline="" src="(.*)"></video>#imsU', $html4, $link_video);	 
		 //var_dump($link_video."\n");
		 //preg_match('#<meta property="og:video" content="(.*)">#imsU', $html4, $linkgetvideo1);
		 //preg_match('~<meta property="og:video" content="(.*)">~', $html4, $linkgetvideo1);
		 preg_match('#.+<meta property="og:video" content="(.+)">#m', $html4, $linkgetvideo1);
		 echo "The result of the substitution is ".$linkgetvideo1[1]."\n";
		 $arr_img = $linkgetvideo1[1];
		 echo $arr_img."\n";
		 preg_match('#{"file":"(.*)","label":"480p"#imsU', $html4, $link_video); 
		 echo "The result of the substitution is ".$link_video[1]."\n";


$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

$ii=0;
//foreach ($arr_img as $img) {
	if($arr_img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    $imageUrl = $arr_img;
    $responseJson = uploadViCloudflare($imageUrl, $slug, $chap3, $ii);
    echo "Uploaded: " . $responseJson . "\n";


    // Decode the JSON response
$response = json_decode($responseJson, true);

    if (isset($response['success']) && $response['success'] === true && isset($response['result']['preview'])) {
		$ii++;
        $uploadedImageUrl = $response['result']['preview'];
		echo "Uploaded: " . $uploadedImageUrl . "\n";
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
echo $ImageUrls."\n";

//var_dump($ImageUrls)."\n";
$dateChap=date('Y-m-d H:i:s');
//$chap3='Chuong '.$list_chap[2][$i];

$db->AddChap(preg_replace('/^/m','Chương ',$list_chap[2][$i]),"","","Ẩn",$dateChap,$kq,$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
     $db->UpdateChapToStory($kq,preg_replace('/^/m','Chương ',$list_chap[2][$i]),$dateChap);
     			}
			}
  		}
	}
	$i = 0;
while( $i < 5000 )
{
  sleep(0.85);
  echo '.';
  $i++;
}
echo 'done'."\n";
}else{

$idStory=$db->GetStoryByLink($nameStory,1,0);
//$prefix = "https://hhhkungfu.tv/luyen-khi-muoi-van-nam";
//$slug = str_replace($prefix, "", $url);
if($checkall==1){
preg_match('#<img class="movie-thumb" src="(.*)" alt=".*">#imsU', $html3, $summary_image);
preg_match('#<meta property="og:url" content="(.*)">#imsU', $html3, $slug);

preg_match('#<div class="summary-content">(.*)</div>#ismU', $html3, $other_name);
preg_match('#<p class="category">Thể Loại: (.*)</p>#imsU', $html3, $the_loai);
preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);
//print_r($genres);
//$genres=$genres[1][0];
print_r($genres);

preg_match_all('#<div class="author-content">(.*)</div>#ismU', $html, $tac_gia);
preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
preg_match('#<div class="summary-content" style="text-align: right">(.*)</div>#imsU', $html, $m_status);
preg_match('#<meta property="og:description" content="(.*)" />#imsU', $html3, $desc);
//$desx=$desc[1];
//print_r($desx);

preg_match('#<meta property="og:image" content="(.*)" />#ismU', $html3, $cover);
//print_r($cover);

$arr_authors=array();
$arr_genres=array();
$arrGenreEn=array();
foreach($authors[1] as $item){
 array_push($arr_authors,$item);
}
/*
foreach($genres[1][0] as $item){
 array_push($arr_genres,$item);
 array_push($arrGenreEn, $curl->slug($item));
}*/
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
$responseJson = uploadToCloudflare($imageUrl, $slug, $chap3, $ii);
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


//preg_match_all('#.*<ul id="listsv-1" class="halim-list-eps">(.*)</ul><div.*#imsU', $html, $list_chap);
preg_match_all('#<li class="halim-episode halim-episode-.*"><a href="(.*)" title=".*"><span class="halim-info-.* box-shadow halim-btn" data-post-id=".*" data-server="1"  data-episode-slug=".*>(.*)</span></a>#imsU', $html3, $list_chap);
$i = 0;
while( $i < 5000 )
{
  sleep(0.85);
  echo '.';
  $i++;
}
echo 'done'."\n";
for($i=count($list_chap[1])-1;$i>-1;$i--){

    $chap2=preg_replace('/^/m','Chương ',$list_chap[2][$i]);
	//$chap2='Tap-'.$title;
    print_r($chap2."\n");
	
     if($db->check_chap_exist($chap2, $idStory)<1){
 		 $html2 = $curl->getContent($urlproxy.$list_chap[1][$i]);
		 //echo $html2."\n";
		 preg_match_all('#.* data-subsv-id="1" data-link="(.*)">Link 1</span>#imsU', $html2, $listcap_video);
		 echo "The result of the substitution is -> ".$listcap_video[1][0]."\n";
				 



		 $linkvideo="https://archive.org/".$listchap_video;
		 $html4 = $curl->getContent($urlproxy.$listcap_video[1][0]);
		 //echo $html4."\n";
		 //print_r($html4)."\n";
		 preg_match('#<video class="jw-video jw-reset" tabindex="-1" disableremoteplayback="" webkit-playsinline="" playsinline="" src="(.*)"></video>#imsU', $html4, $link_video);	 
		 //var_dump($link_video."\n");
		 //preg_match('#<meta property="og:video" content="(.*)">#imsU', $html4, $linkgetvideo1);
		 //preg_match('~<meta property="og:video" content="(.*)">~', $html4, $linkgetvideo1);
		 preg_match('#.+<meta property="og:video" content="(.+)">#m', $html4, $linkgetvideo1);
		 echo "The result of the substitution is ".$linkgetvideo1[1]."\n";
		 $arr_img = $linkgetvideo1[1];
		 echo $arr_img."\n";
		 preg_match('#{"file":"(.*)","label":"480p"#imsU', $html4, $link_video); 
		 echo "The result of the substitution is ".$link_video[1]."\n";

		 
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

// Iterate over each image and upload it
$ii=0;
//foreach ($arr_img as $img) {
	if($arr_img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    $imageUrl = $arr_img;
    $responseJson = uploadViCloudflare($imageUrl, $slug, $chap3, $ii);
    echo "Uploaded: " . $responseJson . "\n";


    // Decode the JSON response
$response = json_decode($responseJson, true);

    if (isset($response['success']) && $response['success'] === true && isset($response['result']['preview'])) {
		$ii++;
        $uploadedImageUrl = $response['result']['preview'];
		echo "Uploaded: " . $uploadedImageUrl . "\n";
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
echo $ImageUrls."\n";

//var_dump($ImageUrls)."\n";
$dateChap=date('Y-m-d H:i:s');
$chap3='Chuong '.$list_chap[2][$i];

$db->AddChap(preg_replace('/^/m','Chương ',$list_chap[2][$i]),"","","Ẩn",$dateChap,$idStory[0],$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
	 $db->UpdateChapToStory($idStory[0],preg_replace('/^/m','Chương ',$list_chap[2][$i]),$dateChap);
			}
		}
	}
	
$j=1;
$db->dis_connect();//ngat ket noi mysql

 $array=array("Error"=>"$j");

echo json_encode($array);

?>