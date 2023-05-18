<?php
require_once '../model/bd.php';
require_once '../utils/funcoes.php';

if (
    !isset($_POST['cod'])
    || !isset($_POST['nome'])
    || !isset($_POST['quantidade'])
    || !isset($_POST['preco_compra'])
) {
    exit("Erro ao modificar");
}

$codigo = $_POST['cod'] ?? null;
$nome = $_POST['nome'] ?? null;
$quantidade = $_POST['quantidade'] ?? null;
$preco_compra = $_POST['preco_compra'] ?? null;

$query_dados_material = "SELECT nome_material FROM materiais WHERE cod_material = $codigo";

$dados_material = $conn->query($query_dados_material);
$dados_material = $dados_material->fetch_assoc();

if (!$dados_material['nome_material'] === $nome) {
    if (!verificar_materiais_existentes($nome, $conn)) {
        header("Location: ../view/modificar_materiais_form.php?erro=nomeexistente");
        exit;
    }
}

$modificar_material_query = "UPDATE materiais
SET nome_material = '$nome', quantidade_estoque = '$quantidade', preco_compra = '$preco_compra' WHERE cod_material = '$codigo'";


$modificar_material = mysqli_query($conn, $modificar_material_query);

if ($quantidade < 0) {
    $cod_erro = $conn->errno;
    header("Location: ../view/modificar_materiais_form.php?erro=$cod_erro");
    exit;
}
if ($modificar_material) {
    header("Location: ../view/modificar_materiais_form.php?mensagem=cadastradocomsucesso");
    exit;
}
