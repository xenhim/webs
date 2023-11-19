<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
 <ul class="pagination-list">     
	<?php
	$totalPages = ceil($totalRecords / $item_per_page);
	if ($current_page > 3) {
    $first_page = 1;
    ?>
	<li><a class="pagination-previous" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?>/trang-<?= $first_page ?>.html<?= $h1 ?><?= $country?><?= $p1?><?= $status?><?= $p2?><?= $sort?>"><span aria-hidden="true">«</span></a></li>
    <?php
	}
if ($current_page > 1) {
    $prev_page = $current_page - 1;
    ?>
	<li><a class="pagination-link" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?>/trang-<?= $prev_page ?>.html<?= $h1 ?><?= $country?><?= $p1?><?= $status?><?= $p2?><?= $sort?>"><span aria-hidden="true">‹</span></a></li>
<?php }
?>
<?php for ($num = 1; $num <= $totalPages; $num++) { ?>
    <?php if ($num != $current_page) { ?>
        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
			<li><a class="pagination-link" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?>/trang-<?= $num ?>.html<?= $h1 ?><?= $country?><?= $p1?><?= $status?><?= $p2?><?= $sort?>"><?= $num ?></a></li>
        <?php } ?>
    <?php } else { ?>      
		<li><a class="pagination-link is-current" href="javascript:void(0)"><?= $num ?></a></li>
    <?php } ?>
<?php } ?>
<?php
if ($current_page < $totalPages - 1) {
    $next_page = $current_page + 1;
    ?>
	<li><a class="pagination-link" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?>/trang-<?= $next_page ?>.html<?= $h1 ?><?= $country?><?= $p1?><?= $status?><?= $p2?><?= $sort?>"><span aria-hidden="true">›</span></a></li>
<?php
}
if ($current_page < $totalPages) {
    $end_page = $totalPages;
    ?>
	<li><a class="pagination-next" href="<?= $linkOption1?><?= $genres1?>-<?= $IdGenre?>/trang-<?= $end_page ?>.html<?= $h1 ?><?= $country?><?= $p1?><?= $status?><?= $p2?><?= $sort?>"><span aria-hidden="true">»</span></a></li>
    <?php
}
?>
 </ul>
</nav>