<header>
    <div class="cxFlex80">
        <img src="imgs/logo.png" alt="Logótipo" id="imgLogo">
        <p id="slogan">Projeto Camalheia :: viaje pelo mundo ficando alojado na... cama alheia</p>

        <?php 
        if(isset($_SESSION['utilizador_id'])){
            $utilizador      = $_SESSION['utilizador_nome'];
        }
        ?>
        <?php if(!isset($_SESSION['utilizador_id'])): ?>
        <form action="" name="formLogin" id="id_formLogin" method="POST" enctype="application/x-www-form-urlencoded">
            <div id="agrupaInputs">
                <input type="text" name="fuser" placeholder="user" class="input-login" required>
                <input type="password" name="fpass" placeholder="password" class="input-login" required>
            </div>
            <input type="submit" value="entrar">
        </form>
        <?php else: ?>
            <p class='logout-link'>
                Olá <?= $utilizador ?> 
                <a href='logout.php'>Logout</a>
            </p>
        <?php endif; ?>
    </div>
</header>