<?php

require './vendor/autoload.php'; // Đảm bảo đã include autoload.php từ Composer

use GuzzleHttp\Client;
use GuzzleHttp\Promise;

function uploadToCloudflare($filePaths, $cloudflareApiToken) {
    $client = new Client();

    $promises = [];

    foreach ($filePaths as $filePath) {
        $promises[] = $client->postAsync('https://api.cloudflare.com/client/v4/uploads', [
            'headers' => [
                'Authorization' => 'Bearer ' . $cloudflareApiToken,
            ],
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($filePath, 'r'),
                ],
            ],
        ]);
    }

    $results = Promise\unwrap($promises);
    $results = Promise\settle($promises)->wait();

    $uploadedFiles = [];

    foreach ($results as $result) {
        if ($result['state'] === Promise\PromiseInterface::FULFILLED) {
            $response = $result['value'];
            $body = json_decode($response->getBody(), true);
            $uploadedFiles[] = $body['result']['uid']; // Lấy thông tin tệp đã tải lên
        }
    }

    return $uploadedFiles;
}

// Sử dụng hàm uploadToCloudflare
$filePaths = ['./truyenname.json', './truyenname.json'];
$cloudflareApiToken = 'KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP';

$uploadedFiles = uploadToCloudflare($filePaths, $cloudflareApiToken);

// Xử lý $uploadedFiles theo nhu cầu của bạn
