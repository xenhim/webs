<?php
    require_once('model/conn.php');
    require_once('class.cURL.php');
    require_once('function/function.php');

function uploadToCloudflare($imageUrl, $url, $chap2, $ii) {
    //global $ii;
    $prefix = "https://nhattruyenplus.com/truyen-tranh/";
    $slug = str_replace($prefix, "", $url);
    $chap = str_replace("Chương ", "chapter-", $chap2);
    //echo $slug."-".$chap."-".$ii."\n";
    $ii++;

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $imageUrl;
//$sungs = $slug."-".$chap."-".uniqid(rand())."-".$ii;
$sungs = $slug."-"."xemtruyen_xyz"."-".$chap."-".$ii;
$datasave = base64_decode("Y3VybCAtLXJlcXVlc3QgUE9TVCBcCiAtLXVybCBodHRwczovL2FwaS5jbG91ZGZsYXJlLmNvbS9jbGllbnQvdjQvYWNjb3VudHMvNzkyYzJmZDdlOTc3YWM1MTkyZWE0NDRlZDlhOTY4MTYvaW1hZ2VzL3YxIFwKIC0taGVhZGVyICdBdXRob3JpemF0aW9uOiBCZWFyZXIg");
$datasave .= $ids.base64_decode("JyBcCiAtLWZvcm0gJ3VybD1odHRwczovL3dvcmtlci1yYXBpZC1idXR0ZXJmbHktM2YzYS54ZW1pbmluZy53b3JrZXJzLmRldi8/dXJsPQ==");
$datasave .= $datapost.base64_decode("JyBcCiAtLWZvcm0gJ21ldGFkYXRhPXsia2V5IjoidmFsdWUifScgXAogLS1mb3JtICdpZD0=");
$datasave .= $sungs.base64_decode("JyBcCiAtLWZvcm0gJ3JlcXVpcmVTaWduZWRVUkxzPWZhbHNlJw==");
//echo $datasave."\n";
$result = shell_exec($datasave);
//echo $result."\n";

    //$ii++;
    return $result;
}

function uploadToCloudflara($imageUrl, $url, $chap2, $slug, $ii) {
    //global $ii;
    $proxu = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";

    $prefix = "https://www.nettruyenus.com/truyen-tranh/";
    //$slug = str_replace($prefix, "", $url);
    $ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
    //$datapost = $imageUrl;
    $chap = str_replace("Chương ", "chapter-", $chap2);
    echo $chap."\n";

        sleep(6);



    // Sử dụng hàm uploadToCloudflare
    //$urlmage = $proxu.$image2;
    //$idname = $sungs;
// Đường dẫn đến file chứa các URL
$urlFile = 'truyenname.json';
$urls = file($urlFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
//$urls = $filePe;
// Khởi tạo curl multi handler
$mh = curl_multi_init();

// Mảng để giữ các handles
$curlArray = [];

// Authorization header
$authHeader = 'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP';

foreach ($urls as $i => $url) {
    echo $url."\n";
    $ii++;
    //$sungs = $slug."-".$chap."-".$ii;
    $sungs = $slug."-"."xemtruyen_xyz"."-".$chap."-".$ii;
    echo $sungs."\n";
    // Khởi tạo và thiết lập các tùy chọn curl cho mỗi yêu cầu
    $curlArray[$i] = curl_init();

    // Đặt các tùy chọn curl
    curl_setopt($curlArray[$i], CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1');
    curl_setopt($curlArray[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlArray[$i], CURLOPT_POST, true);
    curl_setopt($curlArray[$i], CURLOPT_HTTPHEADER, [$authHeader]);

    // Tạo các trường form data
    $postData = [
        'url' => $proxu.$url,
        'metadata' => json_encode(["key" => "value"]),
        'id' => $sungs,
        'requireSignedURLs' => 'false',
    ];
    //print_r($postData);
    
    curl_setopt($curlArray[$i], CURLOPT_POSTFIELDS, $postData);

    // Thêm handle đến curl multi handle
    curl_multi_add_handle($mh, $curlArray[$i]);
}

// Thực hiện các yêu cầu
$running = null;
do {
    curl_multi_exec($mh, $running);
} while ($running);

// Đóng các handles và in ra kết quả
foreach ($curlArray as $curl) {
    // In ra kết quả hoặc lưu vào một biến
    $response = curl_multi_getcontent($curl);
    //$response = json_decode($responseJson, true);
    $uploadedImageUrls = [];
    
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $ii++;
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
        $ImageUrls = implode(",", $uploadedImageUrls);
        $filePath = 'truyensname.txt';
        $filePe = file_put_contents($filePath, $ImageUrls);
        echo $filePe."\n";
        //echo $ImageUrls."\n";
    }/*else if(isset($response['success']) && $response['success'] === false){
        $ii++;
                $upload_location = "/uploads/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../wp-content/".$upload_location)) {
                    mkdir("../wp-content/".$upload_location, 0777, true);
                }
                copy($imageUrl,"../wp-content/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$imageUrl,'../wp-content/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                echo $data."\n";
                $uploadedImageUrl="https://xemtruyen.xyz/page".$upload_location."/".$ii.".jpg";
                $response[] = $uploadedImageUrl;
}*/
    // Xóa handle từ curl multi handle và đóng handle đơn
    curl_multi_remove_handle($mh, $curl);
    curl_close($curl);
}
// Đóng curl multi handle
curl_multi_close($mh);
    
        return $response;
}

    var_dump($filePe);



$curl = new cURL();
$db = new config();
$db->config();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$site = $db->GetDomain_site(3);
$proxu = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";

$base_url = "http://" . $site . "/the-loai";
$context_url = getContextOptions();

function getContextOptions() {
    $opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept-language: en\r\n" .
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
            "referer: https://www.nhattruyenplus.com/",
        ),
    );
    return stream_context_create($opts);
}

$page = 1; // Bắt đầu từ trang 1

    while (true) {
    // Xây dựng URL của trang cần lấy
    $url = $base_url . "?page=" . $page;
    $string = $curl->getContent($proxu . $url);
         $page++;

    // Kiểm tra nếu trang không tồn tại hoặc không có nội dung, thoát khỏi vòng lặp
    if (!$string) {
        break;
    }

    //echo $string."\n";
    //preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl00_divPager"#ismU', $string, $content);
    preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl01_divPager"#ismU', $string, $content);
    preg_match_all('#<a class="jtip".*href="(.*)">(.*)</a>#imsU', $content[1], $list_name);
    $list_manga = array_combine($list_name[1], $list_name[2]);
    print_r($list_manga);


    $slug = ""; // Initialize with an empty string or a default value
    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
    print_r($nameStory."\n");
    $slug = $curl->slug(trim($nameStory));

   
    if($db->check_story_exist($nameStory,1,0)>0){
         
    $html= $curl->getContent($proxu.$url);
    preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
    //var_dump($html."\n");

   
    if($html !=""){
        //var_dump($html."\n");
        
    $parse = parse_url($url);
    preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
    print_r($list_chap);
    $Name_Chapter=$db->GetNameStoryOFChap($nameStory,1,0);
    $posity= check_chap($list_chap[2],$Name_Chapter[0]);
    print_r($posity."\n");

    $e=0;
    for($i=$posity-1;$i>-1;$i--)
    {
            preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
             $chap2=str_replace('Chapter','Chương',$chapter[0]);
             print_r($chap2."\n");

       if($db->check_chap_exist($chap2,$Name_Chapter[1])<1){
        if($e<6){
            $html1 = $curl->getContent($proxu.$list_chap[1][$i]);
            if($html1 !=""){
                preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
                $dom = new DOMDocument();
                @$dom->loadHTML($list_chap_img[1][0]);
                $x = new DOMXPath($dom);
                $arr_img=array();
                $ii = 0;
                foreach($x->query("//img") as $node)
                {
                    $cover="";
                    if (!preg_match('#http#i', $node->getAttribute("src"))) {
                    //$ii++;
                        $cover = 'http:' . $node->getAttribute("src");
                    }else{
                          $cover =  check_blogger($node->getAttribute("src"));
                    }
                    if($cover !="")
                    //$ii++;
                    array_push($arr_img,$cover);
                }
                 $dateChap=date('Y-m-d H:i:s');
                $image2 = implode(PHP_EOL, $arr_img);
                $images = str_replace("http:data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=", "", $image2);

                                     
                $filePath = 'truyennamea.json';
                $filePe = file_put_contents($filePath, $images);
                $fpFileData = fopen("truyennamea.json", "a");

                echo $fpFileData."\n";
                // Lưu dữ liệu JSON vào tệp truyenname.json

                if ($arr_img !=[] && $db->check_chap_exist($chap2,$Name_Chapter[1])<1) {
                    $imageArr = array_map(function($img) {
                        return $img;
                    }, $arr_img);
                        $image1 = implode(",", $imageArr);

                }
    

//var_dump($page);
//echo $page."\n";


//echo $urls."\n";
    $ii=0;
    $responJson = uploadToCloudflara($image1, $url, $chap2, $slug, $ii);
    //echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responJson, true);
    
//echo $ii."\n";
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

// Iterate over each image and upload it
foreach ($arr_img as $img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    $imageUrl = $img;
    //$responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
    //$responseJson = uploadToCloudflara($imageUrl, $url, $chap2, $slug, $ii);
    //echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    //$response = json_decode($responseJson, true);
    //echo "Uploaded: " . $response . "\n";

    // Check if the upload was successful and the variants key exists
    
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $ii++;
        echo $ii."\n";
        $uploadedImageUrl = $response['result']['variants'][0];
        $chap = str_replace("Chương ", "chapter-", $chap2);
        $sungs = $slug."-"."xemtruyen_xyz"."-".$chap."-".$ii;
        $uploe = "https://imagedelivery.net/JDzrA2GqFSvC_q8u0OrkLQ/".$sungs."/public";
        $uploadedImageUrls[] = $uploe; // Add the URL to the array
    }else if(isset($response['success']) && $response['success'] === false){
        $ii++;
                $upload_location = "/uploads/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../wp-content/".$upload_location)) {
                    mkdir("../wp-content/".$upload_location, 0777, true);
                }
                copy($imageUrl,"../wp-content/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$imageUrl,'../wp-content/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                echo $data."\n";
                $uploadedImageUrl="https://xemtruyen.xyz/wp-content".$upload_location."/".$ii.".jpg";
                $uploadedImageUrls[] = $uploadedImageUrl;
            }
     }
}
         
// Output all uploaded URLs as a comma-separated string
//$ImageUrls = implode(",", $uploadedImageUrls);

/*
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs

// Iterate over each image and upload it
foreach ($arr_img as $img) {
    //$imgs = 'https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=';
    print_r($img."\n");
    $imageUrl = $img;
    $responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $ii);
    //echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

    // Check if the upload was successful and the variants key exists
    if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
        $uploadedImageUrl = $response['result']['variants'][0];
        $uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
    }
}*/

// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
echo $ImageUrls."\n";

                     $db->AddChap($chap2,"","","Ẩn",$dateChap,$Name_Chapter[1],$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
                     $db->UpdateChapToStory($Name_Chapter[1],$chap2,$dateChap);
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
