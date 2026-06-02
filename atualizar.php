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

// 2º momento: info da cidade escolhida
if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['cidade_id'])){
    $sql            = "SELECT * FROM cidades WHERE id_c=?";
    $stmt           = $conexao->prepare($sql);
    $stmt->execute([$_GET['cidade_id']]);
    $dados_cidade   = $stmt->fetch();
    $id             = $dados_cidade['id_c'];
    $nome           = $dados_cidade['nome_c'];
    $habitantes     = $dados_cidade['habitantes_c'];
    $pais           = $dados_cidade['pais_c'];
    $dataf          = $dados_cidade['dataf_c'];
    $descricao      = $dados_cidade['desc_c'];
}

/* 
EXEMPLO DE RADIO PREENCHIDO:
if($restaurante == 0){
    $radioSimSelected = "";
    $radioNaoSelected = "checked";
}elseif($restaurante == 0){
    $radioSimSelected = "checked";
    $radioNaoSelected = "";
}

<input type="radio" fnome="restaurante" value="1" <?=$radioSimSelected ?>> Sim <br><br>
<input type="radio" fnome="restaurante" value="0" <?=$radioNaoSelected ?>> Não  
*/


// 3º momento: SE(formulário recebido)
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['fnome'])){
    $sql   = "UPDATE cidades SET nome_c=?, pais_c=?, habitantes_c=?, dataf_c=?, desc_c=? WHERE id_c=?";
    $atArray = [
        $_POST['fnome'],
        $_POST['fpais'],
        $_POST['fhabitantes'],
        $_POST['fdataf'],
        $_POST['fdescricao'],
        $_POST['fid'],
    ];
    $stmt = $conexao->prepare($sql);
    $stmt->execute($atArray);
    
    // cria um elemento alerta no array session_start
    $_SESSION['alerta'] = "Cidade atualizada com sucesso";
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

        <p id="p_titulo_01">Atualizar cidade</p>
        <br>
        <div>

            <!-- 1º passo -->
            <?php if(!isset($_GET['cidade_id'])): ?>
                <?php foreach($resposta as $cidade): ?>
                    <a href="atualizar.php?cidade_id=<?= $cidade['id_c'] ?>" class="lista-link"> <?= $cidade['nome_c'] ?> </a> 
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- 2º passo -->
            <?php if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET['cidade_id'])): ?>
            <form method="POST" action="">
                <input type="hidden" name="fid" value="<?=$id?>">
                <input type="text" name="fnome" placeholder="Nome da cidade" class="class-inputs" value="<?=$nome?>" required> <br><br>
                <input type="text" name="fpais" placeholder="País" class="class-inputs" required value="<?=$pais?>"> <br><br>
                <input type="number" name="fdataf" placeholder="Data de fundação" class="class-inputs" required value="<?=$dataf?>"> <br><br>
                <input type="number" name="fhabitantes" placeholder="Número de habitantes" class="class-inputs" required value="<?=$habitantes?>"> <br><br>
                <textarea name="fdescricao" placeholder="Texto descritivo" class="class-inputs" required><?=$descricao?></textarea> <br><br>
                <input type="submit" value="atualizar"> 
                <input type="reset" value="apagar">
            </form>
            <?php endif; ?>
            <br><br><br><br>
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>  
    <?php require_once "includes/janela_avisos.php" ?>  
</body>
</html>