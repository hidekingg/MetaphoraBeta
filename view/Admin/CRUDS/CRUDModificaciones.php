<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDModificaciones.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Modificaciones</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Modificación' : 'Agregar Nueva Modificación' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="modificacionForm">
                <input type="hidden" name="IdModificaciones" id="IdModificaciones" value="">
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="TablaAfectada" class="form-label">Tabla Afectada</label>
                        <input type="text" class="form-control" id="TablaAfectada" name="TablaAfectada" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="IdOperacion" class="form-label">Operación</label>
                        <select class="form-select" id="IdOperacion" name="IdOperacion" required>
                            <option value="">Seleccionar operación</option>
                            <?php foreach ($operaciones as $operacion): ?>
                            <option value="<?= $operacion['IdOperacion'] ?>">
                                <?= htmlspecialchars($operacion['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="IdUsuario" class="form-label">Usuario</label>
                        <select class="form-select" id="IdUsuario" name="IdUsuario" required>
                            <option value="">Seleccionar usuario</option>
                            <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['IdUsuario'] ?>">
                                <?= htmlspecialchars($usuario['Username']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="Fecha_Hora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="Fecha_Hora" name="Fecha_Hora" required>
                    </div>
                    
                    <div class="col-md-8 mb-3">
                        <label for="Descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="Descripcion" name="Descripcion" rows="3" required></textarea>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                    <a href="?a=CRUDModificaciones" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de modificaciones -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Modificaciones</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tabla Afectada</th>
                            <th>Operación</th>
                            <th>Usuario</th>
                            <th>Fecha/Hora</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($modificaciones as $modificacion): ?>
                        <tr>
                            <td><?= $modificacion['IdModificaciones'] ?></td>
                            <td><?= htmlspecialchars($modificacion['TablaAfectada']) ?></td>
                            <td><?= htmlspecialchars($modificacion['NombreOperacion']) ?></td>
                            <td><?= htmlspecialchars($modificacion['NombreUsuario']) ?></td>
                            <td><?= $modificacion['Fecha_Hora'] ?></td>
                            <td><?= htmlspecialchars($modificacion['Descripcion']) ?></td>
                            <td>
                                <a href="?a=CRUDModificaciones&edit=<?= $modificacion['IdModificaciones'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $modificacion['IdModificaciones'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDModificaciones&delete=<?= $modificacion['IdModificaciones'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta modificación?')">
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
                        <a class="page-link" href="?a=CRUDModificaciones&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDModificaciones&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDModificaciones&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getModificacionById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdModificaciones').value = data.IdModificaciones;
            document.getElementById('TablaAfectada').value = data.TablaAfectada;
            document.getElementById('IdOperacion').value = data.IdOperacion;
            document.getElementById('IdUsuario').value = data.IdUsuario;
            document.getElementById('Fecha_Hora').value = data.Fecha_Hora.replace(' ', 'T');
            document.getElementById('Descripcion').value = data.Descripcion;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDModificaciones"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('modificacionForm').reset();
            document.getElementById('IdModificaciones').value = '';
            window.location.href = '?a=CRUDModificaciones';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>