<?php
    require_once('model/conn1.php');
    require_once('class.cURL.php');
    require_once('function/function.php');

//$ii=1;
/*/uploads/comics/b0bd52f1-9398-41a1-b9ad-1d9209c6d7fc-tu-luc-bat-dau-lien-vo-dich.jpeg
function uploadToCloudflare($image2, $url, $chap2, $ii) {
	$proxu="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
	$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
	$datapost = $imageUrl;
	$chap = str_replace("Chương ", "chapter-", $chap2);
	$sungs = $slug."-".$chap."-".$ii;
	// Sử dụng hàm uploadToCloudflare
	$urlmage = $proxu.$image2;
	$idname = $sungs;
    // Định nghĩa danh sách các yêu cầu cần gửi
    $requests = array();

    // Số lượng yêu cầu tối đa được gửi cùng một lúc
    $maxConcurrentRequests = 10;

    // Thêm các yêu cầu vào danh sách
    for ($i = 0; $i < $maxConcurrentRequests; $i++) {
        $ch = curl_init();

        $headers = array(
            'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP'
        );

        $data = array(
            'url' => $urlmage,
            'metadata' => '{"key":"value"}',
            'id' => $idname,
            'requireSignedURLs' => 'false'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $requests[$i] = $ch;
    }

    // Khởi tạo multi cURL handler
    $mh = curl_multi_init();

    // Thêm các yêu cầu vào multi cURL handler
    foreach ($requests as $ch) {
        curl_multi_add_handle($mh, $ch);
    }

    // Thực hiện các yêu cầu
    do {
        $status = curl_multi_exec($mh, $active);
        if ($active) {
            curl_multi_select($mh);
        }
    } while ($status === CURLM_CALL_MULTI_PERFORM || $active);

    // Lấy kết quả từ mỗi yêu cầu (Bạn cần xử lý kết quả ở đây)

    // Đóng các cURL handler
    foreach ($requests as $ch) {
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }

    // Đóng multi cURL handler
    curl_multi_close($mh);
}
*/

//$ii=1;
function uploadToCloudflare($imageUrl, $url, $chap2, $slug, $ii) {
	//global $ii;
    $prefix = "https://www.nettruyenus.com/truyen-tranh/";
    //$slug = str_replace($prefix, "", $url);
	$chap = str_replace("Chương ", "chapter-", $chap2);
	echo $chap."\n";
    //echo $slug."-".$chap."-".$ii."\n";
	$ii++;
	

$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
$datapost = $imageUrl;
$sungs = $slug."-".$ii;
//echo $sungs."\n";
$datasave = base64_decode("Y3VybCAtLXJlcXVlc3QgUE9TVCBcCiAtLXVybCBodHRwczovL2FwaS5jbG91ZGZsYXJlLmNvbS9jbGllbnQvdjQvYWNjb3VudHMvNzkyYzJmZDdlOTc3YWM1MTkyZWE0NDRlZDlhOTY4MTYvaW1hZ2VzL3YxIFwKIC0taGVhZGVyICdBdXRob3JpemF0aW9uOiBCZWFyZXIg");
$datasave .= $ids.base64_decode("JyBcCiAtLWZvcm0gJ3VybD1odHRwczovL3dvcmtlci1yYXBpZC1idXR0ZXJmbHktM2YzYS54ZW1pbmluZy53b3JrZXJzLmRldi8/dXJsPQ==");
$datasave .= $datapost.base64_decode("JyBcCiAtLWZvcm0gJ21ldGFkYXRhPXsia2V5IjoidmFsdWUifScgXAogLS1mb3JtICdpZD0=");
$datasave .= $sungs.base64_decode("JyBcCiAtLWZvcm0gJ3JlcXVpcmVTaWduZWRVUkxzPWZhbHNlJw==");
echo $datasave."\n";
	
	$result = shell_exec($datasave);
echo $result."\n";

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
    $db=new config();
    $db->config();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $site=$db->GetDomain_site(2);
    $proxu="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";

    $url="https://".$site."/tim-truyen/mystery";
if($url) {
        $fpFileData = fopen("list.txt", "a");
        fwrite($fpFileData, $datasave."\n");
        //fwrite($fpFileData, $result4."\n");
        fclose($fpFileData);

    $string = $curl->getContent($proxu.$url);
	//echo $string."\n";
    //preg_match('#<div class="items">(.*)id="ctl00_mainContent_ctl00_divPager"#ismU', $string, $content);
    preg_match('#<div class="items">(.*)<div id="ctl00_mainContent_ctl01_divPager" class="pagination-outter">#ismU', $string, $content);
    preg_match_all('#<a class="jtip".*href="(.*)">(.*)</a>#imsU', $content[1], $list_name);
    $list_manga = array_combine($list_name[1], $list_name[2]);
	print_r($list_manga);
	//echo $list_name[1]."\n";
	//print_r($list_name[1]."\n");


//$urlproxy="https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
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
//echo $html."\n";
    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
		echo $nameStory."\n";
	//print_r($nameStory."\n");
	//print_r($url."\n");
/*$i = 0;
while( $i < 5000 )
{
  sleep(0.55);
  echo '.';
  $i++;
}
echo 'done';
echo "\n";*/
echo $url."\n";
$html = $curl->getContent($proxu.$url);

		
$parse = parse_url($proxu.$url);
//echo $parse."\n";
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
//preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
//echo $html."\n";
//var_dump($name[1]."\n");
$nameStory=$name[1];
echo $nameStory."\n";
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
//var_dump($content."\n");

$slug = $curl->slug(trim($nameStory));
$ii++;
$path2 = "uploads/chap/manga/190x247/$slug/";
//$path4 = "https://projectxemtruyens3bucket.s3.ap-southeast-1.amazonaws.com";
//$path5 = "https://projectxemtruyens3bucket.s3.ap-southeast-1.amazonaws.com/story/190x247/$slug/";
$path1 = $slug."-".uniqid(rand())."-".$ii.'.jpg';
$path3 = "../wp-content/uploads/story/190x247/$slug/";
$path4 = "../wp-content/uploads/chap/manga/190x247/$slug/";

    //$response = uploadToCloudflare($imagePath);

if (!preg_match('#http#i', $cover[1])) {
    $cover[1] = 'http:' . $cover[1];
}

if (!file_exists("../wp-content/".$path2)) {
	 mkdir("../wp-content/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$filePe = $link_img;
echo $filePe."\n";
$responseJson = uploadToCloudflare($link_img, $url, $chap2, $slug, $ii);
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

$kq=$db->AddStory3($nameStory,$othername,$status,$content,$uploadedImageUrl,$slug,$waning,$authors1,$genre1,$genre2,$country,$dateUpload,"",$url,$female,$male);

//print_r($kq)."\n";
//echo $kq."\n";

         
preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
//$e=0;
//for ($i=0;$i<$tot;$i++){
for($i=count($list_chap[1])-1;$i>-1;$i--){
    preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
     $chap2=str_replace('Chapter','Chương',$chapter[0]);
	echo $chap2."\n";
     if($db->check_chap_exist($chap2,$kq)<1){
    $html1 = $curl->getContent($proxu.$list_chap[1][$i]);
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
            $cover = 'http:' . $node->getAttribute("src");
            if($checkimg==1){
               // $ii++;
                $upload_location = "/uploads/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../wp-content/".$upload_location)) {
                    mkdir("../wp-content/".$upload_location, 0777, true);
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                //$data=("$cover,'../page/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }else{
            $cover =  check_blogger($node->getAttribute("src"));
            if($checkimg==1){
                //$ii++;  // Increase the counter after processing each image
                $upload_location = "uploads/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../wp-content/".$upload_location)) {
                    mkdir("../wp-content/".$upload_location, 0777, true);
                     
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
//$image1 = [$arr_img];
//$imgchap = str_replace("data=nethttp", "data=net\n\rhttp", $arr_img);
$image2 = implode(PHP_EOL, $arr_img);
$filePath = 'truyenname.json';
$filePe = file_put_contents($filePath, $image2);
echo $filePe."\n";
// Lưu dữ liệu JSON vào tệp truyenname.json
var_dump($sungs);

//echo $urls."\n";

if ($arr_img !=[] && $db->check_chap_exist($chap2,$kq)<1) {
    $imageArr = array_map(function($img) {
        return $img;
    }, $arr_img);
	    $image1 = implode(",", $imageArr);

}
	$ii=0;
	$responJson = uploadToCloudflara($image1, $url, $chap2, $slug, $ii);
    //echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responJson, true);
	
		 
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
		 
// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode('","', $uploadedImageUrls);
$ImageUrla = '["'.$ImageUrls.'"]';
echo $ImageUrla."\n";

//var_dump($ImageUrls)."\n";
$dateChap=date('Y-m-d H:i:s');

$db->AddChap($chapter[0],"","","Ẩn",$dateChap,$kq,$ImageUrla,"","","",$parse["host"],"",$list_chap[1][$i]);
     $db->UpdateChapToStory($kq,$chapter[0],$dateChap);
	 //$e++;	 
				 }
     // $ii++;
			  }
		 }
	}
}else{
$idStory=$db->GetStoryByLink($nameStory,1,0);
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
$path2 = "uploads/chap/manga/190x247/$slug/";
$path1 = $slug."-".uniqid(rand()).'.jpg';
$path3 = "../wp-content/upload/story/190x247/$slug/";
$path4 = "../wp-content/upload/chap/manga/$slug/";
//echo $path4."\n";
//var_dump($path4);

if (!preg_match('#http#i', $cover[1])) {
    $cover[1] = 'http:' . $cover[1];
}

if (!file_exists("../wp-content/".$path2)) {
	 mkdir("../wp-content/".$path2, 0777, true);
}

$link_img=$cover[1];
//copy($link_img,$path3.$path1, $context_url);
$imageUrl = $link_img;
//echo $imageUrl."\n";
$responseJson = uploadToCloudflare($imageUrl, $url, $chap2, $slug, $ii);
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
    
preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
for($i=count($list_chap[1])-1;$i>-1;$i--){
	preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
	$chap2=str_replace('Chapter','Chương',$chapter[0]);
	echo $chap2."\n";

	 if($db->check_chap_exist($chap2, $idStory[0]) < 1) {
	$html1 = $curl->getContent($urlproxy.$list_chap[1][$i]);
	preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
	$dom = new DOMDocument();
	@$dom->loadHTML($list_chap_img[1][0]);
	$x = new DOMXPath($dom);
	$arr_img=array();
	    $ii = 0;  // Reset the counter for each new chapter
        foreach($x->query("//img") as $node) {
        $cover="";
        if (!preg_match('#http#i', $node->getAttribute("src"))) {
            $cover = 'http:' . $node->getAttribute("src");
            if($checkimg==1){
                //$ii++;  // Increase the counter after processing each image
                $upload_location = "/uploads/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../wp-content/".$upload_location)) {
                    mkdir("../wp-content/".$upload_location, 0777, true);
                     
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../wp-content/'.$upload_location.'/'.$ii.'.jpg', $context_url");
                //echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }else{
            $cover =  check_blogger($node->getAttribute("src"));
            if($checkimg==1){
                //$ii++;
                $upload_location = "uploads/chap/manga/".$slug."/".tofloat($chap2);
                if (!file_exists("../wp-content/".$upload_location)) {
                    mkdir("../wp-content/".$upload_location, 0777, true);
                     
                }
             
                //copy($cover,"../page/".$upload_location."/".$ii.".jpg", $context_url);
                $data=("$cover,'../wp-content/'.$upload_location.'/'.$ii.'.jpg', $context_url");
               // echo $data."\n";
                //$cover=$upload_location."/".$ii.".jpg";
            }
        }
		//$ii++;  // Increase the counter after processing each image	
        array_push($arr_img,$cover);
    }
//$imgchap = str_replace("data=nethttp", "data=net\n\rhttp", $arr_img);
$image2 = implode(PHP_EOL, $arr_img);
$filePath = 'truyenname.json';
$filePe = file_put_contents($filePath, $image2);
echo $filePe."\n";

// Lưu dữ liệu JSON vào tệp truyenname.json


//if ($arr_img !=[] && $db->check_chap_exist($chapter[0],$idStory[0])<1) {
if($arr_img !=[] && $db->check_chap_exist(str_replace('Chapter','Chương',$chapter[0]),$idStory[0])<1) {
    $imageArr = array_map(function($img) {
        return $img;
    }, $arr_img);

    $image1 = implode(",", $imageArr);

}
	$ii=0;
	$responseJson = uploadToCloudflara($image1, $url, $chap2, $slug, $ii);
    //echo "Uploaded: " . $responseJson . "\n";

    // Decode the JSON response
    $response = json_decode($responseJson, true);

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
		 
// Output all uploaded URLs as a comma-separated string

//$ImageUrls = implode(",", $uploadedImageUrls);
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
    }
  }

/*

    foreach ($list_manga as $url => $name) {
      $nameStory=$name;
	print_r($nameStory."\n");

   
    if($db->check_story_exist($nameStory,1,0)>0){
         
    $html= $curl->getContent($proxu.$url);
    preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
	var_dump($html."\n");

   
    if($html !=""){
		//var_dump($html."\n");
        
    $parse = parse_url($url);
    preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
	var_dump($list_chap."\n");	
    $Name_Chapter=$db->GetNameStoryOFChap($nameStory,1,0);
    $posity= check_chap($list_chap[2],$Name_Chapter[0]);
	print_r($posity);

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
				$ii = 1;
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
					$ii++;	
					array_push($arr_img,$cover);
				}
				 $dateChap=date('Y-m-d H:i:s');
				 if($arr_img !=[] && $db->check_chap_exist($chap2,$Name_Chapter[1])<1){
				     $image1=implode(",",$arr_img);
				     //print_r($image1);
					 
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
}

// Output all uploaded URLs as a comma-separated string
$ImageUrls = implode(",", $uploadedImageUrls);
					 
    				 $db->AddChap($chap2,"","","Ẩn",$dateChap,$Name_Chapter[1],$ImageUrls,"","","",$parse["host"],"",$list_chap[1][$i]);
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
 
}*/
$db->dis_connect();//ngat ket noi mysql	
?>
