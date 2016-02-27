<?php
namespace App\Model\Auth;

use App\Model\AppModel;

class Permission extends AppModel
{
    public $idPermission;
    public $Permission;

    protected function getIdField()
    {
        return 'idPermission';
    }

    protected function createTable()
    {
        //permissions
        $className = (new \ReflectionClass($this))->getShortName();
        $sql = "CREATE TABLE IF NOT EXISTS `$className` (
            `".$this->getIdField()."` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `Permission` VARCHAR(255) NOT NULL UNIQUE,
            PRIMARY KEY (`".$this->getIdField()."`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1123457408";
        $this->db->exec($sql);
    }

    public function isAuthorized($idUser, $objectName, $permission = 'Read')
    {
        $query = 'SELECT 1
            FROM User U
            INNER JOIN UserToPermGroup UPG
                ON (U.idUser = UPG.idUser)
            INNER JOIN PermGroup PG
                ON (UPG.idPermGroup = PG.idPermGroup)
            INNER JOIN PermGroupToObject PGO
                ON (PG.idPermGroup = PGO.idPermGroup)
            INNER JOIN Object O
                ON (PGO.idObject = O.idObject)
            INNER JOIN Permission P
                ON (PGO.idPermission = P.idPermission)
            WHERE
                U.idUser = :idUser
                AND O.ObjectName = :objectName
                AND P.Permission = :permission';

        $query_params = array(
            ':idUser' => $idUser,
            ':objectName' => $objectName,
            ':permission' => $permission,
        );

        try {
            // Execute the query against the database
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (\PDOException $ex) {
            // Note: On a production website, you should not output $ex->getMessage().
            // It may provide an attacker with helpful information about your code.
            die('Failed to run query: '.$ex->getMessage());
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    public function grantAuthorization($requesterId, $objectId, $permission)
    {
    }
}
