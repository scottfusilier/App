<?php
namespace App\Model\Auth;

use App\Model\AppModel;

class Object extends AppModel
{
    public $idObject;
    public $ObjectName;

    protected function getIdField()
    {
        return 'idObject';
    }

    protected function createTable()
    {
        $className = (new \ReflectionClass($this))->getShortName();
        $sql = "CREATE TABLE IF NOT EXISTS `$className` (
              `".$this->getIdField()."` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `ObjectName` VARCHAR(255) NOT NULL UNIQUE,
              PRIMARY KEY (`".$this->getIdField()."`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1124477406";
        $this->db->exec($sql);
    }
}
