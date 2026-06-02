<?php
session_start();

unset($_SESSION['utilizador_nome']);
unset($_SESSION['utilizador_nivel']);
unset($_SESSION['utilizador_id']); 

session_destroy();

header("location:index.php");
?>