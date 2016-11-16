<?php

use GanbaroDigital\ServiceLogger\V1\BuildServiceLogger;
use GanbaroDigital\ServiceLogger\V1\ServiceFormatter;
use GanbaroDigital\ServiceLogger\V1\ServiceLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\UidProcessor;

/*
 * Exit if called directly.
 * PHP version check and exit.
 */
if ( ! defined( 'WPINC' ) ) {
    die;
}

class PSR3_LOG
{
    /**
     * a PSR3-compliant logger for you to use
     *
     * @var ServiceLogger
     */
    public static $logger;

    /**
     * creates a new logger
     *
     * @return void
     */
    public static function init()
    {
        // here's the default config we're going to use, if none is
        // provided
        $defaultConfig = [
            'min_log_level' => 'INFO',
            'log_file' => ABSPATH . 'blog.log',
        ];

        // TODO: get overrides from the WP database
        //
        // we'll come back to this when we have an admin interface

        // build the component that will write log messages out
        $handler = new StreamHandler($defaultConfig['log_file'], $defaultConfig['min_log_level']);
        $handler->setFormatter(new ServiceFormatter);

        // build the logger itself
        self::$logger = new ServiceLogger(
            "ServiceLogger",
            [ $handler ],
            [ new IntrospectionProcessor ]
        );

        // all done
    }
}

PSR3_LOG::init();
