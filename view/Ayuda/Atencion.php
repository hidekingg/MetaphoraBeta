<?php require("view/layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

    <div class="container" style="text-align: center; margin-bottom: 2%;">
        <img src="view/img/BannerMini.png" alt="..." width="70%">
    </div>

    <center>
    <div style="width: 70%; text-align: left;">
    <div class="card-header bg-primary text-white">
        <h2 class="text-center" style="background-color: #2b824b;">Formulario de Atención</h2>
    </div>
    <div class="card-body">
        <form action="enviar_correo.php" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono de contacto:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="mb-3">
                <label for="asunto" class="form-label">Asunto:</label>
                <select class="form-select" id="asunto" name="asunto" required>
                    <option value="" selected disabled>Seleccione un asunto</option>
                    <option value="Consulta general">Consulta general</option>
                    <option value="Problema con reserva">Problema con reserva</option>
                    <option value="Reembolso">Reembolso</option>
                    <option value="Sugerencia">Sugerencia</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje:</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Enviar solicitud</button>
            </div>
        </form>
    </div> 
    </div></center>

</main>

<!--Espacio para el Footer, no tocar-->
<?php require("view/layout/footer.php"); ?>