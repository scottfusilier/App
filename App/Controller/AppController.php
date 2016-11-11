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

    public function accessControl($method)
    {
        return ($this->Auth->hasUser() || in_array($method, $this->openACL));
    }

    public function defaultUnauthRedirect()
    {
        return $this->redirect('/');
    }
}
