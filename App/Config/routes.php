<?php
/**
 * Application Routes
 */

$routes = function (FastRoute\RouteCollector $r) {

$r->addRoute('GET', '/', '\App\Controller\ExampleController::index');

$r->addRoute(['GET','POST'] , '/example', function ($args) { var_dump($args); });

$r->addRoute('POST', '/data', '\App\Controller\ExampleDataController::data');

$r->addRoute(['GET', 'POST'], '/s/{action}', '\App\Controller\ExampleDataController::data');

//$r->addRoute('GET', 'POST'], '/user/{id:\d+}', '\App\Controller\ExampleController::react');

//$r->addRoute(['POST', 'OPTIONS'], '/api/{something}', '\App\Controller\ExampleController::api');

return $r;
};
