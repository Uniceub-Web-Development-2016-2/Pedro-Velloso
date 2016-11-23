<?php

session_start();

//Codigo estáva sendo quebrado pelo httpful :<

/*
function __autoload($Class) {

    $classDir = array("util");
    $isDir = null;

    foreach ($classDir as $dName){
        if (!$isDir && file_exists("./app/{$dName}/{$Class}.class.php")){
            include_once ("./app/{$dName}/{$Class}.class.php");
            $isDir = true;
        }
    }

    if (!$isDir){
        trigger_error("Erro ao incluir" . __DIR__. "/{$Class}.class.php", E_USER_ERROR);
        die;
    }
}*/

include_once("./app/util/GeraHTML.class.php");
include_once("./app/util/Crypt.class.php");

function get_navigation(){

$s = explode("?", $_SERVER['REQUEST_URI']);
$pag = explode("/", $s[0]);

return $pag[2];

}

/*
* TODO: usar função get_navigation()
*/
function pag_load(){

$s = explode("?", $_SERVER['REQUEST_URI']);
$pag = explode("/", $s[0]);
include_once("request.php");

if($pag[2] != null){
    if(!file_exists("./app/php/{$pag[2]}.php")){
        include_once("./app/html/errors/404.html");
    }else{
        include_once("./app/php/{$pag[2]}.php");
    }
}else{
    include("./app/php/inicio.php");
}

}