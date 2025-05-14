<?php require("layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

    <div class="container" style="text-align: center; margin-bottom: 2%;">
        <img src="view/img/BannerMini.png" alt="..." width="70%">
    </div>

    <?php                         
        if(isset($_SESSION["IdUsuario"])){
            if($_SESSION["IdUsuario"]==0){
            echo '<div class="Titular">';
            echo '<h2>Inicia Sesión para Reservar!</h2>';
            echo '</div>';
            }
            else{

                echo '<div class="Titular">';
                    echo '<h2>¿A dónde te vamos a llevar?</h2>';
                echo '</div>';
        
                echo'<form id="formularioBusqueda" action="" class="formulario-busqueda"> ';
                echo'<div class="grupo-formulario">';
                echo'<label for="origen">Origen</label>';
                echo'<select id="origen" name="origen" required>';
                echo'<option value="">Desde donde viajas</option>';
                foreach ($data as $key => $value) {         
                    foreach ($value as $terminal) {               
                        echo '<option value="'.$terminal["IdTerminal"].'">'.$terminal["Nombre"].'</option>';
                    }           
                }
                echo'</select>';
                echo' </div>';

                echo'<div class="grupo-formulario">';
                echo'<label for="destino">Destino</label>';
                echo'<select id="destino" name="destino" required>';
                echo'<option value="">Hacia donde viajas</option>';
                foreach ($data as $key => $value) {         
                    foreach ($value as $terminal) {               
                        echo '<option value="'.$terminal["IdTerminal"].'">'.$terminal["Nombre"].'</option>';
                    }           
                }
                echo'</select>';
                echo'</div>';
                echo'<div class="divisor"></div>';

                echo'<div class="grupo-formulario">';
                echo'<label for="fecha">Fecha</label>';
                echo'<input type="date" id="fecha" name="fecha" required>';
                echo'</div>';
                echo'<br>';
                echo'<input type="submit" class="btn btn-success" value="Buscar viaje">';
                echo'<input type="hidden" name="i" value="MandarViajes">';
                echo'</form>';  

                }
            }
            else{
            echo '<div class="Titular">';
            echo '<h2>Inicia Sesión para Reservar!</h2>';
            echo '</div>';       
            }
        ?>
</main>

<!--Espacio para el Footer, no tocar-->
<?php require("layout/footer.php"); ?>