<?php 
use \Hcode\Page;
 
//redirecionamento de rotas a / é pasta raiz
$app->get('/', function() {
    
	//echo "OK";

	//$sql = new Hcode\DB\sql();
	//$results = $sql->select("SELECT * FROM tb_users");
    //echo json_encode($results);

$page = new Page();

$page->setTpl("index");


});

?>