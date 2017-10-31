<?php if( ! defined( 'ABSPATH') ) exit; ?>
<div class="wrap">
	<h1><?php echo self::NAME;?></h1>
	<p>
		<?php

		printf(
			'<a href="%1$s" target="_blank" class="button">%2$s</a> ',
			'https://wordpress.org/plugins/wp-original-media-path/faq/',
			__( 'FAQ', self::I18N )
		);
		printf(
			'<a href="%1$s" target="_blank" class="button">%2$s</a> ',
			'https://wordpress.org/plugins/wp-original-media-path/installation/',
			__( 'How to Configure', self::I18N )
		);
		printf(
			'<a href="%1$s" target="_blank" class="button">GitHub</a> ',
			'https://github.com/rvola/wp-original-media-path'
		);
		printf(
			'<a href="%1$s" target="_blank" class="button button-primary">%2$s</a>',
			'https://www.paypal.me/rvola',
			__( 'Donate', self::I18N )
		);

		?>
	</p>
	<form method="post" action="options.php">
		<?php
		settings_fields( 'wpomp_fields' );
		do_settings_sections( 'wpomp_pages' );
		submit_button();
		?>
	</form>
</div>
