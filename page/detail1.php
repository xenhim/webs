<?php 
	session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
		require_once('model/connection.php'); 
		require_once('function/function.php'); 
		$db=new config();
		$db->config();
		$user=0;
		$IdStory=$_GET["IdStory"];
		$subscribe_class="fas"; 
		$subscribe_text="Theo dõi";
		
		if(!isset($_SESSION['name_comment'])){
		 $_SESSION['name_comment']="";
		}
		if(!isset($_SESSION['subscribe']))
		$_SESSION['subscribe']=[];
		if(!isset($_SESSION['like']))
		$_SESSION['like']=[];

	if(isset($_SESSION['email'])){
		$user=$_SESSION['email'];
		$subscribe=$db->GetSubscribe($user);	
		if($subscribe!="" || $subscribe!="@"){
				$subscribe1=explode(",",$subscribe);
				if(array_search($IdStory,$subscribe1)!=[]){
					$subscribe_class="far"; 
					$subscribe_text="Huỷ theo dõi";
				}
			}
			
	}else{
		if($_SESSION['subscribe']!=[]){
			if(array_search($IdStory,$_SESSION['subscribe'])!=[]){
				$subscribe_class="far"; 
				$subscribe_text="Huỷ theo dõi";
				 
				
			}
		}		
	}

    $chapis = $db->GetChapter3($IdStory);
    //echo microtime(true)-$time;
        //print_r($chapis)."\n";
        //echo $chapis."\n";
        $data = $chapis;
    // Lấy giá trị từ khóa 'Name'
        $name = $data[0]['Name'];

    // Sử dụng biểu thức chính quy để tìm số trong chuỗi
        if (preg_match('/\d+/', $name, $matches)) {
        $numberchapis = $matches[0];
        //echo $number."\n";
        //print_r($number)."\n";
    }
        $datanumberchapis = $numberchapis;
        //print_r($datanumberchapis)."\n";
        //echo $data."\n";
        $datachap="[Tới Chap $datanumberchapis]";
        //echo $datachap."\n";
        $gach=" - ";
        $bb1=$gach.$datachap;
        //echo $bb1."\n";

		// $Sum_Subscribe=number_format($db->GetSumSubscribeStory($IdStory));
		// $Sum_Like=number_format($db->GetSumLikeStory($IdStory));
		// $Sum_Views=number_format($db->GetSumViewsStory($IdStory));
		$linkOption=siteURL();		
		$domain=$_SERVER['SERVER_NAME'];
		$linkOption1=$linkOption."page/";
		$banner=$db->GetAdvertisement();
		
		$arr= $db->GetIdStory($IdStory);
		$the_loai="truyen-tranh/";
	    if($arr[14]==1)
		$the_loai="tieu-thuyet/";
		if($arr==[])
			header("location:".$linkOption);
		$Sum_Subscribe=$arr[16];
		$Sum_Like=$arr[17];
		$Sum_Views=$arr[18];
		$gach="";
		if($arr[2]!="")
			$gach=" - ";
		//str_replace(";", " - ",$arr[1])
		//str_replace(";", " - ",$arr[2])
		
		
		//require_once('getChap2.php'); 
		
?>

<!DOCTYPE html>
<html lang="vi">

<head>
   <meta charset="utf-8">
    <title><?=$arr[1].$bb1?> Tiếng Việt - <?=$domain?></title>
    <meta name="keyword" content="<?=$arr[1].",".$arr[1]?> tiếng việt,đọc truyện tranh <?=$arr[1]?>,truyện <?=$arr[1].$gach.str_replace(";", " - ",$arr[2])?>">
    <meta name="description" content="❶✔️ Đọc truyện tranh <?=$arr[1].$gach.str_replace(";", " - ",$arr[2])?> tiếng việt. Mới nhất nhanh nhất tại <?=$domain?>">
    <meta itemprop="description" content="❶✔️ Đọc truyện tranh <?=$arr[1].$gach.str_replace(";", " - ",$arr[2])?> tiếng việt. Mới nhất nhanh nhất tại <?=$domain?>">
    <meta itemprop="name" content="<?=$arr[1]?>">
    <meta itemprop="image" content="<?=$arr[0]?>">
    <meta property="og:title" content="<?=$arr[1].$bb1?> Tiếng Việt">
    <meta property="og:description" content="❶✔️ Đọc truyện tranh <?=$arr[1].$gach.str_replace(";", " - ",$arr[2])?> tiếng việt. Mới nhất nhanh nhất tại <?=$domain?>">
    <meta property="og:image" content="<?=$arr[0]?>">
    <link rel="canonical" href="<?=$linkOption.$the_loai?><?=vn_str_filter($arr[1])."-".$arr[15]?>">
    <meta property="og:site_name" content="<?=$domain?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?=$linkOption.$the_loai?><?=vn_str_filter($arr[1])."-".$arr[15]?>">
    <meta property="fb:pages" content="118730167811356">
    <meta name="copyright" content="Copyright © 2023 <?=$domain?>">
    <meta name="Author" content="<?=$domain?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico?v=1.1" type="image/x-icon">
   
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">
    <style>
        


.socials-share a {
    padding: 4px 30px;
    color: #fff;
    line-height: 2em;
    text-decoration: none;
    border-radius: 2px;
    white-space: nowrap;
    display: inline-block;
    margin-bottom: 4px;
}

.socials-share span.fa {
    margin-right: 3px;
}

.bg-facebook {
    background: #3a5899;
}

.bg-facebook:hover, .bg-facebook:focus {
    background: #1d418d;
}

.bg-twitter {
    background: #00acee;
}

.bg-twitter:hover, .bg-twitter:focus {
    background: #0b93c7;
}

.bg-google-plus {
    background: #db4437;
}

.bg-google-plus:hover, .bg-google-plus:focus {
    background: #bb2a1d;
}

.bg-pinterest {
    background: #cb1e26;
}

.bg-pinterest:hover, .bg-pinterest:focus {
    background: #ae0e15;
}

.bg-email {
    background: #dd5348;
}

.bg-email:hover, .bg-email:focus {
    background: #ce3f34;
}
    </style>
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0&appId=677674087348142" nonce="otfVAtjy"></script>

                                                                                                                                  
<?php include 'googleAnalytics.php';?>
</head>

<body>
    <input type="hidden" id="keyword-default" value="one">
    <div class="outsite ">
         <?php
		 require_once('header/headerDetail.php');
		 //require_once('library/get_html.php');
		 //require_once('qc/bannerHeader.php'); 
		 
		 require_once('qc/bannerHeader.php');
		 $url = $db->GetUrl1($IdStory);
		//$html=file_get_html($url);
							
		
		 ?>
		
        <section class="main-content">
            <div class="container has-background-white story-detail">
                <div id="path">
                    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="<?=$linkOption?>">
                                <span itemprop="name">Trang Chủ</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<?php
						 echo '<a href="'.$linkOption.$the_loai.vn_str_filter($arr[1])."-".$IdStory.'" title="'.$arr[1].'">';
						  //echo '<a itemprop="item" href="detail.php?IdStory='.$IdStory.'">';
                                echo '<span itemprop="name">'.$arr[1].'</span>';
                          echo '</a>';
						?>
                           
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </div>
                <div class="block01">
                    <div class="left"><img src="<?php echo $arr[0]?>" alt="<?php echo $arr[1];?>" />
                    </div>
                    <div class="center" itemscope="" itemtype="http://schema.org/Book">
                        <h1 itemprop="name"><?php echo $arr[1]?></h1>
                        <div class="txt">
							<?php if($arr[2]!="") echo '<span class="info-item">Tên Khác: '.$arr[2].'</span>';?>
                           
                            
							<?php 
							$AuthorArr=ConvertStrToArr($arr[7]);
							if($arr[7]!=""){
								echo '<p class="info-item">Tác giả: ';
									
									for($i=0;$i<count($AuthorArr);$i++){
										$IdAuthor=$db->GetIdAuthor($AuthorArr[$i]);
										if($i==0)
										echo '<a class="org" href="'.$linkOption.'tac-gia/'.vn_str_filter($AuthorArr[$i]).'-'.$IdAuthor.'.html">'.$AuthorArr[$i].'</a>';
										else echo ', <a class="org" href="'.$linkOption.'tac-gia/'.vn_str_filter($AuthorArr[$i]).'-'.$IdAuthor.'.html">'.$AuthorArr[$i].'</a>';
									}
								echo '</p>';
							}
							?>
							
                            <p class="info-item">Tình trạng: <?php echo $arr[3]?></p>
                            <div>
                                <span>Thống kê:</span>
                                <span class="sp01"><i class="fas fa-thumbs-up"></i> <span class="sp02 number-like"><?=$Sum_Like?></span></span>
                                <span class="sp01"><i class="fas fa-heart"></i> <span class="sp02"><?=$Sum_Subscribe?></span></span>
                                <span class="sp01"><i class="fas fa-eye"></i> <span class="sp02"><?=$Sum_Views?></span></span>
                            </div>
                        </div>
                       
						<?php
						
						  $Genre = explode(",", $arr[8]);
						  if($arr[8]!=""){
						   echo '<ul class="list01">';
						  for($i=0;$i<count($Genre);$i++){
							  $genre12=$db->GetIdGenre($Genre[$i]);
							  echo  '<li class="li03"><a href="'.$linkOption.'the-loai/'.vn_str_filter($Genre[$i]).'-'.$genre12.'.html">'.$Genre[$i].'</a></li>';
							  
							  
						  }
						  $chapStar="";
						  $arr2 = $db->GetChapter2($IdStory); 
								foreach($arr2 as $muc2) { 

									$chapStar=$linkOption.$the_loai.vn_str_filter($arr[1])."-".$IdStory."-chap-".tofloat($muc2['Name']).".html";
									//break;
								} 
							echo '</ul>';
						  }							
						?> 
                       
                        <ul class="story-detail-menu">
                            <li class="li01"><a href="<?=$chapStar?>" class="button is-danger is-rounded"><span class="btn-read"></span>Đọc từ đầu</a>
                            </li>
                            <li class="li02"><a href="javascript:void(0);" class="button is-danger is-rounded btn-subscribe subscribeBook" data-page="index" data-id="<?=$IdStory?>"><span class="<?=$subscribe_class?> fa-heart"></span><?=$subscribe_text?></a>
                            </li>
                            <li class="li03"><a href="javascript:void(0);" class="button is-danger is-rounded btn-like" data-id="<?=$IdStory?>"><span class="fas fa-thumbs-up"></span>Thích</a>
                            </li>
                            <!--<li class="li04"><a href="#" class="button is-info is-rounded"><span class="btn-request"></span>Đọc tiếp</a>-->
                            </li>
                        </ul>
                        <div class="txt txt01 story-detail-info" itemprop="description">
                            <p>
							<?php echo $arr[4]?>
							</p>
                        </div>
                    </div>
                </div>
                <ul class="story-detail-menu">
                    <!--<li class="li01"><a href="" class="button is-danger is-rounded"><span class="btn-read"></span>Đọc từ đầu</a>-->
                    </li>
                    <li class="li02"><a href="javascript:void(0);" class="button is-danger is-rounded btn-subscribe subscribeBook" data-page="index" data-id="<?=$IdStory?>"><span class="<?=$subscribe_class?> fa-heart"></span><?=$subscribe_text?></a>
                    </li>
                    <li class="li03"><a href="javascript:void(0);" class="button is-danger is-rounded btn-like" data-id="<?=$IdStory?>"><span class="fas fa-thumbs-up"></span>Thích</a>
                    </li>
                    <!--<li class="li04"><a href="" class="button is-info is-rounded"><span class="btn-request"></span>Đọc tiếp</a>-->
                    </li>
                </ul>
				<?php if($arr[6]=="Nhạy Cảm"){?>
				<p class="alert alert-danger warning-info">
                <span>Cảnh báo độ tuổi:</span>
                Truyện tranh <?=$arr[1]?> có thể có nội dung và hình ảnh nhạy cảm, không phù hợp với lứa tuổi của bạn. Nếu bạn dưới 16 tuổi, vui lòng chọn một truyện khác để giải trí. Chúng tôi sẽ không chịu trách nhiệm liên quan nếu bạn bỏ qua cảnh báo này.
				
				</p>
				<?php }
				
				require_once('qc/bannerDetail.php'); 
				?>
				
				
                <div class="block02">
                    <div class="title">
                        <h2 class="story-detail-title">Danh sách chương</h2>
                    </div>
                    <div class="box">
                        <div class="works-chapter-list">
                            <?php 
										
	
							//$countChap=$db->GetCountChapter($IdStory);
								
							//$sum=$html->find('div.works-chapter-list div.works-chapter-item');
							
							// foreach($sum as $tam)
							// { 
							
								// echo "<h1 style='color:red;'>".$tam->find('div.works-chapter-list div.works-chapter-item',0)."</h1>";
							// }
							//$listChapter=$db->GetChapterFull($IdStory);
							
							// if($countChap<=count($sum)){
								
								 // $b1=$html->find('div.works-chapter-list');
								// for($i=0;$i<count($sum);$i++){
									
									// $str_1=strpos($html->find('div.works-chapter-list div.works-chapter-item a',$i)->innertext,"-");
									// $name="";
									// if($str_1==""){
										// $name=$html->find('div.works-chapter-list div.works-chapter-item a',$i)->innertext;
									// }else{
										// $name=substr($html->find('div.works-chapter-list div.works-chapter-item a',$i)->innertext,0,$str_1-1);
										
									// }
									
									
									// if(array_search($name, $listChapter)==""){		
										// $NameAnother=$name;
										// $Summary="Ẩn";
										// $DateUpload=$html->find('div.works-chapter-list div.works-chapter-item div.text-right',$i)->innertext;
										// //echo $name;
										// $db->UpdateChapter($name,$NameAnother,$Summary,$DateUpload,$IdStory);
									// }
									
								// }
							// }
							 date_default_timezone_set("Asia/Ho_Chi_Minh");
						    //$time = microtime(true);	
							$arr2 = $db->GetChapter2($IdStory); 
							//echo microtime(true)-$time;
								foreach($arr2 as $muc2) { 
							
									echo '<div class="works-chapter-item row">'; 
									echo '<div class="col-md-10 col-sm-10 col-xs-8 ">';
									if($muc2['Title']!="")
										$title1=" - ".$muc2['Title'];
									else $title1=$muc2['Title'];
									$kk1=$linkOption.$the_loai.vn_str_filter($arr[1])."-".$IdStory."-chap-".tofloat($muc2['Name']).".html";
									echo '<a target="_blank" href="'.$kk1.'">'.$muc2['Name'].$title1.'</a>';
									
									echo '</div>'; 
									echo ' <div class="col-md-2 col-sm-2 col-xs-4 text-right">'.date("d/m/Y", strtotime($muc2['DateUpload'])).'</div>'; echo '</div>'; 
								
								} 
								//echo count($sum);
								// if(!empty($sum)){
									// for($i=0;$i<count($sum);$i++){
										// foreach($b1 as $item){
											
											// $c=$item->find('div.works-chapter-list div.works-chapter-item a',$i)->innertext;
											// $d=$item->find('div.works-chapter-list',$i)->innertext;
											// echo $c;
							// // echo '<div class="works-chapter-item row">'; 
							// // echo '<div class="col-md-10 col-sm-10 col-xs-8 ">';
							// // echo '<a target="_blank" href="">'.$c.'</a>';
							// // echo '</div>'; 
							// // echo ' <div class="col-md-2 col-sm-2 col-xs-4 text-right">'.$d.'</div>'; echo '</div>'; 
											
											// //$i++;
										// }
									// }
									
								// }
							
								
								?>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="book_id" value="<?=$IdStory?>" />
                <input type="hidden" id="total_page" value="" />
                <input type="hidden" id="parent_id" value="" />
                <input type="hidden" id="episode_name" value="" />
                <input type="hidden" id="episode_id" value="" />
                <input type="hidden" id="slug" value="<?=vn_str_filter($arr[1])?>" />
				<input type="hidden" id="team_id" value="0">												  
               	<?php
					$countComment=$db->GetCountComment($IdStory);
					
					require_once('comment.php');
										
				?>
            </div>
        </section>
      
	 <?php 
		require_once('footer/footer.php');
		
	 ?>
	 <script type="text/javascript">
		var m = 0;
		m=<?php echo json_encode($user);?> ;
		if (m==0){
			m=0;  			
		}
	var m2 = <?php echo json_encode($IdStory); ?> 
	var linkOption1 = <?php echo json_encode($linkOption1); ?> 
	var Type_Chapter=1;
	var name_comment=<?php echo json_encode($_SESSION['name_comment'])?>;
	</script>
	<script async="" src="<?=$linkOption1?>js/comment/binhluan.js"></script>
	<script type="text/javascript">
		setTimeout(function() {
			document.getElementById("load_comments").click();
		}, 1000);
	</script>	
        <?php
	      require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php		  
	    require_once('qc/bannerContent.php');
		$db->dis_connect();//ngat ket noi mysql	
	  ?>
	  
<section class="footer">
    <div class="container">
        <div class="level">
            <div class="level-left">
                <div class="col-sm-4 text-center" itemscope="" itemtype="http://schema.org/Organization">
                    <a itemprop="url" href="//xemtruyen.xyz">
                        <img itemprop="logo" src="https://xemtruyen.xyz/page/frontend/images/logo-xemtr4.png" alt="XemTruyen.Xyz - Truyện tranh Online">
                    </a>
                </div>
                <div class="text-footer">Quảng Cáo: admin@xemtr.com</div>
            </div>
            <div class="level-right">
                <ul class="social-links">
                    <li><a rel="nofollow noopener" href="https://itunes.apple.com/us/app/truyenqq/id1282215661?ls=1&amp;mt=8"><span class="app-store-icon"></span></a></li>
                    <li><a rel="nofollow noopener" href="https://play.google.com/store/apps/details?id=com.xemtruyen.xyz.pro"><span class="google-play-icon"></span></a></li>
                </ul>
                <!-- /.social-links -->
            </div>
        </div>
    </div>
</section>		  
</body>
</html>