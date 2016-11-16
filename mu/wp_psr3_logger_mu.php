<?php

/**
 * Copyright (c) 2016-present Ganbaro Digital Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the names of the copyright holders nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Wordpress Plugin
 * @package   WP/LoggingService
 * @author    Stuart Herbert <stuherbert@ganbarodigital.com>
 * @copyright 2016-present Ganbaro Digital Ltd www.ganbarodigital.com
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link      http://code.ganbarodigital.com/wp_logging_service
 */

/**
 * Plugin Name:       PSR3 Logger MU Loader
 * Plugin URI:        https://github.com/ganbarodigital/wp_psr3_logger
 * Description:       This plugin provides a PSR3-compliant logger for your plugin to use
 * Version:           1.0.0
 * Author:            Ganbaro Digital
 * Author URI:        https://ganbarodigital.com
 * License:           3-Clause BSD
 * License URI:       http://www.opensource.org/licenses/bsd-license.php
 * Domain Path:       /languages
 * Text Domain:       wp_psr3_logger
 * Network:           true
 * GitHub Plugin URI: https://github.com/ganbarodigital/wp_psr3_logger
 * GitHub Branch:     develop
 * Requires WP:       4.0
 * Requires PHP:      5.6
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// make sure our logging plugin has been loaded
$wpLoggingServiceFile = 'wp_psr3_logger/wp_psr3_logger.php';
require_once(WP_PLUGIN_DIR . '/' . $wpLoggingServiceFile);

// avoid the plugin also being activated by the normal mechanism
add_action(
    'activated_plugin',
    function($plugin, $network_wide) use ($wpLoggingServiceFile) {
        if ($plugin === $wpLoggingServiceFile) {
            deactivate_plugins($wpLoggingServiceFile);
        }
    },
    10,
    2
);

// modify the plugins admin panel
function wpls_mu_plugin_active($actions)
{
    if (isset($actions['activate'])) {
        unset($actions['activate']);
    }
    if (isset($actions['delete'])) {
        unset($actions['delete']);
    }
    if (isset($actions['deactivate'])) {
        unset($actions['deactivate']);
    }

    return array_merge([
        'mu-plugin' => esc_html__('Activated as mu-plugin', 'wp_logging_service')
    ], $actions);
}


add_filter('network_admin_plugin_action_links_' . $wpLoggingServiceFile, 'wpls_mu_plugin_active' );
add_filter('plugin_action_links_' . $wpLoggingServiceFile, 'wpls_mu_plugin_active' );
add_action(
    'after_plugin_row_' . $wpLoggingServiceFile,
    function () {
        print('<script>jQuery(".inactive[data-plugin=\'' . $wpLoggingServiceFile . '\']").attr("class", "active");</script>' );
        print('<script>jQuery(".active[data-plugin=\'' . $wpLoggingServiceFile . '\'] .check-column input").remove();</script>' );
    }
);