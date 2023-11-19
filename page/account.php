<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	$Id="";
	$LastName="";
	$FirstName="";		
	$Birthday="";
	$Phone="";
	$Gender="";
	$Path="";
if(isset($_SESSION['email'])){
		$Email=$_SESSION['email'];
	    $arrUser=$db->GetInfoUser($_SESSION['email']);
	    $Id=$arrUser[0];
		$LastName=$arrUser[1];
		$FirstName=$arrUser[2];		
		$Birthday=$arrUser[3];
		$Phone=$arrUser[4];
		$Gender=$arrUser[5];
		$Path=$arrUser[6];
	}else{
		header("location:../");
	}
	$banner=$db->GetAdvertisement();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Sửa Thông Tin Cá Nhân</title>               
	<meta property="og:site_name" content="xemtruyen.xyz" />
    <meta property="og:type" content="article" />
  
    <meta property="fb:admins" content="100090159813452" />
    <meta property="fb:pages" content="118730167811356" />
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <![endif]-->
    <meta name="copyright" content="Copyright © 2023 xemtruyen.xyz" />
    <meta name="Author" content="xemtruyen.xyz" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
     <link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico?v=1.1" type="image/x-icon">
   
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
	<script type="text/javascript" src="<?php echo $linkOption1;?>frontend/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="<?php echo $linkOption1;?>frontend/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?php echo $linkOption1;?>frontend/js/jquery.iframe-transport.js"></script>
</head>
<body>
<div id="fb-root"></div>

<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php 
require_once('header/headerDetail.php');
require_once('qc/bannerHeader.php'); 
?>  	
<section class="main-content">
    <div class="container">
        <div class="messages columns">	
			<?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="account";
			require_once('header/headerLeft.php');
			
			?>
			
            <div class="column columns">
                <div class="user-right column">
                    <div class="img"><img class="image-avatar" src="<?php echo $linkOption1.$Path;?>" alt="" /></div>
					
                    <input type="file" multiple="false" name="file" id="uploadavatar" style="display: none;">
                    <button class="button is-danger btn-avatar">Chọn hình</button>
                </div>
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Thông tin tài khoản</p>
                    </div>
                
                        <div class="form-change-pass">
                            <div class="field">
                                <p class="txt">UID:</p>
                                <p class="control">
                                    <input id="UID" class="input" type="text"  value="<?php echo $Id; ?>"  disabled>
                                </p>
                            </div>
                            <div class="field">
                                <p class="txt">Email:</p>
                                <p class="control">
                                    <input id="email" class="input" type="email" value="<?php echo $Email;?>"  disabled>
                                </p>
                            </div>
                        </div>
                        <div class="level title user-title">
                            <p class="level-left has-text-weight-bold">Thông tin cá nhân</p>
                        </div>
                        <div class="form-change-pass user-form">
                            <div class="field">
                                <p class="txt">Họ</p>
                                <p class="control">
                                    <input class="input" type="text" id="last_name" name="last_name" value="<?php echo $LastName; ?>">
                                </p>
                            </div>
                            <div class="field">
                                <p class="txt">Tên</p>
                                <p class="control">
                                    <input class="input" type="text" id="first_name" name="first_name" value="<?php echo $FirstName; ?>">
                                </p>
                            </div>
                            <div class="field">
                                <p class="txt">Ngày sinh</p>
                                <p class="control">
                                    <input class="input" type="date" id="birthday" name="birthday" value="<?php echo $Birthday; ?>">
                                </p>
                            </div>
                            <div class="field">
                                <p class="txt">Điện thoại</p>
                                <p class="control">
                                    <input class="input" id="phone" name="phone" type="number" value="<?php echo $Phone; ?>">
                                </p>
                            </div>
                            <div class="field user-field">
                                <span class="txt">Giới tính</span>
                                <input type="radio" id="gender1" name="gender" value="1"  <?php if($Gender==1) echo "checked"; ?>>
                                <label for="gender1">Nam</label>
                                <input type="radio" id="gender2" name="gender" value="0" <?php if($Gender==0) echo "checked"; ?>>
                                <label for="gender2">Nữ</label>
                            </div>
                            <div class="field">
                                <p class="txt">Mật khẩu hiện tại:</p>
                                <p class="control">
                                    <input class="input" id="password_old" name="password_old" type="password" value="">
                                </p>
                            </div>
                            <input type="hidden" id="avatar" name="avatar" value="">
                            <input type="hidden" id="inputDelImage" name="inputDelImage" value="">
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger" type="submit" id="editInfo" src-image="<?php echo $Path;?>">Lưu</button>
                                </p>
                            </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
var Email=<?php echo json_encode($_SESSION['email'])?>;
var linkOption12=<?php echo json_encode($linkOption1)?>;
$(document).ready(function(){
	 $('.btn-avatar').click(function(){ $('#uploadavatar').trigger('click'); });
	 $("#uploadavatar").fileupload({
			url: linkOption12+"fileupload/uploadAvatar.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar").attr("src",linkOption12+k.path);
					$("#editInfo").attr("src-image",k.path);
				}				
				$(".btn-avatar").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar").text(progress +"%");
			},
	
		});
});
</script> 
<script type="text/javascript" src="<?= $linkOption1?>js/login/editInfo.js"></script>      
     <?php
	      require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php		  
	    require_once('qc/bannerContent.php');
	   ?>
</body>
</html>