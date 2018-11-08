<?php 

require_once("vendor/autoload.php");

//esse slim é namespace declarado la no arquivo autoload_namespace.php
use \Slim\Slim;

//esse caminho esta declarado no json na pata ecommerce
use \Hcode\Page;

use \Hcode\PageAdmin;


$app = new Slim();

$app->config('debug', true);


//redirecionamento de rotas a / é pasta raiz
$app->get('/', function() {
    
	//echo "OK";

	//$sql = new Hcode\DB\sql();
	//$results = $sql->select("SELECT * FROM tb_users");
    //echo json_encode($results);

$page = new Page();

$page->setTpl("index");


});


$app->get('/admin', function() {
    
  
$page = new PageAdmin();

$page->setTpl("index");


});



$app->run();

 ?>