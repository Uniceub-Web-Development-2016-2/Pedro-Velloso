<?php

$html = new GeraHTML("./app/html/inicio/login.html");

if(isset($_POST['enviar'])){
	unset($_POST['enviar']);
	$html->set_pag('./app/html/inicio/loginProcesso.html');
	$_POST['username'] = strtolower($_POST['username']);
	$userRequest = request("user", "auth", "post");
	$u = json_decode($userRequest, true);
	$onDb = (count($u) == 1) ? true : false;
	$crypt = new Crypt();

	$redirect = '<script>window.setTimeout(function(){ window.location = "./inicio"; },2300);</script>';
	if($onDb && $u[0]['username'] == $_POST['username'] && $crypt->verifyHash($_POST['password'], $u[0]['password'])){
		$html->put(array("#titulo#", "#tipo_box#", "#mensagem#", "#redirect#"), array("Sucesso!", "success", "Bem-vindo ao nosso site {$_POST['username']}! <br> Estamos te redirecionando para a página inicial!", $redirect));
		unset($u[0]['password']);
		$_SESSION = $u[0];
	}else{
		$html->put(array("#titulo#", "#tipo_box#", "#mensagem#", "#redirect#"), array("Erro!", "danger", "Não foi possivel logar no sistema!", ""));
	}


}

echo $html->get_pag();