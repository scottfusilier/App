<?php
namespace App\Controller;

use Lib\Container\AppContainer as Container;
use App\Template\BasicTemplate as Template;
use App\View\Basic as View;

class UserController extends AppController
{
    public function login($request, $response, $args)
    {
        $params = $request->getParsedBody();
        $Auth = Container::get('AuthComponent');

        if (!empty($params)) {
           $params = $this->loginArgs($params);
           if (!empty($params) && $Auth->login($params)) {
                $location = $Auth->sessionGetVar('location');
                if ($location) {
                    $Auth->sessionRemoveVar($location);
                    return $this->redirect($response, $location);
                }
                return $this->redirect($response,'/');
           }
        }

        if ($Auth->hasUser()) {
            return $this->redirect($response,'/');
        }

        // render login template and view
        return $this->render($response,Template::get()->render(\App\View\User\Login::get()));
    }

    public function logout($request, $response, $args)
    {
        $Auth = Container::get('AuthComponent');
        $Auth->logout();
        return $this->redirect($response,'/login');
    }
/*
 *  Expected login args
 */
    protected function loginArgs($args)
    {
        $expected = [
            'email',
            'password',
            'token',
            'formName'
        ];

        foreach ($expected as $key) {
            if (empty($args[$key])) {
                return [];
            }
        }

        return $args;
    }
}
