<?php

declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'Model/Connection.php';
require_once 'Model/Product.php';
require_once 'Model/ProductLoader.php';


$products = new ProductLoader();