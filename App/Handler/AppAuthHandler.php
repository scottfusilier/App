<?php
namespace App\Handler;

use Lib\Handler\AppAuthHandlerInterface;

class AppAuthHandler implements AppAuthHandlerInterface
{
    public function handleAuth($controller, $action, $vars)
    {
        if ($controller->isOpenACL($action)) {
            return $controller->{$action}($vars);
        }

        if (!$controller->isAuthenticated()) {
            $noAuth = $controller->defaultUnauthAction();
            $newController = $noAuth['controller'];
            $newAction = $noAuth['action'];
            $controller = new $newController();
            return $controller->{$newAction}($vars);
        }

        if ($controller->isAuthorized($action)) {
            return $controller->{$action}($vars);
        }

        return $controller->unAuthorized();
    }
}
