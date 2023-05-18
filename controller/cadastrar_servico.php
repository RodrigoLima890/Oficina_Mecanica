<?php 
require_once "../model/bd.php";
$nome = $_POST['novo_servico']??null;
$preco = $_POST['preco']??null;
$cod_ocupacao = $_POST['responsavel']??null;

$query_insercao = "INSERT INTO servicos (nome_servico, tipo_usuario, preco) VALUES ('$nome','cod_ocupacao','preco')";
$conn->query($query_insercao);

header("Location: ../view/adicionar_servico_form.php?confirmacao=true");

?>