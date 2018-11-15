<?php 
session_start();
require_once("vendor/autoload.php");

//esse slim é namespace declarado la no arquivo autoload_namespace.php
use \Slim\Slim;

//esse caminho esta declarado no json na pata ecommerce
//use \Hcode\Page;
 

$app = new Slim();

$app->config('debug', true);

require_once("site.php");
require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");
$app->run();

 ?>