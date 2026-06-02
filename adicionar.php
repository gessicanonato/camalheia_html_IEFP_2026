<?php
session_start();
require_once "includes/funcoes.php";
$conexao = criar_conexao();

// 2º momento - SE(formulário recebido)
// isset($var) função nativa do PHP que devolve True/False consoante a variável avaliada ($var) existe ou não
if(isset($_POST['fnome'])){
    $sql= "INSERT INTO cidades (nome_c, pais_c, habitantes_c, dataf_c, desc_c) VALUES (?,?,?,?,?)";

    $adArray = [
        $_POST['fnome'],
        $_POST['fpais'],
        $_POST['fhabitantes'],
        $_POST['fdataf'],
        $_POST['fdescricao']
    ];

    $stmt = $conexao->prepare($sql);
    $stmt->execute($adArray);

    // cria um elemento alerta no array session_start
    $_SESSION['alerta'] = "Cidade adicionada com sucesso";
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

        <p id="p_titulo_01">Adicionar cidade</p>
        <br>
        <div>
            <form method="POST" action="">
                <input type="text" name="fnome" placeholder="Nome da cidade" class="class-inputs" required> <br><br>
                <input type="text" name="fpais" placeholder="País" class="class-inputs" required> <br><br>
                <input type="number" name="fdataf" placeholder="Data de fundação" class="class-inputs" required> <br><br>
                <input type="number" name="fhabitantes" placeholder="Número de habitantes" class="class-inputs" required> <br><br>
                <textarea name="fdescricao" placeholder="Texto descritivo" class="class-inputs" required></textarea> <br><br>
                <input type="submit" value="adicionar"> 
                <input type="reset" value="apagar">
            </form>
            <br><br><br><br>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>  
    <?php require_once "includes/janela_avisos.php" ?>  
</body>
</html>