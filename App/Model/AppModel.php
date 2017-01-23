<?php
namespace App\Model;

use Lib\Model\SqlModel;

abstract class AppModel extends SqlModel
{
    public function setup()
    {
        return $this->createTable();
    }
}
