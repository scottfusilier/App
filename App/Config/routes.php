<?php
/**
 * Application Routes
 */

$routes = function (FastRoute\RouteCollector $r) {

$r->addRoute('GET', '/', '\App\Controller\ExampleController::index');

$r->addRoute('GET', '/dashboard', '\App\Controller\ExampleController::dashboard');

$r->addRoute(['GET','POST'] , '/example', function ($args) { var_dump($args); });

$r->addRoute('POST', '/data', '\App\Controller\ExampleDataController::data');

$r->addRoute(['GET', 'POST'], '/s/{action}', '\App\Controller\ExampleDataController::data');

$r->addRoute(['GET', 'POST'], '/login', '\App\Controller\ExampleController::login');
$r->addRoute('GET', '/logout', '\App\Controller\ExampleController::logout');

//$r->addRoute(['GET', 'POST'], '/user/{id:\d+}', '\App\Controller\ExampleController::user');
//$r->addRoute(['POST', 'OPTIONS'], '/api/{something}', '\App\Controller\ExampleController::api');

return $r;
};
