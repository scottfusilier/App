<?php
namespace App\Controller;

class ExampleController extends AppController
{
    public function index($args)
    {
        \App\View\ExampleView::view()->render();
    }
}
