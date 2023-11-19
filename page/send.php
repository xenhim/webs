<?php

	session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php'); 
	require_once('function/function.php'); 
	
	$db=new config();
	$db->config();
	$linkOption=siteURL();	
	$linkOption1=$linkOption."page/";
	$banner=$db->GetAdvertisement();
	if(isset($_SESSION['email'])){
		
	}else{
		header("location:".$linkOption);
	}
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <title>Gửi Tin Nhắn</title>
    <meta property="og:site_name" content="<?=$linkOption?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption?>gui-tin-nhan.html">
    <meta property="fb:pages" content="100090159813452">
    <meta name="copyright" content="Copyright © 2023 <?=$linkOption?>">
    <meta name="Author" content="<?=$linkOption?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="<?=$linkOption1?>frontend/images/favicon.ico?v=1.1" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?=$linkOption1?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?=$linkOption1?>frontend/css/style.css">
    <script src="<?=$linkOption1?>js/main.js"></script>
   
  </head>
  <body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root" class=" fb_reset">
      <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
        <div></div>
      </div>
    </div>

    <input type="hidden" id="keyword-default" value="one">
    <div class="outsite ">
<?php
require_once('header/headerDetail.php');
require_once('qc/bannerHeader.php'); 
?>

      <title>Gửi Tin Nhắn</title>
      <section class="main-content">
        <div class="container">
          <div class="messages columns">
            <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="";
			require_once('header/headerLeft.php');
			?>  
            <div class="column columns">
              <div class="user-main column">
                <form method="post">
                  <input type="hidden" name="token" value="ENHJIFYAzrF5/ySQ-1631590659-b6ef24f3dfd8af264cc7502f8005f377f1380c9b">
                  <div class="level title user-title">
                    <p class="level-left has-text-weight-bold">Gửi tin nhắn</p>
                  </div>
                  <div class="user-form">
                    <div class="field">
                      <p class="txt">UID</p>
                      <p class="control">
                        <input class="input" type="text" id="uid" name="uid" value="">
                      </p>
                    </div>
                    <div class="field">
                      <p class="txt">Tiêu Đề</p>
                      <p class="control">
                        <input class="input" type="text" id="title" name="title" value="">
                      </p>
                    </div>
                    <div class="field">
                      <p class="txt">Nội Dung</p>
                      <p class="control">
                        <textarea class="textarea" name="content"></textarea>
                      </p>
                    </div>
                    <div class="field">
                      <p class="control">
                        <button class="button is-danger" type="submit">Gửi</button>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php	
				require_once('footer/footerDetail.php');	
	?> 
      <!-- /.footer -->
    </div>
  </body>
</html>