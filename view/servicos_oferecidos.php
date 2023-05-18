<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/servicos_ofertados.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Servicos</title>
</head>

<body>
    <a href="adicionar_servico_form.php"><button class="btn btn-primary">Adicionar Serviço</button></a>
    <h2 class="title text-center">Serviços Ofertados</h2>
    <div class="tabela-container">
        <table class="table table-hover table-striped" id="myTable">
            <thead>
                <tr>
                    <th>Codigo Serviço</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Responsavel</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once '../model/bd.php';
                $consultar_servicos = "SELECT s.cod_servico, s.nome_servico,s.preco, t.tipo_nome
                FROM servicos s JOIN tipo_usuarios t ON s.usuario_tipo = t.cod_tipo";


                $consulta = mysqli_query($conn, $consultar_servicos);
                while ($linha = $consulta->fetch_object()) {
                    echo '<tr><td>' . $linha->cod_servico . '</td>';
                    echo '<td>' . $linha->nome_servico . '</td>';
                    if ($linha->preco == null) {
                        echo '<td> Á Combinar</td>';
                    } else {
                        echo '<td>' . $linha->preco . '</td>';
                    }
                    echo '<td class="red">' . $linha->tipo_nome . '</td>';
                }
                ?>
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