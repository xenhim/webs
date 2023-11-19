<?php
	 //require_once('../model/connection.php'); 
	 //require_once('../model/connection.php'); 
	 // $db=new config();
	 // $db->config();
	 $listEmoji=$db->GetListEmoji(1);
	 $listEmoji2=$db->GetListEmoji(0);
	 $linkOption=siteURL();
	 $linkOption1=$linkOption."page/";
	
?>
<div id="list_emoji" class="modal fade">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close close-emoji"><span aria-hidden="true">×</span>
            </button>
            <span class="modal-title">Biểu Tượng Cảm Xúc</span>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs">
			<?php
			
		
				
				$i=0;
				foreach($listEmoji as $tam2)
				{	
					if($i==0)
					echo '<li class="active"><a data-id="'.$tam2['NameEmoji'].'">'.$tam2['NameEmoji'].'</a></li>';
					else
					echo '<li><a data-id="'.$tam2['NameEmoji'].'">'.$tam2['NameEmoji'].'</a></li>';	
				 $i++;

				}
				
			?>
			
            </ul>

            <div class="tab-content">
				<?php
					$j=0;
				foreach($listEmoji as $tam2)
				{	
					if($j==0){
						echo '<div id="'.$tam2['NameEmoji'].'" class="tab-pane fade in active">';
							foreach($listEmoji2 as $tam3)
							{
								if($tam3['NameEmoji']==$tam2['NameEmoji'])
								echo '<img data-code="'.$tam3['Code'].'" src="'.$linkOption1.$tam3['Path'].'" class="emoji_comment">';	
							}
						echo '</div>';
					}
					else{
						echo '<div id="'.$tam2['NameEmoji'].'" class="tab-pane fade">';	
						    foreach($listEmoji2 as $tam3)
							{
								if($tam3['NameEmoji']==$tam2['NameEmoji'])
								echo '<img data-code="'.$tam3['Code'].'" src="'.$linkOption1.$tam3['Path'].'" class="emoji_comment">';	
							}
						echo '</div>';
					}
				 $j++;

				}
				?>

            </div>
        </div>
    </div>
</div>
