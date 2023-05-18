<?php 
require_once '../model/bd.php';
session_start();

$senha_parc = $_POST['senha']??null;
$usuario = $_POST['usuario']??null;

$senha = sha1($senha_parc);

$consultar_usuarios = "SELECT cod_usuario, nome_usuario, senha FROM usuarios
 WHERE nome_usuario = '$usuario' and senha = '$senha' LIMIT 1";

$row = $conn->query($consultar_usuarios);

$dados = $row->fetch_assoc();

$_SESSION['cod_usuario'] = $dados['cod_usuario'];
$_SESSION['nome_usuario'] = $dados['nome_usuario'];


if($row->num_rows < 1){
    header('Location: ../view/index.php?erro=usuarioinvalido');
    exit;
}else{
   header('Location: ../view/main.php');
   exit;
}

?>