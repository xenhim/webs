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

	// $arr_genres= $db->GetGenre();
	// $arr_authors= $db->GetAuthor();
	// $arr_countrys=$db->GetCountry();
	// $arr_authors1=array();
	// foreach($arr_authors as $muc)
	// {
		// array_push($arr_authors1,$muc['Name']);
		 
	// }
	
	$linkOption1=$linkOption."page/";
	$id="";
if(isset($_GET['id']))	
$id=$_GET['id'];	

	$arr_story= $db->GetStory();
	$img_slider= $db->GetPathSliderById($id);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Sửa slider</title>               	
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="frontend/images/favicon.ico?v=1.1" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<link rel="stylesheet" href="frontend/file/jquery.tag-editor.css">	
	<script src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="frontend/file/jquery.caret.min.js"></script>
    <script src="frontend/file/jquery.tag-editor.js"></script>	
	<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="frontend/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="frontend/js/jquery.iframe-transport.js"></script>
	<script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
</head>
<body onbeforeunload="return Reload()">
<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');

?>
<section class="main-content">
    <div class="container">
        <div class="messages columns">
			<?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="";
			require_once('header/headerLeft.php');
			?>          
 <div class="column columns">
                <div class="user-right column">
					<div class="img"><img id="idAvatar" class="image-avatar" src="<?=$img_slider[0]?>" alt=""  /></div>
                    <input type="file" multiple="false" name="file" id="uploadavatar" style="display: none;">
                    <button class="button is-danger btn-avatar" id="chon_hinh" >Chọn hình</button>
                </div>
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Sửa slider</p>
                    </div>
                                 
                        <div class="form-change-pass user-form">
                            <div class="field">
                                <p class="txt">Name</p>
                                <select id='selUser' class="form-control" disabled>
								<option value='0'>-- Select Name --</option> 
								<?php
								   foreach($arr_story as $muc)
									{
											if($img_slider[1]==$muc['Id'])
											 echo '<option value="'.$muc['Id'].'" selected>'.$muc['Name'].'</option>';
											else
											 echo '<option value="'.$muc['Id'].'">'.$muc['Name'].'</option>'; 												
										 
									}	
								?>											
								</select>   
                            </div>                            			
                            <input type="hidden" id="avatar" name="avatar" value="">
                            <input type="hidden" id="inputDelImage" name="inputDelImage" >
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger"  id="editSlider" data-id="<?=$id?>" src-image="<?=$img_slider[0]?>" src-path="">Lưu</button>
                                </p>
                            </div>                    
                    </div>
                </div>
                  
    </div>
</section>


<script>
var linkOption12=<?php echo json_encode($linkOption1)?>;
$(document).ready(function(){
		
    $("#selUser").select2();
	$("#editSlider").click(function(){
		var id=$('#editSlider').attr("data-id");
		var path=$('#editSlider').attr("src-image");
		var idStory = $('#selUser').val();
		
	  $.ajax({     
	   url:linkOption12+'ajax/slider/edit.php',
	   type:'POST',
	   cache:false,
	   data:{'id':id,'idStory':idStory,'path':path},
	   success:function(kq){
		   var o = JSON.parse(kq);
		   console.log("a"+o.Error+"b");
		       //location.reload();
			 }
	   })
		 
	});
    $('.btn-avatar').click(function(){ $('#uploadavatar').trigger('click');
	  
	});
	
	$("#uploadavatar").fileupload({
			url: "fileupload/uploadSlider.php",
			//dataType: 'json',
			done: function (e, data) {	
				
			var k= JSON.parse(data.result);	
			//console.log(k.name);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					
						//alert(data.result.path);
						console.log(k.path);
						$("#editSlider").attr("src-image",k.path);
						
						$(".image-avatar").attr("src",k.path);
						//$("#avatar").val(data.result.path);
				}				
				
				
				$(".btn-avatar").text('Chọn Hình...');
			},
			progressall: function (e, data) {
				//alert(data.loaded);
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$(".btn-avatar").text(progress +"%");
			},
	
		});
});
</script>       



</div>	
	
</body>
</html>