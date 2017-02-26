<?php
/**
 * Application Routes
 */

/* register middleware groups, note: these can be added on a per-route basis */
Lib\App::getInstance()->addMiddlewares('Atn', [
    new App\Middleware\Authentication
]);

Lib\App::getInstance()->addMiddlewares('Atr', [
    new App\Middleware\Authorization,
    new App\Middleware\Authentication
]);

//Lib\App::getInstance()->setGlobalMiddlewares([new App\Middleware\Authorization]);

/* application routes */

$routes = function (FastRoute\RouteCollector $r) {

$r->get('/[{id:\d+}]', ['App\Controller\BasicController::index']);

$r->addRoute(['GET','POST'], '/login', ['App\Controller\UserController::login']);

$r->get('/logout', ['App\Controller\UserController::logout']);

$r->addRoute(['GET','POST'], '/protected[/{id:\d+}]', ['App\Controller\BasicController::secret','Atn']);

$r->get('/protected/permissioned', ['App\Controller\BasicController::secret','Atr']);

$r->get('/hello', [function($request, $response, $vars) {
    $response->getBody()->write('hello');
    return $response;
}]);

$r->get('/example', [\App\Controller\ExampleController::class,'Atn']);
$r->get('/example2', [\App\Controller\BasicController::class.'::index','Atr']);
$r->get('/example/[{id:\d+}]', [\App\Controller\BasicController::class.'::index']);

$r->addRoute(['GET', 'POST'], '/api/{something}', [\App\Controller\BasicController::class.'::index']);

$r->addGroup('/here/there', function (FastRoute\RouteCollector $r) {
    $r->get('/something', [function ($request, $response, $vars) { $response->getBody()->write("do a thing"); return $response; }]);
    $r->get('/another-route', [\App\Controller\ExampleController::class, 'Atn']);
    $r->get('/protected-route', [function ($request, $response, $vars) { $response->getBody()->write("do secret things"); return $response; },'Atn']);
});

return $r;
};
