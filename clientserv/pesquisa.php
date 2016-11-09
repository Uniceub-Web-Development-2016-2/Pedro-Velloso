<?php
include "request.php";

if (!empty($_GET['name'])){

	request("user", "search", "get", $_GET);

}else{

?>

<form method="GET" action="" name="user">

	<input type="text" name="name" placeholder="Nome">


	<!--<input type="hidden" name="resource" value="user">-->

	<br />
	<input type="submit" value="Enviar">


</form>

<?php } ?>