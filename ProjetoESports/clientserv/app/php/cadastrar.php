<?php

if(isset($_SESSION['username'])){

	header("Location: ./inicio");

}else{

$html = new GeraHTML("./app/html/inicio/cadastro.html");

$locations = request("location", "search", "get");

$lA = json_decode($locations, true);
$options = "";
foreach ($lA as $value) {
	$options .= '<option value="'. $value['id'] .'">'. $value['name'] .'</option>
	';
}

$html->put("#local_select#", $options);

if(isset($_POST["enviar"])){
	$html->set_pag("./app/html/inicio/cadastroProcesso.html");
	unset($_POST['enviar']);
	$_POST['username'] = strtolower($_POST['username']);
	$_POST['type'] = 1;
	$_POST['situation'] = 0;
	$crypt = new Crypt();
	$_POST['password'] = $crypt->generateHash($_POST['password']);

	$isCadUser = onDb("user", array("username" => $_POST['username']));
	$isCadEmail = onDb("user", array("email" => $_POST['email']));

	if($isCadUser || $isCadEmail){
		$html->put(array("#titulo#", "#tipo_box#", "#mensagem#"), array("Erro!", "danger", "Usuário ou e-mail ja cadastrado!"));
	}else{
		$response = request("user", "create", "post");
		$response = json_decode($response, true);
		
		$html->put(array("#titulo#", "#tipo_box#", "#mensagem#"), array("Sucesso!", "success", "Bem-vindo ao nosso site {$_POST['name']}! Clique <a href='./login'>aqui</a> para realizar seu login!"));
		
	}
}

echo $html->get_pag();
}