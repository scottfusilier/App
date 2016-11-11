<?php
namespace App\Handler;

use Lib\Handler\AppErrorHandlerInterface;
use App\View\System\FourOhFour;
use App\View\System\AppError;
use App\Template\ExampleTemplate;

class AppErrorHandler implements AppErrorHandlerInterface
{
    public function handleNotFound()
    {
        ExampleTemplate::get()->render(FourOhFour::get());
    }

    public function handleAppError(\Exception $e)
    {
        ExampleTemplate::get()->render(AppError::get());
    }
}
