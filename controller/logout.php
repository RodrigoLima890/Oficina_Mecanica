<?php
//iniciar a sessão
session_start();
//guardar dados em um array
$_SESSION = array();
//dps destruir os dados
session_destroy();
//redirecionar
header("Location: ../view/index.php");
exit();
?>