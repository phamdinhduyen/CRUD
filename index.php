<?php
require_once('Database/DBConnection.php');
require_once("Helper/helper.php");

$requestUri = $_SERVER["REQUEST_URI"];
$requestUri = explode("/", $requestUri);
$data = array_values(array_filter($requestUri));

if(count($data)==1){
    require_once("Views/home.php");
} 
else if (count($data)  == 2 ) {
    $controller = $data[1];
     $controller = explode("?", $controller);
    $controller = $controller[0];
    $controller = ucfirst($controller) . "Controller";
    require_once("Controllers/$controller.php");
      
    $controller = new $controller;
    $controller->index();
} else if ( count($data)==3) {
    $controller = $data[1];
    $method = $data[2];
     
    $controller = ucfirst($controller) . "Controller";
    require_once("Controllers/$controller.php");
    $controller = new $controller;
    $params = [];
    if (strpos($method, '?')) {
        $arrMethod = explode('?', $method);
        $method = $arrMethod[0];
        $params = $arrMethod[1];
        $params = explode('&', $params);
        $arrParams = [];
        foreach($params as $param) {
            $p = explode('=', $param);
            $arrParams[$p[0]] = $p[1];
        }
        $params = $arrParams;
    }
    $controller->$method($params);
} else {
     require_once("Views/404.php");
}