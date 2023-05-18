<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/cadastro_usuario.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Cadastro Usuario</title>
</head>

<body>
    <?php
    $mensagem = $_GET['mensagem'] ?? null;
    $erro = $_GET['erro'] ?? null;

    if ($mensagem === "usuariocadastrado") {
        echo '<script>alert("Usuário cadastrado com sucesso")</script>';
    } elseif ($erro === "senhasnãoconferem") {
        echo '<script>alert("Senhas não conferem")</script>';
    }
    ?>
    <form class="form-container" method="post" action="../controller/cadastrar_usuario.php">
        <h2>Cadastrar Usuario</h2>
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="senha1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirme Sua Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="senha2">
        </div>
        <select class="form-select" aria-label="Default select example" name="tipo">
            <?php
            require_once '../model/bd.php';
            $tipos_query = "SELECT cod_tipo, tipo_nome FROM tipo_usuarios";
            $tipos = mysqli_query($conn, $tipos_query);
            while ($tipo = $tipos->fetch_object()) {
                echo "<option value='$tipo->cod_tipo'>$tipo->tipo_nome</option>";
            }
            
            ?>
        </select>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
   <?php 
   require_once "../utils/funcoes.php";
   btnVoltar();
   ?>
</body>

</html>