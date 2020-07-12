<?php
/**
 * Created by Phalms Module Generator.
 *
 * module pengumuman
 *
 * @package 
 * @author  dwiagus
 * @link    http://
 * @date:   2020-07-12
 * @time:   05:07:49
 * @license MIT
 */

$router->add('/pengumuman', array(
    'namespace'  => 'Modules\Pengumuman\Controllers',
    'module'     => 'pengumuman',
    'controller' => 'pengumuman',
    'action'     => 'index'
));

$router->add('/pengumuman/list', array(
    'namespace'  => 'Modules\Pengumuman\Controllers',
    'module'     => 'pengumuman',
    'controller' => 'pengumuman',
    'action'     => 'list'
));

$router->add('/pengumuman/create', array(
    'namespace'  => 'Modules\Pengumuman\Controllers',
    'module'     => 'pengumuman',
    'controller' => 'pengumuman',
    'action'     => 'create'
));

$router->add('/pengumuman/edit', array(
    'namespace'  => 'Modules\Pengumuman\Controllers',
    'module'     => 'pengumuman',
    'controller' => 'pengumuman',
    'action'     => 'edit'
));

$router->add('/pengumuman/get', array(
    'namespace'  => 'Modules\Pengumuman\Controllers',
    'module'     => 'pengumuman',
    'controller' => 'pengumuman',
    'action'     => 'get'
));

$router->add('/pengumuman/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Pengumuman\Controllers',
    'module'     => 'pengumuman',
    'controller' => 'pengumuman',
    'action'     => 'delete',
    'id'         => 1
));

