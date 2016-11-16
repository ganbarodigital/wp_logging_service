<?php

/**
 * Plugin Name:       PSR3 Logger
 * Plugin URI:        https://github.com/ganbarodigital/wp_psr3_logger
 * Description:       This plugin provides a PSR3-compliant logger for your plugin to use
 * Version:           1.0.0
 * Author:            Ganbaro Digital
 * Author URI:        https://ganbarodigital.com
 * License:           3-Clause BSD
 * License URI:       http://www.opensource.org/licenses/bsd-license.php
 * Domain Path:       /languages
 * Text Domain:       wp_logging_service
 * Network:           true
 * GitHub Plugin URI: https://github.com/ganbarodigital/wp_psr3_logger
 * GitHub Branch:     develop
 * Requires WP:       4.0
 * Requires PHP:      5.6
 */

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
    die;
}

// this should make the code in our vendor/ folder available
require_once(__DIR__ . '/vendor/autoload.php');

// this creates our logger
require_once(__DIR__ . '/src/logging_service.php');
