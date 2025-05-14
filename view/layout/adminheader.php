<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MetaphoraAdmin</title>
    <link rel="stylesheet" href="view/css/styleadmin.css">
    <link rel="stylesheet" type="text/css" href="view/Boostrap/bootstrap.min.css">
    <script type="text/javascript" src="view/Boostrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="view/Boostrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" href="view/img/logo.ico">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
</head>

<body>
    
    <header>

    <nav class="navbar navbar-expand fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?a=AdminMenu" >
                <img src="view/img/MetaphoraAdminLogo.png" alt="Metaphora" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
            <ul class="navbar-nav align-items-center" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?i=Index">Volver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?a=AdminMenu">Inicio</a>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php?a=AdminVenta">Vender</a>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?a=AdminAdministrar">Administrar</a>
                </li>
               <!--  <li class="nav-item">
                    <a class="nav-link" href="index.php?a=AdminConsultar">Consultar</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Viajes
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="index.php?a=AdminReBoletos">Reimprimir boletos</a></li>
                        <li><a class="dropdown-item" href="index.php?a=AdminProgViajes">Programar Viajes</a></li>
                        <li><a class="dropdown-item" href="index.php?a=AdminMostrarViajes">Mostrar Viajes</a></li>
                        <li><a class="dropdown-item" href="index.php?a=AdminLiberarViajes">Liberar Viajes</a></li>
                    </ul>
                </li>-->
            </ul>
        </div>
        </div>
    </nav>

    </header>