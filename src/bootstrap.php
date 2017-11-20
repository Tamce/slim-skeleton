<?php
defined('BASEPATH') or define('BASEPATH', realpath(__DIR__.'/../').'/');
require BASEPATH.'vendor/autoload.php';

/** Setup Dotenv */
require BASEPATH.'src/helpers.php';
$env = new \Dotenv\Dotenv(BASEPATH);
$env->load();

/** Boot App */
$app = new \Slim\App(['settings' => require BASEPATH.'src/config.php']);
$container = $app->getContainer();

/** Setup Eloquent */
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function ($c) use ($capsule) {
    return $capsule;
};

/** Setup Session */
$app->add(new Slim\Middleware\Session($container['settings']['session']));
$container['session'] = function ($c) {
    return new SlimSession\Helper;
};

/** Setup Logger */
$container['log'] = function ($c) {
    $config = $c['settings']['log'];
    $log = new \Monolog\Logger($config['name']);
    $log->pushHandler(new \Monolog\Handler\StreamHandler(BASEPATH.$config['file'], $config['level']));
    return $log;
};

/** Setup Module Loader */
$modules = new \Tamce\SlimModule\Loader($app, 'App\\Modules\\');
$container['modules'] = $modules;

/** Setup Routes */
require BASEPATH.'src/routes/web.php';
require BASEPATH.'src/routes/modules.php';

return $app;
