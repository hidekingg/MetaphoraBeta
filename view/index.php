<?php require("layout/header.php"); ?>
<!--Espacio para el Header, no tocar-->

<!--El inicio de secion sera un elemento variable, ya que los botones apareceran o deapareceran en funcion de si se inicio secion o no.-->
<main>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="view/img/banner.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="view/img/promo1.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="view/img/promo2.png" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>


    <div class="parrafos">
        <p>
            Metaphora, una plataforma orgullosamente chiapaneca, te permite reservar viajes en transporte de pasajeros dentro de Chiapas. 
            Trabajamos en colaboración con empresas aliadas, cuyas unidades están diseñadas para las carreteras de la región, garantizando 
            un servicio de calidad, confort y seguridad. Con Metaphora, disfrutas de una experiencia de reserva sencilla y un viaje placentero.
        </p><br>
    </div>

    <div class="parrafos" style="text-align: center;">
        <h3><b>BÚSCANOS!</b></h3>
        <p>¡Visita cualquiera de nuestras sucursales y puntos de venta!</p>
    </div>

    
    <div class="row justify-content-center g-2">
        <div class="col-auto">
            <div class="card" style="width: 16rem;">
                <img src="view/img/img1.png" class="card-img-top" alt="Sucursal Bicentenario">
                <div class="card-body">
                    <p class="card-text">Sucursal Bicentenario</p>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card" style="width: 16rem;">
                <img src="view/img/img2.png" class="card-img-top" alt="Sucursal Centro">
                <div class="card-body">
                    <p class="card-text">Sucursal Centro</p>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="card" style="width: 16rem;">
                <img src="view/img/img3.png" class="card-img-top" alt="Sucursal Parque de la marimba">
                <div class="card-body">
                    <p class="card-text">Sucursal Parque de la marimba</p>
                </div>
            </div>
        </div>
    </div>

</main>

<!--Espacio para el Footer, no tocar-->
<?php require("layout/footer.php"); ?>