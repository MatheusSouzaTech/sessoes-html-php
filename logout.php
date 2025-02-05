<?php
session_start(); //iniciar a sessão paar destriur a sessão
session_destroy(); // destroi a sessão
header('Location: index.php');
exit();
 
?>