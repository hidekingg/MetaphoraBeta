<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDOperaciones.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Operaciones</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Operación' : 'Agregar Nueva Operación' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="operacionForm">
                <input type="hidden" name="IdOperacion" id="IdOperacion" value="">
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="Nombre" class="form-label">Nombre de la Operación</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                    <a href="?a=CRUDOperaciones" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de operaciones -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Operaciones</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($operaciones as $operacion): ?>
                        <tr>
                            <td><?= $operacion['IdOperacion'] ?></td>
                            <td><?= htmlspecialchars($operacion['Nombre']) ?></td>
                            <td>
                                <a href="?a=CRUDOperaciones&edit=<?= $operacion['IdOperacion'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $operacion['IdOperacion'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDOperaciones&delete=<?= $operacion['IdOperacion'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta operación?')">
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
                        <a class="page-link" href="?a=CRUDOperaciones&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDOperaciones&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDOperaciones&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getOperacionById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdOperacion').value = data.IdOperacion;
            document.getElementById('Nombre').value = data.Nombre;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDOperaciones"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('operacionForm').reset();
            document.getElementById('IdOperacion').value = '';
            window.location.href = '?a=CRUDOperaciones';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>