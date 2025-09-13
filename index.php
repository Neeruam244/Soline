<?php 

define('_ROOTPATH_', __DIR__); //

spl_autoload_register();

use app\controller\Controller;

$controller = new Controller();
$controller->route();