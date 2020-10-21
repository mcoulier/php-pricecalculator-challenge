<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'Model/Connection.php';
require 'Model/Product.php';
require 'Model/ProductLoader.php';
require 'Model/Customer.php';
require 'Model/CustomerLoader.php';
require 'Model/CustomerGroup.php';
require 'Model/CustomergroupLoader.php';
require 'Controller/HomepageController.php';

$controller = new HomepageController();
$controller->render($_GET, $_POST);