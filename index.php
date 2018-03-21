<?php
require_once (__DIR__ . '/core/autoloader.php');
Autoloader::register();
$app = new core\App(); 
$app-> connect();
$route_object = new core\Route();
$route_object->init();
//  я везде с object писала