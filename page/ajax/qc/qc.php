<?php
$header1=$_POST['header1'];
$link_header1=$_POST['link_header1'];
$header2=$_POST['header2'];
$link_header2=$_POST['link_header2'];
$content=$_POST['content'];
$link_content=$_POST['link_content'];
$left_ad=$_POST['left'];
$link_left=$_POST['link_left'];
$footer1=$_POST['footer1'];
$link_footer1=$_POST['link_footer1'];
$footer2=$_POST['footer2'];
$link_footer2=$_POST['link_footer2'];

$content_mobile=$_POST['content_mobile'];
$link_content_mobile=$_POST['link_content_mobile'];

$left_mobile=$_POST['left_mobile'];
$link_left_mobile=$_POST['link_left_mobile'];

$footer_mobile=$_POST['footer_mobile'];
$link_footer_mobile=$_POST['link_footer_mobile'];
require_once('../../model/connection.php');
$db=new config();
$db->config();
$error=$db->UpdateAdvertisement($header1,$link_header1,$header2,$link_header2,$content,$link_content,$left_ad,$link_left,$footer1,$link_footer1,$footer2,$link_footer2,$content_mobile,$link_content_mobile,$left_mobile,$link_left_mobile,$footer_mobile,$link_footer_mobile);
$db->dis_connect();//ngat ket noi mysql	
$array=array("Error"=>"$header1"); 	
echo json_encode($array);
?>