<?php require("layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<main>

    <div class="container" style="text-align: center; margin-bottom: 2%;">
        <img src="view/img/BannerMini.png" alt="..." width="70%">
    </div>

<!--_________________________________________________________________-->

    <div class="Titular">
        <h2>Terminales!</h2>
        <center><hr width="30%"></center>
    </div>

    <div id="map"></div>

    <script>
    // Inicializa el array fuera del bucle
    const branches = [
    <?php foreach ($data as $MapTerminal):?>,
        {
            name: "<?= $MapTerminal['Nombre'] ?>",
            image: "<?= $MapTerminal['ImgTerminal'] ?>",
            address: "<?= $MapTerminal['DireccionCompleta'] ?>",
            coords: [<?= $MapTerminal['Coordenadas'] ?>]
        },
    <?php endforeach; ?>
    ];
    </script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="main.js">
    </script> 

</main>

<!--Espacio para el Footer, no tocar-->
<?php require("layout/footer.php"); ?>