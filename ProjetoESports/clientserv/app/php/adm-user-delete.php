<?php 

if(isset($_SESSION['username'])){

if($_SESSION['type'] != 2){
	header("Location: ./404");
}else{

$html = new GeraHTML('./app/html/adm/user-delete.html');

$requestUserParams = array("id" => $_GET['id']);
$requestUser = request('user', 'search', 'get', $requestUserParams);
$user = json_decode($requestUser, true)[0];

$html->put('#user#', $user['name']);

if(isset($_POST['enviar'])){
	unset($_GET);
	unset($_POST['enviar']);

	$_POST['id'] = $user['id'];

	$remove = request('user', 'remove', 'delete');
	header("Location: ./adm-users");

}

echo $html->get_pag();
}

}else{
	header('Location: ./inicio');
}