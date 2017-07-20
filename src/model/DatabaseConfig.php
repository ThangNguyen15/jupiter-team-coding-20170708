<?php
/**
 * Created by PhpStorm.
 * User: hieuhpt
 * Date: 13/07/2017
 * Time: 19:01
 */

namespace Src\Model;


class DatabaseConfig
{
    private $serverName = "mysql";
    private $dbname = "test";
    private $userName = "root";
    private $password = "root";
    public function getServerName()
    {
        return $this->serverName;
    }
    public function setServerName($serverName)
    {
        $this->serverName = $serverName;
    }
    public function getDbname()
    {
        return $this->dbname;
    }
    public function setDbname($dbname)
    {
        $this->dbname = $dbname;
    }
    public function getUserName()
    {
        return $this->userName;
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}