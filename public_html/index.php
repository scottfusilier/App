<?php

include dirname(dirname(__FILE__)).'/App/bootstrap.php';

session_start();

/* run the application */
Lib\Container\AppContainer::register(new App\Handler\AppErrorHandler);
Lib\Container\AppContainer::register(new App\Handler\AppAuthHandler);

Lib\App::getInstance()->run($routes);
