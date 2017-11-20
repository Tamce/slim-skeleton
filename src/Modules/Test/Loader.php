<?php

namespace App\Modules\Test;

class Loader implements \Tamce\SlimModule\Interfaces\Module
{
    use \Tamce\SlimModule\Traits\ProvideRoutes;

    protected $app;

    public function load(\Slim\App $app, $config = null)
    {
        $this->app = $app;
        $this->loadRoutes([
            'prefix' => '/test',
            'routes' => [
                '' => ['GET', function ($req, $res) {
                    return $res->write('The module system is working.');
                }]
            ]
        ]);
    }

    public function setup()
    {
    }

    public function getApp()
    {
        return $this->app;
    }
}
