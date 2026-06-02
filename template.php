<?php
session_start();
require_once "includes/funcoes.php";
$conexao = criar_conexao();
?>

<!DOCTYPE html>
<html lang="pt">
<?php require_once "includes/head.php"; ?>
<body>
    <?php require_once "includes/header.php"; ?>    
    <main>
        <?php require_once "includes/pesquisa_e_nav.php"; ?>
        <p id="p_titulo_01"> Aqui ficará um título </p>
        <br>
        <div>
            <p>
                <strong>Aqui ficará o titulo do parágrafo</strong> 
                Aqui poderão ficar dados
            </p>

            <br><br>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>  
    <?php require_once "includes/janela_avisos.php" ?>  
</body>
</html>