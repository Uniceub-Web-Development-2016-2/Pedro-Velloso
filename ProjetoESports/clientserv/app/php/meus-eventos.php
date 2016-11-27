<?php

$html = new GeraHTML('./app/html/eventos/events-mine.html');

$meusEventosParams = array("userId" => $_SESSION['id']);
$meusEventos = request('events', 'search', 'get', $meusEventosParams);
$eventos = json_decode($meusEventos, true);

$table = "";

foreach ($eventos as $value) {
	$tableData = new GeraHTML('./app/html/eventos/events-mine-proc.html');

	$date = new DateTime($value['date']);

	//Game
	$gameParams = array("id" => $value['gamesId']);
	$game = request('games', 'search', 'get', $gameParams);
	$game = json_decode($game, true)[0];

	//Location 
	$locationParams = array("id" => $value['locationId']);
	$location = request('location', 'search', 'get', $locationParams);
	$location = json_decode($location, true)[0];

	$tableData->put(
		array("#id#", "#name#", "#description#", "#date#", "#game#", "#location#"),
		array($value['id'], $value['name'], $value['description'], $date->format('d/m/Y'), $game['name'], $location['name'])
		);

	$table .= $tableData->get_pag();
}

$html->put("#table_content#", $table);

echo $html->get_pag();