<?php 
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php'); 
	require_once('function/function.php'); 
	$db=new config();
	$db->config();
	if(!isset($_SESSION['name_comment'])){
		$_SESSION['name_comment']="";
	}

date_default_timezone_set('Asia/Ho_Chi_Minh');
$dateUpload=date('Y-m-d H:i:s');

		$linkOption=siteURL();		
		$domain=$_SERVER['SERVER_NAME'];
		$linkOption1=$linkOption."page/";
		
		$banner=$db->GetAdvertisement();
		$Id=$_GET["id"];
		$Name=$_GET["name"];
		$listNews=$db->GetNewsById($Id);
	
		
	
		
	
		
		$paper_color="";$text_color="";$text_font="";$text_size="";
		if(isset($_SESSION["paper_color"]))
		$paper_color=$_SESSION['paper_color'];

		if(isset($_SESSION['text_color']))
		$text_color=$_SESSION['text_color'];

		if(isset($_SESSION['text_font']))
		$text_font=$_SESSION['text_font'];

		if(isset($_SESSION['text_size']))
		$text_size=$_SESSION['text_size'];
	
	
 ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
	<title><?=$listNews[1]?></title>

	<meta name="description" content="<?="Đọc truyện tranh ".$bb1.$nextChapMeta." Mới nhất nhanh nhất tại ".$domain?>">
	<meta name="author" content="<?=$domain?>">
	<meta name="email" content="xemtruyen.xyz@gmail.com">

	<meta property="og:description" content="<?="Đọc truyện tranh ".$bb1.$nextChapMeta." Mới nhất nhanh nhất tại ".$domain?>">

	<meta property="fb:pages" content="118730167811356" />
	<meta name="copyright" content="Copyright © 2023 <?=$domain?>" />
	<meta name="Author" content="<?=$domain?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/read.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">	
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
	<script src="<?php echo $linkOption1;?>js/js.js"></script>
	<?php include 'googleAnalytics.php';?>
</head>	
    <body onbeforeunload="HandleOnClose()">
	<script language="javascript">
	function HandleOnClose() {
	   if (event.clientY < 0) {
		  event.returnValue = 'Are you sure you want to leave the page?';
	   }
	}
	</script>
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root" class=" fb_reset">
            <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                <div></div>
            </div>
        </div>

        <input type="hidden" id="keyword-default" value="nanatsu">
        <div class="outsite on">
            <?php
			$styleOn=0;	
			require_once('header/headerDetail.php');			
			?>
            <!-- /.main-menu -->
         
            <section class="main-content on">

				<?php
				$bc_full="-full";
				$bc_mobile="top";
				require_once('qc/bannerHeader.php'); 
				?>
                <div class="story-see container">
                    <div class="story-see-main" style="margin-top: 15px;">
                        <div class="block">
							?>
                            <div class="box">
                                <div id="path" class="path-top">
                                    <ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                            <a itemprop="item" href="<?=$linkOption?>">
                                                <span itemprop="name">Trang Chủ</span>
                                            </a>
                                            <meta itemprop="position" content="1">
                                        </li>
                                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
										    <a href="<?=$linkOption."tin-tuc-chi-tiet/"?><?=vn_str_filter($listNews[1])."-".$Id?>" title="<?=$listNews[1]?>">                                          
                                                <span itemprop="name"><?php echo  $listNews[1];?></span>
                                            </a>
                                            <meta itemprop="position" content="2">
                                        </li>
                                        
                                    </ol>
                                </div>
                                <div>
                                    <h1 class="detail-title"><a href="#"><?php echo $listNews[1];?></a> </h1>
                                    <time datetime="2020-10-20T12:25:21+07:00">(Cập nhật lúc: <?php echo $dateUpload;?>)</time>
									 
                                </div>
								
							                              
                            </div>
							
							<?php
							require_once('qc/bannerFooterTopChap.php');	
							if($listNews[3]!=""){
								echo '<div class="box" id="box_font" style="font-size: 26px;color:#2b2b2b;background-color:#F4F4F4;background-image:none;font-family:Palatino Linotype,Arial,Times New Roman,sans-serif;">';
								
									echo preg_replace("/<\/?div[^>]*\>/i", "", $listNews[3]); 
								echo '</div>';
							}
							?>
							
                            

						
					
                            <div class="show-footer"></div>
                             <?php
									require_once('qc/bannerFooterChap.php'); 
							?>	
                            <div class="story-detail has-background-white on">
                                <div id="path">
                                    <ol class="breadcrumb" itemscope="" itemtype="">
                                        <li itemprop="itemListElement" itemscope="" itemtype="">
                                            <a itemprop="item" href="<?=$linkOption?>">
                                                <span itemprop="name">Trang Chủ</span>
                                            </a>
                                            <meta itemprop="position" content="1">
                                        </li>
                                        <li itemprop="itemListElement" itemscope="" itemtype="">
                                            <a itemprop="item" href="<?=$linkOption."tin-tuc-chi-tiet/"?><?=vn_str_filter($listNews[1])."-".$Id?>">
                                                <span itemprop="name"><?php echo $listNews[1];?></span>
                                            </a>
                                            <meta itemprop="position" content="2">
                                        </li>
                                       
                                    </ol>
                                </div>                          
							
                            </div>
                        </div>
                    </div>
                    <div id="stop" class="scrollTop" style="display: none; bottom: 60px;">
					
                        <span><a href="#"><img src="<?php echo $linkOption1;?>frontend/images/back-to-top-icon.png"></a></span>
                    </div>
                </div>
            </section>
            <!-- /.main-content -->

          
            <!-- /.footer -->
			
            <?php 
			require_once('footer/footer.php');
			
			?>
      
          
       <?php
	      require_once('footer/footerDetail.php');
	      require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php		  
	    require_once('qc/bannerContent.php');
	   
   
		$db->dis_connect();//ngat ket noi mysql	
	   ?>
    </body>
</html>
