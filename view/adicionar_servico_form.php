<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>cadastrar serviço</title>
    <style>
        .container {
            width: 600px;
            margin-top: 25px;
        }
    </style>
</head>

<body>
    <?php 
    $confirmacao = $_GET['confirmacao']??null;
    if($confirmacao === 'true'){
        echo "<script>alert('Serviço Cadastrado')</script>";
    }
    ?>
    <form action="../controller/cadastrar_servico.php" method="post" class='container'>
        <h2>Cadastro De Serviços</h2>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">Nome Serviço</label>
            <input type="text" name="novo_servico" class="form-control" id="formGroupExampleInput" placeholder="Nome Do Serviço">
        </div>

        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Preço</label>
            <input type="number" name="preco" class="form-control" id="formGroupExampleInput2" placeholder="Preço">
        </div>

        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label">Responsavel</label>
            <select name="responsavel" id="formGroupExampleInput2">
                <?php
                require_once "../model/bd.php";
                $query_dados_ocupacao = "SELECT cod_tipo, tipo_nome FROM tipo_usuarios";
                $dados_ocupacao = mysqli_query($conn, $query_dados_ocupacao);
                while($ocupacao = $dados_ocupacao->fetch_object()){
                    echo "<option value='$ocupacao->cod_tipo'>$ocupacao->tipo_nome</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    <a href='servicos_oferecidos.php'><button class='btn button'><span class='material-symbols-outlined'>
                arrow_back_ios
            </span></button></a>
</body>

</html>