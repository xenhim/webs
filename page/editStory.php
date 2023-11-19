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
	$id=$_GET['idStory'];
	$arr_Story=$db->GetIdStory($id);
	$arr_genres= $db->GetGenre();
	$arr_authors= $db->GetAuthor();
	$arr_countrys=$db->GetCountry();
	
	$arr_authors1=array();
	foreach($arr_authors as $muc)
	{
		array_push($arr_authors1,$muc['Name']);
		 
	}	
	
	$tempStory1="story-".uniqid(rand()).".txt";
	$tempStory2="temp/";
	$tempStory=$tempStory2.$tempStory1;
	$myfile = fopen($tempStory, "w");
	fclose($myfile);
	
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Sửa Truyện</title>                
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="frontend/images/favicon.ico?v=1.1" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<link rel="stylesheet" href="frontend/file/jquery.tag-editor.css">	
	<script src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="frontend/file/jquery.caret.min.js"></script>
    <script src="frontend/file/jquery.tag-editor.js"></script>	 
</head>
<body onbeforeunload="return Reload()">
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
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
					<?php
						$path=$db->GetAvatarStory($id);
					?>
                    <div class="img"><img id="idAvatar" class="image-avatar" src="<?php echo $path;?>" alt=""  /></div>
					
                    <input type="file" multiple="false" name="file" id="uploadStory" style="display: none;">
                    <button class="button is-danger btn-avatar">Chọn hình</button>
                </div>
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Sửa truyện</p>
                    </div>
                   
                   
                        <div class="form-change-pass user-form">
                            <div class="field">
                                <p class="txt">Name</p>
                                <p class="control">
                                    <input class="input" type="text" id="Name" name="last_name" value="<?php echo $arr_Story[1] ?>">
                                </p>
                            </div>
                            <div class="field">
                                <p class="txt">Name Other</p>
                                <p class="control">
                                    <input class="input" type="text" id="NameOther" name="first_name" value="<?php echo $arr_Story[2] ?>">
                                </p>
                            </div>
                            <div class="field">
                                <span class="txt">Status</span>
								
								<select id="Status" class="form-control">
										<?php if($arr_Story[3]=="Đang tiến hành"){
											echo "<option selected>Đang tiến hành</option>";
											echo "<option>Hoàn Thành</option>";
										}else{
											echo "<option>Đang tiến hành</option>";
											echo "<option selected>Hoàn Thành</option>";
										}
										?>
										
								</select>
                            </div>
                            <div class="field">
                                <p class="txt">Content</p>
                                <p class="control">
                                    <textarea rows="10" class="input" id="Content" ><?php echo $arr_Story[4] ?></textarea>
                                </p>
                            </div>
                            <div class="field user-field">
                               <label>Badge</label>
								<select id="Badge" class="form-control">
									<?php 
									if($arr_Story[5]=="Chọn"){
										echo "<option selected>Chọn</option>";
										echo "<option>Hot</option>";
										echo "<option>New</option>";
									}else if($arr_Story[5]=="Hot"){
										echo "<option>Chọn</option>";
										echo "<option selected>Hot</option>";
										echo "<option>New</option>";
									}else if($arr_Story[5]=="New"){
										echo "<option>Chọn</option>";
										echo "<option>Hot</option>";
										echo "<option selected>New</option>";
									}
									?>						
								</select>
                               
                            </div>
							  <div class="field user-field">
                              <label>Waning</label>
								<select id="Waning" class="form-control">
									<?php 
									if($arr_Story[6]=="Thường"){
										echo "<option selected>Thường</option>";
										echo "<option>Nhạy Cảm</option>";
									}else if($arr_Story[6]=="Nhạy Cảm"){
										echo "<option>Thường</option>";
										echo "<option selected>Nhạy Cảm</option>";
									}
									?>
										
								</select>
                               
                            </div>
							<div class="field user-field">
                             		
									<label>Genres</label>

									<textarea rows="15" class="control"  id="Genre" style="width:100%"></textarea>		
                               
                            </div>
							<div class="field user-field">
						
                              <label>Authors</label>
									<textarea rows="2" id="Author" style="width:100%"></textarea>	
                               
                            </div>
							<div class="field user-field">
								<label>Countrys</label>
								<select id="Country" class="form-control">										
								<?php
								   foreach($arr_countrys as $muc3)
									{
									
										if($arr_Story[9]==$muc3['Name']){
										   echo '<option selected>'.$muc3['Name'].'</option>'; 
										}else{
											 echo '<option>'.$muc3['Name'].'</option>'; 
										}
										 
									}	
								?>				
								</select>
                               
                            </div>
                            	<div class="field user-field">
							   <label>Type</label>
                               <select id="Gender" class="form-control">
									<?php									
									if($arr_Story[13]==0 && $arr_Story[14]==1){										
										echo '<option>Truyện tranh</option>';
									    echo '<option selected>Truyện Chữ</option>';
									}else if($arr_Story[13]==1 && $arr_Story[14]==0){										
										echo '<option selected>Truyện Tranh</option>';
									    echo '<option>Truyện Chữ</option>';
									} 
									 
									?>
									
																			
								</select>
                            </div>
							<div class="field" tyle="display:none">
                                <p class="txt">URL 1</p>
                                <p class="control">
                                    <input class="input" type="text" id="URL1" name="first_name" value="<?php echo $arr_Story[11]?>" disabled>
                                </p>
                            </div>
							<div class="field">
                                 <p class="txt">Link để thu thập truyện</p>
                                <p class="control">
                                    <input class="input" type="text" id="URL2" name="first_name" value="<?php echo $arr_Story[12]?>">
                                </p>
                            </div>	
                            <input type="hidden" id="avatar" name="avatar" value="">
                            <input type="hidden" id="inputDelImage" name="inputDelImage" value="">
                            <div class="field">
                                <p class="control">
                                    <button  class="button is-danger"  id="editStory" data-id="<?php echo $id?>" src-image="<?php echo $path?>">Lưu</button>
                                </p>
                            </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<?php
	$Genres=array();
	   foreach($arr_genres as $muc)
		{
			array_push($Genres,$muc['Name']);
			 
		}	
		//$Genres2=array();

	  $Genres4=$arr_Story[8];
	  $Author4=$arr_Story[7];
   
?>
<script>
var tempStory=<?php echo json_encode($tempStory1)?>;
	function Reload(){
		 $.ajax({     
	       url:'temp/deletePage.php',
	       type:'POST',
	       cache:false,
	       data:{'tempStory':tempStory},
	       success:function(kq){
			  
		   }			   
	      })
		  return ;
	}



 $(function() {
		 var m=<?php echo json_encode($Genres)?>;
		 var m2=<?php echo json_encode($Genres4)?>;
		 
		 var u2= <?php echo json_encode($Author4)?>;
		
		 var js_array = [<?php echo '"'.implode('","', $Genres).'"' ?>];
		 var js_array_au = [<?php echo '"'.implode('","', $arr_authors1).'"' ?>];
		
		 var m3 = m2.split(",");
		 var u3 = u2.split(",");
		$('#Genre').tagEditor({
			autocomplete: { delay: 0, position: { collision: 'flip' }, source:js_array  },
			forceLowercase: false,
			initialTags: m3,
			placeholder: 'Genre ...'
		});
		$('#Author').tagEditor({
                autocomplete: { delay: 0, position: { collision: 'flip' }, source:js_array_au  },
                forceLowercase: false,
				initialTags: u3,
                placeholder: 'Author ...'
        });

	});
</script>
<script type="text/javascript" src="frontend/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="frontend/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="frontend/js/jquery.iframe-transport.js"></script>
<script>
var id=<?php echo json_encode($id)?>;
    $('.btn-avatar').click(function(){ $('#uploadStory').trigger('click');$('#Name').trigger("keyup"); });
$(document).ready(function(){
	$('#Gender').change(function () {
     var optionSelected = $(this).find("option:selected");
     var textSelected   = optionSelected.text();
     var nameStory11=document.getElementById("Name").value;
	  var Gender= textSelected;
	  var type="edit";
	 
	   $.ajax({     
	       url:'temp/temp-ajax.php',
	       type:'POST',
	       cache:false,
	       data:{'name':nameStory11,'tempStory':tempStory,'type':type,'idStory':id,'Gender':Gender},
	       success:function(kq){
			   var o=JSON.parse(kq);
			   var o1=o.name;	
			   var o2=o.story_exist;
			   
			   if(o2==1 && o1.replace(/[^a-zA-Z0-9]/g, '') !=""){
				   $('#editStory').prop("disabled", false); 
				   $('#chon_hinh').prop("disabled", false);
			   }else{
				   $('#editStory').attr("disabled", true);
				   $('#chon_hinh').attr("disabled", true);
			   }
		   }			   
	      })
    });	
		$("#Name").keyup(function(){
			var nameStory11=document.getElementById("Name").value;
			var Gender= $('#Gender :selected').text();
			var type="edit";
			$.ajax({     
			   url:'temp/temp-ajax.php',
			   type:'POST',
			   cache:false,
			   data:{'name':nameStory11,'tempStory':tempStory,'type':type,'idStory':id,'Gender':Gender},
			   success:function(kq){
				   var o=JSON.parse(kq);
				   var	o1=o.name;
				   var o2=o.story_exist;
				  if(o2==1 && o1.replace(/[^a-zA-Z0-9]/g, '') !=""){
				   $('#editStory').prop("disabled", false); 
				   $('#chon_hinh').prop("disabled", false);
			   }else{
				   $('#editStory').attr("disabled", true);
				   $('#chon_hinh').attr("disabled", true);
			   }
			   }			   
	      })
		});
		 $("#uploadStory").fileupload({
			url: "fileupload/uploadStory.php?idStory="+id+"&tempStory="+tempStory,
			
			done: function (e, data) {	
				
					var k= JSON.parse(data.result);
					
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					if($('#inputDelImage').val() == ''){
							$('#inputDelImage').val($('#avatar').val());
						}else{
							$('#inputDelImage').val($('#inputDelImage').val() + ',' + $('#avatar').val());
						}
						$("#editStory").attr("src-image",k.path2);
						$(".image-avatar").attr("src",k.path);
						$("#avatar").val(k.path);
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
</div>


<script type="text/javascript" src="js/page/addStory.js"></script>
</body>
</html>