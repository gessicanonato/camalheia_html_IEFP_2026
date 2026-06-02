<?php
session_start();
require_once "includes/funcoes.php";

$conexao = criar_conexao();

$sql = "SELECT * FROM cidades";
        // como não precisa de ser uma instrução preparada basta query() direto
$stmt = $conexao->query($sql);
        /* Se tivesse placeholders, para informação introduzida pelo utilizador,
        teria de ser uma instrução preparada. Deste modo seria:
        $stmt = $conexao->prepare($sql);
        $stmt->execute(); */
$resultado = $stmt->fetchAll();


if(isset($_POST['fuser'])){
    $sql ="SELECT * FROM utilizadores WHERE nome_u=?";
    $stmt = $conexao->prepare($sql);
    $stmt->execute([$_POST['fuser']]);
    $resposta = $stmt->fetch();

    if($resposta != false){
        //$passEncriptada = password_hash($_POST['fpass'],PASSWORD_DEFAULT);
        if(password_verify($_POST['fpass'], $resposta['pass_u'])){
            $_SESSION['utilizador_nome']    = $resposta['nome_u'];
            $_SESSION['utilizador_nivel']   = $resposta['nivel_u'];
            $_SESSION['utilizador_id']      = $resposta['id_u'];
        }else{
            $_SESSION['alerta'] = "A password está incorreta.";
        }
    }else{
        $_SESSION['alerta'] = "Utilizador não encontrado";
    }
}


// se o array de SESSION tem um elemento alerta
if(isset($_SESSION['alerta'])){
    // cria variável com o texto do alerta
    $alerta = $_SESSION['alerta'];
    // remove o alerta de SESSION
    unset($_SESSION['alerta']);
    // exibe a janela alerta
    $styleJanelaAlerta = "display:block;";
}else{
    // mantém escondida a janela alerta
    $styleJanelaAlerta = "display:none;";
}


//pre($resultado);
?>

<!DOCTYPE html>
<html lang="pt">
<?php require_once "includes/head.php"; ?>
<body>
    <?php require_once "includes/header.php"; ?>
    <main>
        <?php require_once "includes/pesquisa_e_nav.php"; ?>
        <p id="p_01">
            Um homem precisa viajar. Por sua conta, não por meio de histórias, imagens, livros ou TV. Precisa viajar por si, com seus olhos e pés, para entender o que é seu. Para um dia plantar as suas próprias árvores e dar-lhes valor. Conhecer o frio para desfrutar o calor. E o oposto. Sentir a distância e o desabrigo para estar bem sob o próprio teto.
            Um homem precisa viajar para lugares que não conhece para quebrar essa arrogância que nos faz ver o mundo como o imaginamos, e não simplesmente como é ou pode ser. Que nos faz professores e doutores do que não vimos, quando deveríamos ser alunos, e simplesmente ir ver.
        </p>
        <p id="p_autor_01">Amyr Klink</p>
        <p id="p_titulo_01">Cidades aderentes:</p>

        <div class="cxFlex100">
            <!-- por cada cidade que esteja na BD, executa: -->
            <?php foreach($resultado as $cidade): ?>
                <div class="cxinhaCidade">
                    <a href="detalhes.php?cidadeID=<?=$cidade['id_c']?>">
                        <p class="tituloCxinha"><?=$cidade['nome_c']?> </p>
                        <p class="txtCxinha"> <?=$cidade['habitantes_c']?> habitantes</p>
                        <p class="txtCxinha"> <?=$cidade['pais_c']?></p>
                    </a>
                </div>
            <?php endforeach ?>
            <!-- até aqui -->
        </div>
    </main>
    <?php require_once "includes/footer.php" ?>

    <div id="janelaAlertas_id" style="<?= $styleJanelaAlerta ?>">
        <div id="alerta_id">
            <div id="titulo_aviso">Informação:</div>
            <p id="textoAviso_id"><?= $alerta ?></p>
            <br>
            <div class='grupo-bts'>
                <a href="#" onclick="removerJanelaAlerta()" class="bts-aviso">OK</a>
            </div>
        </div>
    </div>

</body>
</html>