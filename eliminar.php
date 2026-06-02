<?php
session_start();
require_once "includes/funcoes.php";
$conexao = criar_conexao();

//echo "Esta página foi acedida por: " .$_SERVER["REQUEST_METHOD"] ."<br>";

// 1º momento: Listagem das cidades com id no <a href
$resposta = "";
if(!isset($_GET['cidade_id'])){
    $sql        = "SELECT * FROM cidades";
    $stmt       = $conexao->query($sql);
    $resposta   = $stmt->fetchAll();
}

// 2º momento: Elimina na BD
if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['cidade_id'])){
    $sql    = "DELETE FROM cidades WHERE id_c=?";
    $stmt   = $conexao->prepare($sql);
    /* $array = [$_GET['cidade_id']];
    $stmt->execute($array); */
    $stmt->execute([$_GET['cidade_id']]);

    // cria um elemento alerta no array session_start
    $_SESSION['alerta'] = "Cidade eliminada com sucesso";
    // navega para index.php
    header('location:index.php');

}
?>

<!DOCTYPE html>
<html lang="pt">
<?php require_once "includes/head.php"; ?>
<body>
    <?php require_once "includes/header.php"; ?>
    <main>
        <?php require_once "includes/pesquisa_e_nav.php"; ?>

        <p id="p_titulo_01">Eliminar cidade</p>
        <br>
        <div>

            <!-- 1º passo -->
            <?php if(!isset($_GET['cidade_id'])): ?>
                <?php foreach($resposta as $cidade): ?>
                    <a href="#" onclick="confirmaEliminar('<?=$cidade['nome_c'] ?>',<?=$cidade['id_c'] ?>)" class="lista-link"> <?= $cidade['nome_c'] ?> </a> 
                <?php endforeach; ?>
            <?php endif; ?>
            <br><br><br><br>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?> 
    <?php require_once "includes/janela_avisos.php" ?>   
</body>
</html>