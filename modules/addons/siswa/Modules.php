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

namespace Modules\Siswa;

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
                "Modules\\Siswa\\Controllers" => __DIR__."/controllers/",
                "Modules\\Siswa\\Models"      => __DIR__."/models/",
                "Modules\\Siswa\\Plugin"      => __DIR__."/plugin/",
                "Modules\\Frontend\\Controllers"      => $config->modules->core."/frontend/controllers/",
                "Modules\\User\\Models"      => $config->modules->core."/user/models/",
                "Modules\\Kelas\\Models"      => $config->modules->addons."/kelas/models/",
                "Modules\\History\\Models"      => $config->modules->addons."/history/models/",
                "Modules\\Tahunajaran\\Models"      => $config->modules->addons."/tahunajaran/models/",
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