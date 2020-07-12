<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'pengumuman' => [
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
