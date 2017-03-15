<?php
namespace App\Handler;

use Lib\Handler\AppErrorHandlerInterface;
use App\View\System\FourOhFour;
use App\View\System\AppError;
use App\Template\BasicTemplate as Template;

class AppErrorHandler implements AppErrorHandlerInterface
{
    public function handleNotFound()
    {
        return Template::get()->render(FourOhFour::get());
    }

    public function handleAppError(\Exception $e)
    {
        return Template::get()->render(AppError::get());
    }
}
