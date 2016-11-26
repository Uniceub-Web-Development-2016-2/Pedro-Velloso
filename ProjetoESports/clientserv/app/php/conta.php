<?php 

if(!isset($_SESSION['username'])){
	header("Location: ./inicio");
}else{

$html = new GeraHTML("./app/html/inicio/alterarconta.html");

$requestUser = request('user', 'search', 'get', array('id' => $_SESSION['id']));
$user = json_decode($requestUser, true)[0];

$locations = request("location", "search", "get");

$lA = json_decode($locations, true);

$options = "";
foreach ($lA as $value) {
	$selected = "";
	if($_SESSION['locationId'] == $value['id']){
		$selected = "selected";
	}
	$options .= '<option value="'. $value['id'] .'" '. $selected .'>'. $value['name'] .'</option>
	';
}

$html->put("#local_select#", $options);

$html->put(array("#name#", "#email#", "#username#"), array($user['name'], $user['email'], $user['username']));

if(isset($_POST['enviar'])){
	$html->set_pag("./app/html/inicio/alterarcontaProcesso.html");
	unset($_POST['enviar']);
	$_POST['id'] = $_SESSION['id'];
	if(is_null($_POST['password']) || $_POST['password'] == ''){
		unset($_POST['password']);
	}else{
		$crypt = new Crypt();
		$_POST['password'] = $crypt->generateHash($_POST['password']);
	}

	$updateUser = request('user', 'update', 'put');
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['locationId'] = $_POST['locationId'];

	$html->put("#mensagem#", "Conta alterada com sucesso!");
	
}


echo $html->get_pag();

}