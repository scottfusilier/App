<?php
namespace App\Template;

use Lib\View\BasicView;
use App\View\Example\ExampleHeaderView;
use App\View\Example\ExampleFooterView;

class ExampleTemplate extends AppTemplate
{
    public function render(BasicView $content)
    {
        // site header
        ExampleHeaderView::get()->render();
        // site content
        $content->render();
        // site footer
        ExampleFooterView::get()->render();
    }
}
