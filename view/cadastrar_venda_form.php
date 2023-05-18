<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/cadastrar_vendas.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>Cadastrar Venda</title>
</head>

<body>
    <?php
    $cod_erro = $_GET['erro'] ?? null;
    $confirmacao = $_GET['confirmacao'] ?? null;
    if ($cod_erro == '1366') {
        echo "<script>alert('Erro ao fechar a venda')</script>";
        header('Location: cadastrar_venda_form.php');
    }
    if ($cod_erro == 'quantidades_nulas') {
        echo "<script>alert('Quantidades Inválidas')</script>";
        header('Location: cadastrar_venda_form.php');
    }
    if ($confirmacao == "msgSucesso") {
        echo "<script>alert('Venda realizada com sucesso')</script>";
        header('Location: cadastrar_venda_form.php');
    }

    ?>

    <form action="../controller/cadastrar_venda.php" method="post" class="cadastro">
        <h2>Cadastrar Venda</h2>
        <p>Serviço Vendido:</p>
        <select class="form-select form" aria-label="Default select example" name="servico_selecionado">
            <?php
            require_once '../model/bd.php';
            session_start();
            $cod_usuario = $_SESSION['cod_usuario'];

            $tipo_user_query = "SELECT tipo FROM usuarios WHERE cod_usuario = $cod_usuario";
            $tipo_user = $conn->query($tipo_user_query);

            $row = $tipo_user->fetch_assoc();

            $tipo = $row['tipo'];

            $servicos_disponiveis_query = "SELECT t.cod_tipo, s.nome_servico, s.cod_servico  FROM servicos s JOIN tipo_usuarios t ON s.usuario_tipo = t.cod_tipo WHERE t.cod_tipo = '$tipo'";

            $servicos = mysqli_query($conn, $servicos_disponiveis_query);
            while ($servico = $servicos->fetch_object()) {
                echo "<option value='$servico->cod_servico'>$servico->nome_servico</option>";
            }
            ?>
        </select>
        <div class="alingn-left">

            <p>Materiais Usados:</p>
            <table class="table">
                <?php
                $query_materiais = "SELECT cod_material, nome_material, quantidade_estoque FROM materiais";

                $consulta_bd = mysqli_query($conn, $query_materiais);
                while ($material = $consulta_bd->fetch_object()) {
                    echo "<tr>";
                    echo "<td><input class='form-check-input' type='checkbox' value='$material->cod_material' id='flexCheckDefault' name='cod-materiais[]'></td>";
                    echo '<td><label class="form-check-label" for="flexCheckDefault">';
                    echo "$material->nome_material";
                    echo '</label></td>';
                    echo "<td><label for='quantidade-material'>Quantidade Usada</label>";
                    echo "<input type='number' name='quantidade-materiais[]' id='quantidade-materiais' class='quantidade'></td></tr>";
                }
                ?>
        </div>

        </table>
        <button type="submit" class="btn btn-primary">Gerar Nota</button>
    </form>
    </div>
    <?php 
   require_once "../utils/funcoes.php";
   btnVoltar();
   ?>

</body>

</html>