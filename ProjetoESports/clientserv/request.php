<?php
include ("./httpful.phar");

function request($resource, $operation, $method, array $qArray = NULL){

	//Criação da URI com parametros dinamicos
	$uri = "localhost/restserv/{$resource}/{$operation}".arrayToQueryString($qArray);
	$json = (count($_POST) > 0) ? json_encode($_POST) : json_encode($_GET);
	if($method != "GET"){
		$response = \Httpful\Request::{$method}($uri)->sendsJson()->body($json)->send();
	} else {
		$response = \Httpful\Request::get($uri)->send();
	}

	//Resposta da Request

	echo $response->body;
}


function arrayToQueryString(array $a = NULL){

	$qS = NULL;
	if(!is_null($a)){
		$qS = "?";
		foreach($a as $key => $value) {
			$qS .= "{$key}={$value}&";	
		}
		$qS = substr($qS, 0, -1);
	}	

	return $qS;

}