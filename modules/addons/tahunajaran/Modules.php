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

namespace Modules\Tahunajaran;

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
                "Modules\\Tahunajaran\\Controllers" => __DIR__."/controllers/",
                "Modules\\Tahunajaran\\Models"      => __DIR__."/models/",
                "Modules\\Tahunajaran\\Plugin"      => __DIR__."/plugin/",
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