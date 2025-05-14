<?php require("view/layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->
<main>
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Información del Viaje</h3>
        </div>
        <div class="card-body">
            <?php
            // Mostrar datos del viaje
            $idViaje = $_SESSION['id_viaje'] ?? 'No especificado';
            $asientosSeleccionados = $_SESSION['asientos_seleccionados'] ?? [];
            
            // Obtener el primer registro (asumiendo que solo hay uno)
            $viajeData = !empty($dataViaje) ? $dataViaje[0] : [];
            
            $terminalOrigen = $viajeData['TerminalOrigen'] ?? 'No especificado';
            $terminalDestino = $viajeData['TerminalDestino'] ?? 'No especificado';
            $fechaSalida = $viajeData['FechaSalida'] ?? 'No especificado';
            $horaSalida = $viajeData['HoraSalida'] ?? 'No especificado';
            ?>

            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Terminal de Origen:</strong> <?= htmlspecialchars($terminalOrigen) ?></p>
                    <p><strong>Terminal de Destino:</strong> <?= htmlspecialchars($terminalDestino) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha de Salida:</strong> <?= htmlspecialchars($fechaSalida) ?></p>
                    <p><strong>Hora de Salida:</strong> <?= htmlspecialchars($horaSalida) ?></p>
                </div>
            </div>


            <hr>

            <form action="">
            <input type="hidden" name="i" value="ConfirmarAsientos"> <!-- Método del controlador -->
            <input type="hidden" name="id_viaje" value="<?= htmlspecialchars($idViaje) ?>">
            
            <h4 class="mb-3">Información de los Pasajeros</h4>
            
            <?php foreach($asientosSeleccionados as $index => $asientoId): 
                $asientoData = $asientosMap[$asientoId] ?? null;
                $numeroAsiento = $asientoData['NumeroAsiento'] ?? 'N/A';
                $columnaAsiento = $asientoData['Columna'] ?? 'N/A';
            ?>
            <div class="passenger-form mb-4 p-3 border rounded">
                <h5>Pasajero <?= $index + 1 ?> - Asiento: <?= htmlspecialchars($numeroAsiento . $columnaAsiento) ?></h5>
                
                <input type="hidden" name="asientos[]" value="<?= htmlspecialchars($asientoId) ?>">
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombre_<?= $index ?>" class="form-label">Nombre(s)</label>
                        <input type="text" class="form-control" id="nombre_<?= $index ?>" 
                            name="nombres[]" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="apellidos_<?= $index ?>" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos_<?= $index ?>" 
                            name="apellidos[]" required>
                    </div>
                        
                        <div class="col-md-12">
                            <label class="form-label">Tipo de pasajero</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_pasajero[<?= $index ?>]" id="adulto_<?= $index ?>" value="Adulto" checked required>
                                <label class="form-check-label" for="adulto_<?= $index ?>">
                                    Adulto
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_pasajero[<?= $index ?>]" id="nino_<?= $index ?>" value="Niño(a) (menor a 12 años)" required>
                                <label class="form-check-label" for="nino_<?= $index ?>">
                                    Niño(a) (menor a 12 años)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_pasajero[<?= $index ?>]" id="inapam_<?= $index ?>" value="INAPAM" required>
                                <label class="form-check-label" for="inapam_<?= $index ?>">
                                    Adulto mayor con INAPAM
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Continuar con el pago</button>
                </div>
            </form>
        </div>
    </div>
</main>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>