<?php
/**
 * Created by Phalms Module Generator.
 *
 * module history kelas
 *
 * @package presensi
 * @author  dwiagus
 * @link    http://dwiagus.pw
 * @date:   2020-07-11
 * @time:   10:07:57
 * @license MIT
 */

$router->add('/history', array(
    'namespace'  => 'Modules\History\Controllers',
    'module'     => 'history',
    'controller' => 'history',
    'action'     => 'index'
));

$router->add('/history/list', array(
    'namespace'  => 'Modules\History\Controllers',
    'module'     => 'history',
    'controller' => 'history',
    'action'     => 'list'
));

$router->add('/history/create', array(
    'namespace'  => 'Modules\History\Controllers',
    'module'     => 'history',
    'controller' => 'history',
    'action'     => 'create'
));

$router->add('/history/edit', array(
    'namespace'  => 'Modules\History\Controllers',
    'module'     => 'history',
    'controller' => 'history',
    'action'     => 'edit'
));

$router->add('/history/get', array(
    'namespace'  => 'Modules\History\Controllers',
    'module'     => 'history',
    'controller' => 'history',
    'action'     => 'get'
));

$router->add('/history/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\History\Controllers',
    'module'     => 'history',
    'controller' => 'history',
    'action'     => 'delete',
    'id'         => 1
));

