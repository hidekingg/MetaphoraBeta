<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDBoletos.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Boletos</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Boleto' : 'Agregar Nuevo Boleto' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="boletoForm">
                <input type="hidden" name="IdBoleto" id="IdBoleto" value="">
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="IdEstatusBoleto" class="form-label">Estatus</label>
                        <select class="form-select" id="IdEstatusBoleto" name="IdEstatusBoleto" required>
                            <option value="">Seleccionar estatus</option>
                            <?php foreach ($estatusBoletos as $estatus): ?>
                            <option value="<?= $estatus['IdEstatusBoleto'] ?>">
                                <?= htmlspecialchars($estatus['Nombre']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="IdUsuario" class="form-label">Usuario</label>
                        <select class="form-select" id="IdUsuario" name="IdUsuario" required>
                            <option value="">Seleccionar usuario</option>
                            <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['IdUsuario'] ?>">
                                <?= htmlspecialchars($usuario['NombreCompleto']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="Nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="Apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="Apellidos" name="Apellidos" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="IdPromocion" class="form-label">Promoción</label>
                        <select class="form-select" id="IdPromocion" name="IdPromocion">
                            <option value="">Sin promoción</option>
                            <?php foreach ($promociones as $promocion): ?>
                            <option value="<?= $promocion['IdPromocion'] ?>">
                                <?= htmlspecialchars($promocion['Condiciones']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="IdViaje" class="form-label">Viaje</label>
                        <select class="form-select" id="IdViaje" name="IdViaje" required>
                            <option value="">Seleccionar viaje</option>
                            <?php foreach ($viajes as $viaje): ?>
                            <option value="<?= $viaje['IdViaje'] ?>">
                                <?= htmlspecialchars($viaje['DescripcionViaje']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="IdAsiento" class="form-label">Asiento</label>
                        <select class="form-select" id="IdAsiento" name="IdAsiento" required>
                            <option value="">Seleccionar asiento</option>
                            <?php foreach ($asientos as $asiento): ?>
                            <option value="<?= $asiento['IdAsiento'] ?>">
                                <?= htmlspecialchars($asiento['DescripcionAsiento']) ?>
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
                    <a href="?a=CRUDBoletos" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de boletos -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Boletos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estatus</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Promoción</th>
                            <th>Viaje</th>
                            <th>Asiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($boletos as $boleto): ?>
                        <tr>
                            <td><?= $boleto['IdBoleto'] ?></td>
                            <td><?= htmlspecialchars($boleto['EstatusBoleto']) ?></td>
                            <td><?= htmlspecialchars($boleto['NombreUsuario'] . ' ' . $boleto['ApellidoUsuario']) ?></td>
                            <td><?= htmlspecialchars($boleto['Nombre']) ?></td>
                            <td><?= htmlspecialchars($boleto['Apellidos']) ?></td>
                            <td><?= $boleto['DescuentoPromocion'] ? htmlspecialchars($boleto['DescuentoPromocion']) : 'N/A' ?></td>
                            <td><?= htmlspecialchars($boleto['PrecioViaje']) ?></td>
                            <td><?= htmlspecialchars($boleto['NumeroAsiento'] . $boleto['ColumnaAsiento'] . ' (' . $boleto['NombreAutobus'] . ')') ?></td>
                            <td>
                                <a href="?a=CRUDBoletos&edit=<?= $boleto['IdBoleto'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $boleto['IdBoleto'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDBoletos&delete=<?= $boleto['IdBoleto'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar este boleto?')">
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
                        <a class="page-link" href="?a=CRUDBoletos&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDBoletos&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDBoletos&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getBoletoById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdBoleto').value = data.IdBoleto;
            document.getElementById('IdEstatusBoleto').value = data.IdEstatusBoleto;
            document.getElementById('IdUsuario').value = data.IdUsuario;
            document.getElementById('Nombre').value = data.Nombre;
            document.getElementById('Apellidos').value = data.Apellidos;
            document.getElementById('IdPromocion').value = data.IdPromocion || '';
            document.getElementById('IdViaje').value = data.IdViaje;
            document.getElementById('IdAsiento').value = data.IdAsiento;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDBoletos"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('boletoForm').reset();
            document.getElementById('IdBoleto').value = '';
            window.location.href = '?a=CRUDBoletos';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>