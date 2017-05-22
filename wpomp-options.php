<?php if( ! defined( 'ABSPATH') ) exit; ?>
<div class="wrap">
	<h1><?php echo self::NAME;?></h1>
	<p>
		<a href="https://wordpress.org/plugins/wp-original-media-path/installation/" target="_blank" class="button"><?php _e( 'How to Configure', self::I18N );?></a>
		<a href="https://wordpress.org/plugins/wp-original-media-path/faq/" target="_blank" class="button"><?php _e( 'FAQ', self::I18N );?></a>
		<a href="https://github.com/rvola/wp-original-media-path" target="_blank" class="button">GitHub</a>
		<a href="https://paypal.me/rvola" target="_blank" class="button button-primary"><?php _e( 'Donate', self::I18N );?></a>
	</p>
	<form method="post" action="options.php">
	<?php
		settings_fields( 'wpomp_fields' );
		do_settings_sections( 'wpomp_pages' );
		submit_button();
	?>
	</form>
</div>
