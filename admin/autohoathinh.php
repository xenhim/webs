<?php
include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');

function uploadToCloudflare($imageUrl, $slug, $chap3, $ii) {
	$chap = "chapter-" . $chap3;
	$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
	$datapost = $imageUrl;
	$sungs = $slug . "-" . $chap . "-" . uniqid(rand()) . "-" . $ii;
	$datasave = "curl -request POST ";
	$datasave .= "-url https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816816/images/v1 ";
	$datasave .= "-header 'Authorization: Bearer " . $ids . "' ";
	$datasave .= "-form 'metadata={\"key\":\"value\"}' ";
	$datasave .= "-form 'file=@" . $datapost . "' ";
	$datasave .= "-form 'filename=" . $sungs . "' ";
	$datasave .= "-form 'response_fields={\"id\":1,\"url\":1}'";
	$result = shell_exec($datasave);
	return $result;
}

function uploadViCloudflare($imageUrl, $slug, $chap3, $ii) {
	$chap = "chapter-" . $chap3;
	$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";
	$datapost = $imageUrl;
	$sungs = $slug . "-" . $chap . "-" . uniqid(rand()) . "-" . $ii;
	$chapgs = str_replace("https://hhhkungfu.tv/", "", $sungs);
	$datasave = "curl -X POST ";
	$datasave .= "-H 'Authorization: Bearer " . $ids . "' ";
	$datasave .= "-H 'Content-Type: application/json' ";
	$datasave .= "-H 'cache-control: no-cache' ";
	$datasave .= "-H 'Postman-Token: 6b3d4a5d-6b4f-4f3c-8d3d-1a4c7a6f8c7e' ";
	$datasave .= "-H 'User-Agent: PostmanRuntime/7.20.1' ";
	$datasave .= "-H 'Accept: */*' ";
	$datasave .= "-H 'Host: worker-rapid-butterfly-3f3a.xemining.workers.dev' ";
	$datasave .= "-H 'Accept-Encoding: gzip, deflate' ";
	$datasave .= "-H 'Content-Length: 0' ";
	$datasave .= "-H 'Connection: keep-alive' ";
	$datasave .= "-H 'cache-control: no-cache' ";
	$datasave .= "-F 'metadata={\"key\":\"value\"}' ";
	$datasave .= "-F 'file=@" . $datapost . "' ";
	$datasave .= "-F 'filename=" . $sungs . "' ";
	$datasave .= "-F 'response_fields={\"id\":1,\"url\":1}' ";
	$result = shell_exec($datasave);
	return $result;
}


$curl = new cURL();
$db=new config();
$db->config();
$j=0;
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Define the URL and URL proxy
$url = "https://hhhkungfu.tv/tinh-than-bien-phan-4";
$urlproxy = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";

// Define the country, checkall, badge, waning, and checkimg variables
$country = 'all';
$checkall = 0;
$badge = 'Anime';
$waning = 'Thường';
$checkimg = 1;

// Get the content of the URL using the cURL library
$html3 = $curl->getContent($urlproxy.$url);

// Parse the URL
$parse = parse_url($urlproxy.$url);

// Define the options for the stream context
$opts = array(
	'http' => array(
		'method' => "GET",
		'header' => "Accept-language: en\r\n" .
		"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
		"referer: https://hhhkungfu.tv/hanh-trinh-di-gioi-cua-ta",
	),
);

// Create the stream context
$context_url = stream_context_create($opts);

// Define the sum variable and loop through the numbers 1 to 10
$sum = 0;
for($i = 1; $i<=10; $i++) {
	$sum = $sum + $i;
}

// Create a new DOMDocument object and load the HTML content
$dom = new DOMDocument();
@$dom->loadHTML($html3);

// Create a new DOMXPath object
$xpath = new DOMXPath($dom);

// Define the query to select the episode links
$query = '//*[@class="halim-list-eps"]/li[*]/a';

// Define the query to select the story name links
$queryname = '//*[@id="listsv-1"]/li[*]/a';

// Execute the query to get the episode links
$links = $xpath->query($query);

// Loop through the selected <a> elements and extract the href attribute
if($links){
	foreach ($links as $link) {
		$href = $link->getAttribute('href');
		$title = $link->getAttribute('title');

		// Get the content of the episode URL using the cURL library
		$html1 = $curl->getContent($urlproxy.$href);

		// Get the name of the story
		preg_match('#<h1 class="entry-title">(.*)</h1>#imsU', $html3, $name);

		// Get the summary image
		preg_match('#<img class="movie-thumb" src="(.*)" alt=".*">#imsU', $html3, $summary_image);

		// Get the slug
		preg_match('#<meta property="og:url" content="(.*)">#imsU', $html3, $slug);

		// Get the other name
		preg_match('#<div class="summary-content">(.*)</div>#ismU', $html3, $other_name);

		// Get the genres
		preg_match('#<p class="category">Thể Loại: (.*)</p>#imsU', $html3, $the_loai);
		preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);

		// Get the authors
		preg_match_all('#<div class="author-content">(.*)</div>#ismU', $html, $tac_gia);
		preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);

		// Get the status
		preg_match('#<div class="summary-content" style="text-align: right">(.*)</div>#imsU', $html, $m_status);

		// Get the description
		preg_match('#<meta property="og:description" content="(.*)" />#imsU', $html3, $desc);

		// Get the cover image
		preg_match('#<meta property="og:image" content="(.*)" />#ismU', $html3, $cover);

		// Initialize variables
		$othername = "";
		$link_img = "";
		$status = "";
		$author = "";
		$genre1 = "";
		$genre2 = "";
		$dateUpload = date('Y-m-d H:i:s');
		$female = 1; // truyện tranh
		$male = 0; // truyện trữ

		// Get the story name
		$nameStory = $name[1];

		// Get the slug
		$slug = $curl->slug(trim($nameStory));

		// Check if the story already exists in the database
		if($db->check_story_exist($nameStory,1,0)<=0){

			// Get the other name
			if(isset($other_name[1]))
				$othername = $other_name[1];

			// Get the genres
			$arr_genres = array();
			$arrGenreEn = array();
			foreach($genres[1] as $item){
				array_push($arr_genres, $item);
				array_push($arrGenreEn, $curl->slug($item));
			}

			// Get the authors
			$arr_authors = array();
			foreach($authors[1] as $item){
				array_push($arr_authors, $item);
			}

			// Get the status
			$status = $m_status[1];

			// Get the content
			$content = $desc[1];

			// Get the cover image URL
			$link_img = $cover[1];

			// Create the directory for the story images
			$path2 = "upload/story/190x247/$slug/";
			if (!file_exists("../page/".$path2)) {
				mkdir("../page/".$path2, 0777, true);
			}

			// Upload the cover image to Cloudflare
			$imageUrl = $link_img;
			$responseJson = uploadToCloudflare($imageUrl, $slug, $chap3, $ii);
			$response = json_decode($responseJson, true);

			// Check if the upload was successful
			if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
				$uploadedImageUrl = $response['result']['variants'][0];
			}

			// Add the story to the database
			$kq=$db->AddStory3($nameStory,$othername,$status,$content,$uploadedImageUrl,$badge,$waning,implode(",",$arr_authors),implode(",",$arr_genres),implode(",",$arrGenreEn),$country,$dateUpload,"",$url,$female,$male);
		}
	}
}
//preg_match_all('#.*<ul id="listsv-1" class="halim-list-eps">(.*)</ul><div.*#imsU', $html, $list_chap);
preg_match_all('#<li class="halim-episode halim-episode-.*"><a href="(.*)" title=".*"><span class="halim-info-.* box-shadow halim-btn" data-post-id=".*" data-server="1"  data-episode-slug=".*>(.*)</span></a>#imsU', $html3, $list_chap);
//print_r($list_chap."\n");
//$list_chap=$href;
//print_r($href."\n");
//var_dump($list_chap[1]);
//print_r($list_chap)."\n";
//$list_chap='https://manga18fx.com' . $list_chap[1];
//echo $list_chap."\n";
//print_r($list_chap)."\n";
$i = 0;
while( $i < 5000 )
{
  sleep(0.85);
  echo '.';
  $i++;
}
echo 'done'."\n";
for($i=count($list_chap[1])-1;$i>-1;$i--){
	//if($title){
    //preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
		//print_r($list_chap[2][$i])."\n";

    //preg_match('#<span class="active halim-info-1-tap-(.*) box-shadow halim-btn"#imsU', $list_chap[2][$i], $chapter);
	//print_r($list_chap[2][$i])."\n";
	//var_dump($list_chap[2][$i]."\n");
	
//$re = '/^/m';
//$str = $chapter[0];
//$subst = "Chương ";
//$result = preg_replace($re, $subst, $str);
//print_r($result)."\n";

    $chap2=preg_replace('/^/m','Chương ',$list_chap[2][$i]);
	// Define variables
	$chap2 = 'Tap-' . $title;
	$kq = null;
	$urlproxy = 'https://example.com/';
	$arr_img = [];

	// Check if chapter exists
	if ($db->check_chap_exist($chap2, $kq) < 1) {
		// Get content from URL
		$html2 = $curl->getContent($urlproxy . $list_chap[1][$i]);

		// Find video link
		preg_match_all('#.* data-subsv-id="1" data-link="(.*)">Link 1</span>#imsU', $html2, $listcap_video);
		$link_video = '';
		if (!empty($listcap_video[1][0])) {
			$html4 = $curl->getContent($urlproxy . $listcap_video[1][0]);
			preg_match('#<video class="jw-video jw-reset" tabindex="-1" disableremoteplayback="" webkit-playsinline="" playsinline="" src="(.*)"></video>#imsU', $html4, $link_video);
		}

		// Find video source
		$linkgetvideo1 = '';
		if (!empty($link_video[1])) {
			preg_match('#.+<meta property="og:video" content="(.+)">#m', $html4, $linkgetvideo1);
		}

		// Add image to array
		if (!empty($linkgetvideo1[1])) {
			$arr_img[] = $linkgetvideo1[1];
		}
	}

	// Upload images
	if (!empty($arr_img) && $db->check_chap_exist($chap2, $kq) < 1) {
		$imageArr = array_map(function($img) {
			return $img;
		}, $arr_img);

		$image1 = implode(",", $imageArr);

		// Upload images to server
		$upload_location = "/upload/chap/manga/" . $slug . "/" . tofloat($chap2);
		if (!file_exists("../page/" . $upload_location)) {
			mkdir("../page/" . $upload_location, 0777, true);
		}

		foreach ($arr_img as $key => $value) {
			$filename = $key + 1 . '.jpg';
			$file = file_get_contents($value);
			file_put_contents("../page/" . $upload_location . "/" . $filename, $file);
		}
	}
$uploadedImageUrls = []; // This array will store all successfully uploaded URLs
$ii = 0;

if ($checkall == 1) {
	preg_match('#<img class="movie-thumb" src="(.*)" alt=".*">#imsU', $html3, $summary_image);
	preg_match('#<meta property="og:url" content="(.*)">#imsU', $html3, $slug);

	preg_match('#<div class="summary-content">(.*)</div>#ismU', $html3, $other_name);
	preg_match('#<p class="category">Thể Loại: (.*)</p>#imsU', $html3, $the_loai);
	preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);

	preg_match_all('#<div class="author-content">(.*)</div>#ismU', $html, $tac_gia);
	preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
	preg_match('#<div class="summary-content" style="text-align: right">(.*)</div>#imsU', $html, $m_status);
	preg_match('#<meta property="og:description" content="(.*)" />#imsU', $html3, $desc);

	preg_match('#<meta property="og:image" content="(.*)" />#ismU', $html3, $cover);

	$arr_authors = [];
	$arr_genres = [];
	$arrGenreEn = [];

	foreach ($authors[1] as $item) {
		array_push($arr_authors, $item);
	}

	$status = $m_status[1];
	$authors1 = implode(",", $arr_authors);
	$genre1 = implode(",", $arr_genres);
	$genre2 = implode(",", $arrGenreEn);

	if (isset($other_name[1])) {
		$othername = $other_name[1];
	}

	$content = $desc[1];
	$slug = $curl->slug(trim($nameStory));
	$path2 = "upload/story/190x247/$slug/";
	$path1 = $slug . "-" . uniqid(rand()) . '.jpg';
	$path3 = "../page/upload/story/190x247/$slug/";
	$path4 = "../page/upload/chap/manga/$slug/";

	if (!preg_match('#http#i', $cover[1])) {
		$cover[1] = 'http:' . $cover[1];
	}

	if (!file_exists("../page/" . $path2)) {
		mkdir("../page/" . $path2, 0777, true);
	}

	$link_img = $cover[1];
	$imageUrl = $link_img;
	$responseJson = uploadToCloudflare($imageUrl, $slug, $chap3, $ii);
	$response = json_decode($responseJson, true);

	if (isset($response['success']) && $response['success'] === true && isset($response['result']['variants'][0])) {
		$uploadedImageUrl = $response['result']['variants'][0];
	}

	$db->UpdateStory3($idStory[0], $nameStory, $othername, $status, $content, $uploadedImageUrl, $badge, $waning, $authors1, $genre1, $genre2, $country, $dateUpload, "", $url, $female, $male);
	$j = 1;
} else {
	$idStory = $db->GetStoryByLink($nameStory, 1, 0);
}

foreach ($arr_img as $img) {
	if ($arr_img) {
		$imageUrl = $img;
		$responseJson = uploadViCloudflare($imageUrl, $slug, $chap3, $ii);
		echo "Uploaded: " . $responseJson . "\n";

		$response = json_decode($responseJson, true);

		if (isset($response['success']) && $response['success'] === true && isset($response['result']['preview'])) {
			$ii++;
			$uploadedImageUrl = $response['result']['preview'];
			echo "Uploaded: " . $uploadedImageUrl . "\n";
			$uploadedImageUrls[] = $uploadedImageUrl;
		} else if (isset($response['success']) && $response['success'] === false) {
			$ii++;
			$upload_location = "/upload/chap/manga/" . $slug . "/" . tofloat($chap2);

			if (!file_exists("../page/" . $upload_location)) {
				mkdir("../page/" . $upload_location, 0777, true);
			}

			copy($imageUrl, "../page/" . $upload_location . "/" . $ii . ".jpg", $context_url);
			$data = ("$imageUrl,'../page/' . $upload_location . '/' . $ii . '.jpg', $context_url");
			echo $data . "\n";
			$uploadedImageUrl = "https://xemtruyen.xyz/page" . $upload_location . "/" . $ii . ".jpg";
			$uploadedImageUrls[] = $uploadedImageUrl;
		}
	}
}

$ImageUrls = implode(",", $uploadedImageUrls);
echo $ImageUrls . "\n";

$dateChap = date('Y-m-d H:i:s');
$db->AddChap(preg_replace('/^/m', 'Chương ', $list_chap[2][$i]), "", "", "Ẩn", $dateChap, $kq, $ImageUrls, "", "", "", $parse["host"], "", $list_chap[1][$i]);
$db->UpdateChapToStory($kq, preg_replace('/^/m', 'Chương ', $list_chap[2][$i]), $dateChap);

$i = 0;

while ($i < 5000) {
	sleep(0.85);
	echo '.';
	$i++;
}

echo 'done' . "\n";


//preg_match_all('#.*<ul id="listsv-1" class="halim-list-eps">(.*)</ul><div.*#imsU', $html, $list_chap);
preg_match_all('#<li class="halim-episode halim-episode-.*"><a href="(.*)" title=".*"><span class="halim-info-.* box-shadow halim-btn" data-post-id=".*" data-server="1"  data-episode-slug=".*>(.*)</span></a>#imsU', $html3, $list_chap);
//print_r($list_chap."\n");
//$list_chap=$href;
//print_r($href."\n");
//var_dump($list_chap[1]);
//print_r($list_chap)."\n";
//$list_chap='https://manga18fx.com' . $list_chap[1];
//echo $list_chap."\n";
//print_r($list_chap)."\n";
$i = 0;
while( $i < 5000 )
{
  sleep(0.85);
  echo '.';
  $i++;
}
echo 'done'."\n";
for($i=count($list_chap[1])-1;$i>-1;$i--){
	//if($title){
    //preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
		//print_r($list_chap[2][$i])."\n";

    //preg_match('#<span class="active halim-info-1-tap-(.*) box-shadow halim-btn"#imsU', $list_chap[2][$i], $chapter);
	//print_r($list_chap[2][$i])."\n";
	//var_dump($list_chap[2][$i]."\n");
	
//$re = '/^/m';
//$str = $chapter[0];
//$subst = "Chương ";
//$result = preg_replace($re, $subst, $str);
//print_r($result)."\n";

    $chap2=preg_replace('/^/m','Chương ',$list_chap[2][$i]);
	//$chap2='Tap-'.$title;
    print_r($chap2."\n");
	
     if($db->check_chap_exist($chap2, $idStory)<1){
    //$html1 = $curl->getContent($urlproxy.$list_chap[1][$i]);
	//print_r($html1)."\n";
    //preg_match_all('#.*play-alternative-sv box-shadow" data-subsv-id="1" data-link="(.*)">.*</span>#imsU', $html1, $list_chap_img);
	//preg_match('#<video class="jw-video jw-reset" tabindex="-1" disableremoteplayback="" webkit-playsinline="" playsinline="" style="object-fit: fill;" src="(.*)"></video>#imsU', $html1, $listchap_video);
	//print_r($listchap_video."\n");
	//$linkgetvideo="https://hoathinh3d.biz/wp-content/themes/halimmovies/player.php?episode_slug=tap-$title&server_id=1&subsv_id=&post_id=2430&nonce=16a1988c79";
//print_r($list_chap[1][$i]."\n");

		 $html2 = $curl->getContent($urlproxy.$list_chap[1][$i]);
		 //echo $html2."\n";
		 preg_match_all('#.* data-subsv-id="1" data-link="(.*)">Link 1</span>#imsU', $html2, $listcap_video);
		// Define the function to upload images to ViClouflare
		function uploadViCloudflare($imageUrl, $slug, $chap3, $ii) {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => array('url' => $imageUrl, 'slug' => $slug, 'chap' => $chap3, 'index' => $ii),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			return $response;
		}

		// Define the variables
		$j = 1;
		$uploadedImageUrls = array();

		// Check if the request method is POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Get the input data
			$url = $_POST['url'];
			$slug = $_POST['slug'];
			$chap2 = $_POST['chap'];
			$context_url = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36')));

			// Get the HTML content of the URL
			$html = file_get_contents($url, false, $context_url);

			// Get the list of chapters
			preg_match_all('#<a href="(.*)" title="(.*)">(.*)</a>#imsU', $html, $list_chap);

			// Connect to the database
			$db = new mysqli('localhost', 'username', 'password', 'database_name');

			// Iterate over each chapter and upload its images
			foreach ($list_chap[1] as $i => $chap) {
				// Get the HTML content of the chapter
				$html_chap = file_get_contents($chap, false, $context_url);

				// Get the list of images in the chapter
				preg_match_all('#<img.*?src="(.*?)".*?>#ims', $html_chap, $list_img);

				// Iterate over each image and upload it
				foreach ($list_img[1] as $img) {
					// Upload the image to ViCloudflare
					$responseJson = uploadViCloudflare($img, $slug, $chap2, $j);
					echo "Uploaded: " . $responseJson . "\n";

					// Decode the JSON response
					$response = json_decode($responseJson, true);

					// Check if the image was uploaded successfully
					if (isset($response['success']) && $response['success'] === true && isset($response['result']['preview'])) {
						$uploadedImageUrl = $response['result']['preview'];
						echo "Uploaded: " . $uploadedImageUrl . "\n";
						$uploadedImageUrls[] = $uploadedImageUrl; // Add the URL to the array
					} else if (isset($response['success']) && $response['success'] === false) {
						// If the image failed to upload, copy it to the server and add its URL to the array
						$upload_location = "/upload/chap/manga/".$slug."/".tofloat($chap2);
						if (!file_exists("../page/".$upload_location)) {
							mkdir("../page/".$upload_location, 0777, true);
						}
						copy($img, "../page/".$upload_location."/".$j.".jpg", $context_url);
						$uploadedImageUrl = "https://xemtruyen.xyz/page".$upload_location."/".$j.".jpg";
						echo "Uploaded: " . $uploadedImageUrl . "\n";
						$uploadedImageUrls[] = $uploadedImageUrl;
					}
					$j++;
				}

				// Output all uploaded URLs as a comma-separated string
				$imageUrls = implode(",", $uploadedImageUrls);
				echo $imageUrls."\n";

				// Add the chapter to the database
				$dateChap = date('Y-m-d H:i:s');
				$chap3 = 'Chuong '.$list_chap[2][$i];
				$db->query("INSERT INTO chapters (title, content, description, status, created_at, story_id, image_urls, author_id, editor_id, translator_id, source, slug, chapter_number) VALUES ('".preg_replace('/^/m','Chương ',$list_chap[2][$i])."', '', '', 'Ẩn', '".$dateChap."', '".$idStory[0]."', '".$imageUrls."', '', '', '', '".$parse["host"]."', '', '".$list_chap[1][$i]."')");
				$db->query("UPDATE stories SET latest_chapter = '".preg_replace('/^/m','Chương ',$list_chap[2][$i])."', updated_at = '".$dateChap."' WHERE id = '".$idStory[0]."'");
			}

			// Disconnect from the database
			$db->close();

			// Output the result as JSON
			$array = array("Error" => $j);
			echo json_encode($array);
			}
		}
	}
}
