<?php
//include 'class.cURL.php';
include 'model/conn.php';
require_once('function/function.php');
require_once('function/simple_html_dom.php');

//$curl = new cURL();

$url = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=https://hoathinh3d.biz/luyen-khi-muoi-van-nam";

//$response = file_get_contents($url);
//$html = $curl->getContent($url);
$html1 = curl_get_contents($url);

//echo $html1;
// The HTML content you provided
//$html = $response;
//echo $html;

preg_match('#<div class="first"> <img src="(.*)" alt=".*"></div>;#ismU', $html1, $cover); 
print_r($cover."\n");
var_dump($cover);

//$dom = new simple_html_dom_node($html1);
//var_dump($dom);

// Create a new DOMDocument
//$dom = new DOMDocument();

// Load the HTML content into the DOMDocument
$dom->loadHTML($html1);

// Create a new DOMXPath object
$xpath = new DOMXPath($dom);

// Define the XPath expression to select the <a> elements within the <ul> with id "listsv-1"
$query = '//ul[@id="listsv-1"]/li/a';

// Use XPath to query the DOM
$links = $xpath->query($query);

// Loop through the selected <a> elements and extract the href attribute
foreach ($links as $link) {
    $href = $link->getAttribute('href');
    $title = $link->getAttribute('title');
    echo "Title: $title, Link: $href\n";
}

$url = $href;
//$response = $curl->getContent($url);
//$response = file_get_contents($url);
$html3 = curl_get_contents($url);
//echo $response;


preg_match('#var post_id = (.*);#ismU', $html3, $post_id);
print_r($post_id);
preg_match('#"episode_slug":"(.*)"#ismU', $html3, $episode_slug); 
print_r($episode_slug);

$urldata = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=".rawurlencode("https://hoathinh3d.biz/wp-content/themes/halimmovies/player.php?episode_slug=$episode_slug[1]&server_id=1&subsv_id=2&post_id=$post_id[1]&nonce=");
//echo $urldata;
//$response = file_get_contents($urldata);
//echo $response;




// Replace with the URL you want to open
// Send an HTTP GET request to the URL
//$response = file_get_contents($url);
//echo $response;

//preg_match('#var post_id = (.*);#ismU', $response, $post_id); 
//print_r($post_id[1]);
//preg_match('#"episode_slug":"(.*)"#ismU', $response, $episode_slug); 
//print_r($episode_slug[1]);

//$urldata = "https://hoathinh3d.biz/wp-content/themes/halimmovies/player.php?episode_slug=$episode_slug[1]&server_id=1&subsv_id=&post_id=$post_id[1]&nonce=$cover[1]";
//echo $urldata;



//echo $response;
// Check if the request was successful
if ($response) {
	
$html2 = $urldata;
//$url = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=".$href;
// Send an HTTP GET request to the URL
//$response = file_get_contents($url);
$html2 = $curl->getContent($html2);
echo $html2;

$parse = parse_url($html2);
$opts = array(
        'http' => array(
            'method' => "GET",
            'header' => "Accept-language: en\r\n" .
            "user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.100 Safari/537.36\r\n" .
            "referer: https://hoathinh3d.biz/luyen-khi-muoi-van-nam",
        ),
    );
$context_url = stream_context_create($opts);
	
echo $response;

	
// Create a new DOMDocument
$dom = new DOMDocument();

// Load the HTML content into the DOMDocument
$dom->loadHTML($html);
	
	
$query = '//*[@id="ajax-player"]/div[2]/div[4]/video';

    // Create a DOMXPath object to query the HTML
   //$xpath = new DOMXPath($dom);
// Use XPath to query the DOM
$links = $xpath->query($query);

    // Use XPath to find the element with class "jw-media" and "jw-reset"
    $videoElements = $xpath->query($query);
//echo "Video Source: $videoElements";

    // Check if the element was found
    if ($videoElements->length > 0) {
        $videoElement = $videoElements->item(0);
        $src = $videoElement->getAttribute('src');
        echo "Video Source: $src";
    } else {
        echo "Video source not found on the page.";
    }
} else {
    echo "Failed to retrieve the web page.";
}



?>
