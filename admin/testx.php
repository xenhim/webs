<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Starting clock time in seconds
$start_time = microtime(true);
$a = 1;




// Hàm thực hiện request GET và trả về mảng các ID
function getCloudflareImageIds() {
    //echo "Getting image IDs...<br>";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1?per_page=30');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP',
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    //echo "Response from Cloudflare:<br>";
    //print_r($response);
    //echo "<br>";

    $data = json_decode($response, true);
	$continuation_token = $data['result']['continuation_token'];
	//print_r($continuation_token);
    $ids = array();

    // Lấy tất cả các ID từ nội dung trả về
if (isset($data['result']['images'])) {
    foreach ($data['result']['images'] as $item) {
        if (isset($item['id'])) {
            $ids[] = $item['id'];
            }
        }
    }

    //echo "IDs extracted:<br>";
    print_r($ids);
    //echo "<br>";

    return $ids;
}


// Đoạn mã khác ở đây...
		$ii=0;

// Hàm thực hiện yêu cầu DELETE cho một ID cụ thể
function deleteImageByIdAsync($id) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/accounts/792c2fd7e977ac5192ea444ed9a96816/images/v1/' . $id);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP'
    ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 10000); // Timeout in milliseconds

    return $ch;
}

// Hàm thực hiện yêu cầu DELETE cho một danh sách ID
function deleteImagesAsync($ids) {
    $chArray = array();

    foreach ($ids as $id) {
        $ch = deleteImageByIdAsync($id);
        $chArray[] = $ch;
        //print_r($chArray);
    }

    // Thực hiện các yêu cầu DELETE bất đồng bộ
    $responses = array();

    $mh = curl_multi_init();
    foreach ($chArray as $ch) {
        curl_multi_add_handle($mh, $ch);
    }

    $active = null;
    do {
        $mrc = curl_multi_exec($mh, $active);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($active && $mrc == CURLM_OK) {
        if (curl_multi_select($mh) != -1) {
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }
    }

    foreach ($chArray as $ch) {
        $responses[] = curl_multi_getcontent($ch);
        curl_multi_remove_handle($mh, $ch);
    }
    curl_multi_close($mh);
	
    // Xử lý phản hồi từ các yêu cầu DELETE
    foreach ($responses as $response) {
		global $ii;
        // Xử lý phản hồi ở đây
        // Ví dụ: print_r($response);
		$ii++;
		echo '['.$ii.']'."\n";	
		print_r($response);
    }
}

// Lấy danh sách ID từ hàm getCloudflareImageIds()
$ids = getCloudflareImageIds();

// Chia danh sách ID thành các nhóm có số lượng giới hạn (ví dụ: 100 ID mỗi nhóm)

$chunkedIds = array_chunk($ids, 30);

// Thực hiện yêu cầu DELETE cho từng nhóm ID
foreach ($chunkedIds as $chunk) {
	//$sleep_time = rand(1, 2);
	//sleep($sleep_time);
    deleteImagesAsync($chunk);
}

// Start loop
for ($i = 1; $i <= 10000000; $i++) {
    $a++;
}

// End clock time in seconds
$end_time = microtime(true);

// Calculating the script execution time
$execution_time = $end_time - $start_time;
$executiontime = floor($execution_time);
//echo gmdate("H:i:s", $executiontime);

echo " Execution time of script = " . gmdate("H:i:s", $executiontime) . " Time \n";

?>