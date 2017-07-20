<?php
/**
 * Created by PhpStorm.
 * User: windd01
 * Date: 20/07/2017
 * Time: 14:08
 */

namespace Src\Controller;
use Src\Model\StaffModel;
use Src\View\ViewStaff;
use Src\Entity\Staff as StaffEntity;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ControllerStaff
{
    private $_model;
    private $_view;
    public function __construct()
    {
        $this->_model = new StaffModel();
        $this->_view = new ViewStaff();
    }
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    public function handleUrl()
    {
        $url = explode('/', $_GET['controller']);
        if ($url[0] == "staffs") {
            return intval($url[1]);
        }
        return 0;
    }

    public function convert(StaffEntity $staff_e) {
        $staffArray = array('id' => $staff_e->getId(),
            'name' => $staff_e->getName(),
            'age' => $staff_e->getAge(),
        );
        return $staffArray;
    }
    public function get($type)
    {
        if (empty($this->handleUrl()))
        {
            if($type =='json')
            {
                $this->_view->displayResultOfRequestInJson($this->_model->getAll());
            }
            else if ($type == 'xml')
            {
                $this->_view->displayResultOfGetAllRequestInXml($this->_model->getAll());
            }
        }
        else
        {
            $toView = $this->_model->GetStaffById($this->handleUrl());
            if ($type =='json')
            {
                $this->_view->displayResultOfRequestInJson($this->convert($toView));
            }
            else
            {
                $this->_view->displayResultOfRequestInXml($this->convert($toView));
            }
        }
    }
    public function post($type)
    {
        $staff_e = new StaffEntity();
        $check = $this->_model->CreateStaff($staff_e);

        if ($check)
        {
            if ($type == 'json')
            {
                $this->_view->displayResultOfRequestInJson($this->convert($staff_e));
            }
            else
            {
                $this->_view->displayResultOfRequestInXml($this->convert($staff_e));
            }
        }
        else
        {
            echo " Fail to Create";
        }
    }

    public function put($type)
    {
        $staff_e = $this->_model->GetStaffById($this->handleUrl());
        $check = $this->_model->UpdateStaff($staff_e);
        if ($check)
        {
            echo " Update success";
            if ($type =='json')
            {
                $this->_view->displayResultOfRequestInJson($this->convert($staff_e));
            }
            else
            {
                $this->_view->displayResultOfRequestInXml($this->convert($staff_e));
            }
        }
        else
        {
            echo "Update Fail";
        }
    }

    public function delete()
    {
        $staff_e = $this->_model->GetStaffById($this->handleUrl());
        $check = $this->_model->deleteStaff($staff_e);
        if ($check)
        {
            echo " Delete completed";
        }
        else
        {
            echo " Delete fail";
        }
    }
}