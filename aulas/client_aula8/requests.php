<?php
include('httpful.phar');
$get_request = 'http://172.22.51.134/aula8/user/search?first_name="'.$_GET['search'].'"';
$response = \Httpful\Request::get($get_request)->send();
echo  $response->body;