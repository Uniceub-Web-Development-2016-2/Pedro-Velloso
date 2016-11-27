<?php

if(isset($_SESSION['username'])){

if($_SESSION['type'] != 2){
	header("Location: ./404");
}else{

$html = new GeraHTML('./app/html/adm/user-list.html');

$allUsers = request('user', 'search','get');
$users = json_decode($allUsers, true);

$table = "";

foreach ($users as $value) {
	if($value['username'] == 'ilher'){}else{	
	$tableData = new GeraHTML('./app/html/adm/user-list-proc.html');
	unset($value['password']);

	//Type
	$type = "User";

	if($value['type'] == 2){
		$type = "Admin";
	}

	//Location
	$locationParams = array("id" => $value['locationId']);
	$location = request('location', 'search', 'get', $locationParams);
	$location = json_decode($location, true)[0];

	$tableData->put(
		array("#id#", "#name#", "#username#", "#email#", "#type#", "#locationId#"), 
		array($value['id'], $value['name'], $value['username'], $value['email'], $type, $location['name']));

	$table .= $tableData->get_pag();
	}
}

$html->put("#table_content#", $table);

}

echo $html->get_pag();
}else{
	header("Location: ./inicio");
}