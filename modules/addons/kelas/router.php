<?php
/**
 * Created by Phalms Module Generator.
 *
 * module managemen kelas
 *
 * @package presensi
 * @author  dwiagus
 * @link    https://dwiagus.pw
 * @date:   2020-07-09
 * @time:   00:07:18
 * @license MIT
 */

$router->add('/kelas', array(
    'namespace'  => 'Modules\Kelas\Controllers',
    'module'     => 'kelas',
    'controller' => 'kelas',
    'action'     => 'index'
));

$router->add('/kelas/list', array(
    'namespace'  => 'Modules\Kelas\Controllers',
    'module'     => 'kelas',
    'controller' => 'kelas',
    'action'     => 'list'
));

$router->add('/kelas/create', array(
    'namespace'  => 'Modules\Kelas\Controllers',
    'module'     => 'kelas',
    'controller' => 'kelas',
    'action'     => 'create'
));

$router->add('/kelas/edit', array(
    'namespace'  => 'Modules\Kelas\Controllers',
    'module'     => 'kelas',
    'controller' => 'kelas',
    'action'     => 'edit'
));

$router->add('/kelas/get', array(
    'namespace'  => 'Modules\Kelas\Controllers',
    'module'     => 'kelas',
    'controller' => 'kelas',
    'action'     => 'get'
));

$router->add('/kelas/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Kelas\Controllers',
    'module'     => 'kelas',
    'controller' => 'kelas',
    'action'     => 'delete',
    'id'         => 1
));

