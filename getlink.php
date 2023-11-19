<?php
include('./wp-content/plugins/fanfox-manga-crawler/libs/simplehtmldom_1_5/simple_html_dom.php');

function getLinksFromPage($url) {
    $html = file_get_html($url);
	//echo $html."\n";

    $links = [];
    foreach ($html->find('figure.clearfix a.jtip') as $element) {
        $links[] = $element->href;
//	print_r($links)."\n";
    }

    return $links;
}
//print_r($links)."\n";


$url = "https://worker-rapid-butterfly-3f3a.xemining.workers.dev/?url=https://www.nettruyenus.com/tim-truyen";
$allLinks = [];

for ($page = 1; $page <= 595; $page++) {
    echo "Scraping page $page...\n";
    $pageUrl = $url . "?page=" . $page;
	echo "Scraping page $pageUrl...\n";
$links = getLinksFromPage($pageUrl);
//print_r($links)."\n";
foreach ($links as $link) {
    if (!in_array($link, $allLinks)) {
        $allLinks[] = $link;
    }
}
	//print_r($allLinks)."\n";
    $allLinks = array_merge($allLinks, $links);
	//print_r($allLinks)."\n";
    sleep(1); // Wait for 1 second before proceeding to the next page to avoid getting blocked
}

file_put_contents('alllinks.txt', implode(PHP_EOL, $allLinks));
echo "Done!";
?>
