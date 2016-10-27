<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>COMUNIDAD ITCM</title>
    <link rel="icon" href="img/favicon.ico">
    <link rel="manifest" href="/manifest.json">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script>
        var OneSignal = OneSignal || [];
        OneSignal.push(["init", {
            appId: "your_own_api_key",
            autoRegister: false,
            notifyButton: {
                enable: false /* Set to false to hide */
            }
        }]);
    </script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css"> <!-- TEMA BOOTSTRAP ORIGINAL -->
    <link rel="stylesheet" href="css/material-kit.css">
    <!--link rel="stylesheet" href="css/bootstrap-united.css"--> <!-- TEMA BOOTSTRAP A EDITAR -->
    <link rel="stylesheet" href="css/jquery.dataTables.css"> <!-- TEMA JQUERY DATATABLES -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.css"> <!-- TEMA BOOTSTRAP PARA DATATABLES -->
    <link rel="stylesheet" href="css/responsive.bootstrap.min.css">
    <!-- TEMA BOOTSTRAP PARA DATATABLES RESPONSIVAS -->
    <link rel="stylesheet" href="css/bootstrap-social.css"> <!-- TEMA BOOTSTRAP PARA BOTONES SOCIALES -->
    <link rel="stylesheet" href="css/style.css"> <!-- MIS ESTILOS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
</head>
<body>

<!--Navigation Area-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand titulo">#ComunidadITCM</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right links">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Servicios <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="asesores.php">Buscar un asesor</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="profesores.php">Conoce a tu profesor</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="tramites.php">Guía de trámites</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="encuestas.php">Encuestas</a></li>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['email'])) {
                    $link = "perfil.php";
                    $texto = "Mi Cuenta";
                } else {
                    $link = "acceder.php";
                    $texto = "acceder";
                }

                echo "<li class='page-scroll'>
                            <a href='$link'>$texto</a>
                            </li>"
                ?>
                <li class="page-scroll">
                    <a href="soporte.php">Soporte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header class="main_header">

    <?php
    if ($_SERVER['PHP_SELF'] == "/comunidaditcm/index.php" || $_SERVER['PHP_SELF'] == "/index.php") {
        echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="img/itcm4.jpg" alt="...">
                <div class="carousel-caption">
                    <p>Comunidad ITCM</p>
                    <p>Creado por y para estudiantes del tec</p>
                </div>
            </div>
            <div class="item">
                <img src="img/itcm2.jpg" alt="...">
                <div class="carousel-caption">
                    <p>Comunidad ITCM</p>
                    <p>Creado por y para estudiantes del tec</p>
                </div>
            </div>
            <div class="item">
                <img src="img/itcm3.jpg" alt="...">
                <div class="carousel-caption">
                    <p>Comunidad ITCM</p>
                    <p>Creado por y para estudiantes del tec</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>';
    } else {
        echo '<div class="jumbotron">
        <div class="container">
            <div class="div-login">
            </div>
        </div>
    </div>';
    }
    ?>


</header>