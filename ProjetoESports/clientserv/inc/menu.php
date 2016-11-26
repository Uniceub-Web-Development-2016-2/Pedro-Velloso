<?php
$html = new GeraHTML("./inc/menu.html");

$menuLog = file_get_contents("./inc/menu/login.html");


if(isset($_SESSION['username'])){
	$menuLog = file_get_contents('./inc/menu/logged.html');
	$html->put("#login#", $menuLog);
	$html->put("#user_session#", $_SESSION['name']);
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

//Admin menu

if(isset($_SESSION['username'])){
	if($_SESSION['type'] == 2){
		$adm = file_get_contents('./inc/menu/admin.html');
		$html->put("#admin#", $adm);
	}else{
		$html->put("#admin#", '');
	}

}else{
	$html->put("#admin#", '');
}

echo $html->get_pag();