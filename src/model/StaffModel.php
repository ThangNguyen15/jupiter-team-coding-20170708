<?php
/**
 * Created by PhpStorm.
 * User: hieuhpt
 * Date: 08/07/2017
 * Time: 16:26
 */

namespace Src\Model;

use Src\Model\DatabaseConfig as DBConfig;
use Src\Entity\Staff as StaffEntity;

class StaffModel
{
    private $dbh;
    public function __construct()
    {
        $this->dbh = self::Connect(new DBConfig());
    }
    public function __destruct()
    {
        $this->dbh = null;
    }
    static public function Connect(DBConfig $dbConfig)
    {
        return new
        \PDO("mysql:host=" . $dbConfig->getServerName() . ";dbname=" . $dbConfig->getDbname(), $dbConfig->getUserName(), $dbConfig->getPassword());
    }
    public function CreateStaff(StaffEntity $staff_e)
    {
        parse_str(file_get_contents("php://input"), $staffArray);
        $staff_e->setName($staffArray["name"]);
        $staff_e->setAge($staffArray["age"]);
        $name = $staff_e->getName();
        $age = $staff_e->getAge();
        $stmt = $this->dbh->prepare("INSERT INTO staff (name, age) VALUES (:name,:age)");
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':age',$age);
        $bool = $stmt->execute();
        $staff_e->setId($this->dbh->lastInsertId());
        return  $bool;
    }
    public function GetStaffById($staffId)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM staff WHERE id = $staffId");
        $stmt->execute();
        return new StaffEntity($stmt->fetch(\PDO::FETCH_ASSOC));
    }
    public function UpdateStaff(StaffEntity $staff_e)
    {
        parse_str(file_get_contents("php://input"), $staffArray);
        $staff_e->setName($staffArray["name"]);
        $staff_e->setAge($staffArray["age"]);
        $id = $staff_e->getId();
        $name = $staff_e->getName();
        $age = $staff_e->getAge();
        $stmt = $this->dbh->prepare("update staff set name ='$name', age = '$age' 
          where id = $id");
        return $stmt->execute();
    }
    public function deleteStaff(StaffEntity $staff_e) {
        $id = $staff_e->getId();
        $stmt = $this->dbh->prepare("DELETE FROM staff WHERE id = $id");
        return $stmt->execute();
    }
    public function getAll() {
        $stmt = $this->dbh->prepare("SELECT * FROM staff");
        $stmt->execute();
        $data = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
    }
}