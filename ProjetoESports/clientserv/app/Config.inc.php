<?php

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
}

function pag_load(){

$s = explode("?", $_SERVER['REQUEST_URI']);
$pag = explode("/", $s[0]);


if($pag[2] != null){
    if(!file_exists("./app/php/{$pag[2]}.php")){
        echo "404";
    }else{
        include_once("./app/php/{$pag[2]}.php");
    }
}else{
    include("./app/php/inicio.php");
}

}