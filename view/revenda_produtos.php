<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/revender_produtos.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>Revendar De Produtos</title>
</head>

<body>
    <?php 
    $confirmacao = $_GET['confirmacao']??null;
    $preco = $_GET['preco'] ?? null;
    if($confirmacao == 'true'){
        echo "<script>alert('revenda realizada com sucesso no valor. No valor de $preco')</script>";
    }
    ?>

    <div class="table-container">
        <h2>Revender Produtos</h2>

        <table class="table table-hover table-striped" id="mytable">
            <thead>
                <tr>
                    <th>Selecione</th>
                    <th>Código Do Produto</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade Em Estoque</th>
                    <th>Quantidade Vendida</th>
                </tr>
            </thead>
            <tbody>
                <form action="../controller/revender_produtos.php" method="post">
                    <?php
                    require_once "../model/bd.php";
                    $query_pegar_dados_material = "SELECT cod_material, nome_material, preco_revenda, quantidade_estoque FROM materiais";
                    $consulta = mysqli_query($conn, $query_pegar_dados_material);
                    while ($material = $consulta->fetch_object()) {
                        echo "<tr><td>
                        <input type='checkbox' name='material[]' value='$material->cod_material'>
                        </td>";
                        echo "<td>$material->cod_material</td>";
                        echo "<td>$material->nome_material</td>";
                        echo "<td>$material->preco_revenda</td>";
                        echo "<td>$material->quantidade_estoque</td>";
                        echo "<td>
                    <input type='number' name='quantidade_vendida[]' class='form-quantidade'>
                    </td>";
                    }
                    ?>
                    <button type="submit" class="btn btn-primary">Cadastrar Revenda</button>
                </form>
            </tbody>
        </table>
    </div>

    <?php
    require_once "../utils/funcoes.php";
    btnVoltar();
    ?>

    <script src="../js/jquery.js"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                language: {
                    lengthMenu: 'Vendas Por Página _MENU_ ',
                    zeroRecords: 'Nada Aqui!',
                    info: 'Mostrando _PAGE_ De _PAGES_ Páginas',
                    infoEmpty: 'Nada Aqui!',
                    infoFiltered: '(filtered from _MAX_ total records)',
                    search: "Pesquisar:",
                    paginate: {
                        first: "Primeiro",
                        last: "Ultimo",
                        next: "Proximo",
                        previous: "Anterior"
                    }
                },
            });
        });
    </script>

</body>

</html>