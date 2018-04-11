<?php
require_once 'config/config.php';
require_once 'Controller.php';

$_REQUEST['action'] = $_REQUEST['action'] ?: 'index';

$controller = new Controller($config);
$action = str_replace('_', '', lcfirst(ucwords($_REQUEST['action'], '_'))) . 'Action';
echo $controller->{$action}();
