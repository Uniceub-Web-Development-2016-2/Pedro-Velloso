<?php

$html = new GeraHTML("./app/html/inicio/cadastro.html");

if(isset($_POST["enviar"])){
	$html->set_pag("./app/html/inicio/cadastroProcesso.html");
	unset($_POST['enviar']);
	$_POST['type'] = 1;
	$_POST['situation'] = 0;
	$_POST['password'] = md5($_POST['password']);

	$isCadUser = onDb("user", array("username" => $_POST['username']));
	$isCadEmail = onDb("user", array("email" => $_POST['email']));

	if($isCadUser || $isCadEmail){
		$html->put(array("#titulo#", "#tipo_box#", "#mensagem#"), array("Erro!", "danger", "Usuário ou e-mail ja cadastrado!"));
	}else{
		request("user", "create", "post");
		$html->put(array("#titulo#", "#tipo_box#", "#mensagem#"), array("Sucesso!", "success", "Bem-vindo ao nosso site {$_POST['name']}! Clique <a href='#'>aqui</a> para realizar seu login!"));
	}
}

echo $html->get_pag();