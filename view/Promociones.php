<?php require("layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

    <div class="container" style="text-align: center;">
        <img src="view/img/promo3.png" alt="..." width="70%">
    </div>

    <div class="Titular">
        <h2>Promociones disponibles</h2>
        <center><hr width="30%"></center>
    </div>

    <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3 d-flex justify-content-center" style="text-align: center;">
    <?php
        foreach ($data as $key => $value) {         
            foreach ($value as $promocion) {               
                echo '<div class="col d-flex justify-content-center">';
                echo '<div class="card" style="width: 18rem;">';
                echo '<img src="'.$promocion['ImagenPromocion'].'" class="card-img-top" alt="...">';
                echo '<div class="card-body">';
                echo '<p class="card-text"><b>'.$promocion['Condiciones'].'</b></p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }           
        }
    ?>
    </div>

</main>

<!--Espacio para el Footer, no tocar-->
<?php require("layout/footer.php"); ?>