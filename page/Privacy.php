<?php
	session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php'); 
	require_once('function/function.php'); 
	$db=new config();
	$db->config();
	$user=0;
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	$history=array();
	if(isset($_SESSION['email'])){
		$user=$_SESSION['email'];
		if($db->GetHistory($user)==""){
	    	$history=array();
		}else{
			$history=explode(",",$db->GetHistory($user));
		}

	}else{
		//$_SESSION['history']=array(1,2,3,4,5,6,7,8,9,10);
		if(isset($_SESSION['history'])){
			if($_SESSION['history']!=[]){
				$history=$_SESSION['history'];
			}
		}
	}
	$domain=$_SERVER['SERVER_NAME'];
	$banner=$db->GetAdvertisement();
	 // session_unset(); 
	 // session_destroy(); 
	
	//print_r($history);
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <title>Chính sách quyền riêng tư - <?=$domain?></title>
    <meta property="og:site_name" content="<?=$domain?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption?>lich-su.html">
    <meta property="fb:pages" content="118730167811356">
    <meta name="copyright" content="Copyright © 2023 <?=$domain?>">
    <meta name="Author" content="<?=$domain?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico?v=1.1" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
    <?php include 'googleAnalytics.php';?>
  </head>
  <body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root" class=" fb_reset">
      <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
        <div></div>
      </div>
    </div>

   
    <input type="hidden" id="keyword-default" value="tổng tài">
    <div class="outsite ">
	   <?php
		  require_once('header/headerDetail.php');
		  require_once('qc/bannerHeader.php'); 
		?>

      <section class="main-content">
        <div class="container story-list">
          <div class="title-list">Chính sách quyền riêng tư</div>
          <div class="tile is-ancestor">
            <div class="tile is-vertical is-parent">
              <?php
				  //$totalRecords=count($history);
				  $item_per_page = 42;
				  //$current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
				  
				if($totalRecords>42){
					if($history[42]==""){							
						 echo '<div class="warning-list box"><p>Ch&iacute;nh S&aacute;ch Quyền Ri&ecirc;ng Tư</p>

<p>XemTruyen t&ocirc;n trọng quyền ri&ecirc;ng tư của từng c&aacute; nh&acirc;n, v&agrave; v&igrave; vậy, ch&uacute;ng t&ocirc;i lu&ocirc;n nỗ lực bảo vệ th&ocirc;ng tin của mọi người. Ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư n&agrave;y sẽ m&ocirc; tả quy tr&igrave;nh ch&uacute;ng t&ocirc;i thu thập, chuyển đổi, xử l&yacute; v&agrave; sử dụng th&ocirc;ng tin c&aacute; nh&acirc;n của bạn.</p>

<p>Bằng c&aacute;ch cung cấp th&ocirc;ng tin c&aacute; nh&acirc;n, bạn đồng &yacute; với việc trao đổi, xử l&yacute;, sử dụng v&agrave; tiết lộ th&ocirc;ng tin theo như đ&atilde; n&ecirc;u trong ch&iacute;nh s&aacute;ch n&agrave;y.</p>

<p>Bạn c&oacute; thể t&igrave;m th&ocirc;ng tin về ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư trong phần ch&acirc;n trang của trang web XemTruyen.</p>

<p>Ch&uacute;ng t&ocirc;i Thu Thập G&igrave;? Ch&uacute;ng t&ocirc;i thu thập th&ocirc;ng tin c&aacute; nh&acirc;n m&agrave; bạn cung cấp, cho biết bạn l&agrave; một người d&ugrave;ng c&aacute; nh&acirc;n. Việc thu thập n&agrave;y chỉ được thực hiện sau khi c&oacute; sự đồng &yacute; của bạn. Th&ocirc;ng tin n&agrave;y c&oacute; thể bao gồm:</p>

<ul>
	<li>Họ v&agrave; t&ecirc;n</li>
	<li>Địa chỉ</li>
	<li>Số điện thoại</li>
	<li>Địa chỉ email</li>
</ul>

<p>Ch&uacute;ng t&ocirc;i Sử Dụng Th&ocirc;ng Tin C&aacute; Nh&acirc;n Như Thế N&agrave;o? Bằng c&aacute;ch cung cấp th&ocirc;ng tin c&aacute; nh&acirc;n, bạn đồng &yacute; rằng, nếu ph&aacute;p luật địa phương hoặc ph&aacute;p luật tại nơi bạn đang ở cho ph&eacute;p, ch&uacute;ng t&ocirc;i sẽ sử dụng th&ocirc;ng tin đ&oacute; để thực hiện c&aacute;c nhiệm vụ sau:</p>

<ul>
	<li>Trả lời c&aacute;c y&ecirc;u cầu của bạn</li>
	<li>Cải thiện dịch vụ của ch&uacute;ng t&ocirc;i</li>
	<li>N&acirc;ng cao th&ocirc;ng tin tr&ecirc;n c&aacute;c phương tiện truyền th&ocirc;ng</li>
	<li>Cung cấp cho bạn c&aacute;c gợi &yacute;, th&ocirc;ng tin hữu &iacute;ch v&agrave; cập nhật về sản phẩm mới</li>
	<li>Th&ocirc;ng b&aacute;o về sản phẩm v&agrave; dịch vụ mới</li>
	<li>Hỗ trợ kh&aacute;ch h&agrave;ng hiểu về sản phẩm v&agrave; dịch vụ của ch&uacute;ng t&ocirc;i</li>
	<li>Đ&aacute;nh gi&aacute; c&aacute;c hồ sơ ứng tuyển c&ocirc;ng việc</li>
	<li>Đối với mục đ&iacute;ch quản trị v&agrave; đảm bảo chất lượng sản phẩm của ch&uacute;ng t&ocirc;i</li>
	<li>Đối với c&aacute;c mục đ&iacute;ch kh&aacute;c được liệt k&ecirc; chi tiết tr&ecirc;n trang web hoặc ứng dụng di động</li>
</ul>

<p>Ch&uacute;ng t&ocirc;i Bảo Mật Th&ocirc;ng Tin Như Thế N&agrave;o? XemTruyen lu&ocirc;n đảm bảo an ninh th&ocirc;ng tin c&aacute; nh&acirc;n của bạn, tuy nhi&ecirc;n, ch&uacute;ng t&ocirc;i kh&ocirc;ng thể đảm bảo sự an to&agrave;n của th&ocirc;ng tin bạn tải l&ecirc;n trang web hoặc qua ứng dụng di động. Bạn chịu rủi ro về việc th&ocirc;ng tin c&oacute; thể bị r&ograve; rỉ, sử dụng sai mục đ&iacute;ch hoặc thay đổi dữ liệu. Ngay khi ch&uacute;ng t&ocirc;i nhận được th&ocirc;ng tin của bạn, ch&uacute;ng t&ocirc;i sẽ sử dụng c&aacute;c biện ph&aacute;p bảo mật chuy&ecirc;n nghiệp để ngăn ngừa những sự cố như vậy xảy ra.</p>

<p>Chia Sẻ Th&ocirc;ng Tin với B&ecirc;n Thứ Ba Ch&uacute;ng t&ocirc;i cam kết kh&ocirc;ng chia sẻ th&ocirc;ng tin của bạn với bất kỳ b&ecirc;n thứ ba hoặc c&aacute;c đơn vị kh&aacute;c.</p>

<p>Thay Đổi Ch&iacute;nh S&aacute;ch Ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư n&agrave;y c&oacute; thể được cập nhật định kỳ. Nếu c&oacute; những thay đổi quan trọng, ch&uacute;ng t&ocirc;i sẽ đăng th&ocirc;ng b&aacute;o tr&ecirc;n trang web hoặc trong c&aacute;c thỏa thuận li&ecirc;n quan. Ch&uacute;ng t&ocirc;i khuyến nghị bạn xem x&eacute;t ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư định kỳ để cập nhật th&ocirc;ng tin mới nhất về c&aacute;ch ch&uacute;ng t&ocirc;i bảo vệ v&agrave; sử dụng th&ocirc;ng tin c&aacute; nh&acirc;n m&agrave; ch&uacute;ng t&ocirc;i thu thập. Việc bạn tiếp tục sử dụng trang web ngụ &yacute; rằng bạn chấp nhận c&aacute;c điều khoản trong Ch&iacute;nh S&aacute;ch Quyền Ri&ecirc;ng Tư v&agrave; c&aacute;c cập nhật của n&oacute;. Những thay đổi trong ch&iacute;nh s&aacute;ch kh&ocirc;ng &aacute;p dụng cho dữ liệu đ&atilde; được thu thập trước đ&oacute;.</p>

<p>Ch&iacute;nh S&aacute;ch Quyền Ri&ecirc;ng Tư mới nhất của XemTruyen được cập nhật lần cuối v&agrave;o ng&agrave;y 31 th&aacute;ng 08 năm 2021.</p>
</div>';	
					}else{
					  $tempPage = ceil($totalRecords / $item_per_page);
					  $tempString = $totalRecords / $item_per_page;
					  $start=($current_page-1)*$item_per_page-$current_page+1;

					  if($tempPage==$current_page && is_float($tempString)==1){	
						  if($totalRecords<$item_per_page)
							  $end=$totalRecords;	
						  else						  
							  $end=$totalRecords-1;					 
					  }
					  else{
						  $end=($current_page)*$item_per_page-$current_page+1;
					  }
					echo '<ul class="list-stories grid-6">';			   
					   //for($i=$end-1;$i>=$start;$i--){
						 for($i=$start;$i<$end;$i++){						   
							storiesListHistory($db->GetByIdStory($history[$i]),$linkOption);					
					   }
					echo '</ul>';
					}
				}else{
					 echo '<div class="warning-list box"><p>Ch&iacute;nh S&aacute;ch Quyền Ri&ecirc;ng Tư</p>

<p>XemTruyen t&ocirc;n trọng quyền ri&ecirc;ng tư của từng c&aacute; nh&acirc;n, v&agrave; v&igrave; vậy, ch&uacute;ng t&ocirc;i lu&ocirc;n nỗ lực bảo vệ th&ocirc;ng tin của mọi người. Ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư n&agrave;y sẽ m&ocirc; tả quy tr&igrave;nh ch&uacute;ng t&ocirc;i thu thập, chuyển đổi, xử l&yacute; v&agrave; sử dụng th&ocirc;ng tin c&aacute; nh&acirc;n của bạn.</p>

<p>Bằng c&aacute;ch cung cấp th&ocirc;ng tin c&aacute; nh&acirc;n, bạn đồng &yacute; với việc trao đổi, xử l&yacute;, sử dụng v&agrave; tiết lộ th&ocirc;ng tin theo như đ&atilde; n&ecirc;u trong ch&iacute;nh s&aacute;ch n&agrave;y.</p>

<p>Bạn c&oacute; thể t&igrave;m th&ocirc;ng tin về ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư trong phần ch&acirc;n trang của trang web XemTruyen.</p>

<p>Ch&uacute;ng t&ocirc;i Thu Thập G&igrave;? Ch&uacute;ng t&ocirc;i thu thập th&ocirc;ng tin c&aacute; nh&acirc;n m&agrave; bạn cung cấp, cho biết bạn l&agrave; một người d&ugrave;ng c&aacute; nh&acirc;n. Việc thu thập n&agrave;y chỉ được thực hiện sau khi c&oacute; sự đồng &yacute; của bạn. Th&ocirc;ng tin n&agrave;y c&oacute; thể bao gồm:</p>

<ul>
	<li>Họ v&agrave; t&ecirc;n</li>
	<li>Địa chỉ</li>
	<li>Số điện thoại</li>
	<li>Địa chỉ email</li>
</ul>

<p>Ch&uacute;ng t&ocirc;i Sử Dụng Th&ocirc;ng Tin C&aacute; Nh&acirc;n Như Thế N&agrave;o? Bằng c&aacute;ch cung cấp th&ocirc;ng tin c&aacute; nh&acirc;n, bạn đồng &yacute; rằng, nếu ph&aacute;p luật địa phương hoặc ph&aacute;p luật tại nơi bạn đang ở cho ph&eacute;p, ch&uacute;ng t&ocirc;i sẽ sử dụng th&ocirc;ng tin đ&oacute; để thực hiện c&aacute;c nhiệm vụ sau:</p>

<ul>
	<li>Trả lời c&aacute;c y&ecirc;u cầu của bạn</li>
	<li>Cải thiện dịch vụ của ch&uacute;ng t&ocirc;i</li>
	<li>N&acirc;ng cao th&ocirc;ng tin tr&ecirc;n c&aacute;c phương tiện truyền th&ocirc;ng</li>
	<li>Cung cấp cho bạn c&aacute;c gợi &yacute;, th&ocirc;ng tin hữu &iacute;ch v&agrave; cập nhật về sản phẩm mới</li>
	<li>Th&ocirc;ng b&aacute;o về sản phẩm v&agrave; dịch vụ mới</li>
	<li>Hỗ trợ kh&aacute;ch h&agrave;ng hiểu về sản phẩm v&agrave; dịch vụ của ch&uacute;ng t&ocirc;i</li>
	<li>Đ&aacute;nh gi&aacute; c&aacute;c hồ sơ ứng tuyển c&ocirc;ng việc</li>
	<li>Đối với mục đ&iacute;ch quản trị v&agrave; đảm bảo chất lượng sản phẩm của ch&uacute;ng t&ocirc;i</li>
	<li>Đối với c&aacute;c mục đ&iacute;ch kh&aacute;c được liệt k&ecirc; chi tiết tr&ecirc;n trang web hoặc ứng dụng di động</li>
</ul>

<p>Ch&uacute;ng t&ocirc;i Bảo Mật Th&ocirc;ng Tin Như Thế N&agrave;o? XemTruyen lu&ocirc;n đảm bảo an ninh th&ocirc;ng tin c&aacute; nh&acirc;n của bạn, tuy nhi&ecirc;n, ch&uacute;ng t&ocirc;i kh&ocirc;ng thể đảm bảo sự an to&agrave;n của th&ocirc;ng tin bạn tải l&ecirc;n trang web hoặc qua ứng dụng di động. Bạn chịu rủi ro về việc th&ocirc;ng tin c&oacute; thể bị r&ograve; rỉ, sử dụng sai mục đ&iacute;ch hoặc thay đổi dữ liệu. Ngay khi ch&uacute;ng t&ocirc;i nhận được th&ocirc;ng tin của bạn, ch&uacute;ng t&ocirc;i sẽ sử dụng c&aacute;c biện ph&aacute;p bảo mật chuy&ecirc;n nghiệp để ngăn ngừa những sự cố như vậy xảy ra.</p>

<p>Chia Sẻ Th&ocirc;ng Tin với B&ecirc;n Thứ Ba Ch&uacute;ng t&ocirc;i cam kết kh&ocirc;ng chia sẻ th&ocirc;ng tin của bạn với bất kỳ b&ecirc;n thứ ba hoặc c&aacute;c đơn vị kh&aacute;c.</p>

<p>Thay Đổi Ch&iacute;nh S&aacute;ch Ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư n&agrave;y c&oacute; thể được cập nhật định kỳ. Nếu c&oacute; những thay đổi quan trọng, ch&uacute;ng t&ocirc;i sẽ đăng th&ocirc;ng b&aacute;o tr&ecirc;n trang web hoặc trong c&aacute;c thỏa thuận li&ecirc;n quan. Ch&uacute;ng t&ocirc;i khuyến nghị bạn xem x&eacute;t ch&iacute;nh s&aacute;ch quyền ri&ecirc;ng tư định kỳ để cập nhật th&ocirc;ng tin mới nhất về c&aacute;ch ch&uacute;ng t&ocirc;i bảo vệ v&agrave; sử dụng th&ocirc;ng tin c&aacute; nh&acirc;n m&agrave; ch&uacute;ng t&ocirc;i thu thập. Việc bạn tiếp tục sử dụng trang web ngụ &yacute; rằng bạn chấp nhận c&aacute;c điều khoản trong Ch&iacute;nh S&aacute;ch Quyền Ri&ecirc;ng Tư v&agrave; c&aacute;c cập nhật của n&oacute;. Những thay đổi trong ch&iacute;nh s&aacute;ch kh&ocirc;ng &aacute;p dụng cho dữ liệu đ&atilde; được thu thập trước đ&oacute;.</p>

<p>Ch&iacute;nh S&aacute;ch Quyền Ri&ecirc;ng Tư mới nhất của XemTruyen được cập nhật lần cuối v&agrave;o ng&agrave;y 31 th&aacute;ng 08 năm 2021.</p>
</div>';	
				}

				$db->dis_connect();//ngat ket noi mysql	
			   ?>
            </div>
          </div>
          <!-- /.list-stories -->
        </div>
		
	 <?php
	  if(count($history)>0)
	  require_once('pagination/paginationHistory.php');
	 ?>
      </section>
	<?php	
	 require_once('footer/footerDetail.php');	
	?> 
    <?php
	      require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php		  
	    require_once('qc/bannerContent.php');
	   ?>
  </body>
</html>