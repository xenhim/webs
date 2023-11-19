<?php
// First install the api client: "composer require api-video/php-api-client"
// Documentation: https://github.com/apivideo/api.video-php-client/blob/main/docs/Api/VideosApi.md#upload
$path1 = uniqid(rand()).'.mp4';
$path3="/var/www/vhosts/xemtruyen.xyz/httpdocs/wp-content/uploads/upvideo/";
$link_img = "https://archive.org/download/tghm_37/37.mp4";
$datasave = base64_decode("d2dldCAtTyA=");
$datasave .= $path3.$path1.base64_decode("IA==");
$datasave .= $link_img.base64_decode("IA==");
//print_r($datasave);
echo $datasave."\n";
$result = shell_exec($datasave);
echo $result."\n";

require __DIR__ . '/vendor/autoload.php';

$client = new \ApiVideo\Client\Client(
    'https://ws.api.video',
    'NtVf9IEqb92gAiyinNaNciNnuXgpQRuADSmBmcz6LTY',
    new \Symfony\Component\HttpClient\Psr18Client()
);

// create a new video & upload a video file
$myVideo = $client->videos()->create((new \ApiVideo\Client\Model\VideoCreationPayload())->setTitle('Uploaded video'));

$client->videos()->upload($myVideo->getVideoId(), new SplFileObject(__DIR__ . '/wp-content/uploads/upvideo/'.$path1.''));

print_r($client."\n");

//copy($link_img,$path3.$path1, $context_url);

// Kiểm tra nếu tải lên thành công
if (isset($response['success']) && $response['success'] === true) {
    // Xóa tệp tại vị trí tạm thời sau khi tải lên thành công
    //unlink($path3 . $path1);
}
/*
// create a new video & upload a video file using progressive upload (the file is uploaded by parts)
$myVideo2 = $client->videos()->create((new \ApiVideo\Client\Model\VideoCreationPayload())->setTitle('Uploaded video (progressive upload)'));

$progressiveSession = $client->videos()->createUploadProgressiveSession($myVideo2->getVideoId());

$progressiveSession->uploadPart(new SplFileObject(__DIR__ . '/10m.mp4.part.a'));
$progressiveSession->uploadPart(new SplFileObject(__DIR__ . '/10m.mp4.part.b'));

$progressiveSession->uploadLastPart(new SplFileObject(__DIR__ . '/10m.mp4.part.c')); 
*/

