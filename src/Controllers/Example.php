<?php
namespace App\Controllers;

class Example extends Controller
{
    public function home($req, $res) {
        $this->logger->info('Example:home accessed.');
        return $res->write('Hello Slim!');
    }
}