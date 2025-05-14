<?php require("view/layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<div class="table-responsive">
    <table class="table table-borderless custom-no-bg" width="100%">
        <tbody>
            <tr>
                <td colspan="2">
                    <nav class="navbar navbar-expand">
                    <div class="contenedor">
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php?p=MiPerfil">Mi perfil</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="index.php?p=MisViajes">Mis viajes</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="index.php?p=MiConfiguracion">Configuración</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                    </nav>
                </td>
            </tr>
            <tr>
                <td style="width: 35%" valign="top">
                    <?php
                        echo'<div class="perfiles">';
                        echo'<div class = "Titular">';
                        echo'<h2><b>Bienvenido:</b><br>'.$_SESSION['Username'].'</h2>';
                        echo'<center>';
                        echo'<img src="'.$_SESSION['FotoPerfil'].'" alt="Perfil" class="profile-img" style="width: 40%; border-radius: 50%; outline: 8px solid #2b824b;">';
                        echo'</center>';
                        echo'</div>';
                        echo'</div>';
                    ?>
                </td>
                <td style="width: 65%" valign="top">
                    <div class="Titular">
                    <div class="perfiles2">
                        <h2 style="text-align: left;">Mis Viajes</h2>
                    </div>
                    </div>

                    <div class="perfiles2">
                    <?php if (!empty($viajesdata) && is_array($viajesdata)): ?>
                    <?php
                        foreach ($viajesdata as $Viajes) {
                            echo '<form action="" class="card mb-3" style="width: 80%;">';
                            echo '<div class="row g-0">';
                            echo '<div class="col-md-4">';
                            echo '<img src="view/img/Boletos/Boletos.png" width="80%" class="d-flex align-items-center ms-4">';
                            echo '</div>';
                            echo '<div class="col-md-8">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title" style="text-align: left;">'.$Viajes['Nombre'].' '.$Viajes['Apellidos'].'</h5>';
                            echo '<h5 class="card-title" style="text-align: left;">'.$Viajes['NumeroAsiento'].''.$Viajes['Columna'].'</h5>';
                            echo '<h6 class="card-title" style="text-align: left;">Fecha de salida: '.$Viajes['FechaSalida'].'</h6>';
                            echo '<h6 class="card-title" style="text-align: left;">Hora de salida: '.$Viajes['HoraSalida'].'</h6>';
                            echo '<p class="card-text" style="text-align: left;">Origen: '.$Viajes['TerminalOrigen'].'<br>Destino: '.$Viajes['TerminalDestino'].'</p>';
                            
                            // Campo oculto con el ID del viaje
                            echo '<input type="hidden" id="IdBoleto" name="IdBoleto" value="'.$Viajes['IdBoleto'].'">';
                            
                            // Centrar el botón
                            echo '<div class="row g-0">'; // Clase para centrar
                            echo '<input type="submit" class="btn btn-success" value="Generar boleto">';
                            echo '<input type="hidden" name="p" value="GenerarBoletosPDF">';
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
                    </div>

                </td>
            </tr>
        </tbody>
    </table>
</div>
</main>


<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>