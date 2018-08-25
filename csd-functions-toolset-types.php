<?php
/*
Plugin Name: CSD Functions - Toolset Types
Version: 1.1
Description: Toolset Types Customizations for CSD Schools and District Theme
Author: Josh Armentano
Author URI: https://abidewebdesign.com
Plugin URI: https://abidewebdesign.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require WP_CONTENT_DIR . '/plugins/plugin-update-checker-master/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/csd509j/CSD-functions-types',
	__FILE__,
	'CSD-functions-types'
);

$myUpdateChecker->setBranch('master'); 

/*
 * Show posts of 'post', 'page' and 'news' post types on home page
 *
 * @since CSD Schools 1.0
 */

function add_my_post_types_to_query( $query ) {
  
  if ( is_home() && $query->is_main_query() ) {
   
    $query->set( 'post_type', array( 'post', 'page', 'news' ) );
  
  }
  
  return $query;
}
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

/*
 * Remove bootstrap tools
 *
 * @since CSD Schools 1.4.9
 */
add_filter( 'mce_buttons_3', 'remove_bootstrap_buttons', 999 );
function remove_bootstrap_buttons($buttons) {
    return array();
}
   
add_filter( 'mce_buttons', 'remove_toggle_button', 999 );
function remove_toggle_button($buttons) {
    $remove = array( 'css_components_toolbar_toggle' );
    return array_diff( $buttons, $remove ); 
} 