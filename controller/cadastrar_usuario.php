<?php 
require_once '../model/bd.php';
$usuario = $_POST['usuario']??null;
$senha1 = $_POST['senha1']??null;
$senha2 = $_POST['senha2']??null;
$tipo = $_POST['tipo']??null;

if($senha1 != $senha2){
    header("Location: ../view/cadastrar_usuarios_form.php?erro=senhasnãoconferem");
    exit;
}else{
    $senha = sha1($senha1);
    $inserir_usuario_query = "INSERT INTO usuarios(nome_usuario,senha,tipo) VALUES ('$usuario', '$senha', '$tipo')";

    $inserir_usuario = mysqli_query($conn, $inserir_usuario_query);
    if($inserir_usuario){
        header("Location: ../view/cadastrar_usuarios_form.php?mensagem=usuariocadastrado");
        exit;
    }
}
?>
