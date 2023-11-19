<?php
	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();
	$linkOption=siteURL();		
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			header("location:".$linkOption);
		}
	}else{
		header("location:".$linkOption);
	}
	$idChap=$_GET['idChap'];
	$idStory=$_GET['idStory'];
	$arr_Story=$db->GetIdStory($idStory);
	$arr_genres= $db->GetGenre();
	$arr_authors= $db->GetAuthor();
	$arr_countrys=$db->GetCountry();
	$arr_Chapter=$db->GetIdChapter1($idChap);
    $nameStory=$db->GetNameStory2($idStory);
	$r1=$arr_Chapter[1];
	$r2=$arr_Chapter[2];
	
	
	

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Sửa Thông Tin Chap</title>                
	<meta property="og:site_name" content="<?=$linkOption?>" />
    <meta property="og:type" content="article" />
    <meta property="fb:admins" content="100090159813452" />
    <meta property="fb:pages" content="118730167811356" />
    <meta name="copyright" content="Copyright © 2023 <?=$linkOption?>" />
    <meta name="Author" content="<?=$linkOption?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="frontend/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<link rel="stylesheet" href="frontend/file/jquery.tag-editor.css">	
	<script src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="frontend/file/jquery.caret.min.js"></script>
    <script src="frontend/file/jquery.tag-editor.js"></script>	
	
	<script src="ckeditor/ckeditor.js" type="text/javascript" ></script>
	
	 
</head>
<body onbeforeunload="return Reload()">


<script>
    function getCookie(name){
        var pattern = RegExp(name + "=.[^;]*")
        matched = document.cookie.match(pattern)
        if(matched){
            var cookie = matched[0].split('=')
            return cookie[1]
        }
        return false
    }
</script>


<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');

?>
   
    
<title>Sửa Thông Tin chap</title>
<section class="main-content">
    <div class="container">
        <div class="messages columns">
			 <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="";
			require_once('header/headerLeft.php');
			$an="";
			if(tofloat($arr_Chapter[0])==0)
				$an="disabled";
			?>

       <div class="column columns">
               
                <div class="user-main" style="overflow: scroll;">
                    <div class="level title">
					   <p class="level-left has-text-weight-bold"><?php echo $nameStory2;?></p>
                        <p class="level-left has-text-weight-bold">Sửa chap</p>
                    </div>
                  
                  
						<div class="field" >
							<div class="img" >
							<?php
							 $a2=explode(",",$arr_Chapter[3]);
								for($i=0;$i<count($a2);$i++){
									
									if (strpos($a2[$i], "https://") !== false || strpos($a2[$i], "http://") !== false)
								  echo '<img  class="image-avatar" src="'.getParseUrl($a2[$i],$arr_Chapter[6],$linkOption).'" alt=""   custom_attribute="'.$a2[$i].'"/><hr>';
							  else  echo '<img  class="image-avatar" src="'.$a2[$i].'" alt=""   custom_attribute="'.$a2[$i].'"/><hr>';
								}
							?>
							</div>
							<input type="file"  name="files[]" id="uploadavatar" style="display: none;" multiple>
							<button class="button is-danger btn-avatar" id="chon_hinh" disabled>Chọn hình</button>
							<button class="button is-danger btn-avatar-clear" id="clear_hinh">Clear hình</button>	
							
						</div>
						<div class="field">
						
						<label for="vehicle1">Summary</label>
						
						 
							
							<select id="Summary" class="form-control">
							<option>Hiển thị</option>
							<option selected>Ẩn</option>
									
								
									
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
								<textarea name="Content_04" rows="10" cols="106" id="Content_04" placeholder="Mỗi link cách nhau dấu phẩy" value="<?=$arr_Chapter[3]?>"><?=$arr_Chapter[3]?></textarea>
							</p>
						</div>
						<div class="field" style="" id="Content4_1">
							<p class="txt">Site</p>
							<p class="control">
								<input type="text" class="input"  id="site" name="site" placeholder="Ví dụ: nettruyengo.com"  value="<?=$arr_Chapter[6]?>">
							</p>
						</div>							
						<div class="field">						
							<p class="txt">Name</p>
							<p class="control">
							<input type="text" class="input"  id="Name" name="Name" value="<?php if (isset($arr_Chapter[0])) echo tofloat($arr_Chapter[0]);else echo ""; ?>"/>
							</p>	
						</div>
					   <div class="field">
							<p class="txt">Title</p>
							<p class="control">
								<input type="text" class="input"  id="Title" name="Title"  value="<?=$arr_Chapter[5]?>">
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
								<button class="button is-danger"  id="editChap" data-id-chap="<?php echo $idChap; ?>" data-id-story="<?php echo $idStory; ?>" <?=$an?> onclick="confirmSave()">Lưu</button>
							</p>
						</div>
                </div>
            </div>
        </div>
    </div>
</section>
 </div>
<?php

   
$db->dis_connect();//ngat ket noi mysql	
?>
<script>
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
 CKEDITOR.replace('Content');
 CKEDITOR.replace('Content_03');
 var nameStory=<?php echo json_encode($nameStory)?>;
 var idChap=<?php echo json_encode($idChap)?>;
 var r1=<?php echo json_encode($r1); ?>;
 var r2=<?php echo json_encode($r2); ?>;
 
CKEDITOR.instances.Content.setData(r1);
CKEDITOR.instances.Content_03.setData(r2);
</script>
<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="frontend/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="frontend/js/jquery.iframe-transport.js"></script>
<script>
$(document).ready(function(){
	
	$('#Summary').on('change', function (e) {
		var valueSelected = this.value;
		if(valueSelected=="Ẩn"){
			document.getElementById("Content1").style.display = "none";
			//document.getElementById("Content2").style.display = "none";
		}
		else{
			document.getElementById("Content1").style.display = "block";
			//document.getElementById("Content2").style.display = "block";
		}
	});
	$("#clear_hinh").click(function(){
		$(".img").html("");
	});
	if(document.getElementById("Name").value!=""){
	 $("#chon_hinh").prop('disabled', false);
	}
	
	
		$("#Name").keyup(function(){
		 
		var nameChap=document.getElementById("Name").value;
		var type="edit";
	   $.ajax({     
	       url:'temp/temp-ajax-chap.php',
	       type:'POST',
	       cache:false,
	       data:{'nameChap':nameChap,'tempChap':tempChap,'type':type,'idStory':idStory,'idChap':idChap},
	       success:function(kq){
			   var o=JSON.parse(kq);
			   var	o1=o.name;	
			   var o1=o.chap_exist;
			   //console.log(o.num);
			   if(o1==1){
				   $('#editChap').prop("disabled", false); 
				  
			   }else{
				   $('#editChap').attr("disabled", true);
			   }
			   if(o1.replace(/[^a-zA-Z0-9]/g, '') !="")
				   $('#chon_hinh').prop("disabled", false);
			   else
				   $('#chon_hinh').attr("disabled", true);
		   }			   
	      })
	});
	 $('.btn-avatar').click(function(){ 
	    $('#Name').trigger("keyup");
	 
	   $('#uploadavatar').trigger('click');
	  
	});
 $("#uploadavatar").fileupload({
			url: "fileupload/uploadChap.php?idStory="+idStory+"&tempChap="+tempChap,
			done: function (e, data) {
			var k=JSON.parse(data.result);	

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
</div>

</body>
</html>