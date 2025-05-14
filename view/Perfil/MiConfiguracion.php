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
                        <h2 style="text-align: left;"><b>CONFIGURACIÓN</b><br>Cambiar datos de usuario</h2>
                    </div>
                    </div>
                    <div class="perfiles2">
                    <!--FotoPerfil, Nombre, Paterno, Materno, Edad, Sexo, Pais, Estado, Municipio, Direccion, CP, Telefono.-->
                    <div class="container py-5">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data" action="index.php?p=ActualizarDatosUsuarios">
                                            <!-- Foto de Perfil -->
                                            <div class="mb-4 text-center">
                                                <label for="fotoPerfil" class="form-label required-field">Foto de Perfil</label>
                                                <?php if (!empty($usuarioData['FotoPerfil'] ?? '')): ?>
                                                    <img src="<?php echo htmlspecialchars($usuarioData['FotoPerfil'] ?? ''); ?>" 
                                                        alt="Foto de perfil" class="img-thumbnail mb-3" style="width: 150px; height: 150px;">
                                                <?php endif; ?>
                                                <input type="file" class="form-control" name="fotoPerfil" id="fotoPerfil" accept=".jpg,.jpeg,.png,.webp">
                                                <div class="form-text">Selecciona una imagen cuadrada para mejor resultado.<br>(No mayor a 2MB, y a 1030 * 1030)</div>
                                            </div>

                                            <!-- Nombre y Apellidos -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="nombre" class="form-label required-field">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                                        value="<?php echo htmlspecialchars($usuarioData['Nombre'] ?? ''); ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="apellidoPaterno" class="form-label required-field">Apellido Paterno</label>
                                                    <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno"
                                                        value="<?php echo htmlspecialchars($usuarioData['Paterno'] ?? ''); ?>" required>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                                                    <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno"
                                                        value="<?php echo htmlspecialchars($usuarioData['Materno'] ?? ''); ?>">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="edad" class="form-label required-field">Edad</label>
                                                    <input type="number" class="form-control" id="edad" min="1" max="120" name="edad"
                                                        value="<?php echo htmlspecialchars($usuarioData['Edad'] ?? ''); ?>" required>
                                                </div>
                                            </div>

                                            <!-- Sexo -->
                                            <div class="mb-3">
                                                <label class="form-label required-field">Sexo</label>
                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M" 
                                                            <?php echo (($usuarioData['Sexo'] ?? '') == 'M') ? 'checked' : ''; ?> required>
                                                        <label class="form-check-label" for="masculino">Masculino</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="sexo" id="femenino" value="F"
                                                            <?php echo (($usuarioData['Sexo'] ?? '') == 'F') ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="femenino">Femenino</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="sexo" id="otro" value="O"
                                                            <?php echo (($usuarioData['Sexo'] ?? '') == 'O') ? 'checked' : ''; ?>>
                                                        <label class="form-check-label" for="otro">Otro</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Ubicación -->
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="pais" class="form-label required-field">País</label>
                                                    <select class="form-select" id="pais" name="pais" required>
                                                        <option value="">Selecciona un país</option>
                                                        <?php foreach ($dataPaises as $pais): ?>
                                                            <option value="<?= $pais['IdPais'] ?>" 
                                                                <?= ($usuarioData['IdPais'] == $pais['IdPais']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($pais['Nombre']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="estado" class="form-label required-field">Estado</label>
                                                    <select class="form-select" id="estado" name="estado" required>
                                                        <option value="">Selecciona un estado</option>
                                                        <?php foreach ($dataEstados as $estado): ?>
                                                            <option value="<?= $estado['IdEstado'] ?>" 
                                                                data-idpais="<?= $estado['IdPais'] ?>"
                                                                <?= ($usuarioData['IdEstado'] == $estado['IdEstado']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($estado['Nombre']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="municipio" class="form-label required-field">Municipio</label>
                                                    <select class="form-select" id="municipio" name="municipio" required>
                                                        <option value="">Selecciona un municipio</option>
                                                        <?php foreach ($dataMunicipios as $municipio): ?>
                                                            <option value="<?= $municipio['IdMunicipio'] ?>" 
                                                                data-idestado="<?= $municipio['IdEstado'] ?>"
                                                                <?= ($usuarioData['IdMunicipio'] == $municipio['IdMunicipio']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($municipio['Nombre']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                </div>
                                            </div>

                                            <!-- Dirección -->
                                            <div class="mb-3">
                                                <label for="direccion" class="form-label required-field">Dirección</label>
                                                <textarea class="form-control" id="direccion" name="direccion" rows="2" required><?php 
                                                    echo htmlspecialchars($usuarioData['Direccion'] ?? ''); 
                                                ?></textarea>
                                            </div>

                                            <!-- Código Postal y Teléfono -->
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="cp" class="form-label required-field">Código Postal</label>
                                                    <input type="text" class="form-control" id="cp" name="cp" pattern="[0-9]{5}" 
                                                        value="<?php echo htmlspecialchars($usuarioData['CP'] ?? ''); ?>" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="telefono" class="form-label required-field">Teléfono</label>
                                                    <input type="tel" class="form-control" id="telefono" name="telefono"
                                                        value="<?php echo htmlspecialchars($usuarioData['Telefono'] ?? ''); ?>" required>
                                                </div>
                                            </div>

                                            <!-- Botones -->
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                                <button type="reset" class="btn btn-outline-secondary me-md-2">Limpiar</button>
                                                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>

                </td>
            </tr>
        </tbody>
    </table>
</div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paisSelect = document.getElementById('pais');
    const estadoSelect = document.getElementById('estado');
    const municipioSelect = document.getElementById('municipio');

    function filtrarEstados() {
        const paisSeleccionado = paisSelect.value;
        [...estadoSelect.options].forEach(option => {
            if (option.value === '') return;
            option.hidden = option.dataset.idpais !== paisSeleccionado;
        });

        // Limpiar selección si el actual ya no corresponde
        if (estadoSelect.selectedOptions[0]?.hidden) {
            estadoSelect.value = '';
        }

        filtrarMunicipios(); // también actualizar municipios
    }

    function filtrarMunicipios() {
        const estadoSeleccionado = estadoSelect.value;
        [...municipioSelect.options].forEach(option => {
            if (option.value === '') return;
            option.hidden = option.dataset.idestado !== estadoSeleccionado;
        });

        if (municipioSelect.selectedOptions[0]?.hidden) {
            municipioSelect.value = '';
        }
    }

    paisSelect.addEventListener('change', filtrarEstados);
    estadoSelect.addEventListener('change', filtrarMunicipios);

    // Llamar al cargar para aplicar filtro inicial
    filtrarEstados();
    filtrarMunicipios();
});
</script>



<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>