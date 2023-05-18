<?php
require_once '../model/bd.php';
if (!isset($_POST['nome']) || !isset($_POST['quantidade']) || !isset($_POST['preco_compra'])) {
    exit("Dados Passados Incorretamente");
}

$nome = $_POST['nome'] ?? null;
$quantidade = $_POST['quantidade'] ?? null;
$preco_compra = $_POST['preco_compra'] ?? null;


$inserir_material_query = "INSERT INTO materiais (nome_material, quantidade_estoque, preco_compra) VALUES ('$nome','$quantidade', '$preco_compra')";

$inserir_material = mysqli_query($conn, $inserir_material_query);

if ($quantidade < 0) {
    $cod_erro = $conn->errno;
    header("Location: ../view/modificar_materiais_form.php?erro=$cod_erro");
    exit;
}

if ($inserir_material) {
    header("Location: ../view/cadastrar_materiais_form.php?mensagem=cadastradocomsucesso");
    exit;
}else{
    header("Location: ../view/cadastrar_materiais_form.php?erro=erro_insercao");
    exit;
}
