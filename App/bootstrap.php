<?php
/* */

$loader = include dirname(__DIR__).'/vendor/autoload.php';
$loader->add('App\\', dirname(__DIR__));

include __DIR__.'/Config/config.php';
include __DIR__.'/Config/routes.php';

Lib\Container\AppContainer::register(new App\Handler\AppErrorHandler);

Lib\App::run($routes);
