<?php
$html = new GeraHTML("./inc/menu.html");

$menuLog = file_get_contents("./inc/menu/login.html");

if(isset($_SESSION)){
	$href = "./login";
	$logIn = "Usuário";
}

$html->put("#login#", $menuLog);

//Active menu
$nav = get_navigation();
if($nav == ""){
	$html->put("#inicio#", "class='active'");
}
if($nav == "cadastrar" || $nav == "login"){
	$html->put("#login_a#", "active");
}
$html->put("#{$nav}#", "class='active'");

echo $html->get_pag();