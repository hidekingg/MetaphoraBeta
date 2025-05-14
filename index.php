<?php
require_once("config.php");
require_once("controller/indexcontroller.php");
require_once("controller/perfilescontroller.php");
require_once("controller/Admincontroller.php");

if (isset($_GET['i'])):
    $metodo = $_GET['i'];
    // Solo permitir métodos alfabéticos, no numéricos
    if(method_exists('indexcontroller', $metodo) && !is_numeric($metodo)):
        indexcontroller::{$metodo}();
    else:
        header("Location: /");
        exit();
    endif;
elseif(isset($_GET['p'])):
    $metodo = $_GET['p'];
    if(method_exists('perfilescontroller', $metodo)):
        perfilescontroller::{$metodo}();
    else:
        // Si el método no existe
        indexcontroller::index();
    endif;
elseif(isset($_GET['a'])):
    $metodo = $_GET['a'];
    if(method_exists('admincontroller', $metodo)):
        admincontroller::{$metodo}();
    else:
        // Si el método no existe
        indexcontroller::index();
    endif;
else:
    indexcontroller::index();  
endif;
?>