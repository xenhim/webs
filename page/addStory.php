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
    <title>Thêm Truyện Mới</title>               	
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
</head>
<body onbeforeunload="return Reload()">
<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');

?>
<title>Thêm truyện</title>
<section class="main-content">
    <div class="container">
        <div class="messages columns">
           <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="addStory";
			require_once('header/headerLeft.php');
			?>  
			<div class="column columns">
                <div class="user-right column">
					<div class="img"><img id="idAvatar" class="image-avatar" src="" alt=""  /></div>
                    <input type="file" multiple="false" name="file" id="uploadavatar" style="display: none;">
                    <button class="button is-danger btn-avatar" id="chon_hinh" disabled>Chọn hình</button>
                </div>
                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Thêm truyện</p>
                    </div>
                                 
                        <div class="form-change-pass user-form">
							
                            <div class="field">
                                <p class="txt">Name</p>
                                <p class="control">
                                    <input class="input" type="text" id="Name" name="last_name">
                                </p>
                            </div>
                            <div class="field">
                                <p class="txt">Name Other</p>
                                <p class="control">
                                    <input class="input" type="text" id="NameOther" name="first_name">
                                </p>
                            </div>
                            <div class="field">
                                <span class="txt">Status</span>
								
								<select id="Status" class="form-control">
									<option>Đang tiến hành</option>
									<option>Hoàn thành</option>						
								</select>
                            </div>
                            <div class="field">
                                <p class="txt">Content</p>
                                <p class="control">
								    <textarea rows="10" class="input" id="Content" ></textarea>
                                   
                                </p>
                            </div>
                            <div class="field user-field">
                               <label>Badge</label>
								<select id="Badge" class="form-control">
									<option>Chọn</option>
									<option>Hot</option>
									<option>New</option>						
								</select>
                               
                            </div>
							<div class="field user-field">
                              <label>Waning</label>
								<select id="Waning" class="form-control">
									<option>Thường</option>
									<option>Nhạy Cảm</option>						
								</select>
                               
                            </div>
							<div class="field user-field">
                               <?php
								$Genres=array();
						
							 
								   foreach($arr_genres as $muc)
									{
										array_push($Genres,$muc['Name']);
										 
									}	
								?>		
									<label>Genres</label>

									<textarea rows="2" id="Genre" style="width:100%"></textarea>		
                               
                            </div>
							<div class="field user-field">
                              <label>Authors</label>
							
								<textarea rows="2" id="Author" style="width:100%"></textarea>		
                               
                            </div>
							<div class="field user-field">
								<label>Countrys</label>
								<select id="Country" class="form-control">
											
								<?php
								   foreach($arr_countrys as $muc)
									{
									
											 echo '<option>'.$muc['Name'].'</option>'; 
										 
									}	
								?>				
								</select>
                               
                            </div> 
							<div class="field user-field">
							   <label>Type</label>
                               <select id="Gender" class="form-control">																		
									<option selected>Truyện Chữ</option>
									<option>Truyện Tranh</option>									
								</select>
                            </div>
							<div class="field" style="display:none">
                                <p class="txt">URL 1</p>
                                <p class="control">
                                    <input class="input" type="text" id="URL1" name="first_name" value="" disabled>
                                </p>
                            </div>
							<div class="field">
                                <p class="txt">Link để thu thập truyện</p>
                                <p class="control">
                                    <input class="input" type="text" id="URL2" name="first_name" value="">
                                </p>
                            </div>							
                            <input type="hidden" id="avatar" name="avatar" value="">
                            <input type="hidden" id="inputDelImage" name="inputDelImage" >
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger"  id="addStory" src-image="" src-path="" disabled>Lưu</button>
                                </p>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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
$(document).ready(function(){
	 $('#Gender').change(function () {
     var optionSelected = $(this).find("option:selected");
     var textSelected   = optionSelected.text();
     var nameStory11=document.getElementById("Name").value;
	  var Gender= textSelected;
	  var type="add";
	  var idStory=0;
	   $.ajax({     
	       url:'temp/temp-ajax.php',
	       type:'POST',
	       cache:false,
	       data:{'name':nameStory11,'tempStory':tempStory,'type':type,'idStory':idStory,'Gender':Gender},
	       success:function(kq){
			   var o=JSON.parse(kq);
			   var o1=o.name;	
			   var o2=o.story_exist;
			   
			   if(o2==1 && o1.replace(/[^a-zA-Z0-9]/g, '') !=""){
				   $('#addStory').prop("disabled", false); 
				   $('#chon_hinh').prop("disabled", false);
			   }else{
				   $('#addStory').attr("disabled", true);
				   $('#chon_hinh').attr("disabled", true);
			   }
		   }			   
	      })
    });	
	$("#Name").keyup(function(){
	  var nameStory11=document.getElementById("Name").value;
	  var Gender= $('#Gender :selected').text();
	  var type="add";
	  var idStory=0;
	   $.ajax({     
	       url:'temp/temp-ajax.php',
	       type:'POST',
	       cache:false,
	       data:{'name':nameStory11,'tempStory':tempStory,'type':type,'idStory':idStory,'Gender':Gender},
	       success:function(kq){
			   var o=JSON.parse(kq);
			   var o1=o.name;	
			   var o2=o.story_exist;
			   
			   if(o2==1 && o1.replace(/[^a-zA-Z0-9]/g, '') !=""){
				   $('#addStory').prop("disabled", false); 
				   $('#chon_hinh').prop("disabled", false);
			   }else{
				   $('#addStory').attr("disabled", true);
				   $('#chon_hinh').attr("disabled", true);
			   }
			   /*if(o1.replace(/[^a-zA-Z0-9]/g, '') !="")
				   $('#chon_hinh').prop("disabled", false);
			   else
				   $('#chon_hinh').attr("disabled", true);*/
		   }			   
	      })
	});

    $('.btn-avatar').click(function(){ $('#uploadavatar').trigger('click');
	  
	});
	
	 $("#uploadavatar").fileupload({
			url: "fileupload/uploadStory.php?idStory=0&tempStory="+tempStory,
			//dataType: 'json',
			done: function (e, data) {	
				
			var k= JSON.parse(data.result);	
			//console.log(k.name);
				if(k.path==""){
					
					alert("Upload fail!!!");
				}else{
					if($('#inputDelImage').val() == ''){
							$('#inputDelImage').val($('#avatar').val());
						}else{
							$('#inputDelImage').val($('#inputDelImage').val() + ',' + $('#avatar').val());
						}
						//alert(data.result.path);
						$("#addStory").attr("src-image",k.path2);
						
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


<script>
	  
	     $(function() {
            // var m=<?php echo json_encode($Genres);?>;
			 var js_array = [<?php echo '"'.implode('","', $Genres).'"' ?>];
			 var js_array_au = [<?php echo '"'.implode('","', $arr_authors1).'"' ?>];
			 
			//var k=['ActionScript', 'AppleScript', 'Asp', 'BASIC', 'C', 'C++', 'CSS', 'Clojure', 'COBOL', 'ColdFusion', 'Erlang', 'Fortran', 'Groovy', 'Haskell', 'HTML', 'Java', 'JavaScript', 'Lisp', 'Perl', 'PHP', 'Python', 'Ruby', 'Scala', 'Scheme'];
          // console.log(k);
            $('#Genre').tagEditor({
                autocomplete: { delay: 0, position: { collision: 'flip' }, source:js_array  },
                forceLowercase: false,
                placeholder: 'Genre ...'
            });
			$('#Author').tagEditor({
                autocomplete: { delay: 0, position: { collision: 'flip' }, source:js_array_au  },
                forceLowercase: false,
                placeholder: 'Author ...'
            });
        });
	  // alert(m);
</script>
	
	<script type="text/javascript" src="js/page/addStory.js"></script>
</body>
</html>