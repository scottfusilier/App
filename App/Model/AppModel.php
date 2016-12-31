<?php
namespace App\Model;

use Lib\Model\Model;

abstract class AppModel extends Model
{
    public function setup()
    {
        return $this->createTable();
    }
}
