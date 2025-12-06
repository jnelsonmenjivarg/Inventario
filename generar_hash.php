<?php
$hash = password_hash("12345", PASSWORD_BCRYPT);
echo "HASH GENERADO:<br><br>";
echo $hash;