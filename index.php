<?php
/**
 * Корневой файл php-приложения.
 */
namespace App;
require('vendor/autoload.php');
require('bootstrap.php');
session_start();
if(empty($_SESSION['key']))
    $_SESSION['key'] = bin2hex(random_bytes(32));
$router = new Router();
?>