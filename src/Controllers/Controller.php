<?php
namespace App\Controllers;

class Controller
{
    protected $container;
    protected $session;
    protected $logger;
    public function __construct($container) {
        $this->container = $container;
        // extract useful services
        $this->session = $container->session;
        $this->logger = $container->logger;
    }
}