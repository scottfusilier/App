<?php
namespace App\View;

class ExampleView extends AppView
{
/*
 *  App\View\ExampleView::get()->render();
 */
    public function render()
    { ?>
<div>
<?=$this->data ?>
</div>
<?php
    }
}
