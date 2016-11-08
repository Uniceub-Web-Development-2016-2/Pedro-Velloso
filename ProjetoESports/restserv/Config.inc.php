<?php

function __autoload($Class) {

    $classDir = array("model", "controller", "conn");
    $isDir = null;

    foreach ($classDir as $dName){
        if (!$isDir && file_exists("./{$dName}/{$Class}.php")){
            include_once ("./{$dName}/{$Class}.php");
            $isDir = true;
        }
    }

    if (!$isDir){
        trigger_error("Erro ao incluir" . __DIR__. " {$Class}.php", E_USER_ERROR);
        die;
    }
}