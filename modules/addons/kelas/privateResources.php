<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'kelas' => [
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
