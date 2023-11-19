<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	$Email=0;
	$banner=$db->GetAdvertisement();
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			header("location:".$linkOption);
		}
	}else{
		header("location:".$linkOption);
	}
	$logo=$db->GetLogo();	
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Logo</title>              
	
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico?v=1.1" type="image/x-icon">  
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
	<script type="text/javascript" src="<?php echo $linkOption1;?>frontend/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="<?php echo $linkOption1;?>frontend/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?php echo $linkOption1;?>frontend/js/jquery.iframe-transport.js"></script>
</head>
<body>
<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php include 'header/headerDetail.php';?>  

	
<section class="main-content">
    <div class="container">
        <div class="messages columns">			
			 <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="logo";
			require_once('header/headerLeft.php');
			?>
            <div class="column columns">              
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Logo</p>
                    </div>
                            <div class="field">
                                <p class="txt">Logo</p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="logo" name="logo" value="<?=$logo[1]?>">
                                </p>						
								<div class="img"><img class="image-avatar-logo" id="img-logo" src="<?=$logo[1]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_logo" id="upload_logo" style="display: none;">
								<button class="button is-danger btn-avatar-logo">Chọn hình</button>								
                            </div>
                            <div class="field">
                                <p class="txt">logo on</p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="logo_on" name="logo_on" value="<?=$logo[2]?>">
                                </p>
							
								<div class="img"><img class="image-avatar-logo_on" id="img-logo_on" src="<?=$logo[2]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_logo_on" id="upload_logo_on" style="display: none;">
								<button class="button is-danger btn-avatar-logo_on">Chọn hình</button>
                            </div>
                            <div class="field">
                                <p class="txt">favicon</p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="favicon" name="favicon" value="<?=$logo[3]?>">
                                </p>
								
								<div class="img"><img class="image-avatar-favicon" id="img-favicon" src="<?=$logo[3]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_favicon" id="upload_favicon" style="display: none;">
								<button class="button is-danger btn-avatar-favicon">Chọn hình</button>								
                            </div>
							<div class="field">
                                <p class="txt">group</p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="group" name="group" value="<?=$logo[4]?>">
                                </p>
								
								<div class="img"><img class="image-avatar-group" id="img-group" src="<?=$logo[4]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_group" id="upload_group" style="display: none;">
								<button class="button is-danger btn-avatar-group">Chọn hình</button>								
                            </div>
							
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger" type="submit" id="editLogo">Lưu</button>
                                </p>
                            </div>
                                      
                </div>
            </div>
        </div>
    </div>
</section>

<script>

var linkOption12=<?php echo json_encode($linkOption1)?>;
$(document).ready(function(){
	 $('.btn-avatar-logo').click(function(){ $('#upload_logo').trigger('click'); });
	 $('.btn-avatar-logo_on').click(function(){ $('#upload_logo_on').trigger('click'); });
	 $('.btn-avatar-favicon').click(function(){ $('#upload_favicon').trigger('click'); });
	 $('.btn-avatar-group').click(function(){ $('#upload_group').trigger('click'); });
	 var dateRandom = new Date();
	
	 $("#upload_logo").fileupload({
			url: linkOption12+"fileupload/uploadLogo.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					
					$(".image-avatar-logo").attr("src", linkOption12+k.path+"?"+dateRandom.getTime());
					
					//$(".image-avatar-logo").attr("src",linkOption12+k.path);
					document.getElementById('logo').value=document.getElementById("img-logo").src;
					
				}				
				$(".btn-avatar-logo").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-logo").text(progress +"%");
			},
	
		});
		 $("#upload_logo_on").fileupload({
			url: linkOption12+"fileupload/uploadLogoOn.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-logo_on").attr("src", linkOption12+k.path+"?"+dateRandom.getTime());
					document.getElementById('logo_on').value=document.getElementById("img-logo_on").src;
				}				
				$(".btn-avatar-logo_on").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-logo_on").text(progress +"%");
			},
	
		});
		 $("#upload_favicon").fileupload({
			url: linkOption12+"fileupload/uploadLogoFavicon.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-favicon").attr("src", linkOption12+k.path+"?"+dateRandom.getTime());
					document.getElementById('favicon').value=document.getElementById("img-favicon").src;
				}				
				$(".btn-avatar-favicon").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-favicon").text(progress +"%");
			},
	
		});
		$("#upload_group").fileupload({
			url: linkOption12+"fileupload/uploadLogoGroup.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-group").attr("src", linkOption12+k.path+"?"+dateRandom.getTime());
					document.getElementById('group').value=document.getElementById("img-group").src;
				}				
				$(".btn-avatar-group").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-group").text(progress +"%");
			},
	
		});
		
		 
});
</script> 
<script type="text/javascript" src="<?= $linkOption1?>js/logo/logo.js"></script>      
</div>
</body>
</html>