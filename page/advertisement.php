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
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng quảng cáo</title>              
	
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
     <link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico?v=1.1" type="image/x-icon">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
			$typeLeftHeader="advertisement";
			require_once('header/headerLeft.php');
			?>
            <div class="column columns">
               
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Đăng quảng cáo</p>
                    </div>
                            <div class="field">
                                <p class="txt"><a id="demo_header1" href="#" title="" >Banner header 1</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="header1" name="header1" value="<?=$banner[1]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_header1" name="link_header1" value="<?=$banner[2]?>">
                                </p>
								<div class="img"><img class="image-avatar-header1" id="img-header1" src="<?=$banner[1]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_header1" id="upload_header1" style="display: none;">
								<button class="button is-danger btn-avatar-header1">Chọn hình</button>
								 <p class="txt"><a id="demo_header2" href="#" title="" >Banner header 2</a></p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="header2" name="header2" value="<?=$banner[3]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_header2" name="link_header2" value="<?=$banner[4]?>">
                                </p>
								<div class="img"><img class="image-avatar-header2" id="img-header2" src="<?=$banner[3]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_header2" id="upload_header2" style="display: none;">
								<button class="button is-danger btn-avatar-header2">Chọn hình</button>
                            </div>
                            <div class="field">
                                <p class="txt"><a id="demo_content" href="#" title="" >Banner content</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="content" name="content" value="<?=$banner[5]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_content" name="link_content" value="<?=$banner[6]?>">
                                </p>
								<div class="img"><img class="image-avatar-content" id="img-content" src="<?=$banner[5]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_content" id="upload_content" style="display: none;">
								<button class="button is-danger btn-avatar-content">Chọn hình</button>
                            </div>
                            <div class="field">
                                <p class="txt"><a id="demo_left" href="#" title="" >Banner left</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="left" name="left" value="<?=$banner[7]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_left" name="link_left" value="<?=$banner[8]?>">
                                </p>
								<div class="img"><img class="image-avatar-left" id="img-left" src="<?=$banner[7]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_left" id="upload_left" style="display: none;">
								<button class="button is-danger btn-avatar-left">Chọn hình</button>								
                            </div>
							<div class="field">
                                <p class="txt"><a id="demo_footer1" href="#" title="" >Banner footer1</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="footer1" name="footer1" value="<?=$banner[9]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_footer1" name="link_footer1" value="<?=$banner[10]?>">
                                </p>
								<div class="img"><img class="image-avatar-footer1" id="img-footer1" src="<?=$banner[9]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_footer1" id="upload_footer1" style="display: none;">
								<button class="button is-danger btn-avatar-footer1">Chọn hình</button>								
                            </div>
							<div class="field">
                                <p class="txt"><a id="demo_footer2" href="#" title="" >Banner footer2</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="footer2" name="footer2" value="<?=$banner[11]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_footer2" name="link_footer2" value="<?=$banner[12]?>">
                                </p>
								<div class="img"><img class="image-avatar-footer2" id="img-footer2" src="<?=$banner[11]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_footer2" id="upload_footer2" style="display: none;">
								<button class="button is-danger btn-avatar-footer2">Chọn hình</button>								
                            </div>
							<div class="field">
                                <p class="txt"><a id="demo_mobile_content" href="#" title="" >Banner Content mobile</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="content_mobile" name="content_mobile" value="<?=$banner[13]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_content_mobile" name="link_content_mobile" value="<?=$banner[14]?>">
                                </p>
								<div class="img"><img class="image-avatar-content_mobile" id="img-content_mobile" src="<?=$banner[13]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_content_mobile" id="upload_content_mobile" style="display: none;">
								<button class="button is-danger btn-avatar-content_mobile">Chọn hình</button>								
                            </div>
							<div class="field">
                                <p class="txt"><a id="demo_mobile_left" href="#" title="" >Banner left mobile</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="left_mobile" name="left_mobile" value="<?=$banner[15]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_left_mobile" name="link_left_mobile" value="<?=$banner[16]?>">
                                </p>
								<div class="img"><img class="image-avatar-left_mobile" id="img-left_mobile" src="<?=$banner[15]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_left_mobile" id="upload_left_mobile" style="display: none;">
								<button class="button is-danger btn-avatar-left_mobile">Chọn hình</button>								
                            </div> 
							<div class="field">
                                <p class="txt"><a id="demo_mobile_footer" href="#" title="" >Banner footer mobile</a></p>
                                <p class="control">
                                    <input class="input" type="text" placeholder="Ảnh" id="footer_mobile" name="footer_mobile" value="<?=$banner[17]?>">
                                </p>
								<p class="control">
                                    <input class="input" type="text" placeholder="Link chuyển trang" id="link_footer_mobile" name="link_footer_mobile" value="<?=$banner[18]?>">
                                </p>
								<div class="img"><img class="image-avatar-footer_mobile" id="img-footer_mobile" src="<?=$banner[17]?>" alt="" /></div>					
								<input type="file" multiple="false" name="upload_footer_mobile" id="upload_footer_mobile" style="display: none;">
								<button class="button is-danger btn-avatar-footer_mobile">Chọn hình</button>								
                            </div>  	
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger" type="submit" id="editBanner">Lưu</button>
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
	
	
	  	$("#demo_header1").tooltip({ content: '<img src="upload/demo/header1.png" />' });
		$("#demo_header2").tooltip({ content: '<img src="upload/demo/header2.png" />' });	
	    $("#demo_content").tooltip({ content: '<img src="upload/demo/content.png" />' });
		
		
$("#demo_footer1").tooltip({ content: '<img src="upload/demo/footer1.png" />' });	
$("#demo_footer2").tooltip({ content: '<img src="upload/demo/footer2.png" />' });	
$("#demo_left").tooltip({ content: '<img src="upload/demo/left.png" />' });	

$("#demo_mobile_left").tooltip({ content: '<img src="upload/demo/mobile_left.png" />' });	
$("#demo_mobile_content").tooltip({ content: '<img src="upload/demo/mobile_content.png" />' });	
$("#demo_mobile_footer").tooltip({ content: '<img src="upload/demo/mobile_footer.png" />' });	
		
	 $('.btn-avatar-header1').click(function(){ $('#upload_header1').trigger('click'); });
	 $('.btn-avatar-header2').click(function(){ $('#upload_header2').trigger('click'); });
	 $('.btn-avatar-content').click(function(){ $('#upload_content').trigger('click'); });
	 $('.btn-avatar-left').click(function(){ $('#upload_left').trigger('click'); });
	 $('.btn-avatar-footer1').click(function(){ $('#upload_footer1').trigger('click'); });
	 $('.btn-avatar-footer2').click(function(){ $('#upload_footer2').trigger('click'); });
	 
	 $('.btn-avatar-content_mobile').click(function(){ $('#upload_content_mobile').trigger('click'); });
	 $('.btn-avatar-left_mobile').click(function(){ $('#upload_left_mobile').trigger('click'); });
	 $('.btn-avatar-footer_mobile').click(function(){ $('#upload_footer_mobile').trigger('click'); });
	 $("#upload_header1").fileupload({
			url: linkOption12+"fileupload/uploadBannerHeader1.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					//$("#header1").text(linkOption12+k.path);
					
					$(".image-avatar-header1").attr("src",linkOption12+k.path);
					document.getElementById('header1').value=document.getElementById("img-header1").src;
					
				}				
				$(".btn-avatar-header1").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-header1").text(progress +"%");
			},
	
		});
		 $("#upload_header2").fileupload({
			url: linkOption12+"fileupload/uploadBannerHeader2.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-header2").attr("src",linkOption12+k.path);
					document.getElementById('header2').value=document.getElementById("img-header2").src;
				}				
				$(".btn-avatar-header2").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-header2").text(progress +"%");
			},
	
		});
		 $("#upload_content").fileupload({
			url: linkOption12+"fileupload/uploadBannerContent.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-content").attr("src",linkOption12+k.path);
					document.getElementById('content').value=document.getElementById("img-content").src;
				}				
				$(".btn-avatar-content").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-content").text(progress +"%");
			},
	
		});
		$("#upload_left").fileupload({
			url: linkOption12+"fileupload/uploadBannerLeft.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-left").attr("src",linkOption12+k.path);
					document.getElementById('left').value=document.getElementById("img-left").src;
				}				
				$(".btn-avatar-left").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-left").text(progress +"%");
			},
	
		});
		$("#upload_footer1").fileupload({
			url: linkOption12+"fileupload/uploadBannerFooter1.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-footer1").attr("src",linkOption12+k.path);
					document.getElementById('footer1').value=document.getElementById("img-footer1").src;
				}				
				$(".btn-avatar-footer1").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-footer1").text(progress +"%");
			},
	
		});
		$("#upload_footer2").fileupload({
			url: linkOption12+"fileupload/uploadBannerFooter2.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-footer2").attr("src",linkOption12+k.path);
					document.getElementById('footer2').value=document.getElementById("img-footer2").src;
				}				
				$(".btn-avatar-footer2").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-footer2").text(progress +"%");
			},
	
		});
		///
		$("#upload_content_mobile").fileupload({
			url: linkOption12+"fileupload/uploadBannerContentMobile.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-content_mobile").attr("src",linkOption12+k.path);
					document.getElementById('content_mobile').value=document.getElementById("img-content_mobile").src;
				}				
				$(".btn-avatar-content_mobile").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-content_mobile").text(progress +"%");
			},
	
		});
		$("#upload_left_mobile").fileupload({
			url: linkOption12+"fileupload/uploadBannerLeftMobile.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-left_mobile").attr("src",linkOption12+k.path);
					document.getElementById('left_mobile').value=document.getElementById("img-left_mobile").src;
				}				
				$(".btn-avatar-left_mobile").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-left_mobile").text(progress +"%");
			},
	
		});
		$("#upload_footer_mobile").fileupload({
			url: linkOption12+"fileupload/uploadBannerFooterMobile.php?linkOption12="+linkOption12,
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					//console.log(linkOption12+k.path);
					$(".image-avatar-footer_mobile").attr("src",linkOption12+k.path);
					document.getElementById('footer_mobile').value=document.getElementById("img-footer_mobile").src;
				}				
				$(".btn-avatar-footer_mobile").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar-footer_mobile").text(progress +"%");
			},
	
		});
		 
});
</script> 
<script type="text/javascript" src="<?= $linkOption1?>js/qc/qc.js"></script>      
</div>
</body>
</html>