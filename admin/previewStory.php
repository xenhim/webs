<?php 
	session_status() === PHP_SESSION_ACTIVE ?: session_start(); 
		require_once('model/connection.php'); 
		require_once('function/function.php'); 
		$db=new config();
		$db->config();
		$user=0;
		$IdStory=$_GET["idStory"];
		$_name=$_GET["_name"];
		$_nameOther=$_GET["_nameOther"];
		$_status=$_GET["_status"];
		$_content=$_GET["_content"];
		$_hot=$_GET["_hot"];
		$_waning=$_GET["_waning"];
		$_genre=$_GET["_genre"];
		$_author=$_GET["_author"];
		$_country=$_GET["_country"];
		$_link=$_GET["_link"];
	
		
		$subscribe_class="fas"; 
		$subscribe_text="Theo dõi";
		
		if(!isset($_SESSION['name_comment'])){
		 $_SESSION['name_comment']="";
		}
		if(!isset($_SESSION['subscribe']))
		$_SESSION['subscribe']=[];
		if(!isset($_SESSION['like']))
		$_SESSION['like']=[];

	
		$linkOption=siteURL();		
		$domain=$_SERVER['SERVER_NAME'];
		$linkOption1=$linkOption."page/";
		$Sum_Subscribe=0;
		$Sum_Like=0;
		$Sum_Views=0;
	
	

?>

<!DOCTYPE html>
<html lang="vi">

<head>
   <meta charset="utf-8">
	<title>Xem thử truyện</title>

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
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0" nonce="Swsej8PV"></script>
</head>

<body>
    <input type="hidden" id="keyword-default" value="one">
    <div class="outsite ">
         <?php
		 require_once('headerDetail.php');
	
		
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
						 echo '<a href="'.$linkOption.vn_str_filter($_name)."-".$IdStory.'" title="'.$_name.'">';
						  //echo '<a itemprop="item" href="detail.php?IdStory='.$IdStory.'">';
                                echo '<span itemprop="name">'.$_name.'</span>';
                          echo '</a>';
						?>
                           
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </div>
                <div class="block01">
                    <div class="left"><img src="<?php echo $linkOption1.$_link?>" alt="<?php echo $_name;?>" />
                    </div>
                    <div class="center" itemscope="" itemtype="http://schema.org/Book">
                        <h1 itemprop="name"><?php echo $_name?></h1>
                        <div class="txt">
							<?php if($_nameOther!="") echo '<span class="info-item">Tên Khác: '.$_nameOther.'</span>';?>
                           
                            
							<?php 
							$AuthorArr=ConvertStrToArr($_author);
							if($_author!=""){
								echo '<p class="info-item">Tác giả: ';
									
									for($i=0;$i<count($AuthorArr);$i++){
										$IdAuthor=0;
										if($i==0)
										echo '<a class="org" href="'.$linkOption.'tac-gia/'.vn_str_filter($AuthorArr[$i]).'-'.$IdAuthor.'.html">'.$AuthorArr[$i].'</a>';
										else echo ', <a class="org" href="'.$linkOption.'tac-gia/'.vn_str_filter($AuthorArr[$i]).'-'.$IdAuthor.'.html">'.$AuthorArr[$i].'</a>';
									}
								echo '</p>';
							}
							?>
							
                            <p class="info-item">Tình trạng: <?php echo $_status?></p>
                            <div>
                                <span>Thống kê:</span>
                                <span class="sp01"><i class="fas fa-thumbs-up"></i> <span class="sp02 number-like"><?=$Sum_Like?></span></span>
                                <span class="sp01"><i class="fas fa-heart"></i> <span class="sp02"><?=$Sum_Subscribe?></span></span>
                                <span class="sp01"><i class="fas fa-eye"></i> <span class="sp02"><?=$Sum_Views?></span></span>
                            </div>
                        </div>
                       
						<?php
						
						  $Genre = explode(",", $_genre);
						  if($_genre!=""){
						   echo '<ul class="list01">';
						  for($i=0;$i<count($Genre);$i++){
							  $genre12=0;
							  echo  '<li class="li03"><a href="'.$linkOption.'the-loai/'.vn_str_filter($Genre[$i]).'-'.$genre12.'.html">'.$Genre[$i].'</a></li>';
							  
							  
						  }
						  $chapStar="#";
						  
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
                        </ul>
                        </br>
                         <div class="socials-share">
                            <a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank"><span class="fa fa-facebook"></span> Share</a>
                            <a class="bg-twitter" href="" target="_blank"><span class="fa fa-twitter"></span> Tweet</a>
                            <a class="bg-google-plus" href="" target="_blank"><span class="fa fa-google-plus"></span> Plus</a>
                            <a class="bg-pinterest" href="" target="_blank"><span class="fa fa-pinterest"></span> Pin</a>
                            <a class="bg-email" href="" target="_blank"><span class="fa fa-envelope"></span> Gmail</a>
                        </div>
                        <div class="txt txt01 story-detail-info" itemprop="description">
                            <p>
							<?php echo $_content?>
							</p>
                        </div>
                    </div>
                </div>
                <ul class="story-detail-menu">
                    </li>
                    <li class="li02"><a href="javascript:void(0);" class="button is-danger is-rounded btn-subscribe subscribeBook" data-page="index" data-id="<?=$IdStory?>"><span class="<?=$subscribe_class?> fa-heart"></span><?=$subscribe_text?></a>
                    </li>
                    <li class="li03"><a href="javascript:void(0);" class="button is-danger is-rounded btn-like" data-id="<?=$IdStory?>"><span class="fas fa-thumbs-up"></span>Thích</a>
                    </li>
                   
                    </li>
                </ul>
				<?php if($_waning=="Nhạy Cảm"){?>
				<p class="alert alert-danger warning-info">
                <span>Cảnh báo độ tuổi:</span>
                Truyện tranh <?=$_name?> có thể có nội dung và hình ảnh nhạy cảm, không phù hợp với lứa tuổi của bạn. Nếu bạn dưới 16 tuổi, vui lòng chọn một truyện khác để giải trí. Chúng tôi sẽ không chịu trách nhiệm liên quan nếu bạn bỏ qua cảnh báo này.
				
				</p>
				<?php }
				
				//require_once('qc/bannerDetail.php'); 
				?>
                <div class="block02">
                    <div class="title">
                        <h2 class="story-detail-title">Danh sách chương</h2>
                    </div>
                    <div class="box">
                        <div class="works-chapter-list">
                            <?php 

							 date_default_timezone_set("Asia/Ho_Chi_Minh");
							$arr2 = $db->GetChapter2($IdStory); 
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
								?>
                        </div>
                    </div>
                </div>
              
               	<?php
					$countComment=$db->GetCountComment($IdStory);
					
					require_once('comment.php');
										
				?>
            </div>
        </section>
      
	 <?php 
		require_once('footer.php');
		
	 ?>
       <?php
	      //require_once('qc/bannerLeft.php'); 
	   ?>	
      </div>
	  <?php		  
	    //require_once('qc/bannerContent.php');
		$db->dis_connect();//ngat ket noi mysql	
	  ?>
</body>
</html>