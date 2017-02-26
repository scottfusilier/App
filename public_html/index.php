<?php

include dirname(dirname(__FILE__)).'/App/bootstrap.php';

session_start();

/* run the application */
Lib\App::getInstance()->run($routes);
