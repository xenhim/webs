<?php 
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php'); 
	require_once('function/function.php'); 
	$db=new config();
	$db->config();
	$user=0;

	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	$subscribe=array();	
	if(isset($_SESSION['email'])){
	$user=$_SESSION['email'];
	$subscribe=$db->GetSubscribe($user);	
	if($subscribe!="" || $subscribe!="@"){
			$subscribe=explode(",",$subscribe);
			//$website = explode(";", $_SESSION['websites'][$i]);
		}
		
	}else{
		//$_SESSION['subscribe']=array(1,2,3,4,5,6,7,8,9,10);
		if(isset($_SESSION['subscribe'])){
			if($_SESSION['subscribe']!=[]){
				$subscribe21=implode(",",$_SESSION['subscribe']);
				$subscribe=explode(",",$subscribe21);
			}
		}		
	}
	$domain=$_SERVER['SERVER_NAME'];
	$banner=$db->GetAdvertisement();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="utf-8">
    <title>Truyện Đang Theo Dõi - <?=$domain?></title>
    <meta property="og:site_name" content="<?=$domain?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption?>truyen-dang-theo-doi.html">
    <meta property="fb:pages" content="109139867535054">
    <meta name="copyright" content="Copyright © 2019 <?=$domain?>">
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

    <input type="hidden" id="keyword-default" value="one">
    <div class="outsite ">
       <?php
		  require_once('header/headerDetail.php');
		  require_once('qc/bannerHeader.php'); 
		?>
      
      <section class="main-content">
        <div class="container story-list">
          <div class="title-list">Truyện Đang Theo Dõi</div>
          <div class="tile is-ancestor">
		
            <div class="tile is-vertical is-parent">
             
			   <?php
			   
			      $totalRecords=count($subscribe);
				  $item_per_page = 42;
				  $current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
				  
			if($totalRecords>0) {
			   if($subscribe[0]==""){	
			   
					 echo '<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!!</div>';
					
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
				   for($i=$start;$i<$end;$i++){			   
						storiesListFollow($db->GetByIdStory($subscribe[$i]),$linkOption);
				   }
			    echo '</ul>';
			   }
			}else{
				echo '<div class="warning-list box">Xin lỗi, không tìm thấy kết quả nào!!</div>';
			}
			    $db->dis_connect();//ngat ket noi mysql	
			   ?>
             
            </div>
          </div>
          <!-- /.list-stories -->
        </div>
      </section>
      <!-- /.main-content -->
	<script>
	var m = 0;
		m=<?php echo json_encode($user);?> ;
		if (m==0){
			m=0;  
		}
	
	var linkOption1 = <?php echo json_encode($linkOption1); ?> 
	</script>
     <script src="<?php echo $linkOption1;?>js/follow/follow.js"></script>
	 
	 <?php
	 if(count($subscribe)>0){	
	  require_once('pagination/paginationFollow.php');
	 }
	 ?>
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