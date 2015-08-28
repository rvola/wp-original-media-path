<?php
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/*Options Pages*/
function wpomp_settings_options() {
	
	/*Variables*/
	$notice_update = $notice_uninstall = false;
	
	/*Check form*/
	/*New settings*/
	if (isset($_POST['wpomp-settings']) && check_admin_referer('wpomp-settings')) {
		update_option('upload_path', $_POST['upload_path'], true);
		update_option('upload_url_path', $_POST['upload_url_path'], true);
		$notice_update = true;
	}
	/*Uninstall*/
	if (isset($_POST['wpomp-uninstall']) && check_admin_referer('wpomp-uninstall')) {
		update_option('upload_path', '', true);
		update_option('upload_url_path', '', true);
		
		$notice_uninstall = true;
		$url_uninstall = wp_nonce_url(admin_url('plugins.php?action=deactivate&plugin=wp-original-media-path/wp_original_media_path.php&plugin_status=all&paged=1'),'deactivate-plugin_wp-original-media-path/wp_original_media_path.php');
	}
		
	/*Notice*/	
	if ($notice_update == true) {
		echo '<div id="message" class="updated fade"><p><strong>'.__('Settings saved.','wpomp').'</strong></p></div>';
	}
	else if ($notice_uninstall == true) {
		echo '<div id="message" class="updated fade"><p><strong>'.__('Uninstall completed.','wpomp').'</strong><br/><a href="'.$url_uninstall.'">'.__('Click here now to disable the plugin','wpomp').'</a></p></div>';
	}
?>
	<style type="text/css">
		.button {width: auto!important;}
		#validation {border-top: 1px solid #dfdfdf;padding: 10px 0}
	</style>
	<div class="wrap" id="wpomp-settings">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2><?php echo WPOMP_NAME; ?></h2>
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div id="namediv" class="stuffbox">
						<h3 class="hndle"><?php _e('Settings','wpomp'); ?></h3>
						<div class="inside">
							<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
								<table class="form-table">
									<tr valign="top">
										<th scope="row">
											<label for="upload_path"><?php _e('Store uploads in this folder','wpomp'); ?></label>
										</th>
										<td>
											<input name="upload_path" type="text" id="upload_path" value="<?php echo esc_attr(get_option('upload_path')); ?>" class="regular-text code" />
											<p class="description"><?php _e('Default is <code>wp-content/uploads</code>','wpomp'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="upload_url_path"><?php _e('Full URL path to files','wpomp'); ?></label>
										</th>
										<td>
											<input name="upload_url_path" type="text" id="upload_url_path" value="<?php echo esc_attr( get_option('upload_url_path')); ?>" class="regular-text code" />
											<p class="description"><?php _e('Configuring this is optional. By default, it should be blank.','wpomp'); ?></p>
										</td>
									</tr>
								</table>
								<div id="validation">
									<?php wp_nonce_field('wpomp-settings');?>
									<input type="submit" value="<?php _e('Update','wpomp');?>" class="button-primary button" name="wpomp-settings"/>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<div id="side-sortables" class="meta-box-sortables ui-sortable">
						<div class="postbox">
							<h3 class="hndle"><?php _e('Uninstall','wpomp'); ?></h3>
							<div class="inside">
								<p><?php _e('Click to delete the settings and disable the plugin','wpomp');?>.</p>
								<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
									<?php wp_nonce_field('wpomp-uninstall');?>
									<input type="submit" value="<?php _e('Uninstall now','wpomp');?>" class="button" name="wpomp-uninstall"/>
								</form>
							</div>
						</div>
					</div>
				</div>
				<br class="clear">
			</div>
		</div>
	</div>
<?php } ?>