<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'siswa' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete',
            'batch',
            'import',
            'upload'
        ],
    ]
]);
