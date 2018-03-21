<?php
namespace core;
class Model
{
    protected $app;
    function __construct() 
    {
        global $app;
        $this->app = $app;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

