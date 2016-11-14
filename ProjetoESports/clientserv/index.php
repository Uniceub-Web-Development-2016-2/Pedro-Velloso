<?php
//Arquivo de configuração
include_once("./app/Config.inc.php");

//Inclue Header
include_once("./inc/metaheader.html");

//Gera o menu utilizando classe para futuras edições dinamicas
include_once("./inc/menu.php");

//Inclui página
pag_load();

//Inclui footer
include_once("./inc/footer.html");