<?php

$var = "aloalo";
$tamanho = strlen($var);

echo "Variavel: " . $var . "<br>Tamanho: ". $tamanho . "<br>"; 

if($tamanho <= 6){
echo "Olha ai!";
}else{
echo "Qualquer outra coisa!";
}

echo "<hr>";

$var = "Essa frase tem mais que 6 letras";
$tamanho = strlen($var);

echo "Variavel: " . $var . "<br>Tamanho: ". $tamanho . "<br>" ;

if($tamanho <= 6){
echo "Olha ai!";
}else{
echo "Qualquer outra coisa!";
}

