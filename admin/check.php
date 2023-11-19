<?php
// Include required files
require_once "RollingCurl/RollingCurl.php";
require_once "RollingCurl/Request.php";
require_once('model/conn.php');
require_once('function/function.php');
$db=new config();
$db->config();
date_default_timezone_set('Asia/Ho_Chi_Minh');

$jsonData = file_get_contents('truyenname.json');
$data = json_decode($jsonData, true);
$urlproxy="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
$urlb = "https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1";
$header = "Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";

function uploadToCloudflare($link_img, $url, $slug, $ii) {
	//global $ii;
    $prefix = "https://www.nettruyenus.com/truyen-tranh/";
    //$slug = str_replace($prefix, "", $url);
	$chap = str_replace("Chương ", "chapter-", $chap2);
    //echo $slug."-".$chap."-".$ii."\n";
	

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $link_img;
$sungs = $slug."-".uniqid(rand());
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

foreach ($data as $story) {
    // Trích xuất thông tin từ $story
	$titles = $story['titles'];
    $nameStory = $story['name'];
	$slug = $story['slug'];
	$name_chap = $story['name_chap'];
    $othername = $story['othername'];
    $status = $story['status'];
    $content = ''; // Điền thông tin nội dung ở đây
    $uploadedImageUrl = $story['link_img'];
    $badge = $story['badge'];
    $waning = $story['waning'];
    $authors1 = $story['author'];
    $genre1 = $story['genre_1'];
    $genre2 = $story['genre_2'];
    $country = $story['country'];
	$host = $story['host'];
	$list_chap = $story['list_chap'];
	$link_img = $story['link_img'];
    $dateUpload = $story['dateUpload'];
    $url = $story['list_chap'];
    $female = $story['female'];
    $male = $story['male'];
    


    // Thực hiện multi-curl để tải hình ảnh và gửi lệnh Curl cho mỗi hình ảnh
    //$chapterImages = $story['listchapter']['chapter-1']; // Thay đổi key nếu cần
	// Thay đổi key 'chapter-1' thành key của mỗi chapter bạn muốn lấy hình ảnh
	//$story = $data;
    $chapterImages = [];
    foreach ($story['listchapter'] as $chapterKey => $chapterImagesArray) {
        if (strpos($chapterKey, 'chapter-') === 0) {
        // Đây là một key của chapter, thêm hình ảnh vào danh sách
        $chapterImages = array_merge($chapterImages, $chapterImagesArray);
    }
}



// Bây giờ $chapterImages chứa danh sách hình ảnh từ tất cả các chapter

    $imageUrls = [];

    // Tạo mảng các công việc cần thực hiện với cURL
    $curlJobs = [];
	
    $ii=1;
    foreach ($chapterImages as $image) {
		$urlimage=$urlproxy.$image;
		$re = '#https://worker-rapid-butterfly-3f3a[\x2e]xemining[\x2e]workers[\x2e]dev/[\x3f]url=(\d{1,4})|https://worker-rapid-butterfly-3f3a[\x2e]xemining[\x2e]workers[\x2e]dev/[\x3f]url=(\w{3}$)|https://worker-rapid-butterfly-3f3a[\x2e]xemining[\x2e]workers[\x2e]dev/[\x3f]url=https://www[\x2e]nettruyenus[\x2e]com/(.*+)|truyen-tranh(.*+)#imsU';
		$str = $urlimage;
		$subst = "$3";
		$result = preg_replace($re, $subst, $str);
		$chap = str_replace("https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=all", "", $result);
		$subst = "$1";
		$urlimags = preg_replace($re, $subst, $chap);
		$urlmage = $urlimags;
		$idname = $titles.'-'.$ii++;
        // Thực hiện các lệnh cURL ở đây
        $curlCommand = "curl --request POST \
            --url https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1 \
            --header 'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP' \
            --form 'url=$urlmage' \
            --form 'metadata={\"key\":\"value\"}' \
            --form 'id=$idname' \
            --form 'requireSignedURLs=false'";

        $curlJobs[] = $curlCommand;
    }

	
if ($curlJobs) {
//echo $link_img."\n";

$responseJson = uploadToCloudflare($link_img, $url, $slug, $ii);
$response = json_decode($responseJson, true);
echo $response."\n";

if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
    $uploadedImageUrl = $response['result']['variants'][0];
    // Lúc này, $uploadedImageUrl chính là URL của hình ảnh bạn đã tải lên
    //echo $uploadedImageUrl."\n"; // In ra hoặc bạn có thể lưu vào cơ sở dữ liệu hoặc xử lý tiếp theo nhu cầu của bạn
}

    // Thực hiện lệnh PHP
$kq = $db->AddStory3($nameStory, $othername, $status, $content, $uploadedImageUrl, $badge, $waning, $authors1, $genre1, $genre2, $country, $dateUpload, "", $url, $female, $male);


if($db->check_chap_exist($name_chap,$kq)<1){

	
    foreach ($curlJobs as $job) {
	echo $job."\n";
    $response = shell_exec($job);
	echo $response."\n";
    // Xử lý nội dung sau khi thực hiện lệnh Curl ở đây
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $ii++;
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    } else if (isset($response['success']) && $response['success'] === false) {
        $ii++;
        $upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
        if (!file_exists("../page/".$upload_location)) {
            mkdir("../page/".$upload_location, 0777, true);
        }
        copy($imageUrl, "../page/".$upload_location."/".$ii.".jpg", $context_url);
        $data = "$imageUrl,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url";
        echo $data."\n";
        $uploadedImageUrl = "https://xemtruyen.xyz/page".$upload_location."/".$ii.".jpg";
        $uploadedImageUrls[] = $uploadedImageUrl;
    }

$ImageUrls = implode(",", $uploadedImageUrls);
$db->AddChap(str_replace('chapter-','Chương ',$name_chap),"","","Ẩn",$dateUpload,$kq,$ImageUrls,"","","",$host,"",$list_chap);
        $db->UpdateChapToStory($kq,str_replace('chapter-','Chương ',$name_chap),$dateUpload);
	}

		}
	}
if ($response === 'dwawdwaa') {

//$kq=$db->AddStory3($nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);

$idStory=$db->GetStoryByLink($nameStory,1,0);
$db->UpdateStory3($idStory[0],$nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);
$db->AddChap($chap,"","","Ẩn",$dateChap,$idStory[0],$ImageUrls,"","","",$host,"",$list_chap);
$db->UpdateChapToStory($idStory[0],$chap,$dateChap);
// Display final results
}
	}
?>
