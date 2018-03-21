<?php
namespace core;
class Controller
{
    protected $app;
    function __construct() 
    {
        global $app;
        $this->app = $app;
    }
    public function sendError($text=null)
    {
        $response = ['error' => 1, 'error_text' => $text == null ? "Неопознанная ошибка": $text];
        $this->app->response($response);
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

