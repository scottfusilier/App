<?php
namespace App\Handler;

use Lib\Handler\AppErrorHandlerInterface;
use App\View\FourOhFour;
use App\Template\ExampleTemplate;

class AppErrorHandler implements AppErrorHandlerInterface
{
    public function handleNotFound()
    {
        ExampleTemplate::get()->render(FourOhFour::get());
    }
}
