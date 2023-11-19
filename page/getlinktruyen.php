<?php
    require_once('model/connection.php');
	require_once('function/function.php');
	require_once('library/get_html.php');
	$db=new config();
	$db->config();	
	$linkOption=siteURL();	
	$linkOption1=$linkOption."page/";
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			header("location:".$linkOption);
		}
	}else{
		header("location:".$linkOption);
	}

	$arr_story=$db->GetStory();
	$idStory=$_GET['idStory'];	
	$info_story=$db->GetIdStory($idStory);
	
	
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Danh sách truyện</title>               
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<link rel="shortcut icon" href="frontend/images/favicon.ico?v=1.1" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<script src="ckeditor/ckeditor.js" type="text/javascript" ></script>
</head>
<body class="hompage dark">
	<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');
?>   
    <title>Danh sách truyện</title>	
	<section class="main-content">
    <div class="container">
        <div class="messages columns">
			 <?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="listStory";
			require_once('header/headerLeft.php');
			
			 $nameStory=$db->GetNameStory2($idStory);
			 
			 $arr2 = $db->GetChapter2($idStory); 
								
			?>  
			<div class="column columns">				
                <div class="user-main column" style="overflow: scroll;">				  
                    <div class="level title">
					   <p class="level-left has-text-weight-bold">Link thu thập</p>
                       <p class="level-left has-text-weight-bold"><?=$nameStory?></p>						   
                    </div> 
					<div class="field">												
						<p class="control">
						<input type="text" class="input"  id="link_content" name="link_content" value="<?=$info_story[12]?>"/>
						</p>	
					</div>               		
					<div class="field" >
						<table class="table">
						  <thead>
							<tr>
							  <th scope="col">Nguồn Lấy</th>
							  <th scope="col">Danh sách chapter</th>
							  <th scope="col">Lấy số chương</th>
							  <th scope="col">Lấy nội dung chương</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>							  
							   <td>
								  <select id="Badge" class="control">
									<option value="truyentranhtuan">Truyện tranh tuần</option>
									<option value="truyenqq">Truyện QQ</option>
									<option value="nettruyenpro">Net truyện pro</option>
									<option value="truyendep">Truyện đẹp</option>
									<option value="truyentranh24">Truyện tranh 24</option>
									<option value="nettruyenonline">Net truyện online</option>
									<option value="comics24h">Comics24h</option>
									<option value="truyensieuhay">Truyện siêu hay</option>							
									<option value="Pops">POPS</option>
									<option value="hotruyen">Hố truyện</option>						
								  </select>	
					          </td>
							  <td>
								  <select id="Badge" class="control">
								  <?php
								  foreach($arr2 as $muc2) { 
								    echo  '<option>'.$muc2['Name'].'</option>';
								  ?>

								   <?php
								  }
								   ?>			
								   </select>							  
							  </td>
							  
							  <td><button class="button is-danger"  id="updateNum" src-path="">Cập nhật</button></td>
							  <td><button class="button is-danger"  id="updateContent" src-path="">Cập nhật</button></td>
							
							</tr>						
						  </tbody>
						</table>
					</div>
					
					<div class="field">												
						<p class="control">
						<input type="text" class="input"  id="link_old" name="link_old" placeholder="Link củ"/>
						</p>	
					</div>
					<div class="field">												
						<p class="control">
						<input type="text" class="input"  id="link_new" name="link_new" placeholder="Link mới"/>
						</p>	
					</div>
					<div class="field">												
						<p class="control">
						<button class="button is-danger"  id="" src-image="" src-path="">Thay thế tất cả</button>
						</p>	
					</div>						
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
 var linkOption1=<?php echo json_encode($linkOption1)?>;
 var idStory=<?php echo json_encode($idStory)?>;
 //var url=<?php echo json_encode($info_story[12])?>;
 var nameStory=<?php echo json_encode($info_story[1])?>;  
$(document).ready(function(){
	
$("#updateNum").click(function(){
	 $('#updateNum').attr("disabled", true);
	 $('#updateContent').prop("disabled", true); 
	 $("#updateNum").text("Đang cập nhật...");
	 var link_content=document.getElementById("link_content").value;
	 $.ajax({     
	   url:linkOption1+'plugin/getStoryqq.php',
	   type:'POST',
	   cache:false,
	   data:{'idStory':idStory,'url':link_content,'name':nameStory},
	   success:function(kq){
		    $("#updateNum").text("Cập nhật");
		   //var o=JSON.parse(kq);
		    location.reload();
		    $('#updateNum').prop("disabled", false); 
		    $('#updateContent').prop("disabled", false); 
	   }			   
	  })
});
$("#updateContent").click(function(){
	 $('#updateNum').attr("disabled", true);
	 $('#updateContent').prop("disabled", true); 
	 $("#updateContent").text("Đang cập nhật...");
	 $.ajax({     
	   url:linkOption1+'plugin/getChapqq.php',
	   type:'POST',
	   cache:false,
	   data:{'name':nameStory,'idStory':idStory},
	   success:function(kq){		  
		   $("#updateContent").text("Cập nhật");
		    var o=JSON.parse(kq);
		    console.log(o);

			//location.reload();
		    $('#updateNum').prop("disabled", false); 
		    $('#updateContent').prop("disabled", false); 
			
	   }			   
	  })
});
		 
});

</script>
	
	
</body>
</html>