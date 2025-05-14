<?php require("view/layout/adminheader.php"); ?>
<main>

<?php 
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>

<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Estados de Asientos</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Estado' : 'Agregar Nuevo Estado' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="estadoForm">
                <input type="hidden" name="IdEstadoAsiento" id="IdEstadoAsiento" value="">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Nombre" class="form-label">Nombre del Estado</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                    <a href="?a=CRUDEstAsientos" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h4>Lista de Estados de Asientos</h4>
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
                        <?php foreach ($estadosAsiento as $estado): ?>
                        <tr>
                            <td><?= $estado['IdEstadoAsiento'] ?></td>
                            <td><?= htmlspecialchars($estado['Nombre']) ?></td>
                            <td>
                                <a href="?a=CRUDEstAsientos&edit=<?= $estado['IdEstadoAsiento'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $estado['IdEstadoAsiento'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDEstAsientos&delete=<?= $estado['IdEstadoAsiento'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar este estado?')">
                                    <i class="bi bi-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDEstAsientos&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDEstAsientos&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    < li class="page-item">
                        <a class="page-link" href="?a=CRUDEstAsientos&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getEstadoAsientoById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdEstadoAsiento').value = data.IdEstadoAsiento;
            document.getElementById('Nombre').value = data.Nombre;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDEstAsientos"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('estadoForm').reset();
            document.getElementById('IdEstadoAsiento').value = '';
            window.location.href = '?a=CRUDEstAsientos';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>
