<?php
/**
 * Application Routes
 */

$routes = function (FastRoute\RouteCollector $r) {

$r->get('/', '\App\Controller\ExampleController::index');

$r->get('/dashboard', '\App\Controller\ExampleController::dashboard');

$r->addRoute(['GET','POST'] , '/example', function ($args) { var_dump($args); });

$r->post('/data', '\App\Controller\ExampleDataController::data');

$r->addRoute(['GET', 'POST'], '/s/{action}', '\App\Controller\ExampleDataController::data');

$r->addRoute(['GET', 'POST'], '/login', '\App\Controller\ExampleController::login');

$r->get('/logout', '\App\Controller\ExampleController::logout');

$r->addGroup('/here/there', function (FastRoute\RouteCollector $r) {
    $r->get('/do-something', function ($args) { echo "do a thing"; });
    $r->get('/do-another-thing', function ($args) { echo "do another thing"; });
    $r->get('/do-the-things', function ($args) { echo "do all the things"; });
});

//$r->addRoute(['GET', 'POST'], '/user/{id:\d+}', '\App\Controller\ExampleController::user');
//$r->addRoute(['POST', 'OPTIONS'], '/api/{something}', '\App\Controller\ExampleController::api');

return $r;
};
