<?php
		require_once('model/connection.php'); 	
		require_once('function/function.php');	
		$db=new config();
		$db->config();
		$linkOption=siteURL();
		$linkOption1=$linkOption."the-loai/";
			
		$genres="";$sort="";$status="";$country="";$page="";
		$genres1="";$genres2="";$country1="";$status1="";$sort1="";$sort2="";$IdGenre="";$minchapter1="";$minchapter="";
	    $s1="";$s2="";$c1="";$c2="";$x1="";$x2="";$p1="";$p2="";$h1="";$genres3="";
		if(isset($_GET["status"])){
		 $c1="&";
		 $x2="&";
		 $h1="?";
		 $status="status=".$_GET["status"];
		}
		if(isset($_GET["country"])){
		 $s1="&";
		 $x1="&";
		 $h1="?";
		 $country="country=".$_GET["country"];
		}
		if(isset($_GET["sort"])){
		 $s2="&";
		 $c2="&";
		 $h1="?";		 
		 $sort="sort=".$_GET["sort"];
		}
	    if((isset($_GET["country"]) && isset($_GET["status"])) || (isset($_GET["country"]) && isset($_GET["sort"]))){
		 $p1="&";
		
		}
		if(isset($_GET["status"]) && isset($_GET["sort"])){
		 $p2="&";
		
		}
	
		if(isset($_GET["status"]) && isset($_GET["country"])&& isset($_GET["sort"])	){
			$Status_sort="$";
		}
		if(isset($_GET["page"])){
			$page="/trang-".tofloat($_GET["page"]);	
		}
		if(isset($_GET["genre"])){
		  $genres1=$_GET["genre"];
		  $genres2=$_GET["genre"]."/";
		}
	    if(isset($_GET["country"]))
		$country1=$_GET["country"];
     	if(isset($_GET["status"]))
		$status1=$_GET["status"];
	  	if(isset($_GET["sort"])){
		$sort1=$_GET["sort"];		
		}
		if(isset($_GET["IdGenre"])){
		 $IdGenre=$_GET["IdGenre"];
		 $genres3=$db->GetGenresByIdAndNameCode($IdGenre);
		}
	$banner=$db->GetAdvertisement();
	$domain=$_SERVER['SERVER_NAME'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<title><?=$genres3." - ".$domain?></title>
	<meta name="keywords" content="truyện <?=$genres3.",".$genres3?>">
	<meta name="description" content="Đọc truyện <?=$genres3?> mới nhất và nhanh nhất tại <?=$domain?>">
	<meta property="og:title" content="<?=$genres3." - ".$domain?>">
	<meta property="og:description" content="Đọc truyện <?=$genres3?> mới nhất và nhanh nhất tại <?=$domain?>">
	<link href="<?=$linkOption1.$genres1."-".$IdGenre?>.html" rel="canonical">
	<meta property="og:site_name" content="<?=$domain?>">
	<meta property="og:type" content="article">
	<meta property="og:url" content="<?=$linkOption1.$genres1."-".$IdGenre?>.html">
	<meta property="fb:pages" content="109139867535054">
	<meta name="copyright" content="Copyright © 2019 <?=$domain?>">
	<meta name="Author" content="<?=$domain?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="shortcut icon" href="<?php echo $linkOption;?>page/frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption;?>page/frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption;?>page/frontend/css/style.css">	  
    <script src="<?php echo $linkOption;?>page/js/main.js"></script>
    	<?php include 'googleAnalytics.php';?>
 </head>   
<input type="hidden" id="keyword-default" value="vợ">
<div class="outsite ">
<?php
require_once('header/headerDetail.php');
require_once('qc/bannerHeader.php'); 
?>
   
<section class="main-content">
    <div class="container story-list">
        
         <div class="title-list"> 
		 <?php
		 $pos = strpos($genres3, "Truyện");
		 if ($pos !== false) 
		   echo $genres3;
		 else echo "Truyện ".$genres3;
		 
		 
		 ?>
		 </div>
			<div class="box">
              <?php echo $db->GetTitleGenre($IdGenre);?>
            </div>
			<div class="story-list-bl01 box">
    <table>
        <tbody>
            <tr>
                <th>Thể loại truyện</th>
                <td>
                    <div class="select is-warning">
                        <select id="category">
						
                            <?php
							$arr2=$db->GetGenre();
							$i1=0; foreach($arr2 as $muc3) 
							{ 
							$i1++;
							if($muc3[ "Type"]==""){							
							 if($i1==1){ 
							?>
							
							<option selected value="<?=$linkOption1?><?=$muc3[ "NameEncode"]?>-<?=$muc3[ "Id"]?>.html"><?=$muc3[ "Name"]?></option>
							<?php
							}
							else{ 
							?>
							<option <?php if($genres1==$muc3[ "NameEncode"]) echo "selected";else echo "";?> value="<?=$linkOption1?><?=$muc3[ "NameEncode"]?>-<?=$muc3[ "Id"]?>.html"><?=$muc3[ "Name"]?></option>
							<?php
							  }
						     }
							}
							?>

                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <th>Tình trạng</th>
                <td>
                    <ul class="choose">
                        <li><a class="<?php if($status1=="0") echo "active"; else echo ""; ?>" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $s1?>status=0<?= $s2?><?= $sort?>">Đang tiến hành</a>
                        </li>
                        <li><a class="<?php if($status1=="1") echo "active"; else echo ""; ?>" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $s1?>status=1<?= $s2?><?= $sort?>">Hoàn thành</a>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Quốc gia</th>
                <td>
                    <ul class="choose">
                        <li><a class="<?php if($country1=="1")  echo "active";else echo ""; ?>" title="Truyện Trung Quốc" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?country=1<?= $c1?><?= $status?><?= $c2?><?= $sort?>">Trung Quốc</a>
                        </li>
                        <li><a class="<?php if($country1=="2")  echo "active";else echo ""; ?>" title="Truyện Việt Nam" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?country=2<?= $c1?><?= $status?><?= $c2?><?= $sort?>">Việt Nam</a>
                        </li>
                        <li><a class="<?php if($country1=="3")  echo "active";else echo ""; ?>" title="Truyện Hàn Quốc" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?country=3<?= $c1?><?= $status?><?= $c2?><?= $sort?>">Hàn Quốc</a>
                        </li>
                        <li><a class="<?php if($country1=="4")  echo "active";else echo ""; ?>" title="Truyện Nhật Bản" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?country=4<?= $c1?><?= $status?><?= $c2?><?= $sort?>">Nhật Bản</a>
                        </li>
                        <li><a class="<?php if($country1=="5")  echo "active";else echo ""; ?>" title="Truyện Mỹ" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?country=5<?= $c1?><?= $status?><?= $c2?><?= $sort?>">Mỹ</a>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>Sắp xếp</th>
                <td>
                    <div class="select is-warning">
                        <select id="category-sort">
                            <option <?php if($sort1==1) echo "selected"; else echo ""; ?> value="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $x1?><?= $status?><?= $x2?>sort=1">Ngày đăng giảm dần</option>
                            <option <?php if($sort1==2) echo "selected"; else echo ""; ?> value="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $x1?><?= $status?><?= $x2?>sort=2">Ngày đăng tăng dần</option>
                            <option <?php if($sort1==3) echo "selected"; else echo ""; ?> value="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $x1?><?= $status?><?= $x2?>sort=3">Ngày cập nhật giảm dần</option>
                            <option <?php if($sort1==4) echo "selected"; else echo ""; ?> value="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $x1?><?= $status?><?= $x2?>sort=4">Ngày cập nhật tăng dần</option>
                            <option <?php if($sort1==5) echo "selected"; else echo ""; ?> value="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $x1?><?= $status?><?= $x2?>sort=5">Lượt xem giảm dần</option>
                            <option <?php if($sort1==6) echo "selected"; else echo ""; ?> value="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?><?= $page?>.html?<?= $country?><?= $x1?><?= $status?><?= $x2?>sort=6">Lượt xem tăng dần</option>
                        </select>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
	

	<div class="tile is-ancestor">
		<div class="tile is-vertical is-parent">
		<?php
			$item_per_page = 42;
			$current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
			
			$Genre_1=$db->GetGenresByIdAndNameCode($IdGenre);	
			storiesList($db->GetGenreTop($country1,$status1,$sort1,$Genre_1,"",$item_per_page,$current_page),$linkOption);

			$offset = ($current_page - 1) * $item_per_page;			
			$totalRecords = $db->GetGenreTop($country1,$status1,$sort1,$Genre_1,"total",$item_per_page,$current_page);
			$db->dis_connect();
		?>
		</div>
	</div>
<?php
	require_once('pagination/paginationGenre.php');
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