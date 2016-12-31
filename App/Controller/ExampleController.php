<?php
namespace App\Controller;

use App\Template\ExampleTemplate;
use App\View\Example as View;

class ExampleController extends AppController
{
    protected $openACL = [ // no authentication required
        'index',
        'login',
        'logout',
    ];

    public function index($args)
    {
        return ExampleTemplate::get()->render(View\ExampleView::get()->setVars(['data' => json_encode($args)]));
    }

    public function dashboard($args)
    {
        return ExampleTemplate::get()->render(View\Dashboard::get());
    }

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

    public function login($args)
    {
        if (!empty($args)) {
           $parms = $this->loginArgs($args);
           if (!empty($parms) && $this->Auth->login($parms)) {
                $location = $this->Auth->sessionGetVar('location');
                if ($location) {
                    $this->Auth->sessionRemoveVar($location);
                    return $this->redirect($location);
                }
                return $this->redirect('/');
           }
        }

        if ($this->Auth->hasUser()) {
            return $this->redirect('/');
        }

        return ExampleTemplate::get()->render(\App\View\User\Login::get());
    }

    public function logout($args)
    {
        $this->Auth->logout();
        return $this->redirect('/login');
    }
}
