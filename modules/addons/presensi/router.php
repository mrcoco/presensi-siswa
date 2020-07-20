<?php
/**
 * Created by Phalms Module Generator.
 *
 * module data presensi siswa
 *
 * @package presensi
 * @author  Dwi Agus
 * @link    http://dwiagus.pw
 * @date:   2020-07-07
 * @time:   14:07:31
 * @license MIT
 */

$router->add('/presensi', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'index'
));

$router->add('/presensi/list', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'list'
));

$router->add('/presensi/create', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'create'
));

$router->add('/presensi/edit', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'edit'
));

$router->add('/presensi/get', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'get'
));

$router->add('/presensi/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'delete',
    'id'         => 1
));

$router->add('/presensi/publish', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'publish'
));

$router->add('/presensi/unpublish', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'unpublish'
));

$router->add('/presensi/laporan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'laporan'
));

$router->add('/presensi/riwayat', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'presensi',
    'action'     => 'riwayat'
));

$router->add('/presensi/izin', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'index'
));

$router->add('/presensi/izin/list', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'list'
));

$router->add('/presensi/izin/create', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'create'
));

$router->add('/presensi/izin/edit', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'edit'
));

$router->add('/presensi/izin/get', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'get'
));

$router->add('/presensi/izin/delete/{id:[0-9]+}', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'delete',
    'id'         => 1
));

$router->add('/presensi/izin', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'index'
));

$router->add('/presensi/izin', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'izin',
    'action'     => 'index'
));

$router->add('/laporan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'index'
));

$router->add('/laporan/harian', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'harian'
));

$router->add('/laporan/bulanan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'bulanan'
));

$router->add('/laporan/semester', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'semester'
));

$router->add('/cetak/harian', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'cetak_harian'
));

$router->add('/cetak/bulanan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'cetak_bulanan'
));

$router->add('/search/laporan/harian', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'search_harian'
));

$router->add('/search/laporan/bulanan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'laporan',
    'action'     => 'search_bulanan'
));

$router->add('/laporan/presensi/bulanan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'riwayat',
    'action'     => 'bulanan'
));

$router->add('/laporan/presensi/harian', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'riwayat',
    'action'     => 'harian'
));

$router->add('/search/presensi/bulanan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'riwayat',
    'action'     => 'search_bulanan'
));

$router->add('/search/presensi/harian', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'riwayat',
    'action'     => 'search_harian'
));

$router->add('/cetak/presensi/harian', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'riwayat',
    'action'     => 'cetak_harian'
));

$router->add('/cetak/presensi/bulanan', array(
    'namespace'  => 'Modules\Presensi\Controllers',
    'module'     => 'presensi',
    'controller' => 'riwayat',
    'action'     => 'cetak_bulanan'
));
