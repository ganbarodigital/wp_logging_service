<?php

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
    die;
}

function gd_wpsl_autoloader($className)
{
    // has a previous autoloader already loaded this?
    if (class_exists($className) || interface_exists($className) || trait_exists($className)) {
        return;
    }

    // the folders we will search
    static $psr0 = [
        "Psr\\Log\\" => realpath(__DIR__ . '/../vendor/psr/log'),
        "Monolog\Monolog\\" => realpath(__DIR__ . '/../vendor/monolog/monolog/src'),
    ];
    static $psr4 = [
        "GanbaroDigital\\ServiceLogger\\" => realpath(__DIR__ . '/../vendor/ganbarodigital/php-mv-service-logger'),
    ];

    // do we support the requested prefix?
    foreach ($psr0 as $prefix => $basePath) {
        if (substr($className, 0, strlen($prefix)) === $prefix) {
            // success :)
            $path = $basePath . '/' . str_replace(["_", "\\"], ["/", "/"], $className) . ".php";
            if (file_exists($path)) {
                require_once($path);
                return;
            }
        }
    }

    // no luck so far ... how about with PSR-4?
    foreach ($psr0 as $prefix => $basePath) {
        if (substr($className, 0, strlen($prefix)) === $prefix) {
            // success :)
            $path = $basePath . '/' . str_replace("\\", "/", $className) . ".php";
            if (file_exists($path)) {
                require_once($path);
                return;
            }
        }
    }

    // if we get here, then no success
}
