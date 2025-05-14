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
        <h2>Administración de Municipios</h2>
        <center><hr width="30%"></center>
    </div>

    <?php if (isset($message)): ?>
        <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Municipio' : 'Agregar Nuevo Municipio' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="municipioForm">
                <input type="hidden" name="IdMunicipio" id="IdMunicipio" value="">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="Nombre" class="form-label">Nombre del Municipio</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="IdEstado" class="form-label">Estado</label>
                        <select class="form-select" id="IdEstado" name="IdEstado" required>
                            <option value="">Seleccionar estado</option>
                            <?php foreach ($estados as $estado): ?>
                                <option value="<?= $estado['IdEstado'] ?>"><?= htmlspecialchars($estado['Nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <?= isset($_GET['edit']) ? 'Actualizar' : 'Guardar' ?>
                    </button>
                    <?php if (isset($_GET['edit'])): ?>
                        <a href="?a=CRUDMunicipio" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Municipios</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($municipios as $m): ?>
                        <tr>
                            <td><?= $m['IdMunicipio'] ?></td>
                            <td><?= htmlspecialchars($m['Nombre']) ?></td>
                            <td><?= htmlspecialchars($m['NombreEstado']) ?></td>
                            <td>
                                <a href="?a=CRUDMunicipio&edit=<?= $m['IdMunicipio'] ?>" 
                                   class="btn btn-sm btn-warning">
                                   <i class="bi bi-pencil"></i> Editar</a>
                                <a href="?a=CRUDMunicipio&delete=<?= $m['IdMunicipio'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('¿Estás seguro de eliminar este municipio?')">
                                   <i class="bi bi-trash"></i> Eliminar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link" href="?a=CRUDMunicipio&page=<?= $page - 1 ?>">&laquo;</a></li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item"><a class="page-link" href="?a=CRUDMunicipio&page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item"><a class="page-link" href="?a=CRUDMunicipio&page=<?= $page + 1 ?>">&raquo;</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (isset($_GET['edit'])): ?>
        fetch('?a=getMunicipioById&id=<?= $_GET['edit'] ?>')
            .then(response => response.json())
            .then(data => {
                document.getElementById('IdMunicipio').value = data.IdMunicipio;
                document.getElementById('Nombre').value = data.Nombre;
                document.getElementById('IdEstado').value = data.IdEstado;
            });
    <?php endif; ?>
});
</script>

<?php require("view/layout/adminfooter.php"); ?>
