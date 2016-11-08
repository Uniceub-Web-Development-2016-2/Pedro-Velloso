<?php
include_once ("Config.inc.php");
$test = new Request($_SERVER['REQUEST_METHOD'],$_SERVER['SERVER_PROTOCOL'],$_SERVER['SERVER_ADDR'],$_SERVER['REMOTE_ADDR'],$_SERVER['REQUEST_URI'],$_SERVER['QUERY_STRING'],file_get_contents('php://input'));

//var_dump($test);
