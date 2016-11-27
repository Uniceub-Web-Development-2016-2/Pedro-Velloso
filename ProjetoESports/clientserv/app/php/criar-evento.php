<?php

if(!isset($_SESSION['username'])){
	header("Location: ./inicio");
}else{
$html = new GeraHTML('./app/html/eventos/event-create.html');

//Locations
$locations = request("location", "search", "get");

$lA = json_decode($locations, true);
$options = "";
foreach ($lA as $value) {
	$options .= '<option value="'. $value['id'] .'">'. $value['name'] .'</option>
	';
}

//Games
$games = request("games", "search", "get");

$gA = json_decode($games, true);
$optGames = "";
foreach ($gA as $value) {
	$optGames .= '<option value="'. $value['id'] .'">'. $value['name'] .'</option>
	';
}

$html->put("#local_select#", $options);
$html->put("#games_select#", $optGames);

if(isset($_POST['enviar'])){
	unset($_POST['enviar']);
	$_POST['userId'] = $_SESSION['id'];
	$_POST['typeEvent'] = 1;
	$_POST['situation'] = 1;

	$criarevento = request('events', 'create', 'post');
	header("Location: ./inicio");

}

echo $html->get_pag();
}