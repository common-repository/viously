<?php
/**
 * Security check
 * Prevent direct access to the file.
 *
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Official plugin in transitional (or standard) mode use the same stylesheet as the traditional website
if (function_exists('amp_is_request') && amp_is_request()) {
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_style( 'viously_style', VIOUSLY_PLUGIN_URL . 'assets/css/public.css');
    });
}

// If an AMP plugin is installed (first one is the official and the second one is the unofficial)
if (is_plugin_activated('amp/amp.php') || is_plugin_activated('accelerated-mobile-pages/accelerated-moblie-pages.php')) {
    // Both plugins use the same action
    add_action('amp_post_template_css', function () {
        ?>
        .vsly-player { display:none; }
        <?php
    });
}

function is_plugin_activated($plugin)
{
    return in_array($plugin, apply_filters('active_plugins', get_option('active_plugins')));
}
