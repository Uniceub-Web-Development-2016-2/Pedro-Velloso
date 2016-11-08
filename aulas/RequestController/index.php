<?php
require "request_controller.php";
require "request.php";
$rc = new RequestController();
var_dump(is_dir(substr($_SERVER['REQUEST_URI'], 1, -1)));
var_dump($rc->create_request($_SERVER));
