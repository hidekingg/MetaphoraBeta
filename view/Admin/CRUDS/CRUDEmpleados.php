<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDEmpleados.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Empleados</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Empleado' : 'Agregar Nuevo Empleado' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="empleadoForm">
                <input type="hidden" name="IdEmpleado" id="IdEmpleado" value="">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="IdPuesto" class="form-label">Puesto</label>
                        <select class="form-select" id="IdPuesto" name="IdPuesto" required>
                            <option value="">Seleccionar puesto</option>
                            <?php foreach ($puestos as $puesto): ?>
                            <option value="<?= $puesto['IdPuesto'] ?>">
                                <?= htmlspecialchars($puesto['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="IdTerminal" class="form-label">Terminal</label>
                        <select class="form-select" id="IdTerminal" name="IdTerminal" required>
                            <option value="">Seleccionar terminal</option>
                            <?php foreach ($terminales as $terminal): ?>
                            <option value="<?= $terminal['IdTerminal'] ?>">
                                <?= htmlspecialchars($terminal['Nombre']) ?>
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
                    <a href="?a=CRUDEmpleados" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de empleados -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Empleados</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Puesto</th>
                            <th>Terminal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $empleado): ?>
                        <tr>
                            <td><?= $empleado['IdEmpleado'] ?></td>
                            <td><?= isset($empleado['NombrePuesto']) ? htmlspecialchars($empleado['NombrePuesto']) : 'Sin puesto' ?></td>
                            <td><?= isset($empleado['NombreTerminal']) ? htmlspecialchars($empleado['NombreTerminal']) : 'Sin terminal' ?></td>
                            <td>
                                <a href="?a=CRUDEmpleados&edit=<?= $empleado['IdEmpleado'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $empleado['IdEmpleado'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDEmpleados&delete=<?= $empleado['IdEmpleado'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
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
                        <a class="page-link" href="?a=CRUDEmpleados&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDEmpleados&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDEmpleados&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getEmpleadoById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdEmpleado').value = data.IdEmpleado;
            document.getElementById('IdPuesto').value = data.IdPuesto;
            document.getElementById('IdTerminal').value = data.IdTerminal;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDEmpleados"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('empleadoForm').reset();
            document.getElementById('IdEmpleado').value = '';
            window.location.href = '?a=CRUDEmpleados';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>