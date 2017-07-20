<?php
/**
 * Created by PhpStorm.
 * User: hieuhpt
 * Date: 08/07/2017
 * Time: 16:32
 */

namespace Src\Entity;


class Staff
{

    private $id;
    private $name;
    private $age;
    public function __construct($arrayStaff = [])
    {
        if (!empty($arrayStaff))
        {
            $this
                ->setId(isset($arrayStaff['id']) ? $arrayStaff['id'] : null)
                ->setName(isset($arrayStaff['name']) ? $arrayStaff['name'] :'')
                ->setAge(isset($arrayStaff['age']) ? $arrayStaff['age'] :'');
        }
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }
}