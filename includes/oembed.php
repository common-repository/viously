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

const VIOUSLY_OEMBED_ENDPOINT = 'https://www.viously.com/oembedamp';

/**
 * Viously oEmbed
 * Register oEmbed provider.
 *
 * @since 1.0
 */
function viously_oembed_provider() {
        wp_oembed_add_provider('https://www.viously.com/*/*', VIOUSLY_OEMBED_ENDPOINT);
}
add_action('init', 'viously_oembed_provider');

/**
 * Override default wordpress implementation to add parameters to oembed call
 *
 * @param string $provider
 * @param string $url
 * @param array $args
 * @return string the url to request
 */
function viously_oembed_rewrite(string $provider, string $url, array $args): string
{
    if (strpos($provider, VIOUSLY_OEMBED_ENDPOINT) !== false) {
        // Separate url and query string
        list($url, $query_string) = explode('?', $url);

        $parsed_get = array();

        if (!empty($query_string)) {
            parse_str($query_string, $parsed_get);
        }

        if (!empty($parsed_get)) {
            // Remove wordpress ajax request params from $args (_locale, rest_routes, etc)
            $rewritten_args = array_diff_key($args, $_GET);

            // Merge parsed_get with rewritten_args (without override already existing indexes into $parsed_get)
            $parsed_get += $rewritten_args;

            $provider = VIOUSLY_OEMBED_ENDPOINT . '?url=' . urlencode($url) . '&' . http_build_query($parsed_get);
        }
    }

    return $provider;
}

add_filter('oembed_fetch_url', 'viously_oembed_rewrite', 10, 3);
