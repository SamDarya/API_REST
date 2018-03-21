<?php
namespace core;
use controller;
class Route
{
    private $app;
    function __construct() 
    {
        global $app;
        $this->app = $app;
    }
    public function error404($text=null)
    {
        $response = ['error' => 1, 'error_text' => $text == null ? "Неопознанная ошибка": $text];
        $this->app->response($response);
    }
    public function init()
    {
        $request_uri = $_SERVER["REQUEST_URI"];
        $request = explode("/",$request_uri);
        if (!empty($request[1]))
        {
            $controller_name = 'controller_'.$request[1];
           
        }
        else
        {   
            $this->error404("Контроллер не найден");
        }
         if (!empty($request[2]))
        {
                $action_name = 'action_'.$request[2];
        }
        else
        {
            $this->error404("Метод не найден");
        }    
        $path = (__DIR__."/../controller/$controller_name.php");
        if(file_exists($path))
        {
            require_once($path);
        }
        else
        {
            $this->error404("Данного контроллера не существует");
        }
        $controller_name = '\\controller\\'.$controller_name;
        $controller_object = new $controller_name;
        if (method_exists($controller_object,$action_name))
        {
            $controller_object->$action_name();
        }
        else
        {
            $this->error404("Данного метода не существует");
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

