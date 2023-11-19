<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('model/connection.php'); 
	require_once('function/function.php');
	$db=new config();
	$db->config();
	$history=array();
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	$linkOption2=$linkOption."tac-gia/";
	$banner=$db->GetAdvertisement();
	$name="";$IdAuthor="";$page="";$status="";$status1="";$page1=0;
		 if(isset($_GET["name"])){
		 
		 $name=$_GET["name"];
		 }		 
		 if(isset($_GET["IdAuthor"])){
		 $IdAuthor="-".$_GET["IdAuthor"];
		 }
		 if(isset($_GET["page"])){
			$page="/trang-".tofloat($_GET["page"]);	
			$page1=tofloat($_GET["page"]);	
		}
		if(isset($_GET["status"])){
		  $status="?status=".$_GET["status"];
		  $status1=$_GET["status"];
		}
		
		$NameAuthor=$db->GetNameAuthor($name);
				
		$domain=$_SERVER['SERVER_NAME'];
		$linkOption1=$linkOption."page/";
		$linkAuthor=$linkOption2.$name.$IdAuthor.".html"
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
   <meta charset="utf-8">
	<title>Tác Giả <?=$NameAuthor?></title>
	<meta name="keywords" content="tác giả <?=$NameAuthor?>,tiểu sử <?=$NameAuthor?>,<?=$NameAuthor?>">
	<meta name="description" content="Tuyển tập truyện và thông tin của tác giả <?=$NameAuthor?> đầy đủ nhất tại <?=$domain?>">
	<meta property="og:title" content="Tác Giả <?=$NameAuthor?>">
	<meta property="og:description" content="Tuyển tập truyện và thông tin của tác giả <?=$NameAuthor?> đầy đủ nhất tại <?=$domain?>">
	<meta property="og:site_name" content="<?=$domain?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?=$linkAuthor?>">
	<meta property="fb:pages" content="109139867535054">
	<meta name="copyright" content="Copyright © 2022 <?=$domain?>">
	<meta name="Author" content="<?=$domain?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
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


    <input type="hidden" id="keyword-default" value="one">
    <div class="outsite ">
      <?php
		  require_once('header/headerDetail.php');
      ?>
   

       <?php
	   
	   require_once('qc/bannerHeader.php'); 
	   ?>
      <!-- /.main-menu -->
      <section class="main-content">
        <div class="container story-list">
          <div class="title-list">Tác giả <?=$NameAuthor?></div>
          <div class="story-list-bl01 box">
            <table>
              <tbody>
                <tr>
                  <th>Tình trạng</th>
                  <td>
                    <ul class="choose">
<li><a class="<?php if($status1=="0") echo "active"; else echo ""; ?>" href="<?= $linkOption?>tac-gia/<?= $name?><?= $IdAuthor?><?= $page?>.html?status=0">Đang tiến hành</a></li>				
<li><a class="<?php if($status1=="2") echo "active"; else echo ""; ?>" href="<?= $linkOption?>tac-gia/<?= $name?><?= $IdAuthor?><?= $page?>.html?status=2">Hoàn thành</a></li>					
                    </ul>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="tile is-ancestor">
            <div class="tile is-vertical is-parent">
              
			  <?php
			   $item_per_page = 24;
		       $current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
			    storiesList($db->GetAuthorTop($status1,$db->GetNameAuthor($name),"",$item_per_page,$current_page),$linkOption);
			  ?>
               
           
            </div>
          </div>
          <!-- /.list-stories -->
        </div>
		<?php
		
		$totalRecords = $db->GetAuthorTop($status1,$db->GetNameAuthor($name),"total",$item_per_page,$current_page);
		$db->dis_connect();//ngat ket noi mysql	
		if(count($history)>0)
	    require_once('pagination/paginationAuthor.php');
	   ?>
      </section>
      <!-- /.main-content -->
      <?php	
	  require_once('footer/footerDetail.php');	
	  ?> 
      
      <?php
	      require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php
		  
	    require_once('qc/bannerContent.php');
		  
		if(!isset($_SESSION['banner'])){
			$_SESSION['banner']="banner";
		}
	   ?>
  </body>
</html>