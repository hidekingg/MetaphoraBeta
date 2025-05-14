<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDAutobuses.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Autobuses</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Autobús' : 'Agregar Nuevo Autobús' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="autobusForm">
                <input type="hidden" name="IdAutobus" id="IdAutobus" value="">
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="IdClase" class="form-label">Clase</label>
                        <select class="form-select" id="IdClase" name="IdClase" required>
                            <option value="">Seleccionar clase</option>
                            <?php foreach ($clases as $clase): ?>
                            <option value="<?= $clase['IdClase'] ?>">
                                <?= htmlspecialchars($clase['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="IdEmpleado" class="form-label">Empleado</label>
                        <select class="form-select" id="IdEmpleado" name="IdEmpleado" required>
                            <option value="">Seleccionar empleado</option>
                            <?php foreach ($empleados as $empleado): ?>
                            <option value="<?= $empleado['IdEmpleado'] ?>">
                                <?= htmlspecialchars($empleado['Nombre'] . ' ' . $empleado['Paterno'] . ' ' . $empleado['Materno']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="Capacidad" class="form-label">Capacidad</label>
                        <input type="number" class="form-control" id="Capacidad" name="Capacidad" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="Modelo" name="Modelo" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="Año" class="form-label">Año</label>
                        <input type="number" class="form-control" id="Año" name="Año" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="Placas" class="form-label">Placas</label>
                        <input type="text" class="form-control" id="Placas" name="Placas" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                    <a href="?a=CRUDAutobuses" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de autobuses -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Autobuses</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Clase</th>
                            <th>Nombre</th>
                            <th>Empleado</th>
                            <th>Capacidad</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Placas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($autobuses as $autobus): ?>
                        <tr>
                            <td><?= $autobus['IdAutobus'] ?></td>
                            <td><?= htmlspecialchars($autobus['NombreClase']) ?></td>
                            <td><?= htmlspecialchars($autobus['Nombre']) ?></td>
                            <td><?= htmlspecialchars($autobus['NombreEmpleado'] ?? 'N/A') ?></td>
                            <td><?= $autobus['Capacidad'] ?></td>
                            <td><?= htmlspecialchars($autobus['Modelo']) ?></td>
                            <td><?= $autobus['Año'] ?></td>
                            <td><?= htmlspecialchars($autobus['Placas']) ?></td>
                            <td>
                                <a href="?a=CRUDAutobuses&edit=<?= $autobus['IdAutobus'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $autobus['IdAutobus'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDAutobuses&delete=<?= $autobus['IdAutobus'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar este autobús?')">
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
                        <a class="page-link" href="?a=CRUDAutobuses&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDAutobuses&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDAutobuses&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getAutobusById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdAutobus').value = data.IdAutobus;
            document.getElementById('IdClase').value = data.IdClase;
            document.getElementById('Nombre').value = data.Nombre;
            document.getElementById('IdEmpleado').value = data.IdEmpleado;
            document.getElementById('Capacidad').value = data.Capacidad;
            document.getElementById('Modelo').value = data.Modelo;
            document.getElementById('Año').value = data.Año;
            document.getElementById('Placas').value = data.Placas;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDAutobuses"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('autobusForm').reset();
            document.getElementById('IdAutobus').value = '';
            window.location.href = '?a=CRUDAutobuses';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>