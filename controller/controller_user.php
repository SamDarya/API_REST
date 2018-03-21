<?php
namespace controller;
use core\Controller;
use model\User;

class controller_user extends Controller
{
    public function action_auth()
    {
        if (isset($_POST['login'])) 
        {
            $login = $_POST['login'];
        } 
        else 
        {
            $this->sendError('Отсутствует входной параметр login');
        }
        if (isset($_POST['password'])) 
        {
            $password = $_POST['password'];
        } 
        else 
        {
            $this->sendError('Отсутствует входной параметр password');
        }
        $user = new User();
        $result = $user->auth($login,$password);
        if ($result == false)
        {
            $this->sendError("Пользователь не найден");
        }
        else 
        {
            $response = ['token' => $result, 'text' => "Тадаааа!"];
            $this->app->response($response);
        }
 
        
    }
    public function action_generatepassword()
    {
        if (isset($_GET['password'])) 
        {
            $password = $_GET['password'];
            $result = User::generatePassword($password);
            $response = ['password' => $password, 'hash' => $result,'text' => "Тадаааа!"];
            $this->app->response($response);
        } 
        else 
        {
            $this->sendError('Пароль отсутствует');
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

