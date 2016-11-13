<?php
namespace App\Handler;

use Lib\Handler\AppAuthHandlerInterface;

class AppAuthHandler implements AppAuthHandlerInterface
{
    public function handleAuth($controller, $action, $vars)
    {
        if ($controller->accessControl($action)) {
            return $controller->{$action}($vars);
        }
        return $controller->defaultUnauthRedirect();
    }
}
