<?php
$html = new GeraHTML('./app/html/inicio/iniciooff.html');

if(isset($_SESSION['username'])){
$html->set_pag("./app/html/inicio/inicio.html");

//Box de Eventos Próximo ao usuário
$nearEventsParams = array("locationId" => $_SESSION['locationId']);
$nearEvents = request('events', 'search', 'get', $nearEventsParams);

$near = count(json_decode($nearEvents, true));

$html->put("#num_events_near#", $near);

//Box de eventos em que o usuário se inscreveu
$eventsEntryParams = array("userId" => $_SESSION['id']);
$eventsEntry = request('entry', 'search', 'get', $eventsEntryParams);

$events = count(json_decode($eventsEntry, true));

$html->put("#events_me#", $events);
}

//Lista dos 10 últimos eventos
$eventsListParams = array("situation" => '1');
$eventsList = request('events', 'list', 'get', $eventsListParams);

$colorStatus = array("inscrito" => "success", "aberto" => "info", "ocorrendo" => "warning", "acabou" => "danger");
$statusName = array("inscrito" => "Inscrito para o dia", "aberto" => "Ocorrerá dia", "ocorrendo" => "Em progresso -", "acabou" => "Ocorreu dia ");

$event = json_decode($eventsList, true);

foreach ($event as $value) {
	//Criador do evento
	$creatonParams = array("id" => $value['userId']);
	$creator = request('user', 'search', 'get', $creatonParams);
	$creation = json_decode($creator, true)[0];

	//Location
	$locationParams = array("id" => $value['locationId']);
	$location = request('location', 'search', 'get', $locationParams);
	$local = json_decode($location, true)[0];

	//Game
	$gameParams = array("id" => $value['gamesId']);
	$games = request('games', 'search', 'get', $gameParams);
	$game = json_decode($games, true)[0];

	//Status
	if(isset($_SESSION['username'])){
	$userInParams = array("userId" => $_SESSION['id'], "eventsId" => $value['id']);
	$userIn = request('entry', 'search', 'get', $userInParams);
	$entry = count(json_decode($userIn, true));
	}
	$status = "aberto";
	$today = date("Y-m-d");

	if(isset($entry) && $entry == 1 && $today < $value['date']){
		$status = "inscrito";
	}else{
		if($today > $value['date']){
			$status = "acabou";
		}
		elseif($today == $value['date']){
			$status = "ocorrendo";
		}
	}

	$html->append("./app/html/inicio/inc/events_list.html");
	$html->put(array("#name#", "#description#", "#date#","#status#", "#status_l#", "#location#", "#userId#", "#id#", "#game#"), array($value['name'], $value['description'], $value['date'], $colorStatus[$status], $statusName[$status], $local['name'], $creation['name'], $value['id'], $game['name']));
}




$pag = $html->get_pag();

echo $pag;

