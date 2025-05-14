<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDAsientos.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Asientos</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Asiento' : 'Agregar Nuevo Asiento' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="asientoForm">
                <input type="hidden" name="IdAsiento" id="IdAsiento" value="">
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="IdAutobus" class="form-label">Autobús</label>
                        <select class="form-select" id="IdAutobus" name="IdAutobus" required>
                            <option value="">Seleccionar autobús</option>
                            <?php foreach ($autobuses as $autobus): ?>
                            <option value="<?= $autobus['IdAutobus'] ?>">
                                <?= htmlspecialchars($autobus['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2 mb-3">
                        <label for="NumeroAsiento" class="form-label">Número de Asiento</label>
                        <input type="number" class="form-control" id="NumeroAsiento" name="NumeroAsiento" required>
                    </div>
                    
                    <div class="col-md-2 mb-3">
                        <label for="Columna" class="form-label">Columna</label>
                        <input type="text" class="form-control" id="Columna" name="Columna" maxlength="1" required>
                    </div>
                    
                    <div class="col-md-2 mb-3">
                        <label for="IdTipoAsiento" class="form-label">Tipo de Asiento</label>
                        <select class="form-select" id="IdTipoAsiento" name="IdTipoAsiento" required>
                            <option value="">Seleccionar tipo</option>
                            <?php foreach ($tiposAsiento as $tipo): ?>
                            <option value="<?= $tipo['IdTipoAsiento'] ?>">
                                <?= htmlspecialchars($tipo['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-2 mb-3">
                        <label for="IdEstadoAsiento" class="form-label">Estado</label>
                        <select class="form-select" id="IdEstadoAsiento" name="IdEstadoAsiento" required>
                            <option value="">Seleccionar estado</option>
                            <?php foreach ($estadosAsiento as $estado): ?>
                            <option value="<?= $estado['IdEstadoAsiento'] ?>">
                                <?= htmlspecialchars($estado['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                    <a href="?a=CRUDAsientos" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de asientos -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Asientos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Autobús</th>
                            <th>Número</th>
                            <th>Columna</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asientos as $asiento): ?>
                        <tr>
                            <td><?= $asiento['IdAsiento'] ?></td>
                            <td><?= htmlspecialchars($asiento['NombreAutobus']) ?></td>
                            <td><?= $asiento['NumeroAsiento'] ?></td>
                            <td><?= $asiento['Columna'] ?></td>
                            <td><?= htmlspecialchars($asiento['TipoAsiento']) ?></td>
                            <td><?= htmlspecialchars($asiento['EstadoAsiento']) ?></td>
                            <td>
                                <a href="?a=CRUDAsientos&edit=<?= $asiento['IdAsiento'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $asiento['IdAsiento'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDAsientos&delete=<?= $asiento['IdAsiento'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar este asiento?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDAsientos&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDAsientos&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDAsientos&page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

</main>

<script>
// Cargar datos para edición
document.addEventListener('DOMContentLoaded', function() {
    <?php if (isset($_GET['edit'])): ?>
    fetch('?a=getAsientoById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdAsiento').value = data.IdAsiento;
            document.getElementById('IdAutobus').value = data.IdAutobus;
            document.getElementById('NumeroAsiento').value = data.NumeroAsiento;
            document.getElementById('Columna').value = data.Columna;
            document.getElementById('IdTipoAsiento').value = data.IdTipoAsiento;
            document.getElementById('IdEstadoAsiento').value = data.IdEstadoAsiento;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDAsientos"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('asientoForm').reset();
            document.getElementById('IdAsiento').value = '';
            window.location.href = '?a=CRUDAsientos';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>