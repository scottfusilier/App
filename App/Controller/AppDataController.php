<?php
namespace App\Controller;

abstract class AppDataController extends AppController
{
    public function data($args)
    {
        if (!empty($args['action']) && method_exists($this, $args['action'])) {
            $method = $args['action'];
            if ($this->isOpenACL($method) || $this->isAuthorized($method)) {
                return $this->$method($args);
            }
            return $this->unAuthorized();
        }
        return $this->renderFourOhFour();
    }
}
