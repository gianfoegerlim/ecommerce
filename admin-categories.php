<?php 
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

$app->get("/admin/categories", function(){
User::verifyLogin();
$categories = Category::listAll(); 

$page = new PageAdmin();

//var_dump($categories);
$page->setTpl("categories",[
  "categories" =>$categories 
]);

});


$app->get("/admin/categories/create", function(){
User::verifyLogin();
$page = new PageAdmin();

$page->setTpl("categories-create");

});


$app->post("/admin/categories/create", function(){
User::verifyLogin();
 $category = new Category();

 $category->setData($_POST); 

//var_dump($_POST);

$category->save();

header('Location: /admin/categories');
exit;
});



$app->get("/admin/categories/:idcategory/delete", function($idcategory){
User::verifyLogin();
 $category = new Category();

 $category->get((int)$idcategory);

 $category->delete();

//var_dump($category->i ()) ;
header('Location: /admin/categories');
exit;
});


$app->get("/admin/categories/:idcategory", function($idcategory){
User::verifyLogin();
$category = new Category();

$category->get((int)$idcategory);

 $page = new PageAdmin();

$page->setTpl("categories-update",[

"category"=>$category->getvalues()
]);

});


$app->post("/admin/categories/:idcategory", function($idcategory){
User::verifyLogin();
$category = new Category();

$category->get((int)$idcategory);

 $category->setdata($_POST);

$category->save(); 

header('Location: /admin/categories');
exit;
});


$app->get("/categories/:idcategory", function($idcategory){

$category = new Category();

$category->get((int)$idcategory);

 $page = new page();

$page->setTpl("category",[

"category"=>$category->getvalues(),
"products"=>[]
]);

});


?>