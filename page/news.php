<?php
		require_once('model/connection.php'); 
		require_once('function/function.php'); 
		$page = basename($_SERVER['REQUEST_URI']);
		$sec = "100000";	
		$db=new config();
		$db->config();
		$linkOption=siteURL();	
		$domain=$_SERVER['SERVER_NAME'];
		$genres="";$sort="";$status="";$country="";$arrange="";$boy="";$daughter="";$per_page="";$page="";
		$genres1="";$country1="";$status1="";$sort1="";$sort2="";$arrange1="";$minchapter1="";$minchapter="";
		$p1="";$h1="";$s1="";$c1="";$linkOption1="";$metaSeo="";
		if(isset($_GET["status"])){
		 $status="status=".$_GET["status"];
		 $c1="&";
		}
	
			
		if(isset($_GET["page"])){
			$page="/trang-".tofloat($_GET["page"]);	
		}
		
	   
	  	if(isset($_GET["sort"])){
		 $sort1=$_GET["sort"];		 
		 $linkOption2=$linkOption.$_GET["sort"]."/";
		 $linkOption1=$linkOption."page/";
		 //$sort3=$db->GetNameSort($sort1);
		 //$metaSeo=$db->GetMetaSeoSort($sort1);
		}
		//echo $sort1;
		$banner=$db->GetAdvertisement();	
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<title>
	Danh mục tin tức
</title>
	<?php
		require_once('header/headerMeta.php');
	?> 	
    <link rel="shortcut icon" href="<?= $linkOption?>page/frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?= $linkOption?>page/frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?= $linkOption?>page/frontend/css/style.css">	  
    <script src="<?=$linkOption?>page/js/main.js"></script>
    <?php include 'googleAnalytics.php';?>
</head> 
<body> 
<input type="hidden" id="keyword-default" value="vợ">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');
require_once('qc/bannerHeader.php'); 
?> 


<section class="main-content">
    <div class="container story-list">
    <div class="title-list">Danh mục tin tức cập nhật</div>
	<div class="tile is-ancestor">
		<div class="tile is-vertical is-parent">
		<?php
			$item_per_page = 42;
			$current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
			$date="";
			
		
			
			newsList($db->GetNewsTop("",$item_per_page,$current_page),$linkOption);
			$totalRecords = $db->GetNewsTop("total",$item_per_page,$current_page);
			$db->dis_connect();//ngat ket noi mysql	
		?>
		</div>
	</div>
<?php
	
	require_once('pagination/paginationNews.php');
?>

</div>
</section>
			<?php	
				require_once('footer/footerDetail.php');	
			?> 
         <!-- /.qr-modal -->
	   <?php
	      require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php		  
	    require_once('qc/bannerContent.php');
	   ?>
	   <script>
	   var linkOption1=<?php echo json_encode($linkOption1)?>;
	   </script>
	   <script src="<?php echo $linkOption1;?>js/qc/ad.js"></script>
</body>
</html>