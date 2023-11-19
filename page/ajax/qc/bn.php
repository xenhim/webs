<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
$type=$_POST["type"];
if($type=="ads_close"){
if(!isset($_SESSION['ads_close']))
	$_SESSION['ads_close']="ads_close";
}
if($type=="popup_close"){
if(!isset($_SESSION['popup_close']))
	$_SESSION['popup_close']="popup_close";
}
?>