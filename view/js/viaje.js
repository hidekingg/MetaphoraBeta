document.addEventListener('DOMContentLoaded', function() {
    // =============================================
    // CONFIGURACIÓN INICIAL DE FECHA
    // =============================================
    const inputFecha = document.getElementById('fecha');
    const hoy = new Date();
    const dia = String(hoy.getDate()).padStart(2, '0');
    const mes = String(hoy.getMonth() + 1).padStart(2, '0');
    const año = hoy.getFullYear();
    const fechaMinima = año + '-' + mes + '-' + dia;
    inputFecha.setAttribute('min', fechaMinima);
    inputFecha.value = fechaMinima;
    
    // =============================================
    // CONTROL DEL DESPLEGABLE DE PASAJEROS
    // =============================================
    const disparadorPasajeros = document.getElementById('disparadorPasajeros');
    const desplegablePasajeros = document.getElementById('desplegablePasajeros');
    
    // Mostrar/ocultar desplegable al hacer clic
    disparadorPasajeros.addEventListener('click', function(e) {
        e.stopPropagation();
        desplegablePasajeros.classList.toggle('mostrar');
    });
    
    // Cerrar desplegable al hacer clic fuera
    document.addEventListener('click', function() {
        desplegablePasajeros.classList.remove('mostrar');
    });
    
    // Evitar que se cierre al hacer clic dentro
    desplegablePasajeros.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // =============================================
    // CONTROLADORES PARA LOS BOTONES DE PASAJEROS
    // =============================================
    document.querySelectorAll('.boton-pasajero').forEach(boton => {
        boton.addEventListener('click', function() {
            const tipo = this.getAttribute('data-tipo');
            const esSuma = this.classList.contains('mas');
            const elementoValor = document.getElementById(`valor${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`);
            const elementoInput = document.getElementById(tipo);
            let valor = parseInt(elementoValor.textContent);
            
            // Actualizar valor
            if (esSuma) {
                valor++;
            } else {
                valor = Math.max(0, valor - 1);
            }
            
            // Actualizar DOM
            elementoValor.textContent = valor;
            elementoInput.value = valor;
            
            actualizarResumenPasajeros();
        });
    });
    
    // =============================================
    // FUNCIÓN PARA ACTUALIZAR EL RESUMEN DE PASAJEROS
    // =============================================
    function actualizarResumenPasajeros() {
        const adultos = parseInt(document.getElementById('adultos').value);
        const ninos = parseInt(document.getElementById('ninos').value);
        const inapam = parseInt(document.getElementById('inapam').value);
        const total = adultos + ninos + inapam;
        
        let textoResumen = total + ' pasajero' + (total !== 1 ? 's' : '');
        if (total > 0) {
            textoResumen += ' (';
            const partes = [];
            if (adultos > 0) partes.push(adultos + ' Adulto' + (adultos !== 1 ? 's' : ''));
            if (ninos > 0) partes.push(ninos + ' Niño' + (ninos !== 1 ? 's' : ''));
            if (inapam > 0) partes.push(inapam + ' INAPAM');
            textoResumen += partes.join(', ') + ')';
        }
        
        document.getElementById('resumenPasajeros').textContent = textoResumen;
    }
});
    
    // Ejemplo de cómo cargar datos dinámicamente
    /*
    fetch('api/terminales.php')
        .then(response => response.json())
        .then(data => {
            const origenSelect = document.getElementById('origen');
            const destinoSelect = document.getElementById('destino');
            
            data.forEach(terminal => {
                const option = document.createElement('option');
                option.value = terminal.id;
                option.textContent = terminal.nombre;
                
                origenSelect.appendChild(option.cloneNode(true));
                destinoSelect.appendChild(option);
            });
        });
    */