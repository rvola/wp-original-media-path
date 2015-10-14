<?php if(!defined('ABSPATH')) exit;?>
<div class="wrap">
	<h2><?php echo $this->_PLUGIN_NAME;?></h2>
	<p>
		<a href="https://github.com/rvola/wp-original-media-path" target="_blank" class="button">GitHub</a>
		<a href="http://wordpress.org/plugins/wp-original-media-path/faq/" target="_blank" class="button"><?php _e('FAQ', 'wpomp');?></a>
		<a href="http://wordpress.org/plugins/wp-original-media-path/installation/" target="_blank" class="button"><?php _e('How to Configure', 'wpomp');?></a>
	</p>
	<form method="post" action="options.php">
	<?php
		settings_fields('wpomp_fields');
		do_settings_sections('wpomp_pages');
		submit_button();
	?>
	</form>
</div>