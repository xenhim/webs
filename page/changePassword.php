<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();
	require_once('model/connection.php');
	require_once('function/function.php');
	$linkOption=siteURL();	
	$db=new config();
	$db->config();	
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			//header("location:../");
		}
	}else{
		header("location:".$linkOption);
	}
	if(!isset($_SESSION['password_old']))
	$_SESSION['password_old']="";
	if(!isset($_SESSION['password_new']))
	$_SESSION['password_new']="";
	if(!isset($_SESSION['confirm_password_new']))
	$_SESSION['confirm_password_new']="";


?>


<html lang="vi">
  <head>
    <meta charset="utf-8">
    <title>Thay Đổi Mật Khẩu</title>
    <meta property="og:site_name" content="<?=$linkOption?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption?>doi-mat-khau.html">
    <meta property="fb:pages" content="109139867535054">
   
    <meta name="copyright" content="Copyright © 2019 <?=$linkOption?>">
    <meta name="Author" content="<?=$linkOption?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="page/frontend/images/favicon.ico?v=1.1" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="page/frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="page/frontend/css/style.css">
    <script src="page/js/main.js"></script>
   
  </head>
  <body>
   
    <div id="fb-root" class=" fb_reset">
      <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
        <div></div>
      </div>
    </div>

   
    <input type="hidden" id="keyword-default" value="tổng tài">
    <div class="outsite ">
      <?php
		require_once('header/headerDetail.php');

		?>
        
      
      <title>Thay Đổi Mật Khẩu</title>
      <section class="main-content">
        <div class="container">
          <div class="messages columns" style="height: 482px;">
           <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="changePassword";
			require_once('header/headerLeft.php');
			?>
            <div class="column">
              <div class="level title">
                <p class="level-left has-text-weight-bold">Đổi mật khẩu</p>
              </div>
             
                <div class="form-change-pass">
                  <div class="field">
                    <p class="txt">Mật khẩu hiện tại</p>
                    <p class="control">
                      <input class="input" type="password" value="<?=$_SESSION['password_old']?>" name="password_old" id="password_old">
                    </p>
                  </div>
                  <div class="field">
                    <p class="txt">Mật khẩu mới</p>
                    <p class="control">
                      <input class="input" type="password" value="<?=$_SESSION['password_new']?>" name="password_new" id="password_new">
                    </p>
                  </div>
                  <div class="field">
                    <p class="txt">Xác nhận mật khẩu</p>
                    <p class="control">
                      <input class="input" type="password" value="<?=$_SESSION['confirm_password_new']?>" name="confirm_password_new" id="confirm_password_new">
                    </p>
                  </div>
                  <div class="field">
                    <p class="control">
                      <button class="button is-danger" id="changePassword">Đổi mật khẩu</button>
                    </p>
                  </div>
                </div>
              
            </div>
          </div>
        </div>
      </section>
      <!-- /.main-content -->
      <script></script>
      <section class="footer">
        <div class="container">
          <div class="level">
            <div class="level-left">
              <div class="col-sm-4 text-center" itemscope="" itemtype="http://schema.org/Organization">
                <a itemprop="url" href="//truyenqq.net">
                  <img itemprop="logo" src="page/frontend/images/logo.png" alt="TruyenQQ - Truyện tranh Online">
                </a>
              </div>
              <div class="text-footer">Copyright © 2019 - All Rights Reserved. Quảng cáo: ad.truyenqq@gmail.com</div>
            </div>
            <div class="level-right"></div>
          </div>
        </div>
      </section>
      <!-- /.footer -->
      <!-- SIZE: 300X250 - BOTTOM - LEFT -->
    </div>
	<script type="text/javascript" src="page/js/password/changePassword.js"></script>
  </body>
</html>