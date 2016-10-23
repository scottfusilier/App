<?php
namespace App\Controller;

abstract class DataController extends AppController
{
    abstract protected function accessControl($method);

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
