<?php
namespace core;

class App
{
        public $db;
        public $config;
        private $pdoOpt = [\PDO::MYSQL_ATTR_FOUND_ROWS => true,];
        function __construct() 
        {
            $this->config =  require_once(__DIR__.'/config.php');
        }
        public function connect()
        {
            
            try 
            {
                $this->db = new \PDO($this->config['db']['dsn'], $this->config['db']['user'], $this->config['db']['password'], $this->pdoOpt); 
                       
            }
            catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }
            
        }
        public function response($arr)
        {
            $info = json_encode($arr);
            echo $info;
            exit;
        }
        
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

