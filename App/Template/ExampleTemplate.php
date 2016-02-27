<?php
namespace App\Template;

use Lib\View\BasicView;

class ExampleTemplate extends AppTemplate
{
    public function render(BasicView $content)
    {
        \App\View\ExampleHeaderView::get()->render();
        $content->render();
        \App\View\ExampleFooterView::get()->render();
    }
}
