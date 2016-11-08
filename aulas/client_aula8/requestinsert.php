<?php
include('httpful.phar');

$json = json_encode($_POST);

$get_request = 'http://172.22.51.134/aula8/user/create';
$response = \Httpful\Request::post($get_request)->sendsJson()->body($json)->send();
echo  $response->body;