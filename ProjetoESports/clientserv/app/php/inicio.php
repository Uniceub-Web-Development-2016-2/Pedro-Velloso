<?php

$html = new GeraHTML("./app/html/inicio/inicio.html");

$nearEventsParams = array("locationId" => $_SESSION['locationId']);
$nearEvents = request('events', 'search', 'get', $nearEventsParams);

$near = count(json_decode($nearEvents, true));

$html->put("#num_events_near#", $near);

$eventsEntryParams = array("userId" => $_SESSION['id']);
$eventsEntry = request('entry', 'search', 'get', $eventsEntryParams);

$events = count(json_decode($eventsEntry, true));

$html->put("#events_me#", $events);

$pag = $html->get_pag();

echo $pag;