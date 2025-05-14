<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

    <div class="Titular">
        <?php
            echo'<h2>¡Bienvenido '.$_SESSION['Username'].'!</h2>';
        ?>
        <center><hr width="30%"></center>
    </div>

    <div class="container" style="text-align: center;">
        <img src="view/img/BannerAdmin.png" alt="..." width="70%">
    </div>

</main>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>