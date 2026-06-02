<?php
session_start();
require_once "includes/funcoes.php";
$conexao = criar_conexao();

// Verificar se o formulário foi submetido
if($_SERVER['REQUEST_METHOD']=='POST'){
    /* pre($_FILES,1);
    pre($_POST,1,1); */
    $cidade = $_POST['fcidade'];
    $desc   = $_POST['fdesc'] ?? "";
    // criar array com o nome do ficheiro, separado por ponto (ex: se se chamar batatas.jpg, separa "batatas" de "jpg")
    $nomecompleto = explode(".", $_FILES["ffoto"]["name"]);
    // dar um nome garantidamente diferente (timestamp UNIX atual) e trazer o último elemento do array (que é a extensão)
    // gerará um nome como 1674329873.jpg
    $novonome = round(microtime(true)) . "." . end($nomecompleto);
    move_uploaded_file($_FILES["ffoto"]["tmp_name"],  "imgs/cidades/".$novonome);

    $sql_adfoto="INSERT INTO fotos (img_f, desc_f, cidade_f) VALUES (?,?,?)";
    //VALUES ('$novonome','$desc','$cidade')";
    $adFoto=[
        $novonome,
        $desc,
        $cidade
    ];

    $stmt = $conexao->prepare($sql_adfoto);
    $stmt->execute($adFoto);

    // depois de inserido a foto navega para a página inicial
    if($stmt==TRUE){
        // cria um elemento alerta no array session_start
        $_SESSION['alerta'] = "Fotografia adicionada com sucesso";
    }else{    
        // cria um elemento alerta no array session_start
        $_SESSION['alerta'] = "Erro ao adicionar a fotografia";
    }
    // navega para index.php
    header('location:index.php');
}else{

    $sql = "SELECT * FROM cidades";
            // como não precisa de ser uma instrução preparada basta query() direto
    $stmt = $conexao->query($sql);
            /* Se tivesse placeholders, para informação introduzida pelo utilizador,
            teria de ser uma instrução preparada. Deste modo seria:
            $stmt = $conexao->prepare($sql);
            $stmt->execute(); */
    $resultado = $stmt->fetchAll();
}

//carregaFoto($conexao);
?>

<!DOCTYPE html>
<html lang="pt">
<?php require_once "includes/head.php"; ?>
<body>
    <?php require_once "includes/header.php"; ?>
    <main>
        <?php require_once "includes/pesquisa_e_nav.php"; ?>
        <p id="p_titulo_01"> Adicionar fotografias </p>
        <br>
        <?php if($_SERVER['REQUEST_METHOD']!='POST'): ?>
        <form action="" method="POST" enctype="multipart/form-data"> 
            <!--  Os dados enviados por POST nao sao visiveis no browser 
            action define para onde os dados sao enviados, action="" envia os dados para este mesmo ficheiro-->
            Fotografia<br>
            <input type="file" name="ffoto" class="class-inputs" required>
            <br><br>
            Cidade<br>
            <select name="fcidade" class="class-inputs" required> 
                <?php foreach($resultado AS $cidade): ?>
                    <option value="<?=$cidade['id_c']?>"><?=$cidade['nome_c']?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            Descrição<br>
            <textarea name="fdesc" class="class-inputs"></textarea>
            <br><br>
            <input type="submit" value="adicionar">

        </form>
        <?php endif;?>
    </main>
    <?php require_once "includes/footer.php" ?>  
    <?php require_once "includes/janela_avisos.php" ?>  
</body>
</html>