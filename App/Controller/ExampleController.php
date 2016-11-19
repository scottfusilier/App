<?php
namespace App\Controller;

use App\Template\ExampleTemplate;

class ExampleController extends AppController
{
    protected $openACL = [
        'index'
    ];

    public function index($args)
    {
        ExampleTemplate::get()->render(\App\View\Example\ExampleView::get()->setVars(['data' => json_encode($args)]));
    }
}
