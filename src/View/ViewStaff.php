<?php
/**
 * Created by PhpStorm.
 * User: windd01
 * Date: 20/07/2017
 * Time: 14:23
 */

namespace Src\View;


class ViewStaff

{
    public function displayResultOfRequestInJson($response)
    {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($response);
    }
    public function displayResultOfRequestInXml($response)
    {
        header('Content type: application/xml');
        echo "<staff>";
        foreach ($response as $tag => $val) {
            echo "<$tag>" . "$val" . "</$tag>";
        }
        echo "</staff>";
    }
    public function displayResultOfGetAllRequestInXml($response)
    {
        header('Content type: application/xml');
        foreach ($response as $key => $value) {
            echo "<staff>";
            foreach ($value as $tag => $val) {
                echo "<$tag>" . "$val" . "</$tag>";
            }
            echo "</staff>";
        }
    }
}