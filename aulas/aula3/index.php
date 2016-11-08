<?php
require("request.php");


$params = NULL;
if($_SERVER['QUERY_STRING'] != NULL){
	$parametros = explode("&", $_SERVER['QUERY_STRING']);
	for($i = 0; $i < count($parametros); $i++){
		$parametro = explode("=", $parametros[$i]);
		$params[$parametro[0]] = $parametro[1];
	}
}

$method = $_SERVER["REQUEST_METHOD"];
$protocol = substr($_SERVER["SERVER_PROTOCOL"], 0, 4);
$server_ip = $_SERVER["SERVER_ADDR"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$resource = substr($_SERVER["SCRIPT_NAME"], 1, 5);
$request = new Request($method, $protocol, $server_ip, $remote_ip, $resource, $params);
var_dump($request);