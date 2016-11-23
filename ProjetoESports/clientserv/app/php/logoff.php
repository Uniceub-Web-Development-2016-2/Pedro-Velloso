<?php

$html = new GeraHTML("./app/html/inicio/logoff.html");

echo $html->get_pag();
session_destroy();