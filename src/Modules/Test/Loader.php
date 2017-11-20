<?php
namespace App\Modules\Test;

use Tamce\SlimModule\Module;
use Tamce\SlimModule\Interfaces\Module as IModule;
use Tamce\SlimModule\Traits\ProvideRoutes;

class Loader extends Module implements IModule
{
    use ProvideRoutes;

    public function load(\Slim\App $app, $config = null)
    {
        parent::load($app, $config);
        $this->loadRoutes([
            'prefix' => '/module',
            'routes' => [
                '' => ['GET', function ($req, $res) {
                    return $res->write('The module system is working.');
                }]
            ]
        ]);
    }
}

