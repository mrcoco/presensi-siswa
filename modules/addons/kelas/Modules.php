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

namespace Modules\Kelas;

use Phalcon\Loader;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $config = $di->get('config');
        $loader->registerNamespaces(
            [
                "Modules\\Kelas\\Controllers" => __DIR__."/controllers/",
                "Modules\\Kelas\\Models"      => __DIR__."/models/",
                "Modules\\Kelas\\Plugin"      => __DIR__."/plugin/",
                "Modules\\Frontend\\Controllers"      => $config->modules->core."/frontend/controllers/",
            ]
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        // registering view
        $config = $di->get('config');
        $view = $di->get('view');
        $view->setViewsDir(__DIR__. '/views/');
        $view->setMainView('main');
        $view->setLayoutsDir($config->application->layoutsDir);
        $view->setPartialsDir($config->application->adminPartialDir );
        $view->setLayout('private');
    }
}