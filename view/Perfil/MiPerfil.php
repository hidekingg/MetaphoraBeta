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
                    <h2 style="text-align: left;">Informacion personal</h2>
                </div>
                </div>

                <?php
                if (isset($data[0][0])) {
                    $usuario = $data[0][0];
                    echo '<div class="perfiles2">';
                    echo '<p><b>Nombre: </b>'.$usuario["Nombre"].'</p>';
                    echo '<p><b>Apellido paterno: </b>'.$usuario["Paterno"].'</p>';
                    echo '<p><b>Apellido materno: </b>'.$usuario["Materno"].'</p>';
                    echo '<p><b>Edad: </b>'.$usuario["Edad"].'</p>';
                    echo '<p><b>Sexo: </b>'.$usuario["Sexo"].'</p>';
                    echo '<p><b>Direccion: </b>'.$usuario["Direccion"].'</p>';
                    echo '<p><b>CP: </b>'.$usuario["CP"].'</p>';
                    echo '<p><b>Telefono: </b>'.$usuario["Telefono"].'</p>';
                    echo '</div>';
                } else {
                    echo '<p>No hay datos disponibles</p>';
                }
                ?>
            </td>
		</tr>
	</tbody>
</table>
</div>
   
</main>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>