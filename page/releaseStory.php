<?php
	require_once('model/connection.php');
	require_once('function/function.php');
	$db=new config();
	$db->config();	
	if(isset($_SESSION['email'])){
		if($db->GetLevelUser($_SESSION['email'])<1){
			//header("location:../");
		}
	}else{
		//header("location:../");
	}
	$linkOption=siteURL();	
	$linkOption1=$linkOption."page/";
	$arr_story= $db->GetStory();
	
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Cập nhật lịch</title>               	
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <link rel="shortcut icon" href="frontend/images/favicon.ico?v=1.1" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">
    <script src="js/main.js"></script>
	<link rel="stylesheet" href="frontend/file/jquery.tag-editor.css">	
	<script src="frontend/file/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script src="frontend/file/jquery.caret.min.js"></script>
    <script src="frontend/file/jquery.tag-editor.js"></script>	
    <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
</head>
<body onbeforeunload="return Reload()">
<input type="hidden" id="keyword-default" value="nanatsu">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');

?>
<title>Cập nhật lịch</title>
<section class="main-content">
    <div class="container">
        <div class="messages columns">
<div class="column is-narrow left pc">
    <ul class="nav-user">
        <li><a class="li01 " href="#">Quản lý tài khoản</a></li>
        <li><a class="li02 " href="#">Tin nhắn</a></li>
        <li><a class="li03 " href="forgotPassword.php">Đổi mật khẩu</a></li>
        <li><a class="li04 " href="listStory.php">Danh sách truyện</a></li>
		<li><a class="li05 is-active" href="addStory.php">Thêm truyện</a></li>
       
    </ul>
</div>           
 <div class="column columns">

                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Cập nhật lịch</p>
                    </div>
                                 
                        <div class="form-change-pass user-form">
                            <div class="field">
                                
                                <p class="txt">Ngày cập nhật</p>
                                <p class="control">
                                    <input class="input" type="time" id="birthday" name="birthday" value="" min="<?= date('Y-m-d'); ?>">
                                </p>
                            </div>
                       
                          
							<div class="field user-field">
							   <label>Name</label>
                              <select id='selUser' class="form-control">
								<option value='0'>-- Select Name --</option> 
								<?php
								   foreach($arr_story as $muc)
									{
									
											 echo '<option value="'.$muc['Id'].'">'.$muc['Name'].'</option>'; 
										 
									}	
								?>			
								
							</select>   
                            </div>
							<div class="field">
                                <p class="txt">Chap</p>
                                <p class="control">
                                    <input class="input" type="text" id="nameChap" name="nameChap" value="">
                                </p>
                            </div>
														
                            <input type="hidden" id="avatar" name="avatar" value="">
                            <input type="hidden" id="inputDelImage" name="inputDelImage" >
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger"  id="addSlider" src-image="" src-path="">Lưu</button>
                                </p>
                            </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


 <script>
var linkOption12=<?php echo json_encode($linkOption1)?>;
        $(document).ready(function(){

            // Initialize select2
            $("#selUser").select2();

            // Read selected option
            $('#addSlider').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
				var nameChap = $('#nameChap').val();
				if(userid==0){
					alert("Vui lòng chọn tên truyện tranh");
				}else if(!parseFloat(nameChap)){
					alert("Vui lòng chọn tên chap đúng");
				}else{
					
					   $.ajax({     
					   url:linkOption12+'ajax/page/releaseStory.php',
					   type:'POST',
					   cache:false,
					   data:{'key':key,'per_page':per_page,'page':page},
					   success:function(kq){
						   
						   
					   }
				}
                
            });
			
			$("#birthday").keyup(function(){
				// var birthday=$("#birthday").val();
				// if(birthday<date('Y-m-d'))
			  // $("birthday").val("");
			});
        });
</script>
</body>
</html>