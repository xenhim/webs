<?php

	session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
	require_once('page/model/connection.php'); 
	require_once('page/function/function.php'); 	
	$db=new config();
	$db->config();
	//echo $_SERVER['SERVER_NAME'];
	$linkOption=siteURL();
	$linkOption1=$linkOption."page/";
	$banner=$db->GetAdvertisement();
	$domain=$_SERVER['SERVER_NAME'];
	$On="";
	if(isset($styleOn))
	$On="dark";	
?>
<!DOCTYPE html>
<html lang="vi">
   <head>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  <title>Truyện tranh online - truyện tranh online ngôn tình full !!</title>
	  <meta name="keyword" content="truyện tranh online, truyện tranh đam mỹ, truyện tranh bách hợp hàn quốc, truyện tranh xuyên không cổ đại, truyện tranh audio, truyện tranh ngôn tình full">
	  <meta name="description" content="Web Truyện tranh online lớn nhất được cập nhật liên tục mỗi ngày - truyện tranh online ngôn tình full, truyện tranh đam mỹ, truyện tranh xuyên không cổ đại">
	  
	  <meta property="og:title" content="truyện tranh online ngôn tình full, truyện tranh đam mỹ, truyện tranh bách hợp hàn quốc, truyện tranh xuyên không cổ đại, truyện tranh audio">
      <meta property="og:type" content="website">
      <meta property="og:url" content="https://xemtruyen.xyz/">
	  <meta property="og:site_name" content="<?=$domain?>">
	  <meta property="og:type" content="article">     
	  <meta property="fb:admins" content="100089719301203">
	  <meta property="fb:pages" content="118730167811356">	 
	  <meta name="copyright" content="Copyright © 2023 <?=$domain?>">
	  <meta name="Author" content="<?=$domain?>">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=6.0, user-scalable=yes">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="<?php echo $linkOption1;?>frontend/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/read.css">	  
    <link rel="stylesheet" type="text/css" href="<?php echo $linkOption1;?>frontend/css/style.css">
    <script src="<?php echo $linkOption1;?>js/main.js"></script>
    <script src="<?php echo $linkOption1;?>js/detect.dev.js"></script>
	   
	<!-- Global site tag (gtag.js) - Google Analytics 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QX4G2G08TN"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QX4G2G08TN');
</script>
-->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?=$linkOption.$the_loai?><?=vn_str_filter($arr[1])."-".$arr[15]?>"
  },
  "headline": "Xem Truyện tranh online - truyện tranh online ngôn tình full !!",
  "description": "❶✔️ Đọc truyện tranh <?=$arr[1].$gach.str_replace(";", " - ",$arr[2])?> tiếng việt. Mới nhất nhanh nhất tại <?=$domain?>",
  "image": "https://xemtruyen.xyz/wp-content/uploads/2023/09/logo-xemtr4.png",  
  "author": {
    "@type": "Person",
    "name": "XemTruyen",
    "url": "<?=$domain?>"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "XemTruyen",
    "logo": {
      "@type": "ImageObject",
      "url": "https://xemtruyen.xyz/wp-content/uploads/2023/09/logo-xemtr4.png"
    }
  },
  "datePublished": "<?=$published_time?>",
  "dateModified": "<?=$published_time?>"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebPage",
  "name": "<?=$arr[1]?>",
  "description": "❶✔️ Đọc truyện tranh <?=$arr[1].$gach.str_replace(";", " - ",$arr[2])?> tiếng việt. Mới nhất nhanh nhất tại <?=$domain?>",
  "image": "<?=$arr[0]?>",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://xemtruyen.xyz/tim-kiem.html?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebSite",
  "name": "XemTruyen",
  "url": "https://xemtruyen.xyz",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://xemtruyen.xyz/tim-kiem.html?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "AggregateRating",
      "itemReviewed": {
        "@type": "Book",
        "image": "https://xemtruyen.xyz/wp-content/uploads/2023/09/logo-xemtr4.png",
        "name": "XemTruyen.Xyz"
      },
      "ratingValue": "88",
      "bestRating": "100",
      "ratingCount": "20"
    },
    </script>
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ClaimReview",
      "url": "<?=$domain?>",
      "claimReviewed": "XemTruyen.Xyz",
      "itemReviewed": {
        "@type": "Claim",
        "author": {
          "@type": "Organization",
          "name": "Xem Truyện tranh online - XemTruyen.Xyz",
          "sameAs": "<?=$domain?>"
        },
        "datePublished": "2023-06-20T08:00:00+08:00",
        "appearance": {
          "@type": "OpinionNewsArticle",
          "url": "<?=$domain?>",
          "headline": "<?=$domain?> - Xem Truyện tranh online",
          "datePublished": "2023-06-22T08:00:00+08:00",
          "author": {
            "@type": "Person",
            "name": "Xem Truyện tranh online - XemTruyen.Xyz",
            "url": "<?=$domain?>"
          },
          "image": "https://xemtruyen.xyz/wp-content/uploads/2023/09/logo-xemtr4.png",
          "publisher": {
            "@type": "Organization",
            "name": "<?=$domain?>",
            "logo": {
              "@type": "ImageObject",
              "url": "https://xemtruyen.xyz/wp-content/uploads/2023/09/logo-xemtr4.png"
            }
          }
        }
      },
      "author": {
        "@type": "Organization",
        "name": "<?=$domain?> Xem Truyện tranh online"
      },
      "reviewRating": {
        "@type": "Rating",
        "ratingValue": "4.5",
        "bestRating": "5",
        "worstRating": "1",
        "alternateName": "False"
      }
    }
</script>
<?php include './page/googleAnalytics.php';?>
	   
   </head>
   <body class="hompage <?= $On?>">
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root" class=" fb_reset">
         <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
            <div></div>
         </div>
      </div>
     <!-- <input type="hidden" id="keyword-default" value="black"> -->
      <div class="outsite <?= $On?>">
         <?php 
		 require_once('page/header/headerDetail.php');		 
		 ?>
         <!-- /.top-bar -->
       
         <!-- /.login-modal -->
    
         <!-- /.notify-modal -->
        
         <!-- /.main-menu --> 
		<?php
			$tempStory="temp/slider.txt";
			
			$myfile = fopen($tempStory, "r") or die("Unable to open file!");
			if(filesize($tempStory) > 0){
			$name1=fread($myfile,filesize($tempStory));	
			fclose($myfile);
		?>
         <section class="hero <?= $On?>">
            <div class="container <?= $On?>">
			<?php			
			$arr1=$db->GetSliderStory();
			/////////////////////////////
		
			
			date_default_timezone_set("Asia/Ho_Chi_Minh");
			$myJSON=array();
			$dateStart=date('Y-m-d H:i:s');	
			foreach($arr1 as $muc3){			
				$myObj = new stdClass();
				$myObj->dateRandom = $dateStart;
				$myObj->Id = $muc3['Id'];
				$myObj->IdStory = $muc3["IdStory"];	
				$myObj->Name =$muc3["Name"];
				$myObj->Path = $muc3["Path"];
				$myObj->Genre = $muc3["Genre"];
				$myObj->Content = $muc3["Content"];
				$myObj->NameUpdate_Chap = $muc3["NameUpdate_Chap"];
				$myObj->DateUpdate_Chap = $muc3["DateUpdate_Chap"];
				$myObj->Male = $muc3["Male"];
				array_push($myJSON,json_encode($myObj));
				
			}		
			
			
			$temp=convert_string_json($name1);	
			 $o = json_decode($db->chuyen_timer($temp[0]["dateRandom"],$dateStart));	 	
			 if($o->years!=0 || $o->months!=0 || $o->days!=0 || $o->hours!=0) {
					$myfile2 = fopen($tempStory, "w") or die("Unable to open file!");
					fwrite($myfile2, implode(',',$myJSON));
					fclose($myfile2);  
			 }
			 else if($o->minutes!=0) {
				 if($o->minutes>=1){
					$myfile2 = fopen($tempStory, "w") or die("Unable to open file!");
					fwrite($myfile2, implode(',',$myJSON));
					fclose($myfile2); 
				 }
			 }
			////////////////////////////
			?>
               <div class="tile is-ancestor">
			   <?php
				$i=0;
			$random=array("violet","green","orange","blue","red");
			shuffle($random);
			
			   foreach($temp as $muc3)			   			   
			   {
				   $the_loai="truyen-tranh/";
				if($muc3['Male']==1)
				   $the_loai="tieu-thuyet/";   
				$NameStory=$db->GetNameStory($muc3['IdStory']);
$ChapSlider=$linkOption.$the_loai.vn_str_filter($NameStory)."-".$muc3['IdStory']."-chap-".tofloat($muc3['NameUpdate_Chap']).".html";
				$i++;
			 if($i==1 || $i==2){
				if($i==1)	   
				echo '<div class="tile is-3 is-vertical is-parent">';           
                   echo  '<div class="tile is-child">';			  
                     echo   '<a href="'.$ChapSlider.'">';
                         echo  '<div class="hero-item">';
                             echo '<img class="cover" src="page/'.$muc3['Path'].'" alt="cover" width="290px" height="191px">';
                              echo'<div class="bottom-shadow"></div>';
                              echo '<div class="captions">';
                                echo '<h3>'.$muc3['Name'].'</h3>';
								echo'</div>';
                              echo'<div class="chapter '.$random[$i-1].'">'.$muc3['NameUpdate_Chap'].'</div>';
                           echo'</div>';
                          
				echo'</a>';
				echo'</div>';
				
				if ($i==2) echo'</div>';
				
				}
                if($i==3){
				echo '<div class="tile is-parent">';
                 echo '<div class="tile is-child">';
                       echo   '<a href="'.$ChapSlider.'">';
                         echo  '<div class="hero-item has-excerpt">';
                            echo  '<img class="cover" src="page/'.$muc3['Path'].'" alt="cover">';
                             echo '<div class="bottom-shadow"></div>';
								echo '<div class="captions">';
                                 echo '<h5>Thể loại: '.$muc3['Genre'].'</h5>';
                                echo '<h3>'.$muc3['Name'].'</h3>';
                              echo '</div>';
                              echo '<div class="chapter '.$random[$i-1].'">'.$muc3['NameUpdate_Chap'].'</div>';
								echo '<div class="excerpt">'.ConvertStr($muc3['Content'],3).'</div>';
                           echo '</div>';                       
                        echo '</a>';
                     echo '</div>';
				echo '</div>';
				 }
				if($i==4 || $i==5){
				if($i==4)	   
				echo '<div class="tile is-3 is-vertical is-parent">';           
                   echo  '<div class="tile is-child">';
                     echo   '<a href="'.$ChapSlider.'">';
                         echo  '<div class="hero-item">';
                             echo '<img class="cover" src="page/'.$muc3['Path'].'" alt="cover" width="290px" height="191px">';
                             echo '<img class="cover" src="page/'.$muc3['Path'].'" alt="cover" width="290px" height="191px">';
                              echo'<div class="bottom-shadow"></div>';
                             echo '<div class="captions">';
                                echo '<h3>'.$muc3['Name'].'</h3>';
								echo'</div>';
                              echo'<div class="chapter '.$random[$i-1].'">'.$muc3['NameUpdate_Chap'].'</div>';
                           echo'</div>';
                          
				echo'</a>';
				echo'</div>';
				if ($i==5) echo'</div>';
				}				   					  			   			   
			   }
			
				?>
               </div>
            </div>
         </section>
         <!-- /.hero -->   
		<?php
			}
		$arr_Release=$db->GetRelease();		
		$date_Release=date("d/m/Y", strtotime(date('Y-m-d')));
		
		if(count($arr_Release)>0){
		?>	
         <section class="schedule">
            <div class="container">
               <div class="schedule-inner">
                  <div class="time">
                     Lịch Ra Truyện Ngày <?php echo $date_Release ?>      
                  </div>
                  <!-- /.time -->
                  <ul class="schedule-list">
				     <?php
					 foreach($arr_Release as $muc3)	{
							 $the_loai="truyen-tranh/";
							if($muc3['Male']==1)
							   $the_loai="tieu-thuyet/"; 
							echo '<li><a href="'.$the_loai.vn_str_filter($muc3['Name']).'-'.$muc3['IdStory'].'.html"><strong class="'.$muc3['Type'].'">['.$muc3['TimeRelease'].']</strong> '.$muc3['Name'].' - Chương '.$muc3['NameChap'].'</a></li>';
						}
					 ?>
                     
                    
                  </ul>
                  <!-- /.schedule-list -->
               </div>
               <!-- /.schedule-inner -->
            </div>
         </section>
         <!-- /.schedule -->
<div style="" class="homepage_suggest">
    <h2>
        <p class="text_list_hot">
            <i class="fa fa-star"></i> Truyện hay
        </p>
    </h2>
    <div id="div_suggest">
        <ul class="list_grid grid" id="list_suggest" style="margin-left: -690px;">
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/bach-luyen-thanh-than-1099"><img class="center" src="https://i.truyenvua.com/ebook/190x247/bach-luyen-thanh-than_1444715692.jpg?gt=hdfgdfg&amp;mobile=2" alt="Bách Luyện Thành Thần"></a>
                    <div class="top-notice">
                        <span class="time-ago">8 Giờ Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Bách Luyện Thành Thần" href="https://truyenqqvn.com/truyen-tranh/bach-luyen-thanh-than-1099">Bách Luyện Thành Thần</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/bach-luyen-thanh-than-1099-chap-1123.html">Chương 1123</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/vo-luyen-dinh-phong-3926"><img class="center" src="https://i.truyenvua.com/ebook/190x247/vo-luyen-dinh-phong_1514903369.jpg?gt=hdfgdfg&amp;mobile=2" alt="Võ Luyện Đỉnh Phong"></a>
                    <div class="top-notice">
                        <span class="time-ago">8 Giờ Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Võ Luyện Đỉnh Phong" href="https://truyenqqvn.com/truyen-tranh/vo-luyen-dinh-phong-3926">Võ Luyện Đỉnh Phong</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/vo-luyen-dinh-phong-3926-chap-3586.html">Chương 3586</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/onepunch-man-244"><img class="center" src="https://i.truyenvua.com/ebook/190x247/onepunch-man_1552232163.jpg?gt=hdfgdfg&amp;mobile=2" alt="Onepunch Man"></a>
                    <div class="top-notice">
                        <span class="time-ago">10 Giờ Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Onepunch Man" href="https://truyenqqvn.com/truyen-tranh/onepunch-man-244">Onepunch Man</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/onepunch-man-244-chap-241.html">Chương 241</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/yeu-than-ky-746"><img class="center" src="https://i.truyenvua.com/ebook/190x247/yeu-than-ky_1443013926.jpg?gt=hdfgdfg&amp;mobile=2" alt="Yêu Thần Ký"></a>
                    <div class="top-notice">
                        <span class="time-ago">1 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Yêu Thần Ký" href="https://truyenqqvn.com/truyen-tranh/yeu-than-ky-746">Yêu Thần Ký</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/yeu-than-ky-746-chap-546.html">Chương 546</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/hoi-phap-su-nhiem-vu-tram-nam-5212"><img class="center" src="https://i.truyenvua.com/ebook/190x247/fairy-tail-100-year-quest_1532514729.jpg?gt=hdfgdfg&amp;mobile=2" alt="Hội Pháp Sư Nhiệm Vụ Trăm Năm"></a>
                    <div class="top-notice">
                        <span class="time-ago">1 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Hội Pháp Sư Nhiệm Vụ Trăm Năm" href="https://truyenqqvn.com/truyen-tranh/hoi-phap-su-nhiem-vu-tram-nam-5212">Hội Pháp Sư Nhiệm Vụ Trăm Năm</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/hoi-phap-su-nhiem-vu-tram-nam-5212-chap-143.html">Chương 143</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/nguyen-ton-3755"><img class="center" src="https://i.truyenvua.com/ebook/190x247/nguyen-ton_1513349962.jpg?gt=hdfgdfg&amp;mobile=2" alt="Nguyên Tôn"></a>
                    <div class="top-notice">
                        <span class="time-ago">1 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Nguyên Tôn" href="https://truyenqqvn.com/truyen-tranh/nguyen-ton-3755">Nguyên Tôn</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/nguyen-ton-3755-chap-726.html">Chương 726</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/toan-chuc-phap-su-4140"><img class="center" src="https://i.truyenvua.com/ebook/190x247/toan-chuc-phap-su_1518956513.jpg?gt=hdfgdfg&amp;mobile=2" alt="Toàn Chức Pháp Sư"></a>
                    <div class="top-notice">
                        <span class="time-ago">1 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Toàn Chức Pháp Sư" href="https://truyenqqvn.com/truyen-tranh/toan-chuc-phap-su-4140">Toàn Chức Pháp Sư</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/toan-chuc-phap-su-4140-chap-1104.html">Chương 1104</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/saeki-san-wa-nemutteru-5542"><img class="center" src="https://i.truyenvua.com/ebook/190x247/saeki-san-wa-nemutteru_1535983645.jpg?gt=hdfgdfg&amp;mobile=2" alt="Saeki-San Wa Nemutteru"></a>
                    <div class="top-notice">
                        <span class="time-ago">2 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Saeki-San Wa Nemutteru" href="https://truyenqqvn.com/truyen-tranh/saeki-san-wa-nemutteru-5542">Saeki-San Wa Nemutteru</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/saeki-san-wa-nemutteru-5542-chap-28.html">Chương 28</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/ta-la-dai-than-tien-5772"><img class="center" src="https://i.truyenvua.com/ebook/190x247/ta-la-dai-than-tien_1540132115.jpg?gt=hdfgdfg&amp;mobile=2" alt="Ta Là Đại Thần Tiên"></a>
                    <div class="top-notice">
                        <span class="time-ago">2 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Ta Là Đại Thần Tiên" href="https://truyenqqvn.com/truyen-tranh/ta-la-dai-than-tien-5772">Ta Là Đại Thần Tiên</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/ta-la-dai-than-tien-5772-chap-642.html">Chương 642</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                        <li>
                <div class="book_avatar">
                    <a href="https://truyenqqvn.com/truyen-tranh/de-ba-12226"><img class="center" src="https://i.truyenvua.com/ebook/190x247/de-ba_1648198417.jpg?gt=hdfgdfg&amp;mobile=2" alt="Đế Bá"></a>
                    <div class="top-notice">
                        <span class="time-ago">2 Ngày Trước</span>                        <span class="type-label hot">Hot</span>                    </div>

                </div>
                <div class="book_info">
                    <div class="book_name">
                        <h3 itemprop="name"><a title="Đế Bá" href="https://truyenqqvn.com/truyen-tranh/de-ba-12226">Đế Bá</a></h3>
                    </div>
                    <div class="clear"></div>
                    <div class="last_chapter">
                        <a href="https://truyenqqvn.com/truyen-tranh/de-ba-12226-chap-103.html">Chương 103</a>
                    </div>
                </div>

                <div class="clear"></div>
            </li>
                    </ul>
        <div class="clear"></div>
        <div class="scroll" style="display: block;">
            <div onclick="scroll_div('left');" class="left">
                <i class="fa fa-angle-left"></i>
            </div>
            <div onclick="scroll_div('right');" class="right">
                <i class="fa fa-angle-right"></i>
            </div>
        </div>
    </div>
</div>	   
       <?php
	   }
	   ?>
	   
	   <?php
	   require_once('page/qc/bannerHeader.php'); 
	   ?>
        <!-- <div class="right-bar pc <?= $On?>">
            <div class="top-right-bar">
               <div class="right-bar-item">
                  <a href="#home"><span class="group-icon"></span></a>
               </div>
               <div class="right-bar-item">
                  <a href="#list-update">
                  <span class="starts-icon"></span>
                  Truyện tranh cập nhật
                  </a>
               </div>
               <div class="right-bar-item">
                  <a href="#list-female">
                  <span class="female-icon"></span>
                  Top ngày
                  </a>
               </div>
               <div class="right-bar-item">
                  <a class="light-see" href="javascript:void(0);">
					  <span class="fas fa-lightbulb"></span>
					  <span class="control-see">Bật đèn</span>
				   </a>
               </div>
				
               <div class="right-bar-item">
                  <a href="#list-male">
                  <span class="male-icon"></span>
                  Tiểu thuyết
                  </a>
               </div>
            </div>
             /.top-right-bar 
            <div class="bottom-right-bar download-app-bottom">
               <div class="right-bar-item">
                  <a href="javascript:void(0);"><span class="rect-icon"></span></a>
               </div>
            </div> 
         </div> -->
	               <!-- /.bottom-right-bar -->

         <!-- /.right-bar -->
         <section class="main-content index">
            <div class="container">
               <div class="latest">
				   <br>
                  <div class="caption" id="list-update"><a href="<?php echo $linkOption;?>truyen-tranh-hay.html"><span class="starts-icon"></span>Truyện tranh mới cập nhật</a></div>
                  <?php
						$arrLatest=$db->GetLatest();
						storiesList($arrLatest,$linkOption);
				  ?>
                  <!-- /.list-stories -->
                  <div class="has-text-centered">
                     <a href="<?php echo $linkOption;?>truyen-tranh-hay/trang-2.html" class="view-more-btn">Xem thêm nhiều truyện</a>
                  </div>
               </div>
               <!-- /.latest -->
               <div class="female">
                  <div class="caption" id="list-female"><a href="<?php echo $linkOption;?>top-ngay.html"><span class="female-icon"></span>Top ngày</a></div>
                  <div class="tile is-ancestor">
                     <div class="tile is-vertical is-parent">
						<?php
						 $date=findTop("day");
						 $arrFemaleIndex=$db->GetFemaleIndex($date);
						 storiesList($arrFemaleIndex,$linkOption);
						?>
                        <!-- /.list-stories -->
                     </div>
                  </div>
               </div>
               <!-- /.female -->
               <div class="male">
                  <div class="caption" id="list-male"><a href="<?php echo $linkOption;?>tieu-thuyet-hay.html"><span class="male-icon"></span>Tiểu thuyết</a></div>
                  <div class="tile is-ancestor">
                     <div class="tile is-vertical is-parent">
                        <?php
						 $arrMaleIndex=$db->GetMaleIndex();
						 storiesList($arrMaleIndex,$linkOption);						
						$db->dis_connect();//ngat ket noi mysql	
						?>
                        <!-- /.list-stories -->
                     </div>
                  </div>
               </div>
               <!-- /.male -->
            </div>
            <div id="Top" class="scrollTop none" style="display: none;">
               <span><a href="index.html"><img src="<?php echo $linkOption1?>frontend/images/back-to-top-icon.png"></a></span>
            </div>
         </section>
         <!-- /.main-content -->        
         <div class="container quick-link">
            <ul class="list-inline">
               <li>
                  <a href="index.html" title="Truyen tranh">
                  <strong class="text-link">Truyen tranh</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Truyện tranh">
                  <strong class="text-link">Tieu thuyet</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Truyen tranh online">
                  <strong class="text-link">Truyen tranh online</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Truyện tranh online">
                  <strong class="text-link">Truyện tranh online</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Doc truyen tranh">
                  <strong class="text-link">Doc truyen tranh</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Đọc truyện tranh">
                  <strong class="text-link">Đọc truyện tranh</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Manhua">
                  <strong class="text-link">Manhua</strong>
                  </a>
               </li>
               <li>
                  <a href="index.html" title="Manga">
                  <strong class="text-link">Manga</strong>
                  </a>
               </li>
            </ul>
         </div>
           <?php	
				require_once('page/footer/footerDetail.php');	
			?> 
			
	   <?php
	      require_once('page/qc/bannerLeft.php'); 
	   ?>
	   
      </div>	  
	   <?php		  
	    require_once('page/qc/bannerContent.php');
	   ?>
	   <script>
	   var linkOption1=<?php echo json_encode($linkOption1)?>;
	   </script>
	   <script src="<?php echo $linkOption1;?>js/qc/ad.js"></script>
   </body>
</html>
