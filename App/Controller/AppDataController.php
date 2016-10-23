<?php
namespace App\Controller;

abstract class AppDataController extends AppController
{
    protected $acl = [];

    protected function accessControl($method)
    {
        return (!in_array($method, $this->acl ) || $this->Auth->hasUser());
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
        return $this->fourOhFour();
    }
}
