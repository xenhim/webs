<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();	
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			header("location:".$linkOption);
		}
	}else{
		header("location:".$linkOption);
	}
	
	$idStory=$_GET['idStory'];

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Thêm Chap</title>                
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="frontend/images/favicon.ico?v=1.1" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<script src="ckeditor/ckeditor.js"></script>
	
	<!--<script src="ckeditor/ckeditor.js" type="text/javascript" ></script>-->
</head>
<body onbeforeunload="return Reload()">


<?php
require_once('header/headerDetail.php');

?>

    
<title>Thêm Chap</title>
<section class="main-content">
    <div class="container">
        <div class="messages columns">

			 <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="";
			require_once('header/headerLeft.php');
			?>          
			<div class="column columns" style="overflow: scroll;">
					<div class="user-main">				  
						<div class="level title">
						    <p class="level-left has-text-weight-bold"><?php echo $nameStory2;?></p>
							<p class="level-left has-text-weight-bold">Thêm Chap</p>
						</div>
			   
						<div class="field" >
							<div class="img" ></div>
							<input type="file"  name="files[]" id="uploadavatar" style="display: none;" multiple>
							<button class="button is-danger btn-avatar" id="chon_hinh" disabled>Chọn hình</button>
							<button class="button is-danger btn-avatar-clear" id="clear_hinh">Clear hình</button>	
						</div>
						
						<div class="field">
						
							<label for="vehicle1">Summary</label>
							<select id="Summary" class="form-control">
									<?php if($arr_Chapter[3]=="Hiển thị"){
										echo "<option selected>Hiển thị</option>";
										echo "<option>Ẩn</option>";
									}else{
										echo "<option>Hiển thị</option>";
										echo "<option selected>Ẩn</option>";
									}
									?>										
							</select>                               
						</div>
						<div class="field" style="" id="Content4_check">
						    <label for="vehicle1">Lấy link ảnh</label>
							<select id="check_link" class="form-control">
							<option selected>Chọn</option>
							<option>Lấy</option>
									
								
									
							</select>
						</div>
						<div class="field" style="" id="Content4">
							<p class="txt">Link ảnh</p>
							<p class="control">
								<textarea name="Content_04" rows="10" cols="106" id="Content_04" placeholder="Mỗi link cách nhau dấu phẩy" ></textarea>
							</p>
						</div>
						<div class="field" style="" id="Content4_1">
							<p class="txt">Site</p>
							<p class="control">
								<input type="text" class="input"  id="site" name="site" placeholder="Ví dụ: nettruyengo.com">
							</p>
						</div>	
						<div class="field">
							<p class="txt">Name</p>
							<p class="control">
								<input type="text" class="input"  id="Name" name="Name" >
							</p>
						</div>
						<div class="field">
							<p class="txt">Title</p>
							<p class="control">
								<input type="text" class="input"  id="Title" name="Title" >
							</p>
						</div>
						<div class="field" style="display:none" id="Content1">
							<p class="txt">Nội dung trước ảnh</p>
							<p class="control">
							<textarea name="Content" rows="10" cols="106" id="Content" ></textarea>  
							</p>
						</div>
						<div class="field" style="display:none" id="Content2">
							<p class="txt">Nội dung sau anh</p>
							<p class="control">
								<textarea name="Content_03" rows="10" cols="106" id="Content_03" ></textarea>
							</p>
						</div>
						<div class="field">
							<p class="control">
								<button class="button is-danger" id-story="<?php echo $idStory; ?>" id="addChap" src-image="" disabled>Lưu</button>
							</p>
						</div>
					</div>
               </div>
            </div>
        </div>   
</section>

<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="frontend/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="frontend/js/jquery.iframe-transport.js"></script>
<script>

	CKEDITOR.replace('Content');
	CKEDITOR.replace('Content_03');
	var temp1=[];
	var idStory=<?php echo json_encode($idStory)?>;
	var tempChap=<?php echo json_encode($tempChap1)?>;
function Reload(){
		 $.ajax({     
	       url:'temp/deletePage.php',
	       type:'POST',
	       cache:false,
	       data:{'tempChap':tempChap},
	       success:function(kq){
			  
		   }			   
	      })
		 return ;
	}

$(document).ready(function(){
	

	$("#clear_hinh").click(function(){
		$(".img").html("");
	});	
	$("#Name").keyup(function(){
		 
		var nameChap=document.getElementById("Name").value;
		if(nameChap !="")
		{
		    $('#addChap').prop("disabled", false); 
		}
		var type="add";
		var idChap="";
	   $.ajax({     
	       url:'temp/temp-ajax-chap.php',
	       type:'POST',
	       cache:false,
	       data:{'nameChap':nameChap,'tempChap':tempChap,'type':type,'idStory':idStory,'idChap':idChap},
	       success:function(kq){
			   var o=JSON.parse(kq);
			   var o1=o.name;
			   var o1=o.chap_exist;
			   if(o1==1){
				   $('#addChap').prop("disabled", false); 
				  
			   }else{
				   $('#addChap').attr("disabled", true);
			   }
			   if(o1.replace(/[^a-zA-Z0-9]/g, '') !="")
				   $('#chon_hinh').prop("disabled", false);
			   else
				   $('#chon_hinh').attr("disabled", true);
		   }			   
	      })
	});
	$('.btn-avatar').click(function(){ 
	   $('#uploadavatar').trigger('click');
	  
	});
	$("#uploadavatar").fileupload({
			url: "fileupload/uploadChap.php?idStory="+idStory+"&tempChap="+tempChap,
			//dataType: 'json',
			done: function (e, data) {
			var k=JSON.parse(data.result);	
			temp1=[];	
			for(var index = 0; index < k.length; index++) {
					var src = k[index];
					$('.img').append('<img  class="image-avatar" src="'+src+'" alt=""   custom_attribute="'+src+'"/><hr>');
					
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
<script type="text/javascript" src="js/page/addChap.js"></script>
</body>
</html>