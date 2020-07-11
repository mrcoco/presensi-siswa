<?php
/**
 * Created by Phalms Module Generator.
 *
 * modules hari libur
 *
 * @package presensi
 * @author  dwiagus
 * @link    http://dwiagus.pw
 * @date:   2020-07-10
 * @time:   22:07:33
 * @license MIT
 */

$router->add('/libur', array(
    'namespace'  => 'Modules\Libur\Controllers',
    'module'     => 'libur',
    'controller' => 'libur',
    'action'     => 'index'
));

$router->add('/libur/list', array(
    'namespace'  => 'Modules\Libur\Controllers',
    'module'     => 'libur',
    'controller' => 'libur',
    'action'     => 'list'
));

$router->add('/libur/create', array(
    'namespace'  => 'Modules\Libur\Controllers',
    'module'     => 'libur',
    'controller' => 'libur',
    'action'     => 'create'
));

$router->add('/libur/edit', array(
    'namespace'  => 'Modules\Libur\Controllers',
    'module'     => 'libur',
    'controller' => 'libur',
    'action'     => 'edit'
));

$router->add('/libur/get', array(
    'namespace'  => 'Modules\Libur\Controllers',
    'module'     => 'libur',
    'controller' => 'libur',
    'action'     => 'get'
));

$router->add('/libur/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Libur\Controllers',
    'module'     => 'libur',
    'controller' => 'libur',
    'action'     => 'delete',
    'id'         => 1
));

