<?php
use Src\Controller\ControllerStaff;
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getMethod()
{
    return $_SERVER['REQUEST_METHOD'];
}
function getContentType()
{
    return $_SERVER['HTTP_ACCEPT'];
}
$controller = new ControllerStaff();

switch (getMethod())
{
    case 'GET':
        if (getContentType() == 'application/json') $controller->get('json');
        else if (getContentType() == 'application/xml') $controller->get('xml');
        else echo "Unknown Content Type";
        break;
    case 'POST':
        if (getContentType() == 'application/json') $controller->post('json');
        else if (getContentType() == 'application/xml') $controller->post('xml');
        else echo "Unknown Content Type";
        break;
    case 'PUT':
        if (getContentType() == 'application/json') $controller->put('json');
        else if (getContentType() == 'application/xml') $controller->put('xml');
        else echo "Unknown Content Type";
        break;
    case 'DELETE':
        $controller->delete();
        break;
    default:
        echo "Unknown Request";
        break;

}