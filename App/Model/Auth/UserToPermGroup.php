<?php
namespace App\Model\Auth;

use App\Model\AppModel;

class UserToPermGroup extends AppModel
{
    public $idUserToPermGroup;
    public $idUser;
    public $idPermGroup;

    protected function getIdField()
    {
        return 'idUserToPermGroup';
    }

    protected function createTable()
    {
        $className = (new \ReflectionClass($this))->getShortName();
        $sql = "CREATE TABLE IF NOT EXISTS `$className` (
              `".$this->getIdField()."` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
              `idUser` INT(10) UNSIGNED NOT NULL, 
              `idPermGroup` INT(10) UNSIGNED NOT NULL, 
              PRIMARY KEY (`".$this->getIdField()."`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1134471211";
        $this->db->exec($sql);
    }
}
