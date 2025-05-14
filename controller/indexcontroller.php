<?php

require_once("model/indexmodel.php");
class indexcontroller{
    private $indexmodel;
    public function __construct()
    {
        $indexmodel = new Index();
    }

    public static function index()
    {
        require_once("view/index.php");
    }

    public static function guardarRegistro(){
        $Username1 = $_REQUEST['Username1'];
        $password1 = $_REQUEST['password1'];
        $indexmodel = new Index();
        $resultado = $indexmodel->registrarse($Username1, $password1);
        session_start();

        if ($resultado === "email_existente") {
            $_SESSION['error'] = "El correo electrónico ya está registrado";
        } elseif ($resultado === true) {
            $_SESSION['success'] = "Registro exitoso";
        } else {
            $_SESSION['error'] = "Error al registrar el usuario";
        }

        header("location:" . urlsite . "index.php?i=index");
    }

    public static function autenticar(){
    $Username = $_REQUEST['Username'];
    $password = $_REQUEST['password'];
    $indexmodel = new Index();
    $resultado = $indexmodel->autentificacion($Username, $password);
    session_start();

    if (!empty($resultado)) {
        foreach ($resultado as $value) {
            foreach ($value as $item) {              
                $_SESSION["IdUsuario"] = $item['IdUsuario'];
                $_SESSION["Username"] = $item['Username']; 
                $_SESSION["FotoPerfil"] = $item['FotoPerfil'];
                $_SESSION["IdRol"] =  $item['IdRol'];  
                $_SESSION["IdEmpleado"] = $item['IdEmpleado'];
                $_SESSION["IdCliente"] = $item['IdCliente'];
            }
        }
        $_SESSION['success'] = "Inicio de sesión exitoso";
    } else {
        $_SESSION['error'] = "Usuario o contraseña incorrectos";
    }

        header("location:" . urlsite . "index.php?i=index");
    }
    
    public static function cerrarSesion(){	
        session_start();
        if(session_destroy()){
            header("location:".urlsite."index.php?i=index");
        }	       
    }

    public static function Promociones()
    {
        $indexmodel=new Promociones();
        $data = $indexmodel->mostrarUltimosPromociones();
        require_once("view/Promociones.php");
    }

    public static function Reserva()
    {
        $indexmodel=new Terminales();
        $data = $indexmodel->mostrarTerminales();
        require_once("view/Reserva.php");
    }

    public static function BuscarViajes()
    {
        require_once("view/Viajes/BuscarViajes.php");
    }

    public static function MandarViajes() {
        $origen = $_REQUEST['origen'];
        $destino = $_REQUEST['destino'];
        $fecha = $_REQUEST['fecha'];
        
        $indexmodel = new Viajes();
        $data = $indexmodel->BuscarViajes($origen, $destino, $fecha);
    
        // Verifica si hay resultados antes de redirigir
        if (!empty($data)) {
            require_once("view/Viajes/BuscarViajes.php");
        } else {
            header("location:".urlsite."index.php?i=BuscarViajes");
        }
    }

    //INICIO DE LA RESERVA ( SELECCION DE ASIENTO )

    public static function SeleccionarAsientos()
    {
        require_once("view/Viajes/SeleccionarAsientos.php");
    }

    public static function ViajeSeleccionado(){
        $Viaje = $_REQUEST['IdViaje'];
        $indexmodel = new Viajes();
        $data = $indexmodel->BuscarAsientos($Viaje);

        if (!empty($data)) {
            require_once("view/Viajes/SeleccionarAsientos.php");
        } else {
            header("location:".urlsite."index.php?i=SeleccionarAsientos");
        }
    }

    public static function InformacionBol()
    {
        session_start();
        
        if (!isset($_SESSION['id_viaje']) || !isset($_SESSION['asientos_seleccionados'])) {
            header("Location: alguna_pagina_de_error.php");
            exit();
        }
    
        $idViaje = $_SESSION['id_viaje'];
        $asientosSeleccionados = $_SESSION['asientos_seleccionados'];
    
        $indexmodel = new Boletos();
        $dataViaje = $indexmodel->VistaPreviaViaje();
        $dataAsientos = $indexmodel->VistaAsiento();
        
        // Convertir $dataAsientos a un formato más fácil de usar (ID => Datos)
        $asientosMap = [];
        foreach ($dataAsientos as $asiento) {
            $asientosMap[$asiento['IdAsiento']] = $asiento;
        }
        
        require_once("view/Viajes/InformacionBol.php");
    }

    public static function ProcesarAsientos()
    {
        session_start();
        
        // Almacenar datos directamente sin validar
        $_SESSION['asientos_seleccionados'] = $_REQUEST['asientos'] ?? [];
        $_SESSION['id_viaje'] = $_REQUEST['IdViaje'] ?? null;

        // Redirigir directamente
        header("location:".urlsite."index.php?i=InformacionBol");
        exit;
    }

    public static function ConfirmarAsientos() {
        session_start();

        // 2. Obtener y validar datos básicos
        $idViaje = $_REQUEST['id_viaje'];

        // 3. Recoger datos de arrays
        $asientos = $_REQUEST['asientos'] ?? [];
        $nombres = $_REQUEST['nombres'] ?? [];
        $apellidos = $_REQUEST['apellidos'] ?? [];
        $tiposPasajero = $_REQUEST['tipo_pasajero'] ?? [];

        // 4. Validar consistencia de datos
        $count = count($asientos);

        // 5. Preparar datos para el modelo
        $pasajeros = [];
        for ($i = 0; $i < $count; $i++) {
            $pasajeros[] = [
                'id_asiento' => $asientos[$i],
                'nombre' => trim($nombres[$i]),
                'apellido' => trim($apellidos[$i]),
                'tipo_pasajero' => $tiposPasajero[$i]
            ];
        }

        // 7. Procesar con el modelo
        $indexmodel = new Boletos();
        $resultado = $indexmodel->guardarBoletos($idViaje, $pasajeros);
        $resultado2 = $indexmodel->AsientosOcupado($pasajeros);


        // 8. Redireccionar según resultado
        if ($resultado) {
            $_SESSION['datos_boletos_generados'] = $resultado;
            header("Location: index.php?i=Boletos");
        } else {
            $_SESSION['error'] = "Error al procesar los boletos";
            header("Location: index.php?i=InformacionBol");
        }
        exit();
    }

    public static function Boletos()
    {
        require_once("view/Viajes/Boletos.php");
    }

    public static function GenerarBoletosPDF(){
        session_start();
        
        if (!isset($_SESSION['datos_boletos_generados'])) {
            $_SESSION['error'] = "No hay boletos para generar";
            header("Location: index.php?i=ConfirmacionPago");
            exit();
        }
    
        $idsBoletos = $_SESSION['datos_boletos_generados'];
        $indexmodel = new Boletos();
        $datosBoletos = $indexmodel->obtenerDatosBoletos($idsBoletos);
        
        require_once('view/tcpdf/tcpdf.php');
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215.9, 279.4), true, 'UTF-8', false);
        
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Metaphora');
        $pdf->SetTitle('Boletos de Viaje');
        $pdf->SetSubject('Boletos de Autobús');
        $pdf->SetKeywords('TCPDF, PDF, boleto, autobús');
        $pdf->SetFont('dejavusans', '', 10);

        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(TRUE, 15);
        
        foreach ($datosBoletos as $boleto) {
            $pdf->AddPage();

            // Cambios aplicados: -10 a todas las coordenadas Y relevantes
            $pdf->Image('view/img/Boletos/LogoVerdeTiny.png', 15, 20, 50);

            $pdf->SetFillColor(240);
            $pdf->RoundedRect(15, 37, 110, 80, 3, '1111', 'F');

            // Nombre del pasajero
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, 40);
            $pdf->SetTextColor(33, 37, 41);
            $pdf->Cell(0, 0, 'NOMBRE/NAME', 0, 1);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(20, 45);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->Cell(0, 0, strtoupper($boleto['Nombre'].' '.$boleto['Apellidos']), 0, 1);
            $pdf->SetTextColor(0);

            // Origen
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, 52);
            $pdf->Cell(0, 0, 'ORIGEN/FROM', 0, 1);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(20, 57);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->Cell(0, 0, strtoupper($boleto['TerminalOrigen']), 0, 1);
            $pdf->SetTextColor(0);

            // Destino
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, 65);
            $pdf->Cell(0, 0, 'DESTINO/TO', 0, 1);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->SetXY(20, 70);
            $pdf->Cell(0, 0, strtoupper($boleto['TerminalDestino']), 0, 1);
            $pdf->SetTextColor(0);

            // Asiento
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, 85);
            $pdf->Cell(0, 0, 'ASIENTO/SEAT', 0, 1);
            $pdf->SetFont('helvetica', 'B', 30);
            $pdf->SetXY(20, 90);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->Cell(0, 0, $boleto['NumeroAsiento'].''.$boleto['Columna'], 0, 1);

            // Fecha y hora
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(50, 85);
            $pdf->SetTextColor(33, 37, 41);
            $pdf->Cell(0, 0, 'FECHA/DATE', 0, 1);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(50, 90);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->Cell(0, 0, strtoupper($boleto['FechaSalida']), 0, 1);

            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(50, 98);
            $pdf->SetTextColor(33, 37, 41);
            $pdf->Cell(0, 0, 'HORA/HOUR', 0, 1);
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->SetXY(50, 103);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->Cell(0, 0, strtoupper($boleto['HoraSalida']), 0, 1);

            // Tipo
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, 105);
            $pdf->SetTextColor(33, 37, 41);
            $pdf->Cell(0, 0, 'ADULTO', 0, 1);

            // Precio y QR
            $pdf->SetFillColor(240);
            $pdf->RoundedRect(140, 87, 60, 30, 3, '1111', 'F');

            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetXY(145, 102);
            $pdf->SetTextColor(33, 37, 41);
            $pdf->Cell(0, 0, 'PRECIO TOTAL/PRICE', 0, 1);

            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->SetXY(145, 107);
            $pdf->Cell(0, 0, '$ '.number_format($boleto['Precio'], 2), 0, 1);

            // QR Code
            $pdf->write2DBarcode(strval($boleto['IdBoleto']), 'QRCODE,H', 150, 42, 40, 40);

            // Viaje
            $pdf->SetFont('helvetica', '', 9);
            $pdf->SetXY(145, 90);
            $pdf->SetTextColor(33, 37, 41);
            $pdf->Cell(0, 0, 'VIAJE/TRAVEL', 0, 1);
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->SetXY(145, 95);
            $pdf->SetTextColor(43, 130, 75);
            $pdf->Cell(0, 0, $boleto['IdViaje'], 0, 1);

            //Imagen avisos
            //Aviso 1
            $pdf->Image('view/img/Boletos/Aviso.png', 15, 125, 185);

            //Aviso 2
            $pdf->Image('view/img/Boletos/Aviso2.png', 15, 162, 90);

            //Promo
            $pdf->Image('view/img/Boletos/Promo.png', 110, 162, 90);

            $terms = "Su boleto es su seguro de viajero. Válido para la fecha y hora indicada.\n\n".
                 "Metaphora S.A. de C.V. (operando como Metaphora) no es la transportista ni presta el servicio directamente, por lo que no existe obligación o solidaridad con la transportista. Mención sólo para efectos fiscales en términos del Art. 72 de la Ley del ISR: RFC de Metaphora S.A. de C.V. [insertar RFC si es necesario]. Cualquier derecho u obligación relacionados con este servicio, incluyendo pagos e indemnizaciones, se regirán por la legislación civil federal mexicana. Los tribunales competentes serán los del fuero federal en Pachuca de Soto, Hidalgo, México, renunciando expresamente a cualquier otra jurisdicción nacional o extranjera.\n".
                 "La transportista no será responsable por: Culpa o negligencia del pasajero, Caso fortuito o fuerza mayor, Pérdida o daño al equipaje por causas ajenas a su control.\n".
                 "Domicilio administrativo de la transportista para notificaciones: Av. Sinaloa MZ203 LT15, Las Granjas, 29019 Tuxtla Gutiérrez, Chis. Políticas importantes: Cancelación: Sin penalización hasta 60 minutos antes de la salida (en taquilla). Para compras en http://metaphora.infy.uk, contactar al servicio al cliente. La devolución por cancelación se hará por medio de transferencia (no reembolso en efectivo). Boletos abordados no son cancelables. Transferencia: Sólo en taquilla, dentro de los 60 minutos posteriores a la compra y hasta 30 minutos antes del viaje. Sujeto a diferencias de tarifa vigente. Equipaje: Hasta 25 kg sin costo. En pérdida, indemnización máxima de 50 UMAS (excluyendo contenido u objetos olvidados). Atención al cliente: Dudas, quejas o sugerencias: Correo: metaphora.ayuda@gmail.com. CHAT en https://api.whatsapp.com/send/?phone=5219611063428&text&type=phone_number&app_absent=0 (horario: L-V 7:00–22:00, Domingos 7:00–21:00). Términos y Condiciones completos: Consulta http://metaphora.infy.uk/index.php?i=TerminosYCondiciones. Para información sobre derechos y responsabilidades, visita http://metaphora.infy.uk/index.php?i=Atencion.";

            $pdf->SetFont('helvetica', '', 6);
            $pdf->SetTextColor(100, 100, 100); // Grayish color
            $pdf->SetXY(15, 210); // Position near the bottom
            $pdf->MultiCell(185, 3, $terms, 0, 'L');


        }
        
        $pdf->Output('boletos_metaphora.pdf', 'I');
    }

    //FIN ( SELECCION DE ASIENTO )

    public static function Terminales()
    {
        $indexmodel=new MapaTerminales();
        $data = $indexmodel->mostrarMapaTerminales();
        require_once("view/Terminales.php");
    }

    public static function Atencion()
    {
        require_once("view/Ayuda/Atencion.php");
    }
    public static function Marcas()
    {
        require_once("view/Ayuda/Marcas.php");
    }
    public static function AcercaDe()
    {
        require_once("view/Ayuda/AcercaDe.php");
    }
    public static function MetodosDePago()
    {
        require_once("view/Ayuda/MetodosDePago.php");
    }
    public static function AvisoPrivacidad()
    {
        require_once("view/Ayuda/AvisoPrivacidad.php");
    }
    public static function TerminosYCondiciones()
    {
        require_once("view/Ayuda/TerminosYCondiciones.php");
    }
    
}
?>