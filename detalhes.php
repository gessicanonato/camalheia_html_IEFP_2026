<?php
session_start();
require_once "includes/funcoes.php";

$conexao = criar_conexao();


$sql        = "SELECT * FROM cidades WHERE id_c=?";
$stmt       = $conexao->prepare($sql);
$stmt->execute([$_GET['cidadeID']]);
$resultado  = $stmt->fetch();

$cidade     = $resultado['nome_c'];
$habitantes = $resultado['habitantes_c'];
$pais       = $resultado['pais_c'];
$fundacao   = $resultado['dataf_c'] >= 0 ? $resultado['dataf_c'] : abs($resultado['dataf_c'])." AC";
$descricao  = $resultado['desc_c'];


$sql        = "SELECT * FROM fotos WHERE cidade_f = ?";
$stmt       = $conexao->prepare($sql);
$stmt->execute([$_GET['cidadeID']]);
$fotos      = $stmt->fetchAll();

//pre($resultado);

?>

<!DOCTYPE html>
<html lang="pt">
<?php require_once "includes/head.php"; ?>
<body>
    <?php require_once "includes/header.php"; ?>
    <main>
        <?php require_once "includes/pesquisa_e_nav.php"; ?>

        <p id="p_titulo_01"> <?=$cidade?> </p>
        <br>
        <div>
            <p>
                <strong>País:</strong> 
                <?= $pais ?> 
            </p>
            <p>
                <strong>Habitantes:</strong> 
                <?= $habitantes ?>
            </p>
            <p>
                <strong>Fundação:</strong> 
                <?= $fundacao ?>
            </p>
            <p>
                <?= $descricao ?>
            </p>
            <br><br>
            <div class="cxFlex100">
                <?php foreach($fotos as $foto): ?>
                <div class="moldura">
                    <img src="imgs/cidades/<?= $foto['img_f'] ?>" class="miniatura">
                    <a href="el_fotos.php?id_foto=<?= $foto['id_f'] ?>" class="eliminar-foto">Eliminar</a>
                </div>
                <?php endforeach ?>
            </div>
            <br><br><br>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>  
    <?php require_once "includes/janela_avisos.php" ?>  
</body>
</html>