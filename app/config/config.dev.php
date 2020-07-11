<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    // 'database' => [
    //     'adapter' => 'MySql',
    //     'host' => 'localhost',
    //     'username' => 'root',
    //     'password' => 'root',
    //     'dbname' => 'phalms'
    // ],
    'application' => [
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'formsDir'       => APP_PATH . '/forms/',
        'viewsDir'       => APP_PATH . '/views/',
        'libraryDir'     => APP_PATH . '/library/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'modulesDir'     => BASE_PATH . '/modules/',
        'extendDir'      => APP_PATH . '/extend',
        'configDir'     => APP_PATH . '/config/',
        'pluginDir'      => APP_PATH . '/plugins',
        'cacheDir'       => BASE_PATH . '/cache/',
        'uploadDir'      => BASE_PATH . '/public/upload/',
        'baseUri'        => '/',
        'publicUrl'      => 'phalms.test',
        'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'mail' => [
        'fromName' => '',
        'fromEmail' => '',
        'smtp' => [
            'server' => 'smtp.gmail.com',
            'port' => 587,
            'security' => 'tls',
            'username' => '',
            'password' => ''
        ]
    ],
    'amazon' => [
        'AWSAccessKeyId' => '',
        'AWSSecretKey' => ''
    ],
    'logger' => [
        'path'     => BASE_PATH . '/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
    // Set to false to disable sending emails (for use in test environment)
    'useMail' => true
]);
