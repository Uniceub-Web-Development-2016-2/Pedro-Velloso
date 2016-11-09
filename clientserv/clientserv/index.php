<?php
include "request.php";

if (!empty($_POST['name'])){

	request("user", "create", "post");

}else{

?>

<form method="POST" action="" name="user">

	<input type="text" name="name" placeholder="Nome" />
	<input type="text" name="username" placeholder="Username">
	<input type="email" name="email" placeholder="E-mail">
	<input type="hidden" name="type" value="1">
	<input type="password" name="password" placeholder="Senha">
	<input type="hidden" name="situation" value="0">


	<!--<input type="hidden" name="resource" value="user">-->

	<br />
	<input type="submit" value="Enviar">


</form>

<?php } ?>