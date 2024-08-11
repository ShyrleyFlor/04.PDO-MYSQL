<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EJEMPLO MVC</title>
    <!-- AQUI ESTA EL CODIGO PARA USAR BOOTSTRAP-->

    <!-- Plugins de CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!--Plugins de JS-->
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

     <!--Iconos-->
     <script src="https://kit.fontawesome.com/e8ed0f89d9.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--LOGO-->
    <div class="container-fluid">
        <h3 class="text-center py-3">MVC</h3>
    </div>
    <!--MENU-->
    <div class="container-fluid bg-light">
        <div class="container">
            <ul class="nav nav-justified py-2 nav-pills">

                <?php if (isset($_GET["pagina"])): ?>
                    <?php if ($_GET["pagina"] == "registro"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=registro">Registro</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=registro">Registro</a>
                        </li>
                    <?php endif ?>

                    <?php if ($_GET["pagina"] == "inicio"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=inicio">Inicio</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=inicio">Inicio</a>
                        </li>
                    <?php endif ?>

                    <?php if ($_GET["pagina"] == "login"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=login">Login</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=login">Login</a>
                        </li>
                    <?php endif ?>

                    <?php if ($_GET["pagina"] == "salir"): ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?pagina=salir">Salir</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pagina=salir">Salir</a>
                        </li>
                    <?php endif ?>

                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link " href="index.php?pagina=inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?pagina=registro">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pagina=login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?pagina=salir">Salir</a>
                    </li>

                <?php endif ?>


            </ul>
        </div>
    </div>

    <!--CONTENIDO-->
    <div class="container-fluid">
        <div class="container py-5">
            <?php
            if (isset($_GET["pagina"])) {

                if ($_GET["pagina"] == "inicio" || $_GET["pagina"] == "registro" || $_GET["pagina"] == "login" || $_GET["pagina"] == "salir") {
                    include "paginas/" . $_GET["pagina"] . ".php";

                }else{
                    include "paginas/e  rror404.php";
                }

            } else {
                include "paginas/registro.php";
            }
            ?>
        </div>
    </div>


</body>

</html>