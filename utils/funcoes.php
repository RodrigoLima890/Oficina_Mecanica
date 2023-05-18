<?php
function btnVoltar()
{
    echo "
<a href='main.php'><button class='btn button'><span class='material-symbols-outlined'>
arrow_back_ios
</span></button></a>
";
}

function retirar_nulos($array)
{
    $array_sem_nulos = array_filter($array, function ($dado) {
        return $dado != null;
    });
    return $array_sem_nulos;
}

function atualizar_materiais($quantidade, $cod_material, $conn)
{
    $query_pegar_quantidades_estoque = "SELECT quantidade_estoque FROM materiais 
    WHERE cod_material = '$cod_material'";

    $quantidades_estoque = $conn->query($query_pegar_quantidades_estoque);
    $quantidade_bd = $quantidades_estoque->fetch_assoc();

    $nova_quantidade = intval($quantidade_bd['quantidade_estoque']) - intval($quantidade);

    $query_modificar_estoque = "UPDATE materiais SET quantidade_estoque = '$nova_quantidade' WHERE cod_material = '$cod_material'";

    $conn->query($query_modificar_estoque);

    mysqli_commit($conn);
}

function verificar_materiais_existentes($nome, $conn)
{
    $query_pegar_nomes = "SELECT nome_material FROM materiasi";
    $nomes = mysqli_query($conn, $query_pegar_nomes);
    while ($nome_bd = $nomes->fetch_object()) {
        strtolower($nome_bd);
        strtolower($nome);
        if ($nome_bd === $nome) {
            return false;
        }
    }
    return true;
}
