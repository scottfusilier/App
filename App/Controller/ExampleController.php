<?php
namespace App\Controller;

use App\Template\ExampleTemplate;

class ExampleController extends AppController
{
    public function index($args)
    {
        ExampleTemplate::get()->render(\App\View\ExampleView::get()->setVars(['data' => var_dump($args)]));
    }
}
