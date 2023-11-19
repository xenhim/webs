<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
 <ul class="pagination-list">     
	<?php
	$totalPages = ceil($totalRecords / $item_per_page);
	if ($current_page > 3) {
    $first_page = 1;
    ?>
	<li><a class="pagination-previous" href="<?= $linkOption?>lich-su/trang-<?= $first_page ?>.html"><span aria-hidden="true">«</span></a></li>
    <?php
	}
if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
	<li><a class="pagination-link" href="<?= $linkOption?>lich-su//trang-<?= $prev_page ?>.html"><span aria-hidden="true">‹</span></a></li>
<?php }
?>
<?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
			<li><a class="pagination-link" href="<?= $linkOption?>lich-su/trang-<?= $num ?>.html"><?= $num ?></a></li>
        <?php } ?>
    <?php } else { ?>      
		<li><a class="pagination-link is-current" href="javascript:void(0)"><?= $num ?></a></li>
    <?php } ?>
<?php } ?>
<?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
	<li><a class="pagination-link" href="<?= $linkOption?>lich-su/trang-<?= $next_page ?>.html"><span aria-hidden="true">›</span></a></li>
<?php
}
if ($current_page < $totalPages) {
    $end_page = $totalPages;
    ?>
	<li><a class="pagination-next" href="<?= $linkOption?>lich-su/trang-<?= $end_page ?>.html"><span aria-hidden="true">»</span></a></li>
    <?php
}
?>
 </ul>
</nav>