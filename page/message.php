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
		$Email=$_SESSION['email'];
	    
	}else{
		header("location:".$linkOption);
	}
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <title>Danh Sách Tin Nhắn</title>
    <meta property="og:site_name" content="<?=$linkOption?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption?>tin-nhan.html">
    <meta property="fb:pages" content="118730167811356">
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
   
    <input type="hidden" id="keyword-default" value="tổng tài">
    <div class="outsite "> 
<?php
require_once('header/headerDetail.php');
require_once('qc/bannerHeader.php'); 
?>
      <section class="main-content">
        <div class="container">
          <div class="messages columns" style="height: 482px;">
             <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="messages";
			require_once('header/headerLeft.php');
			?>  
            <div class="column">
              <div class="level title">
                <p class="level-left has-text-weight-bold">Tin nhắn</p>
                <p class="level-right">
                  <a href="gui-tin-nhan.html">
                    <i class="fas fa-paper-plane"></i> Gửi tin nhắn </a>
                </p>
              </div>
              <table class="table is-narrow">
                <thead>
                  <tr>
                    <th class="col-02">Nội dung</th>
                    <th class="col-03 has-text-centered">Ngày gửi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="2" class="no-result" style="text-align: center;">Không Có Tin Nhắn Nào!</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
      <!-- /.main-content -->
      <section class="footer">
        <div class="container">
          <div class="level">
            <div class="level-left">
              <div class="col-sm-4 text-center" itemscope="" itemtype="http://schema.org/Organization">
                <a itemprop="url" href="//xemtruyen.xyz">
                  <img itemprop="logo" src="//xemtruyen.xyz/frontend/images/logo.png" alt="xemtruyen.xyz - Truyện tranh Online">
                </a>
              </div>
              <div class="text-footer">Copyright © 2023 - All Rights Reserved. Quảng cáo: xemtruyen.xyz@gmail.com</div>
            </div>
            <div class="level-right"></div>
          </div>
        </div>
      </section>
      <!-- /.footer -->
    </div>
  </body>
</html>