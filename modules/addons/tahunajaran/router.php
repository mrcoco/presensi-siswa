<?php
/**
 * Created by Phalms Module Generator.
 *
 * module tahun ajaran
 *
 * @package presensi
 * @author  dwiagus
 * @link    https://presensi.pw
 * @date:   2020-07-09
 * @time:   01:07:18
 * @license MIT
 */

$router->add('/tahunajaran', array(
    'namespace'  => 'Modules\Tahunajaran\Controllers',
    'module'     => 'tahunajaran',
    'controller' => 'tahunajaran',
    'action'     => 'index'
));

$router->add('/tahunajaran/list', array(
    'namespace'  => 'Modules\Tahunajaran\Controllers',
    'module'     => 'tahunajaran',
    'controller' => 'tahunajaran',
    'action'     => 'list'
));

$router->add('/tahunajaran/create', array(
    'namespace'  => 'Modules\Tahunajaran\Controllers',
    'module'     => 'tahunajaran',
    'controller' => 'tahunajaran',
    'action'     => 'create'
));

$router->add('/tahunajaran/edit', array(
    'namespace'  => 'Modules\Tahunajaran\Controllers',
    'module'     => 'tahunajaran',
    'controller' => 'tahunajaran',
    'action'     => 'edit'
));

$router->add('/tahunajaran/get', array(
    'namespace'  => 'Modules\Tahunajaran\Controllers',
    'module'     => 'tahunajaran',
    'controller' => 'tahunajaran',
    'action'     => 'get'
));

$router->add('/tahunajaran/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Tahunajaran\Controllers',
    'module'     => 'tahunajaran',
    'controller' => 'tahunajaran',
    'action'     => 'delete',
    'id'         => 1
));

