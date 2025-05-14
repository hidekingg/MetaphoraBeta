<?php
require_once("model/perfilesmodel.php");
class perfilescontroller{
    public function __construct(){

    }
    public static function MiPerfil()
    {
        $perfilesmodel=new Usuarios();
        $data = $perfilesmodel->mostrarUsuarios();
        require_once("view/Perfil/MiPerfil.php");
    }
    public static function MisViajes()
    {
        $perfilesmodel=new Usuarios();
        $data = $perfilesmodel->mostrarUsuarios();

        $perfilesmodel=new BoletosUsuarios();
        $viajesdata = $perfilesmodel->MostrarViajes();

        require_once("view/Perfil/MisViajes.php");
    }

    public static function ActualizarDatosUsuarios()
    {
        require_once("model/perfilesmodel.php");
        session_start();
        $idUsuario = $_SESSION['IdUsuario'] ?? null; // Asegúrate de tenerlo en sesión

        if (!$idUsuario) {
            echo "No se encontró ID de usuario.";
            return;
        }

        // Validaciones de imagen
        $fotoPerfilRuta = null;
        if (!empty($_FILES['fotoPerfil']['tmp_name'])) {
            $archivo = $_FILES['fotoPerfil'];
            $permitidos = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            $maxSize = 2 * 1024 * 1024;

            if (in_array($archivo['type'], $permitidos) && $archivo['size'] <= $maxSize) {
                $ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
                $nombreArchivo = "FotoPerfil_usuario_" . $idUsuario . "." . $ext;
                $ruta = "view/img/Usuarios/" . $nombreArchivo;

                if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
                    $fotoPerfilRuta = $ruta;
                } else {
                    echo "Error al subir la imagen.";
                    return;
                }
            } else {
                echo "Formato o tamaño de imagen no permitido.";
                return;
            }
        }

        // Recibir el resto de los datos
        $datos = [
            'IdUsuario' => $idUsuario,
            'Nombre' => $_POST['nombre'],
            'Paterno' => $_POST['apellidoPaterno'],
            'Materno' => $_POST['apellidoMaterno'],
            'Edad' => $_POST['edad'],
            'Sexo' => $_POST['sexo'],
            'IdPais' => $_POST['pais'],
            'IdEstado' => $_POST['estado'],
            'IdMunicipio' => $_POST['municipio'],
            'Direccion' => $_POST['direccion'],
            'CP' => $_POST['cp'],
            'Telefono' => $_POST['telefono'],
            'FotoPerfil' => $fotoPerfilRuta
        ];
        
        $perfilesmodel=new Usuarios();
        $resultado = $perfilesmodel->actualizarDatosUsuario($datos);

        if ($resultado) {
            if (!empty($fotoPerfilRuta)) {
                $_SESSION["FotoPerfil"] = $fotoPerfilRuta;
            }
            echo "Datos actualizados correctamente.";
            header("Location: index.php?p=MiConfiguracion");

        } else {
            echo "Error al actualizar.";
        }
    }


    public static function MiConfiguracion()
    {
        $usuariosModel = new Usuarios();
        $dataUsuarios = $usuariosModel->MostrarDatos();

        $paisesModel = new Paises();
        $dataPaises = $paisesModel->mostrarPaises();

        $estadosModel = new Estados();
        $dataEstados = $estadosModel->mostrarEstados();

        $municipiosModel = new Municipios();
        $dataMunicipios = $municipiosModel->mostrarMunicipios();

        // Verificar si se obtuvieron datos
        if (!empty($dataUsuarios)) {
            $usuarioData = $dataUsuarios[0]; // Tomamos el primer registro
        } else {
            $usuarioData = []; // Datos vacíos si no hay resultados
        }

        require_once("view/Perfil/MiConfiguracion.php");
    }

    public static function GenerarBoletosPDF(){
        session_start();
        $idBoleto = $_REQUEST['IdBoleto'];

        $perfilesmodel = new BoletosUsuarios();
        $datosBoletos = $perfilesmodel->obtenerDatosBoletos($idBoleto);
        
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
}
?>