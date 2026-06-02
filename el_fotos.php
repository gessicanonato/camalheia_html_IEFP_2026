<?php
session_start();
require_once "includes/funcoes.php";
$conexao = criar_conexao();

// Verificar se recebemos um id
if(isset($_GET['id_foto'])){

    $sql = "SELECT * FROM fotos WHERE id_f = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$_GET['id_foto']]);
    $resultado = $stmt->fetch();

    $foto_real = "imgs/cidades/". $resultado['img_f'];
    if(unlink($foto_real) == false){
        $_SESSION['alerta'] = "Erro ao eliminar a fotografia";
    }

    $sql = "DELETE FROM fotos WHERE id_f = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$_GET['id_foto']]);
    if($stmt == false){
        $_SESSION['alerta'] = "Erro ao eliminar a fotografia";
    }else{
        $_SESSION['alerta'] = "Fotografia eliminada com sucesso";
    }

    header("location:index.php");
}