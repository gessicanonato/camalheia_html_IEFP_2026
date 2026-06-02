<div id="barraPesquisa">
    <nav>
        <a href="index.php">Home</a>
        <?php if(isset($_SESSION['utilizador_nivel'])): ?>
            <a href="adicionar.php">Adicionar</a>
            <a href="atualizar.php">Atualizar</a>
            <?php if ($_SESSION['utilizador_nivel']==1): ?>
                <a href="eliminar.php">Eliminar</a>
            <?php endif;?>
            <a href="ad_fotos.php">Fotos</a>
        <?php endif; ?>

    </nav>

    <form name="formPesquisa" method="GET" enctype="application/x-www-form-urlencoded" action="">
        <input type="text" name="fpesquisa" class="input-pesquisa">
        <input type="submit" value="pesquisa">
    </form>
</div>