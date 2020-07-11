<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [
        'users' => [
            'index',
            'search',
            'edit',
            'create',
            'delete',
            'list',
            'get',
            'changePassword'
        ],
        'profiles' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete'
        ],
        'banner' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete'
       ],
        'blog' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete'
        ],
        'page' => [
            'index',
            'list',
            'search',
            'edit',
            'create',
            'get',
            'delete'
        ],
        'permissions' => [
            'index'
        ],
        'dashboard' => [
            'index'
        ],
        'webconfig' => [
            'index',
            'search',
            'edit',
            'create',
            'delete',
            'list',
            'get',
            'install'
        ],
        'generator' => [
            'index',
            'search',
            'edit',
            'create',
            'delete',
            'list',
            'get',
            'submit'
        ],
        'menu' => [
            'index',
            'edit',
            'create',
            'delete',
            'list',
            'get',
        ]
    ]
]);
