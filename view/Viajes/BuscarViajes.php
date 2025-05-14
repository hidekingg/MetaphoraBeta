<?php require("view/layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->
<main>

<?php
/*echo "<pre>";
print_r($data);
echo "</pre>";*/
?>
<center>
<?php if (!empty($data) && is_array($data)): ?>
    <?php
        foreach ($data as $Viajes) {
            echo '<form action="" class="card mb-3" style="width: 80%;">';
            echo '<div class="row g-0">';
            echo '<div class="col-md-4">';
            echo '<img src="'.$Viajes['LogoClase'].'" width="80%" class="d-flex align-items-center">';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title" style="text-align: left;">'.$Viajes['FechaSalida'].'</h5>';
            echo '<h6 class="card-title" style="text-align: left;">$'.$Viajes['Precio'].'</h6>';
            echo '<p class="card-text" style="text-align: left;">Origen: '.$Viajes['TerminalOrigen'].'<br>Destino: '.$Viajes['TerminalDestino'].'</p>';
            echo '<p class="card-text" style="text-align: left;"><small class="text-body-secondary">Hora de Salida: '.$Viajes['HoraSalida'].' - Hora de Llegada: '.$Viajes['HoraLlegada'].'</small></p>';
            
            // Campo oculto con el ID del viaje
            echo '<input type="hidden" id="IdViaje" name="IdViaje" value="'.$Viajes['IdViaje'].'">';
            
            // Centrar el botón
            echo '<div class="row g-0">'; // Clase para centrar
            echo '<input type="submit" class="btn btn-success" value="Seleccionar">';
            echo '<input type="hidden" name="i" value="ViajeSeleccionado">';
            echo '</div>'; // Cierre del div de centrado
            echo '</div>'; // Cierre del card-body
            echo '</div>'; // Cierre del col-md-8
            echo '</div>'; // Cierre del row
            echo '</form>'; // Cierre del formulario
        }
    ?>
<?php else: ?>
    <div class="Titular">
        <h2>No se encontraron viajes para los criterios seleccionados.</h2>
    </div>
    
<?php endif; ?>
</center>
</main>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>