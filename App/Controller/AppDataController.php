<?php
namespace App\Controller;

abstract class AppDataController extends AppController
{
    protected $openACL = [];

    protected function accessControl($method)
    {
        return ($this->Auth->hasUser() || in_array($method, $this->openACL));
    }

    public function data($args)
    {
        if (!empty($args['type']) && $args['type'] === __FUNCTION__) {
            if (!empty($args['action']) && method_exists($this, $args['action'])) {
                $method = $args['action'];
                if ($this->accessControl($method)) {
                    return $this->$method($args);
                }
                return $this->unAuthorized();
            }
        }
        return $this->renderFourOhFour();
    }
}
