<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'libur' => [
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
