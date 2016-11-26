<?php
if(isset($_SESSION['username'])){

if($_SESSION['type'] != 2){
	header("Location: ./404");
}else{

$html = new GeraHTML('./app/html/adm/user-edit.html');

$requestUser = request('user', 'search', 'get', array('id' => $_GET['id']));
$user = json_decode($requestUser, true)[0];

if(count($user) == 0){
	header("Location: ./404");
}else{

$locations = request("location", "search", "get");

$lA = json_decode($locations, true);

$options = "";
foreach ($lA as $value) {
	$selected = "";
	if($user['locationId'] == $value['id']){
		$selected = "selected";
	}
	$options .= '<option value="'. $value['id'] .'" '. $selected .'>'. $value['name'] .'</option>
	';
}

$html->put("#local_select#", $options);

$html->put(array("#name#", "#email#", "#username#"), array($user['name'], $user['email'], $user['username']));

if($user['type'] == 1){
	$html->put("#user#", "selected");
	$html->put("#admin#", "");
	}else{
	$html->put("#admin#", "selected");
	$html->put("#user#", "");
}

if(isset($_POST['enviar'])){
	$html->set_pag("./app/html/inicio/alterarcontaProcesso.html");
	unset($_GET);
	unset($_POST['enviar']);
	$_POST['id'] = $user['id'];
	if(is_null($_POST['password']) || $_POST['password'] == ''){
		unset($_POST['password']);
	}else{
		$crypt = new Crypt();
		$_POST['password'] = $crypt->generateHash($_POST['password']);
	}

	$updateUser = request('user', 'update', 'put');


	$html->put("#mensagem#", "Conta alterada com sucesso!");
	
}

}

echo $html->get_pag();
}
}else{
	header('Location: ./inicio');
}