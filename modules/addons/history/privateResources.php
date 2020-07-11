<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'history' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete'
        ],
    ]
]);
