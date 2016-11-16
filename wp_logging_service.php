<?php
/**
 * Logging Service For PHP
 *
 * @package   WP Logging Service
 * @author    Stuart Herbert
 * @license   new BSD
 * @link      https://github.com/ganbarodigital/wp_logging_service
 */

/**
 * Plugin Name:       Wordpress Logging Service
 * Plugin URI:        https://github.com/ganbarodigital/wp_logging_service
 * Description:       This plugin provides a PSR3-compliant logger for your plugin to use
 * Version:           1.0.0
 * Author:            Ganbaro Digital
 * Author URI:        https://ganbarodigital.com
 * License:           3-Clause BSD
 * License URI:       http://www.opensource.org/licenses/bsd-license.php
 * Domain Path:       /languages
 * Text Domain:       wp_logging_service
 * Network:           true
 * GitHub Plugin URI: https://github.com/ganbarodigital/wp_logging_service
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
require_once(__DIR_- . '/src/logging_service.php');
