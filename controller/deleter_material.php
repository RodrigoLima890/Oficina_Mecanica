<?php
require_once "../model/bd.php";

if(!isset($_POST['cod_material'])){
    header("Location: ../view/deletar_material_form.php?erro=cod_erro");
    exit;
} 
$cod_material = $_POST['cod_material']??null;
$query_delecao = "DELETE FROM materiais WHERE cod_material ='$cod_material'";
$conn -> query($query_delecao);

header("Location: ../view/deletar_material_form.php?confirmar=true");
?>