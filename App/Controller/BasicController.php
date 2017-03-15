<?php
namespace App\Controller;

use App\Template\BasicTemplate as Template;
use App\View\Basic as View;

class BasicController extends AppController
{
    public function index($request, $response, $args)
    {
        $params = array_merge($args,$request->getQueryParams());
        return $this->render($response,Template::get()->render(View\BasicView::get()->setVars(['data' => json_encode($params)])));
    }

    public function secret($request, $response, $args)
    {
        return $this->render($response,Template::get()->render(View\BasicView::get()->setVars(['data' => json_encode(['secret'=>'oats'])])));
    }
}
