<?php
if(!isset($_SESSION['username'])){
	header("Location: ./inicio");
}else{

$html = new GeraHTML('./app/html/eventos/event-detail.html');

$eventDetailParams = array("id" => $_GET['id']);
$eventDetail = request('events', 'search', 'get', $eventDetailParams);
$event = json_decode($eventDetail, true)[0];

//User
$creatonParams = array("id" => $event['userId']);
$creator = request('user', 'search', 'get', $creatonParams);
$creation = json_decode($creator, true)[0];

//Location
$locationParams = array("id" => $event['locationId']);
$location = request('location', 'search', 'get', $locationParams);
$local = json_decode($location, true)[0];

//Game
$gameParams = array("id" => $event['gamesId']);
$games = request('games', 'search', 'get', $gameParams);
$game = json_decode($games, true)[0];

//Participantes
$entryParams = array("eventsId" => $event['id']);
$entry = request('entry', 'search', 'get', $entryParams);
if($entry != "[]"){
$entry = count(json_decode($entry)[0]);
}else{
	$entry = 0;
}

//User logado esta participando?
$userEntryParams = array("userId" => $_SESSION['id'], "eventsId" => $event['id']);
$userEntry = request('entry', 'search', 'get', $userEntryParams);
$user = json_decode($userEntry,true);

$statusName = array("aberto" => "Ocorrerá dia", "ocorrendo" => "Em progresso -", "acabou" => "Ocorreu dia ");
$today = date("Y-m-d");
$status = "aberto";

if($today > $event['date']){
	$status = "acabou";
}
elseif($event['date'] == $today){
	$status = "ocorrendo";
}

if($_SESSION['locationId'] != $event['locationId']){
	$html->put("#disabled#", "disabled");
}elseif($today > $event['date']){
	$html->put("#disabled#", "disabled");
}elseif(isset($user[0])){
	$html->put("#disabled#", "disabled");
}else{
	$html->put("#disabled#", "");
}

if(isset($user[0])){
	$html->put("#entrou#", " INSCRITO");
}else{
	$html->put("#entrou#", "");
}

$html->put(array("#name#", "#userId#", "#status_l#", "#date#", "#location#", "#description#", "#game#", "#entries#"), array($event['name'], $creation['name'], $statusName[$status], $event['date'], $local['name'], $event['description'], $game['name'], $entry));

if(isset($_POST['enviar'])){
	unset($_POST['enviar']);
	$id = $_GET['id'];
	unset($_GET);

	$_POST['userId'] = $_SESSION['id'];
	$_POST['eventsId'] = $event['id'];
	$_POST['entryDate'] = $today;

	$participar = request('entry', 'create', 'post');

	header("Location: ./event-info?id={$id}");

}

$dis = "";
if($_SESSION['type'] == 2 || $_SESSION['id'] == $event['userId']){
	$discard = new GeraHTML('./app/html/eventos/event-discard.html');
	$dis = $discard->get_pag();
}

$html->put("#discard#", $dis);

if(isset($_POST['discartar'])){
	unset($_POST['discartar']);
	$idDiscard = $_GET['id'];
	unset($_GET);

	$_POST['id'] = $event['id'];

	$entriesDiscard = request('entry', 'discard', 'delete');

	$eventDiscard = request('events', 'remove', 'delete');
	
	header("Location: ./inicio");

}

echo $html->get_pag();

}