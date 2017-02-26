<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Container\AppContainer as Container;
use Lib\Middleware\MiddlewareInterface;

class Authentication implements MiddlewareInterface
{
    /**
     * Middleware invokable class
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Callable $next)
    {
        $Auth = Container::get('AuthComponent');
        if ($Auth->hasUser()) {
            return $response = $next($request, $response);
        }

        $mimeTypes = explode(',', (!empty($request->getServerParams()['HTTP_ACCEPT']) ? $request->getServerParams()['HTTP_ACCEPT'] : ''));

        if (in_array('text/html', $mimeTypes)) {
            $location = $request->getUri()->getPath();
            $Auth->sessionSetVar('location', $location);
            return $response->withStatus(302)->withHeader('Location', '/login');
        }

        return $response->withStatus(401);
    }
}
