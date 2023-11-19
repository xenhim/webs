<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
if(isset($_POST['paper_color']))
$_SESSION['paper_color']=$_POST['paper_color'];

if(isset($_POST['text_color']))
$_SESSION['text_color']=$_POST['text_color'];

if(isset($_POST['text_font']))
$_SESSION['text_font']=$_POST['text_font'];

if(isset($_POST['text_size']))
$_SESSION['text_size']=$_POST['text_size'];
?>