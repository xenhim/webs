<?php

add_action('madara_chapter_modal_after_chapter_meta', 'wp_manga_chapter_edit_modal_amp_setting');

function wp_manga_chapter_edit_modal_amp_setting(){
	?>
	<div class="wp-manga-chapter-amp-height block">
		<label class="input-label"><strong><?php esc_html_e( 'AMP - Image Height', WP_MANGA_TEXTDOMAIN ); ?></strong></label>

		<input type="text" id="chapter-amp-height">
		<div class="desc"><?php echo sprintf(esc_html__( 'If this chapter uses different Image Height value than global setting in Theme Options > AMP, you can override it using this field. Value is in pixels. Read more about %s', WP_MANGA_TEXTDOMAIN ), '<a href="#">AMP</a>'); ?></div>
	</div>
	<?php
}