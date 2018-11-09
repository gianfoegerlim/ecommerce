<?php 
session_start();
require_once("vendor/autoload.php");

//esse slim é namespace declarado la no arquivo autoload_namespace.php
use \Slim\Slim;

//esse caminho esta declarado no json na pata ecommerce
use \Hcode\Page;

use \Hcode\PageAdmin;

use \Hcode\Model\User;


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
    
  User::verifyLogin();

$page = new PageAdmin();

$page->setTpl("index");


});


$app->get('/admin/login', function() {

//feito por gian
 User::verifyLogin2();

$page = new PageAdmin( ["header"=>false,"footer"=>false]);

$page->setTpl("login");


});


$app->post('/admin/login', function() {
    
 user::login($_POST["login"], $_POST["password"]);

 header("Location: /admin");
exit;
});


$app->get('/admin/logout', function() {
    
  
 user::logout(); 

 header("Location:/admin/login");
exit;
});



$app->get('/admin/users', function() {
    
  User::verifyLogin();

 $users= User::listall();

  $page = new PageAdmin();

  $page->setTpl("users", arraY(
   "users"=>$users

  ));


});

$app->get('/admin/users/create', function() {
    
  User::verifyLogin();

$page = new PageAdmin();

$page->setTpl("users-create");


});


$app->get('/admin/users/:iduser/delete', function($iduser) {
    
  User::verifyLogin();

$user = new User();
$user->get((int)$iduser);
$user->delete();

header("Location: /admin/users");
exit;
});


$app->get('/admin/users/:iduser', function($iduser) {
    
  User::verifyLogin();

$user = new User();

$user->get((int)$iduser);

$page = new PageAdmin();

$page->setTpl("users-update",arraY(

  "user" => $user->getvalues()

));


});

$app->post('/admin/users/create', function() {
    
  User::verifyLogin();
  
  $user = new User();

$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

  $user ->setData($_POST);
 
 //var_dump($user);

  $user ->save();
 


header("Location: /admin/users");
exit;

});


$app->post('/admin/users/:iduser', function($iduser) {
    
User::verifyLogin();

$user = new User();

$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

$user->get((int)$iduser);

$user->setData($_POST);

$user->update();

header("Location: /admin/users");
exit;

});





$app->post();
$app->run();

 ?>