<?php 
//!eHCMFkE@R123|?<>()
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",base64url_decode($_GET['data']))) exit('Image not found!');
$file =base64url_decode($_GET['data']);
$site = base64url_decode($_GET['size']);
$filename = basename($file);
$file_extension = strtolower(substr(strrchr($filename,"."),1));

switch( $file_extension ) {
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpeg"; break;
    case "svg": $ctype="image/svg+xml"; break;
    default: $ctype="image/jpeg"; break;
}
header('Content-type: ' . $ctype);
function base64url_decode($data) {	

	$temp=base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	$temp1=base64_decode($temp);
    return $temp1;
}
function getImage($url, $site) {
		$ch = @curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$head[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
		$head[] = "Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5";
		$head[] = "cache-control: max-age=0";
		$head[] = "Connection: keep-alive";
		$head[] = "Referer: http://".$site."/";
		$head[] = "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_TIMEOUT, 9999);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 9999);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
	}	
	 echo getImage($file, $site);
?>