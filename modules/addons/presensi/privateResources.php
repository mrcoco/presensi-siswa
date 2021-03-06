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
            'rekap',
            'izin',
            'cetak_harian',
            'cetak_bulanan'
        ],
        'laporan' => [
            'index',
            'harian',
            'bulanan',
            'semester',
            'cetak_harian',
            'cetak_bulanan',
            'cetak_semester',
            'search_semester',
            'search_bulanan',
            'search_harian',
        ],
        'rekap' => [
            'index',
            'harian',
            'bulanan',
            'semester',
            'cetak_harian',
            'cetak_bulanan',
            'search_bulanan',
            'search_harian',
        ],
        'riwayat' => [
            'index',
            'harian',
            'bulanan',
            'semester',
            'cetak_harian',
            'cetak_bulanan',
            'search_bulanan',
            'search_harian',
        ],
        'izin' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete',
        ]
    ]
]);
