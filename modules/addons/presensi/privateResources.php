<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'presensi' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete',
            'publish',
            'unpublish',
            'laporan',
            'riwayat',
            'izin',
        ],
    ]
]);
