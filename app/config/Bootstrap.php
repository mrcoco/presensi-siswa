<?php
/**
 * Created by PhpStorm.
 * User: dwiagus
 * Date: 27/12/16
 * Time: 22:29
 */
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Crypt;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbMysqlAdapter;
use Phalcon\Db\Adapter\Pdo\Postgresql as DbPgsqlAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Logger\Formatter\Line as FormatterLine;
use Phalms\Auth\Auth;
use Phalms\Acl\Acl;
use Phalms\HelperExtension;
use Phalms\Mail\Mail;
use Phalms\PhpFunctionExtension;
use Phalms\Widget\Widget;
class Bootstrap
{
    public function run()
    {
        /**
         * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
         */
        $di = new Phalcon\DI\FactoryDefault();

        $this->loader($di);
        /**
         * Read services
         */
        $this->service($di);
        /**
         * Include Autoloader
         */
        $application = new Application($di);
        //$arr_modules = include APP_PATH . '/config/modules.php';
        $modules = $this->modulesConfig();
        $application->registerModules($modules);
//         echo "<pre>";
//         print_r($modules);
//         echo "</pre>";
        echo $application->handle()->getContent();
    }

    public function arrModules()
    {
        $modules = APP_PATH . '/config/modules.php';
        if(file_exists($modules)){
            $arr_modules = include APP_PATH . '/config/modules.php';
            return $arr_modules;
        }
        return false;
    }

    public function coreModules()
    {
        $modules = APP_PATH . '/config/core.module.php';
        if(file_exists($modules)){
            $arr_modules = include APP_PATH . '/config/core.module.php';  
            return $arr_modules;
        }  
        return false;
    }

    public function lmsModules()
    {
        $modules = APP_PATH . '/config/lms.module.php';
        if(file_exists($modules)){
            $arr_modules = include APP_PATH . '/config/lms.module.php';
            return $arr_modules;
        }
        return false;
    }


    public function loader($di)
    {
        /**
         * Get config service for use in inline setup below
         */
        $config = $this->config();
        $loader = new Phalcon\Loader();

        /**
         * We're a registering a set of directories taken from the configuration file
         */
        $loader->registerNamespaces([
            'Phalms'             => $config->application->libraryDir,
            'Modules'            => $config->application->modulesDir,
            'Extend'             => $config->application->extendDir,
            'Plugins'            => $config->application->pluginDir,
            
        ]);

        //force failed load class
        $loader->registerClasses([
                "Modules\Banner\Models\Banner"      => $config->application->modulesDir."addons/banner/models/Banner.php",
                "Modules\Cms\Models\Blog"           => $config->application->modulesDir."addons/cms/models/Blog.php",
                "Modules\Cms\Models\PageCategory"   => $config->application->modulesDir."addons/cms/models/PageCategory.php",
                "Modules\Gallery\Models\Image"      => $config->application->modulesDir."addons/gallery/models/Image.php",
                "Modules\Menu\Models\Menu"          => $config->application->modulesDir."core/menu/models/Menu.php",
                "Modules\Modules\Models\Modules"    => $config->application->modulesDir."core/modules/models/Modules.php",
                "Modules\User\Models\RememberTokens"    => $config->application->modulesDir."core/user/models/RememberTokens.php",
                "Modules\User\Models\Profiles"    => $config->application->modulesDir."core/user/models/Profiles.php",
                "Modules\User\Models\Permissions"    => $config->application->modulesDir."core/user/models/Permissions.php",
            ]);

        $loader->register();
        return $loader;
    }

    public function service($di)
    {
        $di->setShared('config', $this->config());
        $config = $di->getConfig();

        /**
         * The URL component is used to generate all kind of urls in the application
         */
        $di->setShared('url', $this->url($config));

        /**
         * Setting up the view component
         */
        $di->set('view', $this->view($di), true);

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di->set('db', $this->dataBase($config));

        /**
         * If the configuration specify the use of metadata adapter use it or use memory otherwise
         */
        $di->set('modelsMetadata', $this->meta($config));

        /**
         * Start the session the first time some component request the session service
         */
        $di->set('session', $this->session());

        /**
         * Crypt service
         */
        $di->set('crypt',$this->crypt($config));

        /**
         * Dispatcher use a default namespace
         */
        $di->set('dispatcher', $this->dispatch());
        /**
         * Setup the private resources, if any, for performance optimization of the ACL.
         */
        $di->setShared('AclResources', $this->aclResorces());
        $di->set('privateAclResource', $this->aclResorces());

        /**
         * Access Control List
         * Reads privateResource as an array from the config object.
         */
        $di->set('acl', $this->acl($di));

        /**
         * Logger service
         */
        $di->set('logger', function ($filename = null, $format = null)use ($config){
            $this->logger($filename,$format,$config);
        });

        /**
         * Loading routes from the routes.php file
         */
        $di->set('router', function () {
            return require APP_PATH . '/config/routes.php';
        });

        /**
         * Flash service with custom CSS classes
         */
        $di->set('flash', function () {
            $flash =  new Flash([
                'error'     => 'alert alert-danger',
                'success'   => 'alert alert-success',
                'notice'    => 'alert alert-info',
                'warning'   => 'alert alert-warning'
            ]);
            $flash->setAutoescape(false);
            return $flash;
        });

        /**
         * Custom authentication component
         */
        $di->set('auth', function () {
            return new Auth();
        });

        /**
         * Mail service uses AmazonSES
         */
        $di->set('mail', function () {
            return new Mail();
        });

        $di->set('widget', function (){
            return new Widget();
        });

    }

    public function config()
    {
        $config = include APP_PATH . '/config/config.php';

        if (is_readable(APP_PATH . '/config/config.db.php')) {
            $override = include APP_PATH . '/config/config.db.php';
            $config->merge($override);
        }

        return $config;
    }

    public function url($config)
    {
        $url = new UrlResolver();
        $url->setBaseUri($config->application->baseUri);
        return $url;
    }

    public function view($di)
    {
        $config = $di->getConfig();
        $view = new View();

        $view->setViewsDir($config->application->viewsDir);

        $view->registerEngines([
            '.volt' => function ($view) use ($di,$config){


                $volt = new VoltEngine($view, $di);

                $volt->setOptions([
                    'compiledPath' => $config->application->cacheDir . 'volt/',
                    'compiledSeparator' => '_'
                ]);
                $compiler = $volt->getCompiler();
                $compiler->addExtension(
                    new PhpFunctionExtension()
                );
                $compiler->addFunction(
                    'search_arr',
                    function ($resolvedArgs, $exprArgs) {
                        return 'Phalms\HelperExtension::search_by_value(' . $resolvedArgs . ')';
                    }
                );

                return $volt;
            }
        ]);

        return $view;
    }


    public function dataBase($config)
    {
        if($config->database->adapter == 'Postgresql'){
            return new DbPgsqlAdapter([
                'host' => $config->database->host,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname' => $config->database->dbname
            ]);
        }else{
            return new DbMysqlAdapter([
                'host' => $config->database->host,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname' => $config->database->dbname,
                'port'  => $config->database->port,
            ]);
        }
    }


    public function meta($config)
    {
        return new MetaDataAdapter([
            'metaDataDir' => $config->application->cacheDir . 'metaData/'
        ]);
    }


    public function session()
    {
        $session = new SessionAdapter();
        $session->start();
        return $session;
    }

    public function crypt($config)
    {
        $crypt = new Crypt();
        $crypt->setKey($config->application->cryptSalt);
        return $crypt;
    }


    public function dispatch()
    {
        $dispatcher = new Dispatcher();
        $dispatcher->setDefaultNamespace('Modules\Frontend\Controllers');
        return $dispatcher;
    }

    public function aclResorces()
    {
        $resource = include APP_PATH . '/config/privateResources.php';
        $modules_list = $this->arrModules();
            foreach ($modules_list as $module) {
                if(file_exists(BASE_PATH . '/modules/addons/' . $module . '/privateResources.php')){
                    $module_resource = include BASE_PATH . '/modules/addons/' . $module . '/privateResources.php';
                    $resource->merge($module_resource);
                }
            }
        return $resource;
    }

    public function acl($di)
    {
        $acl = new Acl();
        $pr = $this->aclResorces()->privateResources->toArray();
        //$pr = $di->getShared('AclResources')->privateResources->toArray();
        $acl->addPrivateResources($pr);
        return $acl;
    }

    public function logger($filename = null , $format = null ,$config)
    {
        $format   = $format ?: $config->get('logger')->format;
        $filename = trim($filename ?: $config->get('logger')->filename, '\\/');
        $path     = rtrim($config->get('logger')->path, '\\/') . DIRECTORY_SEPARATOR;

        $formatter = new FormatterLine($format, $config->get('logger')->date);
        $logger    = new FileLogger($path . $filename);

        $logger->setFormatter($formatter);
        $logger->setLogLevel($config->get('logger')->logLevel);

        return $logger;
    }

    public function modulesConfig()
    {
        $modules = array_merge($this->coreModulesConfig(),$this->lmsModulesConfig(),$this->addonModuleConfig());
        return $modules;
    }

    public function coreModulesConfig()
    {
        $core_modules = $this->coreModules();
        $modules = array();
        if(!empty($core_modules)){
            foreach ($core_modules as $core) {
                $simple = Phalcon\Text::uncamelize($core);
                $simple = str_replace('_', '-', $simple);
                $modules[$simple] = array(
                    'namespace' => 'Modules\\'.ucfirst($core),
                    'className' => 'Modules\\'.ucfirst($core) . '\Module',
                    'path' => BASE_PATH . '/modules/core/' . $core . '/Modules.php'
                );
            }
        }
        return $modules;
    }

    public function lmsModulesConfig()
    {
        $lms_modules = $this->lmsModules();
        $modules = array();
        if(!empty($lms_modules)) {
            foreach ($lms_modules as $lms) {
                $simple = Phalcon\Text::uncamelize($lms);
                $simple = str_replace('_', '-', $simple);
                $modules[$simple] = array(
                    'namespace' => 'Modules\\'.ucfirst($lms),
                    'className' => 'Modules\\'.ucfirst($lms) . '\Module',
                    'path' => BASE_PATH . '/modules/lms/' . $lms . '/Modules.php'
                );
            }
        }

        return $modules;
    }

    public function addonModuleConfig()
    {
        $modules_list = $this->arrModules();
        $modules = array();
        if(!empty($modules_list)) {
            foreach ($modules_list as $module) {
                $simple = Phalcon\Text::uncamelize($module);
                $simple = str_replace('_', '-', $simple);
                $modules[$simple] = array(
                    'namespace' => 'Modules\\'.ucfirst($module),
                    'className' => 'Modules\\'.ucfirst($module) . '\Module',
                    'path' => BASE_PATH . '/modules/addons/' . $module . '/Modules.php'
                );
            }
        }

        return $modules;
    }
}