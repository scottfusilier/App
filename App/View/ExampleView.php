<?php
namespace App\View;

class ExampleView extends AppView
{
/*
 *  App\View\ExampleView::view()->render();
 */
    public function render()
    { ?>
<div>
<?=$this->data ?>
</div>
<?php
    }
}
