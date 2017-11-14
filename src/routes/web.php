<?php

$app->get('/', function ($req, $res) {
    $this->log->info('Client Accessed.');
    return $res->write('Hello Slim!');
});
