<?php
/*
Plugin Name: Viously
Description: Embed videos from viously.com into your WordPress site.
Version:     2.0
Author:      Viously team
Author URI:  https://www.viously.com
Text Domain: Viously
*/

/*
 * Security check
 * Prevent direct access to the file.
 *
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('VIOUSLY_PLUGIN_PATH', plugin_dir_path(__FILE__ ));
define('VIOUSLY_PLUGIN_URL', plugin_dir_url(__FILE__ ));

/**
 * Include plugin files
 */
include_once ( VIOUSLY_PLUGIN_PATH . 'includes/oembed.php' );
include_once ( VIOUSLY_PLUGIN_PATH . 'includes/css.php' );
