<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    
    <title>Document</title>
</head>
<body>
    <?php 
    require_once '../model/bd.php';
    session_start();
    $cod_usuario = $_SESSION['cod_usuario'];
    print_r($_SESSION);

    $tipo_user_query = "SELECT tipo FROM usuarios WHERE cod_usuario = $cod_usuario";
    $tipo_user = $conn->query($tipo_user_query);

    $row = $tipo_user->fetch_assoc();
    var_dump($row);

    $tipo = $row['tipo'];
    var_dump($tipo);
    ?>
</body>
</html>