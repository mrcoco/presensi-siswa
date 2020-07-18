<?php
/**
 * Created by Phalms Module Generator.
 *
 * Module dat siswa
 *
 * @package 
 * @author  dwiagus
 * @link    http://dwiagus.pw
 * @date:   2020-07-07
 * @time:   11:07:44
 * @license MIT
 */

$router->add('/siswa', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'index'
));

$router->add('/siswa/list', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'list'
));

$router->add('/siswa/create', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'create'
));

$router->add('/siswa/edit', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'edit'
));

$router->add('/siswa/get', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'get'
));

$router->add('/siswa/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'delete',
    'id'         => 1
));

$router->add('/siswa/import', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'import'
));

$router->add('/siswa/upload', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'upload'
));

//$router->add('/siswa/search/{key:[a-zA-Z0-9_-]+}', array(
//    'namespace'  => 'Modules\Siswa\Controllers',
//    'module'     => 'siswa',
//    'controller' => 'siswa',
//    'action'     => 'search',
//    'key'        => 1
//));

$router->add('/siswa/search', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'search',
));

$router->add('/siswa/publish', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'publish'
));

$router->add('/siswa/unpublish', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'unpublish'
));

$router->add('/siswa/batch', array(
    'namespace'  => 'Modules\Siswa\Controllers',
    'module'     => 'siswa',
    'controller' => 'siswa',
    'action'     => 'batch',
));
