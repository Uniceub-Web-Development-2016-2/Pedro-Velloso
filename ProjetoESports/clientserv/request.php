<?php
include ("./app/util/httpful.phar");

function request($resource, $operation, $method, array $qArray = NULL){

	//Criação da URI com parametros dinamicos
	$uri = "localhost/restserv/{$resource}/{$operation}".arrayToQueryString($qArray);
	if($method != "GET"){
		//Encode da body caso $_POST ou $_GET (method="post" ou method="get" no form)
		$json = (count($_POST) > 0) ? json_encode($_POST) : json_encode($_GET);
		//Request para POST, PUT e DELETE
		$response = \Httpful\Request::{$method}($uri)->sendsJson()->body($json)->send();
	} else {
		//Request para GET
		$response = \Httpful\Request::get($uri)->send();
	}

	//Resposta da Request

	return $response->body;
}


function arrayToQueryString(array $a = NULL){

	$qS = NULL;
	if(!is_null($a)){
		$qS = "?";
		foreach($a as $key => $value) {
			$qS .= "{$key}={$value}&";	
		}		
	}	

	return substr($qS, 0, -1);

}

function onDb($resource, $comp){

	$request = request($resource, "search", "get", $comp);
	$request = json_decode($request, true);
	return (count($request) > 0) ? true : false;
	
}