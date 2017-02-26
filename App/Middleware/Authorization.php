<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Lib\Container\AppContainer as Container;
use Lib\Middleware\MiddlewareInterface;

class Authorization implements MiddlewareInterface
{
    /**
     * Middleware invokable class
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, Callable $next)
    {
        $Auth = Container::get('AuthComponent');

        $route = '';
        if (Container::isRegistered('Route')) {
            $route = Container::get('Route');
        }

        preg_match('/[^\\\\]+$/',$route,$match);
        $route = (!empty($match[0]) ? $match[0] : '');

        if (empty($route)) {
            return $response->withStatus(403);
        }

        if ($Auth->userAuthorized($route)) {
            return $response = $next($request, $response);
        }

        return $response->withStatus(403);
    }
}
