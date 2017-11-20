<?php

$app->get('/', function ($req, $res) {
    $this->log->info('Log is working! Client accessed "/"');
    return $res->write('Slim is working! <br><a href="/module">Click Here</a> to check if the module system is working.');
});
