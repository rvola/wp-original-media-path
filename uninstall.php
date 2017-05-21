<?php
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;
update_option( 'upload_path', null, true );
update_option( 'upload_url_path', null, true );
delete_option( 'wpomp_mode' );
