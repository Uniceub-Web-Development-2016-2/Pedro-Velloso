<?php
require("request_controller.php");

$controller = new RequestController();
echo json_encode($controller->create_request($_SERVER));