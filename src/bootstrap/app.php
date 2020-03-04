<?php
defined('BASEPATH') or define('BASEPATH', realpath(__DIR__.'/../../').'/');
require BASEPATH.'src/bootstrap/helpers.php';
require BASEPATH.'vendor/autoload.php';

/** Setup Dotenv */
if (!file_exists(BASEPATH.'.env')) {
    echo ".env file not found";
    die();
}
$env = new \Dotenv\Dotenv(BASEPATH);
$env->load();

date_default_timezone_set(env('TIMEZONE', date_default_timezone_get()));

/** Boot App */
$app = new \Slim\App(['settings' => require BASEPATH.'src/bootstrap/config.php']);
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
$container['logger'] = function ($c) {
    $config = $c['settings']['log'];
    $log = new \Monolog\Logger($config['name']);
    $log->pushHandler(new \Monolog\Handler\StreamHandler(BASEPATH.$config['file'], $config['level']));
    return $log;
};

/** Setup Routes */
require BASEPATH.'src/routes.php';

return $app;
