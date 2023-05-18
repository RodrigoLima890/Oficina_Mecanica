<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Deletar Material</title>
    <style>
        h2{
            margin: auto;
        }
        .container{
            width: 400px;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <?php 
    $erro = $_GET['erro']??null;
    $confirmar = $_GET['confirmar']??null;
    if($erro === 'cod_erro'){
        echo "<script>alert('Erro ao deletar. usuario não passou o código')</script>";
    }
    if($confirmar === 'true'){
        echo "<script>alert('Material Deletado da lista')</script>";
    }
    ?>
    <h2>Deleção De Materiais</h2>
    <form action="../controller/deleter_material.php" method="post" class="container">
        <label for="cod">Código Do Material Deletado</label>
        <input type="number" id="cod" name="cod_material">
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
    <?php 
    require_once "../utils/funcoes.php";
    btnVoltar();
    ?>
</body>
</html>