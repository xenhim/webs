<?php
$li01="";$li02="";$li03="";$li04="";$li05="";$li06="";$li07="";$li08="";$li10="";$li11="";$li12="";

switch ($typeLeftHeader) {
  case "account":
    $li01="is-active";
    break;
  case "addStory":
    $li05="is-active";
    break;
  case "messages":
    $li02="is-active"; 
    break;
  case "changePassword":
    $li03="is-active";
    break;
  case "listStory":
   $li04="is-active";
    break;
  case "advertisement":
    $li06="is-active";
    break;
  case "listRelease":
    $li07="is-active";
    break;
  case "listSlider":
    $li08="is-active";
    break;
  case "listGenre":
    $li10="is-active";
    break;
 case "logo":
    $li11="is-active";
    break;
case "update":
    $li12="is-active";
    break;	
  
}	
	$numFee=$db->CountFeedbackAdmin();
?>

<div class="column is-narrow left pc">
	<ul class="nav-user">
		<li><a class="li01 <?=$li01?>" href="<?=$linkOption?>quan-ly-tai-khoan.html">Quản lý tài khoản</a></li>
		<li><a class="li02 <?=$li02?>" href="<?=$linkOption?>tin-nhan.html">Tin nhắn</a></li>
		<li><a class="li03 <?=$li03?>" href="<?=$linkOption?>doi-mat-khau.html">Đổi mật khẩu</a></li>
		<li><a class="li012 <?=$li12?>" href="<?=$linkOption?>update/">Update theme</a></li>
		<?php
		if($levelUser>0){
			echo '<li><a class="li04 '.$li04.'" href="'.$linkOption.'page/listStory.php">Ds truyện</a></li>';
			echo '<li><a class="li05 '.$li05.'" href="'.$linkOption.'page/addStory.php">Thêm truyện</a></li>';
			echo '<li><a class="li06 '.$li06.'" href="'.$linkOption.'page/advertisement.php">Đăng quảng cáo</a></li>';
			echo '<li><a class="li07 '.$li07.'" href="'.$linkOption.'page/listRelease.php">Ds lịch ra chương</a></li>';
			echo '<li><a class="li08 '.$li08.'" href="'.$linkOption.'page/listSlider.php">Ds slider</a></li>';
			echo '<li><a class="li010 '.$li10.'" href="'.$linkOption.'page/listGenre.php">Ds Danh mục</a></li>';
			echo '<li><a class="li011 '.$li11.'" href="'.$linkOption.'page/logo.php">Logo</a></li>';
			echo '<li class=""><a class="li09"  href="'.$linkOption.'page/listFeedback.php">Ds phản hồi('.$numFee.')</a></li>';
			
			
		}
		?>
		
	</ul>
</div>