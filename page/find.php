<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


		include($_SERVER['DOCUMENT_ROOT'].'/page/model/connection.php');
		include($_SERVER['DOCUMENT_ROOT'].'/page/function/function.php');
		//require_once('model/connection.php'); 
		//require_once('function/function.php'); 		
		$db=new config();
		$db->config();
		$linkOption=siteURL();
		$linkOption1=$linkOption."tim-kiem-nang-cao/";	
		$metaFind=$db->GetMetaSeoFind();
		$domain=$_SERVER['SERVER_NAME'];
		$banner=$db->GetAdvertisement();
		
		
?>

<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="utf-8">
    <title>Tìm kiếm nâng cao - <?=$domain?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta property="og:title" content="Tìm kiếm nâng cao - <?=$domain?>">
    <meta property="og:description" content="">
    <link href="<?=$linkOption?>tim-kiem-nang-cao.html" rel="canonical">
    <meta property="og:site_name" content="<?=$domain?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption?>tim-kiem-nang-cao.html">
    <meta property="fb:pages" content="109139867535054">
    <meta name="copyright" content="Copyright © 2022 <?=$domain?>">
    <meta name="Author" content="<?=$domain?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="<?php echo $linkOption;?>page/frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption;?>page/frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption;?>page/frontend/css/style.css">	
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption;?>page/frontend/find/read.css" />	
    <script src="<?php echo $linkOption;?>page/js/main.js"></script>
	<script src="<?php echo $linkOption;?>page/js/find/find.js"></script>
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
			<div class="title-list">Tìm kiếm nâng cao</div>
			<div class="story-list-bl01 box">
				<div class="text-center">
					<button type="button" class="btn btn-info btn-collapse">
						<?php
						  	$advsearch="";				
						   if(isset($_GET["category"])){
						        $advsearch="hidden";
							    	
								echo '<span class="show-text hidden">Hiện </span>';
						        echo '<span class="hide-text">Ẩn </span>khung tìm kiếm';
						   }else{
							 
							   echo '<span class="show-text">Hiện </span>';
						       echo '<span class="hide-text hidden">Ẩn </span>khung tìm kiếm';
						   }		
						?>
						
					</button>
				</div>
				<div class="advsearch-form  <?=$advsearch?>">
					<div class="form-group clearfix">
						<p><span class="icon-tick"></span> Tìm trong những thể loại này</p>
						<p><span class="icon-cross"></span> Loại trừ những thể loại này</p>
						<p><span class="icon-checkbox"></span> Truyện có thể thuộc hoặc không thuộc thể loại này</p>
					</div>
					<div class="form-group row text-center">
						<a class="btn btn-primary btn-sm btn-reset" href="<?php echo $linkOption."tim-kiem-nang-cao.html";?>"><i class="fa fa-repeat"></i> Reset</a>
					</div>
					<div class="form-group row">
						<!-- <label class="col-sm-5 col-form-label">Thể loại truyện</label> -->
						<div class="label-search">Thể loại truyện</div>
						<div class>
						<?php
					
						 $arr2 = $db->GetGenres();
						 $arrCountry=$db->GetCountryFind();
						 $arrStatus=$db->GetStatusFind();
						 $arrMinchapter=$db->GetMinchapterFind();
						 $arrSort=$db->GetSortFind();
						 function searchCategory($b,$a){
							 $c=0;
							
							foreach ($a as $value) {
							 if($b==$value){
									$c=1;
									break;
								}
							}
							return $c;
						 }
						 $category="";$notcategory="";$category1="";$notcategory1="";$country="";$status="";$minchapter=0;$sort="";
						 if(isset($_GET["category"])){
							 $category=$_GET["category"];
							 $category1=$_GET["category"];
							 if($category !=""){									
								 $category = explode(",", $category);
							 }
						 }
						
						 if(isset($_GET["notcategory"])){
							 $notcategory=$_GET["notcategory"];
							 $notcategory1=$_GET["notcategory"];
							  if($notcategory !=""){									
								 $notcategory = explode(",", $notcategory);
							 }
						 }
						 if(isset($_GET["country"])){
							 $country=$_GET["country"];
						 }
						 if(isset($_GET["status"])){
							 $status=$_GET["status"];
						 }
						 if(isset($_GET["minchapter"])){
							 $minchapter=$_GET["minchapter"];
						 }
						 if(isset($_GET["sort"])){
							 $sort=$_GET["sort"];
						 }
						 // if(isset($_GET["page"])){
							// $page="/trang-".tofloat($_GET["page"]);	
						 // }
						 foreach($arr2 as $muc3){				
							$iconCheck="icon-checkbox";
							if($category !=""){
								if(searchCategory($muc3['Id'],$category)==1){
									$iconCheck="icon-tick";
								}
							}
							if($notcategory !=""){
								if(searchCategory($muc3['Id'],$notcategory)==1){
									$iconCheck="icon-cross";
								}	
							}								
							//echo '<div class="col-md-3 col-sm-4 col-xs-6 mrb10">';
								echo '<div class="genre-item" title="'.$muc3['Title'].'">';
									echo '<span class="'.$iconCheck.'" data-id="'.$muc3['Id'].'">';
								echo '</span>'.$muc3['Name'].' </div>';
							//echo '</div>';
						   }
						  
						?>
						   
							
						</div>
					</div>

					<div class="form-group row">
						<label for="country" class="col-sm-2 col-form-label">Quốc gia</label>
						<div class="col-sm-4">
							<div class="select select-search is-warning">
								<select class="custom-select" id="country">
								<?php
								foreach($arrCountry as $muc3){
											$select="";
											if($muc3["Type"]==$country){
												$select='selected=""';
											}
											 echo '<option '.$select.' value="'.$muc3["Type"].'">'.$muc3['Name'].'</option>';
								  }
								?>
								</select>
							</div>
						</div>

						<label for="country" class="col-sm-2 col-form-label">Tình Trạng</label>
						<div class="col-sm-4">
							<div class="select select-search is-warning">
								<select class="custom-select" id="status">
								<?php
								foreach($arrStatus as $muc3){
									$select="";
									if($muc3["Type"]==$status){
										$select='selected=""';
									}
									 echo '<option '.$select.' value="'.$muc3["Type"].'">'.$muc3['Name'].'</option>';
						  
								}	   
								?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="country" class="col-sm-2 col-form-label">Số lượng chương</label>
						<div class="col-sm-4">
							<div class="select select-search is-warning">
								<select class="custom-select" id="minchapter">
								   <?php
								   foreach($arrMinchapter as $muc3){
									$select="";
									if($muc3["Type"]==$minchapter){
										$select='selected=""';
									}
									 echo '<option '.$select.' value="'.$muc3["Type"].'">'.$muc3['Name'].'</option>';
						  
						  }	  
								   ?>
								</select>
							</div>
						</div>

						<label for="country" class="col-sm-2 col-form-label">Sắp xếp</label>
						<div class="col-sm-4">
							<div class="select select-search is-warning">
								<select class="custom-select" id="sort">
									<?php
									foreach($arrSort as $muc3){
									$select="";
									if($muc3["Type"]==$sort){
										$select='selected=""';
									}
									 echo '<option '.$select.' value="'.$muc3["Type"].'">'.$muc3['Name'].'</option>';
						  
									}	   		
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group clearfix">
						<div class="text-center">
							<button type="button" class="btn btn-success btn-search is-danger">Tìm kiếm</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tile is-ancestor">
				<div class="tile is-vertical is-parent">
				<?php
						$item_per_page = 42;
						$current_page = !empty($_GET['page'])?tofloat($_GET['page']):1; //Trang hiện tại
						$category_notcategory="";
						if($category!=""){
							for($i=0;$i<count($category);$i++){
								$c11=$db->GetGenresByIdAndNameCode($category[$i]);
								$category_notcategory.=" and Genre LIKE '%".$c11."%'";	
								
								
							}
						}
						if($notcategory!=""){
							for($i=0;$i<count($notcategory);$i++){
								$c11=$db->GetGenresByIdAndNameCode($notcategory[$i]);
								$category_notcategory.=" and Genre not LIKE '%".$c11."%'";
									
								
							}
						}
						$arr=$db->GetFind($category_notcategory,$country,$status,$minchapter,$sort,"",$item_per_page,$current_page);
						storiesList($arr,$linkOption);
						
						$totalRecords = $db->GetFind($category_notcategory,$country,$status,$minchapter,$sort,"total",$item_per_page,$current_page);	
						$db->dis_connect();//ngat ket noi mysql		
				?>
				</div>
		    </div>
<?php
	require_once('pagination/paginationFind.php');
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