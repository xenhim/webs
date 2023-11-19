<?php
		require_once('model/connection.php'); 
		require_once('function/function.php');			
		$db=new config();
		$db->config();
		$linkOption=siteURL();
		$linkOption1=$linkOption."page/";
		$linkOption2=$linkOption."tim-kiem/";	
		$banner=$db->GetAdvertisement();
		$per_page="";$page="";$q="";
		if(isset($_GET["page"])){
			$page="/trang-".tofloat($_GET["page"]);	
		}
		if(isset($_GET["q"])){
			$q=$_GET["q"];			
		}
		$domain=$_SERVER['SERVER_NAME'];	
		
?>
<!DOCTYPE html>
<html lang="vi" class="">
  <head>
    <meta charset="utf-8">
    <title>Kết quả: <?=$q." - ".$domain?></title>
    <meta name="keywords" content="">
    <meta name="description" content="Ban dang tim kiem truyen: <?=$q?>">
    <meta property="og:site_name" content="<?=$domain?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption."tim-kiem.html?q=".$q?>">
    <meta property="fb:admins" content="100090159813452">
    <meta property="fb:pages" content="118730167811356"> 
    <meta name="copyright" content="Copyright © 2023 <?=$domain?>">
    <meta name="Author" content="<?=$domain?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="<?= $linkOption1?>frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?= $linkOption1?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?= $linkOption1?>frontend/css/style.css">	  
    <script src="<?= $linkOption1?>js/main.js"></script>
    <?php include 'googleAnalytics.php';?> 
  </head>
  <body>
  
    <input type="hidden" id="keyword-default" value="one">
    <div class="outsite ">
	<?php
		
		require_once('header/headerDetail.php');
		
		$item_per_page = 42;
		$current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
		$arr = $db->GetSearchFull($q,"",$item_per_page,$current_page);	   
	?>
   
      <!-- /.main-menu -->
      <section class="main-content">
        <div class="container story-list">
          <div class="tile is-ancestor">
            <div class="tile is-vertical is-parent">
              <?php							  
			    //storiesList($arr,$linkOption);
				storiesList($arr,$linkOption);
				$totalRecords =$db->GetSearchFull($q,"total",$item_per_page,$current_page);	
				$db->dis_connect();//ngat ket noi mysql		
			  ?>
            </div>
          </div>
		 <?php
			require_once('pagination/paginationSearch.php');
	     ?>
        </div>
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