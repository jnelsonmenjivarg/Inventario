<?php

$password = "12345"; // cambia por tu clave
$hash = password_hash($password, PASSWORD_BCRYPT);

echo "<h3>Hash generado:</h3>";
echo "<pre>$hash</pre>";