<?php
namespace App\View\Example;

use App\View\AppView;

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
