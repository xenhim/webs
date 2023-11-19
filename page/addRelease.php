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
	
	$linkOption1=$linkOption."page/";
	$arr_story= $db->GetStoryJoinRelease();
	date_default_timezone_set("Asia/Ho_Chi_Minh");
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
			<?php
			$levelUser=$db->GetLevelUser($_SESSION['email']);
			$typeLeftHeader="";
			require_once('header/headerLeft.php');
			?>          
 <div class="column columns">

                <div class="user-main column">
                    <div class="level title">
                        <p class="level-left has-text-weight-bold">Cập nhật lịch</p>
                    </div>
                                 
                        <div class="form-change-pass user-form">
                            <div class="field">
                                
                                <p class="txt">Ngày cập nhật</p>
                                <p class="control">
                                    <input class="input" type="date" id="birthday" name="birthday" value="<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" disabled>
                                </p>
                            </div>
							<div class="field">
                                
                                <p class="txt">Giờ cập nhật</p>
                                <p class="control">
                                    <input class="input" type="time" id="birthday1" name="birthday1">
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
                                    <input class="input" type="text" id="nameChap" name="nameChap">
                                </p>
                            </div>
							<div class="field">
                                 <span class="txt">Type</span>								
								<select id="Type" class="form-control">
									<option value="">Chọn</option>
									<option value="hot">Hot</option>						
								</select>
                            </div>							
                            <input type="hidden" id="avatar" name="avatar" value="">
                            <input type="hidden" id="inputDelImage" name="inputDelImage" >
                            <div class="field">
                                <p class="control">
                                    <button class="button is-danger"  id="editRelease">Lưu</button>
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
            $('#editRelease').click(function(){
				var date = $('#birthday').val();
				var time = $('#birthday1').val();
				var type = $('#Type').val();
               
                var idStory = $('#selUser').val();
				var nameChap = $('#nameChap').val();
			
					
			   $.ajax({     
			   url:linkOption12+'ajax/release/add.php',
			   type:'POST',
			   cache:false,
			   data:{'date':date,'time':time,'idStory':idStory,'nameChap':nameChap,'type':type},
			   success:function(kq){
				   //console.log(kq);
				   location.reload();
			   }
                
            });
			
			
        });
		});
</script>
</body>
</html>