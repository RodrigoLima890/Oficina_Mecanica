<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <?php 
    $mensagem = $_GET['erro']??null;
    if($mensagem === "usuarioinvalido"){
        echo "<script>alert('Usuario Não Encontrado')</script>";
    }
    ?>
    <form action="../controller/validar_usuario.php" method="post" id="form-login" class="form_login">
        <h2 class="title">Login</h2>
        <label for="inputPassword5" class="form-label">Usuario:</label>
        <input type="text" id="usuario" class="form-control" name="usuario" aria-labelledby="passwordHelpBlock">
        <label for="inputPassword5" class="form-label">Senha:</label>
        <input type="password" id="senha" class="form-control" name="senha" aria-labelledby="passwordHelpBlock">
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>

</body>

</html>