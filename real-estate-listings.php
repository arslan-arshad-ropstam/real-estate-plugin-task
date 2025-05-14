<?php

/**
 * Plugin Name: Real Estate Listings
 * Description: A plugin to manage and display real estate listings.
 * Version: 1.0.0
 * Author: Ropstam Solutions Pvt. Ltd.
 * License: GPL-2.0+
 */

if (! defined('ABSPATH')) {
    exit;
}

define('REL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('REL_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once REL_PLUGIN_DIR . 'includes/class-real-estate-listings.php';
require_once REL_PLUGIN_DIR . 'includes/class-shortcode.php';


if (defined('WP_CLI') && WP_CLI  && class_exists('WP_CLI_Command')) {
    error_log('Including WP-CLI class: ' . REL_PLUGIN_DIR . 'includes/class-wp-cli.php');
    require_once REL_PLUGIN_DIR . 'includes/class-wp-cli.php';
}

function rel_init()
{
    $plugin = new Real_Estate_Listings();
    $plugin->init();

    $shortcode = new REL_Shortcode();
    $shortcode->init();
}
add_action('plugins_loaded', 'rel_init');

function rel_register_post_type()
{
    $args = array(
        'public' => true,
        'label'  => 'Properties',
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'has_archive' => true,
    );
    register_post_type('property', $args);

    register_taxonomy('city', 'property', array(
        'label' => 'Cities',
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    register_taxonomy('listing_status', 'property', array(
        'label' => 'Listing Status',
        'hierarchical' => false,
        'show_in_rest' => true,
    ));
}
add_action('init', 'rel_register_post_type');


function rel_template_include($template) {
    if (is_singular('property')) {
        $new_template = REL_PLUGIN_DIR . 'templates/single-property.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    } elseif (is_post_type_archive('property') || is_tax('city') || is_tax('listing_status')) {
        $new_template = REL_PLUGIN_DIR . 'templates/archive-property.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'rel_template_include',99);