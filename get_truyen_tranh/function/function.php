<?php
function str_replace_first($search, $replace, $subject)
{
    $search = '/'.preg_quote($search, '/').'/';
    return preg_replace($search, $replace, $subject, 1);
}
function check_blogger($str){
	$str1="";
  if (strpos($str, "https://images2-focus-opensocial.googleusercontent.com") !== false){
	$str1=substr($str,strpos($str, "https://blogger.googleusercontent.com"));
  }else{
  	$str1=$str;  
  }
  return $str1;
}
function check_chap($arr,$str){
       
        $t=0;
        for($i=0;$i<count($arr);$i++)
        {
            preg_match('#(chapter|chap|chương) ([\d.]+)#is', $arr[$i], $chapter);
            
            $chap2=str_replace('Chapter','Chương',$chapter[0]);
            $chap3=str_replace('Chapter','Chương',$str);
            if($chap2==$chap3){
              // echo  $chap2;
             $t=$i;
             break;
            }
            
            
        }
        return $t;
    }
function siteURL() {
		  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
			$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		  $domainName = $_SERVER['HTTP_HOST'];
		    $whitelist = array(
				'127.0.0.1',
				'::1'
			);

			if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
				return $protocol.$domainName."/";
				//hossitng
			}else{
				return $protocol.$domainName."/truyenqq/";
				//localhost
			
			}
}

function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base_64encode($data) {
	$data=base64url_encode($data);
	$outstring = '';
	$l = strlen($data);
	for ($i = 0; $i < $l; $i += 8) {
		$chunk = substr($data, $i, 8);
		$outlen = ceil((strlen($chunk) * 8)/6); 
		$x = bin2hex($chunk);
		$w = gmp_strval(gmp_init(ltrim($x, '0'), 16), 62);
		$pad = str_pad($w, $outlen, '0', STR_PAD_LEFT);
		$outstring .= $pad;
	}
	return $outstring;
}
function vn_str_filter ($str){
$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
$str = preg_replace("/(đ)/", "d", $str);
$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
$str = preg_replace("/(Đ)/", "D", $str);
$str= str_replace(array( '\'', '"',',' , ';', '<', '>','-' ,'/',':','_','.',',','\\','{','}','|','~','`','!','@','#','$','%','^','&','*','(',')','+','=','?','–'), '', $str);
$str=preg_replace('/[\s]+/', ' ', trim($str));
$str=str_replace(' ','-',strtolower($str));
return  $str;
}
function tofloat($num) {
	$num1=substr_count($num, "–");
    if($num1==2)
    $num=substr($num,0,strripos($num,'–')-1);
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : 
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
   
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    } 

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}
?>