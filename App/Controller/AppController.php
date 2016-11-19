<?php
namespace App\Controller;

use Lib\Controller\Controller;
use Lib\Container\AppContainer;
use App\Module\AuthenticationModule;

abstract class AppController extends Controller
{
    protected $Auth;
    protected $openACL = []; //redefine in child classes

    public function __construct()
    {
        $this->setAuth();
    }

    protected function setAuth()
    {
        $this->Auth = new AuthenticationModule();
    }

    protected function renderFourOhFour()
    {
        $this->fourOhFour();
        AppContainer::getInstance('AppErrorHandler')->handleNotFound();
    }

    public function isAuthenticated()
    {
        return $this->Auth->hasUser();
    }

    public function isOpenACL($method)
    {
        return in_array($method, $this->openACL);
    }

    public function isAuthorized($method)
    {
        // your permission check implentation here
        $className = (new \ReflectionClass($this))->getShortName();
        return $this->Auth->userAuthorized($className . '.' . $method);
    }

    public function defaultUnauthAction()
    {
        return [
            'controller' => 'App\\Controller\\ExampleController',
            'action' => 'index'
        ];
    }
}
