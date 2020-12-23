<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$_POST = [
    'host' => 'tienmyhieu.com',
    'title' => 'Đế đức quảng vận',
    'ip1' => '',
    'ip2' => '',
    'ip3' => '14.224.10.2'
];
//header('Content-Type: application/json; charset=UTF-8');
use core\Factory;
require_once (__DIR__ . '/defines.php');
require_once (__DIR__ . '/core/Factory.php');
$factory = new Factory();
$controller = $factory->controller();
//echo json_encode($controller->response());
$controller->response();
