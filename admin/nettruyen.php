<?php
//nettruyen
include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');

$curl = new cURL();
$db = new config();
$db->config();
$j = 0;
date_default_timezone_set('Asia/Ho_Chi_Minh');
$url = "https://www.nettruyenus.com/truyen-tranh/cau-lac-bo-truong-sinh";
$urlproxy = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=";
$country = 'all';
$checkall = 0;
$badge = 'Hot';
$waning = 'Thường';
$checkimg = 1;
$html = $curl->getContent($urlproxy . $url);
$parse = parse_url($urlproxy . $url);
$opts = array(
    'http' => array(
        'method' => "GET",
        'header' => "Accept-language: en\r\n" .
        "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
        "referer: https://www.nettruyenus.com/",
    ),
);
$context_url = stream_context_create($opts);
$othername = "";
$link_img = "";
$status = "";
$author = "";
$genre1 = "";
$genre2 = "";
$dateUpload = date('Y-m-d H:i:s');
$female = 1; //truyện tranh
$male = 0; //truyện trữ
preg_match('#<h1 class="title-detail">(.*)</h1>#imsU', $html, $name);
$nameStory = $name[1];
$kq = $name[0];
$slug = ""; // Initialize with an empty string or a default value
if ($db->check_story_exist($kq, 1, 0) <= 0) {
    preg_match('#<h2 class="other-name.*>(.*)</h2>#ismU', $html, $other_name);
    preg_match('#<li class="kind.*>(.*)</li>#imsU', $html, $the_loai);
    preg_match_all('#<a.*>(.*)</a>#imsU', $the_loai[1], $genres);
    preg_match_all('#<li class="author.*>(.*)</li>#ismU', $html, $tac_gia);
    preg_match_all('#<a.*>(.*)</a>#ismU', $tac_gia[1][0], $authors);
    preg_match('#<li class="status.*>.*<p class="col-xs-8">(.*)</p>#imsU', $html, $m_status);
    preg_match('#<h3 class="list-title">.*<p>(.*)<\/p>#imsU', $html, $desc);
    preg_match('#col-image">.*src="(.*)".*>#ismU', $html, $cover);
    $arr_authors = array();
    $arr_genres = array();
    $arrGenreEn = array();
    foreach ($authors[1] as $item) {
        array_push($arr_authors, $item);
    }
    foreach ($genres[1] as $item) {
        array_push($arr_genres, $item);
        array_push($arrGenreEn, $curl->slug($item));
    }
    $status = $m_status[1];
    $authors1 = implode(",", $arr_authors);
    $genre1 = implode(",", $arr_genres);
    $genre2 = implode(",", $arrGenreEn);
    if (isset($other_name[1]))
        $othername = $other_name[1];
        $content = $desc[1];
    $slug = $curl->slug(trim($nameStory));
    $path2 = "upload/story/190x247/$slug/";
    $path1 = $slug . "-" . uniqid(rand()) .'.jpg';
    $path3 = "../page/upload/story/190x247/$slug/";
    $path4 = "../page/upload/chap/manga/$slug/";
    if (!preg_match('#http#i', $cover[1])) {
        $cover[1] = 'http:' . $cover[1];
    }
    if (!file_exists("../page/" . $path2)) {
        mkdir("../page/" . $path2, 0777, true);
    }
    $link_img = $cover[1];
    $kq = $name[0];
    preg_match_all('#class="col-xs-5 chapter">.*<a href="(.*)".*>(.*)</a>#imsU', $html, $list_chap);
  }

// Khai báo một mảng để lưu trữ thông tin của tất cả các chương
$allChapterInfo = [];
// Khởi tạo giá trị của biến flag
$flag = false;

for ($i = count($list_chap[1]) - 1; $i > -1; $i--) {
    // ... Code lấy thông tin chương ở đây ...
        preg_match('#(chapter|chap|chương) ([\d.]+)#is', $list_chap[2][$i], $chapter);
        $chap3 = str_replace('Chapter', 'chapter-', $chapter[0]);
        $chap2 = str_replace("Chương ", "chapter-", $chap3);
        if ($db->check_chap_exist($chap2, $kq) < 1) {
            $html1 = $curl->getContent($urlproxy . $list_chap[1][$i]);
            preg_match_all('#class="reading-detail box_doc">(.*)<div class="container"#imsU', $html1, $list_chap_img);
            $dom = new DOMDocument();
            @$dom->loadHTML($list_chap_img[1][0]);
            $x = new DOMXPath($dom);
            $arr_img = array();
            foreach ($x->query("//img") as $node) {
                $cover = "";
                if (!preg_match('#http#i', $node->getAttribute("src"))) {
                    $cover = 'http:' . $node->getAttribute("src");
                    if ($checkimg == 1) {
                        // $ii++;
                    }
                } else {
                    $cover = check_blogger($node->getAttribute("src"));
                    if ($checkimg == 1) {
                        //$ii++;  // Increase the counter after processing each image
                    }
                }
                //$ii++;  // Increase the counter after processing each image
                array_push($arr_img, $cover);
            }
            $image1 = implode(",", $arr_img);
            $dateChap = date('Y-m-d H:i:s');
            $parsea = $parse["host"];
            $list_chapa = $list_chap[1][$i];
        }
    
    // Sau khi lấy thông tin chương, thêm nó vào mảng $allChapterInfo
    $chapterInfo = getChapterInfo($slug, $nameStory, $chap2, $image1, $genre1, $genre2, $othername, $link_img, $status, $content, $author, $dateUpload, $female, $male, $badge, $waning, $checkimg, $checkall, $country, $parsea, $list_chapa);
    $allChapterInfo[] = $chapterInfo;
    $responses = $chapterInfo;
    $flag = true;

	// Nếu flag là true, loại bỏ thông tin chương không cần thiết
    if ($flag) {
    //$responses1 = str_replace('\"chapter-\"', '', $responses);
    //$responses2 = str_replace('chapter-.*', '', $responses);
    //$responses3 = str_replace('chapter-0', '', $responses);
    //$responses = str_replace('chapter-33', '', $responses);
    print_r($responses)."\n";

    }

/*
    $chapterInfo = array(
        "titles" => $title,
        "name" => $name,
        "genre_1" => $genre1,
        "genre_2" => $genre2,
        "country" => $country,
        "othername" => $othername,
        "link_img" => $link_img,
        "status" => $status,
        "content" => $content,
        "author" => $author,
        "dateUpload" => $dateUpload,
        "female" => $female,
        "badge" => $badge,
        "waning" => $waning,
        "checkimg" => $checkimg,
        "checkall" => $checkall,
        "country" => $country,
        "male" => $male,
        "host" => $parsea,
        "list_chap" => $list_chapa,
        "chapter_number" => $chapter_number,
        "chapter_images" => $image1
    );
    $allChapterInfo[] = $chapterInfo;
	*/
}

// Lưu tất cả thông tin của tất cả các chương vào tệp truyenname.json
$filePath = 'truyenname.json';
$json_data = json_encode($allChapterInfo, JSON_PRETTY_PRINT);
file_put_contents($filePath, $json_data);

// In ra chuỗi JSON
echo $json_data;

// Định nghĩa hàm để lấy thông tin của một chương
function getChapterInfo($slug, $nameStory, $chap2, $image1, $genre1, $genre2, $othername, $link_img, $status, $content, $author, $dateUpload, $female, $male, $badge, $waning, $checkimg, $checkall, $country, $parsea, $list_chapa) {
    // ... Code lấy thông tin của một chương ở đây ...
$chap = str_replace("chapter- ", "chapter-", $chap2);


$responsson = "listtruyen: $slug-$chap, $nameStory, $chap, $image1, $genre1, $genre2, $othername, $link_img, $status, $content, $author, $dateUpload, $female, $male, $badge, $waning, $checkimg, $checkall, $country, $parsea, $list_chapa";
//print_r($responsson) . "\n";

$items = explode("listtruyen:", $responsson);
//var_dump($content."\n");

// Tạo một mảng kết quả
$result = [];

// Lặp qua từng mục để tạo JSON cho từng mục
foreach (array_slice($items, 1) as $item) {  // Bỏ qua mục đầu tiên vì nó là rỗng
    $info = explode(", ", trim($item));
    $title = $info[0];
    $name = $info[1];
    $chapters = array_slice($info, 2);
    
    $chapter_data = [];
    for ($i = 0; $i < count($chapters); $i += 2) {
        $chapter_number = "chapter-" . preg_replace('/[^0-9]/', '', $chapters[$i]);
        $chapter_images = explode(",", $chapters[$i+1]);
        $chapter_data[$chapter_number] = $chapter_images;
    }

    
        $entry = [
        $title => [
            "titles" => $title,
            "name" => $name,
			"slug" => $slug,
			"name_chap" => $chap,
            "genre_1" => $genre1,
            "genre_2" => $genre2,
            "country" => $country,
            "othername" => $othername,
            "link_img" => $link_img,
            "status" => $status,
            "content" => $content,
            "author" => $author,
            "dateUpload" => $dateUpload,
            "female" => $female,
            "badge" => $badge,
            "waning" => $waning,
            "checkimg" => $checkimg,
            "checkall" => $checkall,
            "country" => $country,
            "male" => $male,
            "host" => $parsea,
            "list_chap" => $list_chapa,
            "listchapter" => $chapter_data
        ]
    ];
    $result[] = $entry;
}
    // Trả về thông tin chương
    return [
        "titles" => $title,
        "name" => $name,
        "slug" => $slug,
        "name_chap" => $chap,
        "genre_1" => $genre1,
        "genre_2" => $genre2,
        "country" => $country,
        "othername" => $othername,
        "link_img" => $link_img,
        "status" => $status,
        "content" => $content,
        "author" => $author,
        "dateUpload" => $dateUpload,
        "female" => $female,
        "badge" => $badge,
        "waning" => $waning,
        "checkimg" => $checkimg,
        "checkall" => $checkall,
        "country" => $country,
        "male" => $male,
        "host" => $parsea,
        "list_chap" => $list_chapa,
        "listchapter" => $chapter_data
    ];
}
?>