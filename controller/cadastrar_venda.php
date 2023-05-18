<?php
require_once '../model/bd.php';
require_once '../utils/funcoes.php';

if (
    !isset($_POST['servico_selecionado'])
) {
    exit("Erro Ao Encontrar Dados");
}

$servico_selecionado = $_POST['servico_selecionado'] ?? null;
$cod_materiais = $_POST['cod-materiais'] ?? null;
$quantidade_materiais = $_POST['quantidade-materiais'] ?? null;

$preco_servico_query = "SELECT preco FROM servicos WHERE cod_servico = '$servico_selecionado'";
$preco_servico = $conn->query($preco_servico_query);
$preco_servico = $preco_servico->fetch_assoc();


mysqli_begin_transaction($conn);
try {
    if (isset($_POST['cod-materiais'])) {
        if (!isset($_POST['quantidade-materiais'])) {
            header("Location: ../view/cadastrar_venda_form.php?erro=quantidades_nulas");
            exit;
        }
        //ciclo para atualizar estoque 
        foreach ($cod_materiais as $code) {
            $query_pegar_quantidades_estoque = "SELECT quantidade_estoque FROM materiais WHERE cod_material = '$code'";
            $quantidades_estoque = $conn->query($query_pegar_quantidades_estoque);
            $quantidade_bd = $quantidades_estoque->fetch_assoc();

            //atualizar quantidade de materiais em estoque
            foreach ($quantidade_materiais as $quantidade) {
                if ($quantidade < 0) {
                    header("Location: ../view/cadastrar_venda_form.php?erro=quantidades_nulas");
                    exit;
                }
                atualizar_materiais($quantidade, $code, $conn);
            }
        }
        session_start();
        $cod_usuario = $_SESSION['cod_usuario'];

        //cadastrar venda
        $query_cadastrar_venda = "INSERT INTO vendas (usuario, servico_vendido,preco_total) 
    VALUES ('$cod_usuario','$servico_selecionado', $preco_servico[preco])";
        $cadastrar_venda = mysqli_query($conn, $query_cadastrar_venda);
        mysqli_commit($conn);
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
                    <th>Serviço Vendido</th>
                    <th>Preço Total</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    $query_nome_preco_servico = "SELECT nome_servico, preco FROM servicos WHERE cod_servico = '$servico_selecionado'";
                    $dados_servico = $conn->query($query_nome_preco_servico);
                    $dados_servico = $dados_servico->fetch_assoc();
                    echo "<td>$dados_servico[nome_servico]</td>";
                    echo "<td>R$ $dados_servico[preco]</td>";
                    $data_venda = new dateTime();
                    $data_venda_formatada = $data_venda->format('d-m-Y H:i:s');
                    echo "<td>$data_venda_formatada</td>";
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="../view/cadastrar_venda_form.php"><button>Voltar</button></a>

</body>

</html>