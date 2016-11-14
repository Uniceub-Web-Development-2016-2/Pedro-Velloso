<?php
include ("request.php");
$html = new GeraHTML("./app/html/inicio/inicio.html");

$usersCadastrados = request("user", "search", "get");
$uCadArray = json_decode($usersCadastrados, true);

$html->put("#num_user_cad#", count($uCadArray));

$pag = $html->get_pag();

echo $pag;