<?php
/**
 * Plugin Name:     fix-wp-new-user-to-all-sites
 * Plugin URI:      https://github.com/edinaldohvieira/fix-wp-new-user-to-all-sites
 * Description:     Se novo usuário, cadastrar automaticamente em todos os sites da rede wpmu.
 * Author:          Edinaldo H Vieira
 * Author URI:      https://github.com/edinaldohvieira
 * Text Domain:     fix-wp-new-user-to-all-sites
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Fix_Wp_New_User_To_All_Sites
 */

// ID DO PLUGIN: fix158638


add_action( 'user_register', 'fix158638_registration_save', 10, 1 );
function fix158638_registration_save( $user_id ) {
	$sites = get_sites();
	foreach ($sites as $site) {
		$blog_id = $site->blog_id;
		$is_user_member_of_blog = is_user_member_of_blog($user_id, $blog_id);
		if(!$is_user_member_of_blog) {
			add_user_to_blog($blog_id, $user_id, "customer");
		}
	}
}
