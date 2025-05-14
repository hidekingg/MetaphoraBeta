<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDClase.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Clases</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Clase' : 'Agregar Nueva Clase' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="claseForm" enctype="multipart/form-data">
                <input type="hidden" name="IdClase" id="IdClase" value="">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="LogoClase" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="LogoClase" name="LogoClase" accept=".jpg,.jpeg,.png,.webp" <?= !isset($_GET['edit']) ? 'required' : '' ?>>
                        <small class="text-muted">Formatos permitidos: JPG, JPEG, PNG, WEBP</small>
                        <?php if (isset($_GET['edit'])): ?>
                        <div class="mt-2">
                            <small>Imagen actual:</small>
                            <div id="currentImageContainer" class="mt-1">
                                <!-- Se llenará con JavaScript -->
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                    <a href="?a=CRUDClase" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de clases -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Clases</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Logo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clases as $clase): ?>
                        <tr>
                            <td><?= $clase['IdClase'] ?></td>
                            <td><?= htmlspecialchars(isset($clase['Nombre']) ? $clase['Nombre'] : '') ?></td>
                            <td>
                                <?php if(!empty($clase['LogoClase'])): ?>
                                <img src="<?= htmlspecialchars(isset($clase['LogoClase']) ? $clase['LogoClase'] : '') ?>" alt="Logo <?= htmlspecialchars(isset($clase['Nombre']) ? $clase['Nombre'] : '') ?>" style="max-width: 100px; max-height: 50px;">
                                <?php else: ?>
                                Sin imagen
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?a=CRUDClase&edit=<?= $clase['IdClase'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $clase['IdClase'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDClase&delete=<?= $clase['IdClase'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar esta clase?')">
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
                        <a class="page-link" href="?a=CRUDClase&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDClase&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDClase&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getClaseById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdClase').value = data.IdClase;
            document.getElementById('Nombre').value = data.Nombre;
            
            // Mostrar imagen actual si existe
            if(data.LogoClase) {
                const container = document.getElementById('currentImageContainer');
                container.innerHTML = `
                    <img src="${data.LogoClase}" alt="Logo actual" style="max-width: 100px; max-height: 50px;">
                    <div class="form-text">Dejar en blanco para mantener la imagen actual</div>
                `;
            }
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDClase"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('claseForm').reset();
            document.getElementById('IdClase').value = '';
            window.location.href = '?a=CRUDClase';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>