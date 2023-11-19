<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('../page/function/function.php');
	require_once('info.php');
	//require_once('../page/model/connection.php'); 
	
	// $db=new config();
	// $db->config();
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	// if(isset($_SESSION['email'])){
		// if($db->GetLevelUser($_SESSION['email'])<1){
			// //header("location:".$linkOption);
		// }
	// }else{
		// //header("location:".$linkOption);
	// }
			
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Update theme</title>              
	
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
<?php include '../page/header/headerDetail.php';?>  

	
<section class="main-content">
    <div class="container">
        <div class="messages columns">			
			 <div class="column is-narrow left pc">
				<ul class="nav-user">
					<li><a class="li012 <?=$li12?>" href="<?=$linkOption?>update/">Update theme</a></li>				
				</ul>
			</div>
            <div class="column columns">              
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Update theme</p>
                    </div>					
					       <div class="field">
                              <p class="control"  style="font-weight: bold;">Phiên bản:<?=$numberTheme?></p>
							  <p class="control" style="color:red;font-weight: bold;">Tình trạng:<?=$acti?></p>
							  <p class="control" style="font-weight: bold;">Ngày Cập nhật:<?=$dateUpdateTheme?></p>							  
                            </div>  
                            <div class="field">                               
                                <p class="control">
                                    <input class="input" type="text" placeholder="Vui lòng nhập key để cập nhật theme" id="key" name="key" value="56VZfbec4ZJ4nVUNz7GqfZ7WPmHs7qgI" disabled>
                                </p>
															
                            </div> 
							<div class="field">
								<input type="file" multiple="false" name="upload_theme" id="upload_theme" style="display: none;">							
								<button class="button is-danger btn-avatar-key">Cập nhật thủ công</button>	
								<button class="button is-danger btn-avatar-key-auto" disabled>Cập nhật tự động</button>								
							</div>
							
													
                </div>
            </div>
        </div>
    </div>
</section>

<script>

var linkOption12=<?php echo json_encode($linkOption1)?>;

function checkFileExist(urlToFile) {
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', urlToFile, false);
    xhr.send();
     
    if (xhr.status == "404") {
        return false;
    } else {
        return true;
    }
}
$(document).ready(function(){
	
	
	
	$("#key").keyup(function(){
		 
		var key=document.getElementById("key").value;
		
	   $.ajax({     
	       url:'key/key.php',
	       type:'POST',
	       cache:false,
	       data:{'key':key},
	       success:function(kq){
			  
		   }			   
	      })
	});
	
	 $('.btn-avatar-key').click(function(){ $('#upload_theme').trigger('click');$('.btn-avatar-key').prop('disabled', true);$('#key').prop('disabled', true); });
	
	 var dateRandom = new Date();
	
	 $("#upload_theme").fileupload({
			url: "upload.php",
			
			done: function (e, data) {
				var k=JSON.parse(data.result);
				
				//var result1 = checkFileExist("temp/readme.txt");
					$('.btn-avatar-key').prop('disabled', false);
					$('#key').prop('disabled', false);
				// if (result1 == true) {
					
					
				// } else {
					// //alert("Sai key!!!");
					// $('.btn-avatar-key').prop('disabled', false);
				// }
				
				// if(k.path==""){
					
					// alert("Upload fail!!!");
					// $('.btn-avatar-key').prop('disabled', false);
				// }				
				// else{
					
					// $('.btn-avatar-key').prop('disabled', false);
					// //$(".image-avatar-logo").attr("src",linkOption12+k.path);
					// //document.getElementById('key').value=document.getElementById("img-key").src;
					// location.reload();
				// }
				location.reload();				
				$(".btn-avatar-key").text('Upload...');
			},
			progressall: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
			  if(progress>=100)
				$(".btn-avatar-key").text("Đang cập nhật...");
			  else
				$(".btn-avatar-key").text(progress +"%");
			},
	
		});

		
		 
});
</script>     
</div>
</body>
</html>