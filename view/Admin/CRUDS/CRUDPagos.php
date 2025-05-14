<?php require("view/layout/adminheader.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

<?php 
// Al inicio de CRUDPagos.php, antes de mostrar el mensaje
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $result = isset($_GET['result']) && $_GET['result'] == '1';
}
?>


<div class="container mt-4">

    <div class="Titular">
        <h2>Administración de Pagos</h2>
        <center><hr width="30%"></center>
    </div>
    
    <?php if (isset($message)): ?>
    <div class="alert alert-<?= $result ? 'success' : 'danger' ?>"><?= $message ?></div>
    <?php endif; ?>
    
    <!-- Formulario para crear/editar -->
    <div class="card mb-4">
        <div class="card-header">
            <h4><?= isset($_GET['edit']) ? 'Editar Pago' : 'Agregar Nuevo Pago' ?></h4>
        </div>
        <div class="card-body">
            <form method="POST" id="pagoForm">
                <input type="hidden" name="IdPago" id="IdPago" value="">
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="IdBoleto" class="form-label">Boleto</label>
                        <select class="form-select" id="IdBoleto" name="IdBoleto" required>
                            <option value="">Seleccionar boleto</option>
                            <?php foreach ($boletos as $boleto): ?>
                            <option value="<?= $boleto['IdBoleto'] ?>">
                                <?= htmlspecialchars($boleto['DescripcionBoleto']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="FechaPago" class="form-label">Fecha de Pago</label>
                        <input type="date" class="form-control" id="FechaPago" name="FechaPago" required>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="Monto" class="form-label">Monto</label>
                        <input type="number" step="0.01" class="form-control" id="Monto" name="Monto" required>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="IdMetodoPago" class="form-label">Método de Pago</label>
                        <select class="form-select" id="IdMetodoPago" name="IdMetodoPago" required>
                            <option value="">Seleccionar método</option>
                            <?php foreach ($metodosPago as $metodo): ?>
                            <option value="<?= $metodo['IdMetodoPago'] ?>">
                                <?= htmlspecialchars($metodo['Nombre']) ?>
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
                    <a href="?a=CRUDPagos" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tabla de pagos -->
    <div class="card">
        <div class="card-header">
            <h4>Lista de Pagos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Boleto</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Método de Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagos as $pago): ?>
                        <tr>
                            <td><?= $pago['IdPago'] ?></td>
                            <td><?= $pago['BoletoId'] ?></td>
                            <td><?= htmlspecialchars($pago['NombreUsuario']) ?></td>
                            <td><?= $pago['FechaFormateada'] ?></td>
                            <td>$<?= number_format($pago['Monto'], 2) ?></td>
                            <td><?= htmlspecialchars($pago['MetodoPago']) ?></td>
                            <td>
                                <a href="?a=CRUDPagos&edit=<?= $pago['IdPago'] ?>" 
                                    class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?= $pago['IdPago'] ?>">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="?a=CRUDPagos&delete=<?= $pago['IdPago'] ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('¿Estás seguro de eliminar este pago?')">
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
                        <a class="page-link" href="?a=CRUDPagos&page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDPagos&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?a=CRUDPagos&page=<?= $page + 1 ?>" aria-label="Next">
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
    fetch('?a=getPagoById&id=<?= $_GET['edit'] ?>')
        .then(response => response.json())
        .then(data => {
            document.getElementById('IdPago').value = data.IdPago;
            document.getElementById('IdBoleto').value = data.IdBoleto;
            document.getElementById('FechaPago').value = data.FechaPago.split(' ')[0]; // Solo la fecha sin hora
            document.getElementById('Monto').value = data.Monto;
            document.getElementById('IdMetodoPago').value = data.IdMetodoPago;
        });
    <?php endif; ?>
    
    // Limpiar formulario al cancelar edición
    const cancelBtn = document.querySelector('a[href="?a=CRUDPagos"]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('pagoForm').reset();
            document.getElementById('IdPago').value = '';
            window.location.href = '?a=CRUDPagos';
        });
    }
});
</script>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/adminfooter.php"); ?>