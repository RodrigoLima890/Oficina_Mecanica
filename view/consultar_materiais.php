<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./styles/consultar_materiais.css">
    <title>Materiais</title>
</head>

<body>

    <h2>Materiais Disponiveis</h2>

    <a href="cadastrar_materiais_form.php"><button type="button" class='button btn btn-primary'>Cadastrar Materiais</button></a>
    <a href="modificar_materiais_form.php"><button type="button" class='button btn btn-primary'>Modificar Materiais</button></a>
    <a href="deletar_material_form.php"><button type="button" class='button btn btn-danger'>Deletar Material</button></a>

    <div class="tabela-container">
        <table class="table table-hover table-striped" id="myTable">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../model/bd.php';
                $consultar_materiais = "SELECT cod_material, nome_material, quantidade_estoque FROM materiais";
                $consulta = mysqli_query($conn, $consultar_materiais);
                while ($linha = $consulta->fetch_object()) {
                    echo '<tr><td>' . $linha->cod_material . '</td>';
                    echo '<td>' . $linha->nome_material . '</td>';
                    if ($linha->quantidade_estoque > 5) {
                        echo '<td>' . $linha->quantidade_estoque . '</td>';
                    } else {
                        echo '<td class="red">' . $linha->quantidade_estoque . '</td>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
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
    </div>
    <?php
    require_once "../utils/funcoes.php";
    btnVoltar();
    ?>
</body>

</html>