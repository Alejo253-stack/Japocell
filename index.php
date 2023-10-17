<?php 
require "./inc/inicio_sesion.php";
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "./inc/hed.php"; ?>
</head>
<body>
    <?php
    $vista = (isset($_GET['vista']) && !empty($_GET['vista'])) ? $_GET['vista'] : "login";

    if (is_file("./css/vista.css") && $vista != "login" && $vista != "404") {
        /* Verificar cierre de sesión */
        if (empty($_SESSION['id']) || empty($_SESSION['usuario'])) {
            include "./vistas/logout.php";
            exit();
        }

        include "./inc/navbar.php";
        include "./css/vista.css";
        include "./inc/script.php";
    } else {
        if ($vista == "login") {
            include "./vistas/login.php";
        } else {
            include "./vistas/404.php";
        }
    }
    ?>
</body>
</html>
