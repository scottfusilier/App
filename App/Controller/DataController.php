<?php
namespace App\Controller;

use Lib\Controller\Controller;

abstract class DataController extends Controller
{
    public function data($args)
    {
        if (isset($args['type']) && $args['type'] === __FUNCTION__) {
            if (isset($args['action']) && method_exists($this, $args['action'])) {
                $method = $args['action'];
                $this->$method($args);
                return;
            }
        }

        $this->unAuthorized();
    }
}
