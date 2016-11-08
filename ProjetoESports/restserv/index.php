<?php
include_once ("Config.inc.php");
$controller = new RequestController();

echo json_encode($controller->execute());
