<?php
require_once "../model/bd.php";
require_once "../utils/funcoes.php";

$cod_materiais = $_POST['material'] ?? null;
$quantidade_vendida = $_POST['quantidade_vendida'] ?? null;

$quantidade_vendida = retirar_nulos($quantidade_vendida);

$preco_total = 0;
try {
    foreach ($cod_materiais as $cod_material) {
        //pegar o preço dos produtos setados
        $query_pegar_preco_produto = "SELECT preco_revenda FROM materiais WHERE cod_material = '$cod_material'";
        $preco_produto = $conn->query($query_pegar_preco_produto);
        $preco_produto = $preco_produto->fetch_assoc();
        //calcular preço da venda
        foreach ($quantidade_vendida as $quantidade) {
            $preco_total += intval($preco_produto['preco_revenda']) * intval($quantidade);
            atualizar_materiais($quantidade, $cod_material, $conn);
        }
    }

    mysqli_begin_transaction($conn);
    session_start();
    $cod_usuario = $_SESSION['cod_usuario'];
    //inserir venda no bd
    $query_insercao = "INSERT INTO vendas (usuario,servico_vendido,preco_total) VALUES 
    ('$cod_usuario', '3', '$preco_total')";
    $insercao = $conn->query($query_insercao);
    mysqli_commit($conn);

    if (!$insercao) {
        $cod_erro = $conn->errno;
        header("Location: ../view/revenda_produtos.php?erro=$cod_erro");
    }
} catch (Exception $e) {
    mysqli_rollback($conn);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../view/styles/nota_venda.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Nota</title>
</head>

<body>
    <div class="container">
        <h2>Dados Da Venda</h2>
        <table>
            <thead>
                <tr>
                    <th>Produtos Vendidos</th>
                    <th>Preço Do Produto</th>
                    <th>Quantidade Vendida</th>
                    <th>Data</th>
                    <th>Preço Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cod_materiais as $cod_material) {
                    $query_pegar_nome_material = "SELECT nome_material, preco_revenda FROM materiais WHERE cod_material = '$cod_material'";
                    $nome_material = $conn->query($query_pegar_nome_material);
                    $nome_material = $nome_material->fetch_assoc();
                    echo "<tr><td>$nome_material[nome_material]</td>";
                    echo "<td>$nome_material[preco_revenda]</td>";
                }
                if($quantidade_vendida < 0){
                    echo "<td>$quantidade</td>";
                }
                foreach ($quantidade_vendida as $quantidade) {
                    echo "<td>$quantidade</td>";
                }
                $data_atual = new DateTime();
                $data_atual_formatada = $data_atual -> format('d-m-Y H:i:s');
                echo "<td>$data_atual_formatada</td>";
                echo "<td>$preco_total</td>";
                ?>
            </tbody>
        </table>
    </div>
    <a href="../view/revenda_produtos.php"><button>Voltar</button></a>

</body>

</html>