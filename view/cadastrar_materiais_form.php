<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/cadastro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Cadastrar Material</title>
</head>
<body>
    <?php 
    $mensegem = $_GET['mensagem']??null;
    $erro = $_GET['erro']??null;
    if($mensegem === 'cadastradocomsucesso'){
        echo "<script>alert('Material Cadastrado Com Sucesso')</script>";
    }
    if ($erro === 'erro_insercao') {
        echo "<script>alert('Erro Ao Inserir')</script>";
    }
    ?>
    <form action="../controller/cadastrar_material.php" method="post" class="cadastro_material">
        <h2>Cadastrar Material</h2>
        <label for="nome">Nome Do Material:</label>
        <input type="text" name="nome" id="nome">
        <label for="quantidade">Quantidade Em Estoque:</label>
        <input type="number" name="quantidade" id="quantidade" step="0.1">
        <label for="preco_compra">Preço De Compra:</label>
        <input type="number" name="preco_compra" id="preco_compra" step="0.1">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
    <a href='consultar_materiais.php'><button class='btn button'><span class='material-symbols-outlined'>
    arrow_back_ios
    </span></button></a>
    
</body>
</html>