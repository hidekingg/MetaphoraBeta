<?php require("view/layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>
    <form id="asientosForm" action="">
        <?php if (!empty($data) && is_array($data)): 
            usort($data, function($a, $b) {
                return strcmp($a['Columna'], $b['Columna']) ?: ($a['NumeroAsiento'] - $b['NumeroAsiento']);
            });
            
        ?>
            
            <div class="card card-body" style="width: 90%; margin-left: auto; margin-right: auto;">

                <h5 class="mb-3">Selecciona tus asientos</h5>
                
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <span class="badge bg-success me-2">Disponible</span>
                        <span class="badge bg-danger me-2">Ocupado</span>
                        <span class="badge bg-primary">Seleccionado</span>
                    </div>
                    <div>
                        <span class="fw-bold">Asientos seleccionados: <span id="contador-asientos">0</span></span>
                    </div>
                </div>

            <div class="bus-seats">

                <div class="seat-column mt-auto">
                <button class="btn btn-sm btn-secondary seat" disabled>ꔮ</button>
                </div>

            <?php
                $currentColumna = '';
                $seatCounter = 0;
                
                foreach ($data as $Asiento) {
                    // Cambio de columna (letra)
                    if ($Asiento['Columna'] != $currentColumna) {
                        // Cerrar la columna anterior si existe
                        if ($currentColumna != '') {
                            echo '</div>';
                        }
                        
                        // Iniciar nueva columna
                        echo '<div class="seat-column mt-auto">';
                        $currentColumna = $Asiento['Columna'];
                        $seatCounter = 0;
                    }
                    
                    // Determinar clase del botón según estado
                    $expectedSeatNumber = $seatCounter < 2 ? $seatCounter + 1 : $seatCounter;
                    if ($Asiento['NumeroAsiento'] != $expectedSeatNumber && $seatCounter < 4) {
                        // Aquí podrías registrar un error o ajustar el contador
                        $seatCounter = $Asiento['NumeroAsiento'] - 1;
                    }

                    $btnClass = '';
                    $disabled = '';
                    $dataAttributes = 'data-id="'.$Asiento['IdAsiento'].'"';
                    
                    switch ($Asiento['IdEstadoAsiento']) {
                        case 1: // Disponible
                            $btnClass = 'btn-success seat-available';
                            $disabled = '';
                            break;
                        case 2: // Ocupado
                            $btnClass = 'btn-danger';
                            $disabled = 'disabled';
                            break;
                        case 3: // Inhabilitado o pasillo
                            $btnClass = 'btn-secondary';
                            $disabled = 'disabled';
                            break;
                        default:
                            $btnClass = 'btn-secondary';
                            $disabled = 'disabled';
                    }
                    
                    // Agregar separación de pasillo cada 2 asientos
                    if ($seatCounter == 2) {
                        echo '<div class="aisle">Pasillo</div>';
                    }
                    
                    // Generar el botón del asiento
                    echo '<button type="button" class="btn btn-sm '.$btnClass.' seat" '.$dataAttributes.' '.$disabled.'>'.$Asiento['NumeroAsiento'].''.$Asiento['Columna'].'</button>';

                    $seatCounter++;

                    if ($seatCounter >= 4) {
                        echo '</div>';
                        $currentColumna = ''; // Forzar nueva columna en próximo asiento
                    }
                }
                
                // Cerrar la última columna
                if ($currentColumna != '') {
                    echo '</div>';
                }
            ?>
            </div>
            
            <!-- Botón de confirmación -->
            <div class="text-end mt-3">
                <button type="submit" id="confirmarAsientos" class="btn btn-primary" disabled>Confirmar asientos</button>
                <input type="hidden" name="i" value="ProcesarAsientos">
            </div>
            </div>
        <?php else: ?>
            <div class="Titular">
                <h2>No se encontraron asientos para el viaje seleccionado.</h2>
            </div>
        <?php endif; ?>
    </form>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('asientosForm');
    const confirmBtn = document.getElementById('confirmarAsientos');
    const contadorAsientos = document.getElementById('contador-asientos');
    let selectedSeats = [];
    
    // Manejar clic en asientos disponibles
    document.querySelectorAll('.seat-available').forEach(seat => {
        seat.addEventListener('click', function() {
            const seatId = this.getAttribute('data-id');
            
            if (this.classList.contains('btn-primary')) {
                // Deseleccionar
                this.classList.remove('btn-primary');
                this.classList.add('btn-success');
                selectedSeats = selectedSeats.filter(id => id !== seatId);
            } else {
                // Seleccionar
                this.classList.remove('btn-success');
                this.classList.add('btn-primary');
                selectedSeats.push(seatId);
            }
            
            // Actualizar contador
            contadorAsientos.textContent = selectedSeats.length;
            
            // Habilitar/deshabilitar botón de confirmar
            confirmBtn.disabled = selectedSeats.length === 0;
        });
    });
    
    // Manejar envío del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (selectedSeats.length === 0) {
            alert('Por favor selecciona al menos un asiento');
            return;
        }
        
        // Eliminar inputs hidden previos si existen
        document.querySelectorAll('input[name="asientos[]"]').forEach(input => input.remove());
        
        // Crear inputs hidden para cada asiento seleccionado
        selectedSeats.forEach(seatId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'asientos[]';
            input.value = seatId;
            form.appendChild(input);
        });
        
        // Agregar IdViaje si no existe
        if (!document.querySelector('input[name="IdViaje"]')) {
            const viajeInput = document.createElement('input');
            viajeInput.type = 'hidden';
            viajeInput.name = 'IdViaje';
            viajeInput.value = '<?= isset($_GET['IdViaje']) ? $_GET['IdViaje'] : '' ?>';
            form.appendChild(viajeInput);
        }
        
        // Enviar formulario
        this.submit();
    });
});
</script>


<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>