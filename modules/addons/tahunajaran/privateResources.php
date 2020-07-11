<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'tahunajaran' => [
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
