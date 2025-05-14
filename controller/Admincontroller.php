<?php
require_once("model/Adminmodel.php");
class admincontroller{
    private $model;
    public function __construct(){
        
    }
    //PAGINAS ADMINISTRACION METAPHORA ADMIN
    //-----------------------------------------------------------------------------------
    public static function AdminMenu()
    {
        require_once("view/Admin/AdminMenu.php");
    }
    public static function AdminAdministrar()
    {
        require_once("view/Admin/AdminAdministrar.php");
    }
    public static function AdminConsultar()
    {
        require_once("view/Admin/AdminConsultar.php");
    }
    public static function AdminLiberarViajes()
    {
        require_once("view/Admin/AdminLiberarViajes.php");
    }
    public static function AdminMostrarViajes()
    {
        require_once("view/Admin/AdminMostrarViajes.php");
    }
    public static function AdminProgViajes()
    {
        require_once("view/Admin/AdminProgViajes.php");
    }
    public static function AdminReBoletos()
    {
        require_once("view/Admin/AdminReBoletos.php");
    }
    public static function AdminVenta()
    {
        require_once("view/Admin/AdminVenta.php");
    }

    //PAGINAS CRUD
    //-----------------------------------------------------------------------------------

    //ASIENTOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDAsientos()
    {
       $model = new AdminModel();
        
        // Obtener datos para los selects
        $autobuses = $model->getAutobuses();
        $tiposAsiento = $model->getTiposAsiento();
        $estadosAsiento = $model->getEstadosAsiento();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'IdAutobus' => $_POST['IdAutobus'],
                'NumeroAsiento' => $_POST['NumeroAsiento'],
                'Columna' => $_POST['Columna'],
                'IdTipoAsiento' => $_POST['IdTipoAsiento'],
                'IdEstadoAsiento' => $_POST['IdEstadoAsiento']
            ];

            if (!empty($_POST['IdAsiento'])) {
                $id = $_POST['IdAsiento'];
                $result = $model->updateAsiento($id, $data);
                $message = $result ? 'Asiento actualizado correctamente' : 'Error al actualizar el asiento';
            } else {
                $result = $model->createAsiento($data);
                $message = $result ? 'Asiento creado correctamente' : 'Error al crear el asiento';
            }

            header("Location: ?a=CRUDAsientos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteAsiento($id);
            $message = $result ? 'Asiento eliminado correctamente' : 'Error al eliminar el asiento';
        }
        
        // Obtener asientos para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $asientos = $model->getAsientos($page, $perPage);
        $total = $model->countAsientos();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDAsientos.php");
    }

    public static function getAsientoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $asiento = $model->getAsientoById($id);
            echo json_encode($asiento);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //AUTOBUSES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDAutobuses()
    {
        $model = new AdminModel();
        
        // Obtener datos para los selects
        $clases = $model->getClases();
        $empleados = $model->getEmpleados();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'IdClase' => $_POST['IdClase'],
                'Nombre' => $_POST['Nombre'],
                'IdEmpleado' => $_POST['IdEmpleado'],
                'Capacidad' => $_POST['Capacidad'],
                'Modelo' => $_POST['Modelo'],
                'Año' => $_POST['Año'],
                'Placas' => $_POST['Placas']
            ];

            if (!empty($_POST['IdAutobus'])) {
                $id = $_POST['IdAutobus'];
                $result = $model->updateAutobus($id, $data);
                $message = $result ? 'Autobús actualizado correctamente' : 'Error al actualizar el autobús';
            } else {
                $result = $model->createAutobus($data);
                $message = $result ? 'Autobús creado correctamente' : 'Error al crear el autobús';
            }

            header("Location: ?a=CRUDAutobuses&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteAutobus($id);
            $message = $result ? 'Autobús eliminado correctamente' : 'Error al eliminar el autobús';
            header("Location: ?a=CRUDAutobuses&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Obtener autobuses para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $autobuses = $model->getAutobusesList($page, $perPage);
        $total = $model->countAutobuses();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDAutobuses.php");
    }

    public static function getAutobusById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $autobus = $model->getAutobusById($id);
            echo json_encode($autobus);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //BOLETOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDBoletos()
    {
        $model = new AdminModel();
        
        // Obtener datos para los selects
        $estatusBoletos = $model->getEstatusBoletos();
        $usuarios = $model->getUsuarios();
        $promociones = $model->getPromociones();
        $viajes = $model->getViajes();
        $asientos = $model->getAsientosDisponibles();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'IdEstatusBoleto' => $_POST['IdEstatusBoleto'],
                'IdUsuario' => $_POST['IdUsuario'],
                'Nombre' => $_POST['Nombre'],
                'Apellidos' => $_POST['Apellidos'],
                'IdPromocion' => !empty($_POST['IdPromocion']) ? $_POST['IdPromocion'] : null,
                'IdViaje' => $_POST['IdViaje'],
                'IdAsiento' => $_POST['IdAsiento']
            ];

            if (!empty($_POST['IdBoleto'])) {
                $id = $_POST['IdBoleto'];
                $result = $model->updateBoleto($id, $data);
                $message = $result ? 'Boleto actualizado correctamente' : 'Error al actualizar el boleto';
            } else {
                $result = $model->createBoleto($data);
                $message = $result ? 'Boleto creado correctamente' : 'Error al crear el boleto';
            }

            header("Location: ?a=CRUDBoletos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteBoleto($id);
            $message = $result ? 'Boleto eliminado correctamente' : 'Error al eliminar el boleto';
            header("Location: ?a=CRUDBoletos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Obtener boletos para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $boletos = $model->getBoletos($page, $perPage);
        $total = $model->countBoletos();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDBoletos.php");
    }

    public static function getBoletoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $boleto = $model->getBoletoById($id);
            echo json_encode($boleto);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //CLASE INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDClase()
    {
        $model = new AdminModel();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre']
            ];
            
            $imageUploaded = false;
            $imagePath = null;
            
            // Manejar la subida de imagen
            if(isset($_FILES['LogoClase']) && $_FILES['LogoClase']['error'] == UPLOAD_ERR_OK) {
                $idClase = !empty($_POST['IdClase']) ? $_POST['IdClase'] : null;
                $uploadResult = $model->handleImageUpload($_FILES['LogoClase'], $idClase);
                
                if($uploadResult['success']) {
                    $data['LogoClase'] = $uploadResult['path'];
                    $imageUploaded = true;
                } else {
                    
                    exit;
                }
            }
            
            if (!empty($_POST['IdClase'])) {
                // Si es una actualización y no se subió nueva imagen, mantener la existente
                if(!$imageUploaded) {
                    $existingClase = $model->getClaseById($_POST['IdClase']);
                    if($existingClase && !empty($existingClase['LogoClase'])) {
                        $data['LogoClase'] = $existingClase['LogoClase'];
                    }
                }
                
                $id = $_POST['IdClase'];
                $result = $model->updateClase($id, $data);
                $message = $result ? 'Clase actualizada correctamente' : 'Error al actualizar la clase';
            } else {
                // Para creación, la imagen es requerida
                if(!$imageUploaded) {
                    header("Location: ?a=CRUDClase&message=" . urlencode('Debe subir una imagen para la clase') . "&result=0");
                    exit;
                }
                
                $id = $model->createClase($data);
                $result = (bool)$id;
                $message = $result ? 'Clase creada correctamente' : 'Error al crear la clase';
                
                // Si se creó correctamente y tenemos ID, actualizar nombre de imagen
                if($result && $imageUploaded) {
                    $newFileName = 'view/img/Marcas/MarcaViajes/Clase_' . $id . '.' . pathinfo($data['LogoClase'], PATHINFO_EXTENSION);
                    rename($data['LogoClase'], $newFileName);
                    $model->updateClase($id, ['LogoClase' => $newFileName]);
                }
            }

            header("Location: ?a=CRUDClase&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteClase($id);
            $message = $result ? 'Clase eliminada correctamente' : 'Error al eliminar la clase';
            header("Location: ?a=CRUDClase&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Obtener clases para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $clases = $model->getClases($page, $perPage);
        $total = $model->countClases();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDClase.php");
    }

    public static function getClaseById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $clase = $model->getClaseById($id);
            echo json_encode($clase);
        }
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //EMPLEADOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDEmpleados()
    {
        $model = new AdminModel();
        
        // Obtener datos para los selects
        $puestos = $model->getPuestos();
        $terminales = $model->getTerminales();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'IdPuesto' => $_POST['IdPuesto'],
                'IdTerminal' => $_POST['IdTerminal']
            ];

            if (!empty($_POST['IdEmpleado'])) {
                $id = $_POST['IdEmpleado'];
                $result = $model->updateEmpleado($id, $data);
                $message = $result ? 'Empleado actualizado correctamente' : 'Error al actualizar el empleado';
            } else {
                $result = $model->createEmpleado($data);
                $message = $result ? 'Empleado creado correctamente' : 'Error al crear el empleado';
            }

            header("Location: ?a=CRUDEmpleados&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteEmpleado($id);
            $message = $result ? 'Empleado eliminado correctamente' : 'Error al eliminar el empleado';
        }
        
        // Obtener empleados para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $empleados = $model->getEmpleados1($page, $perPage);
        $total = $model->countEmpleados();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDEmpleados.php");
        }

        public static function getEmpleadoById() {
            if (isset($_GET['id'])) {
                $model = new AdminModel();
                $id = $_GET['id'];
                $empleado = $model->getEmpleadoById($id);
                echo json_encode($empleado);
            }
        }
        //-----------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------


        //ESTADOS INICIO
        //-----------------------------------------------------------------------------------
        //-----------------------------------------------------------------------------------
        public static function CRUDEstados()
        {
            $model = new AdminModel();
            
            // Procesar formulario
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'Nombre' => $_POST['Nombre']
                ];

                if (!empty($_POST['IdEstado'])) {
                    $id = $_POST['IdEstado'];
                    $result = $model->updateEstado($id, $data);
                    $message = $result ? 'Estado actualizado correctamente' : 'Error al actualizar el estado';
                } else {
                    $result = $model->createEstado($data);
                    $message = $result ? 'Estado creado correctamente' : 'Error al crear el estado';
                }

                header("Location: ?a=CRUDEstados&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
                exit;
            }
            
            // Procesar eliminación
            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $result = $model->deleteEstado($id);
                $message = $result ? 'Estado eliminado correctamente' : 'Error al eliminar el estado';
            }
            
            // Obtener estados para la tabla
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = 10;
            $estados = $model->getEstados($page, $perPage);
            $total = $model->countEstados();
            $totalPages = ceil($total / $perPage);
            
            // Cargar vista
            require_once("view/Admin/CRUDS/CRUDEstados.php");
        }

        public static function getEstadoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $estado = $model->getEstadoById($id);
            echo json_encode($estado);
            }
        }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //ASIENTOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDEstAsientos()
    {
        $model = new AdminModel();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre']
            ];

            if (!empty($_POST['IdEstadoAsiento'])) {
                $id = $_POST['IdEstadoAsiento'];
                $result = $model->updateEstadoAsiento1($id, $data);
                $message = $result ? 'Estado actualizado correctamente' : 'Error al actualizar el estado';
            } else {
                $result = $model->createEstadoAsiento1($data);
                $message = $result ? 'Estado creado correctamente' : 'Error al crear el estado';
            }

            header("Location: ?a=CRUDEstAsientos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteEstadoAsiento1($id);
            $message = $result ? 'Estado eliminado correctamente' : 'Error al eliminar el estado';
        }
        
        // Obtener estados para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $estadosAsiento = $model->getEstadoAsientos1($page, $perPage);
        $total = $model->countEstadoAsientos1();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDEstAsientos.php");
    }

    public static function getEstadoAsientoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $estadoAsiento = $model->getEstadoAsientoById($id);
            echo json_encode($estadoAsiento);
        }
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //ESTADOBOLETO INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDEstBoleto()
    {
        $model = new AdminModel();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre']
            ];

            if (!empty($_POST['IdEstatusBoleto'])) {
                $id = $_POST['IdEstatusBoleto'];
                $result = $model->updateEstatusBoleto($id, $data);
                $message = $result ? 'Estatus actualizado correctamente' : 'Error al actualizar el estatus';
            } else {
                $result = $model->createEstatusBoleto($data);
                $message = $result ? 'Estatus creado correctamente' : 'Error al crear el estatus';
            }

            header("Location: ?a=CRUDEstBoleto&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteEstatusBoleto($id);
            $message = $result ? 'Estatus eliminado correctamente' : 'Error al eliminar el estatus';
        }
        
        // Obtener estatus para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $estatusBoleto = $model->getEstatusBoleto($page, $perPage);
        $total = $model->countEstatusBoleto();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDEstBoleto.php");
    }

    public static function getEstatusBoletoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $estatusBoleto = $model->getEstatusBoletoById($id);
            echo json_encode($estatusBoleto);
        }
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //ESTATUSVIAJES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDEstViajes()
    {
        $model = new AdminModel();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre']
            ];

            if (!empty($_POST['IdEstatusViaje'])) {
                $id = $_POST['IdEstatusViaje'];
                $result = $model->updateEstatusViaje($id, $data);
                $message = $result ? 'Estatus actualizado correctamente' : 'Error al actualizar el estatus';
            } else {
                $result = $model->createEstatusViaje($data);
                $message = $result ? 'Estatus creado correctamente' : 'Error al crear el estatus';
            }

            header("Location: ?a=CRUDEstViajes&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteEstatusViaje($id);
            $message = $result ? 'Estatus eliminado correctamente' : 'Error al eliminar el estatus';
        }
        
        // Obtener estatus para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $estatusViajes = $model->getEstatusViajes($page, $perPage);
        $total = $model->countEstatusViajes();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDEstViajes.php");
    }

    public static function getEstatusViajeById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $estatusViaje = $model->getEstatusViajeById($id);
            echo json_encode($estatusViaje);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //PAGOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDMetPagos()
    {
        $model = new AdminModel();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre']
            ];

            if (!empty($_POST['IdMetodoPago'])) {
                $id = $_POST['IdMetodoPago'];
                $result = $model->updateMetodoPago($id, $data);
                $message = $result ? 'Método de pago actualizado correctamente' : 'Error al actualizar el método de pago';
            } else {
                $result = $model->createMetodoPago($data);
                $message = $result ? 'Método de pago creado correctamente' : 'Error al crear el método de pago';
            }

            header("Location: ?a=CRUDMetPagos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteMetodoPago($id);
            $message = $result ? 'Método de pago eliminado correctamente' : 'Error al eliminar el método de pago';
        }
        
        // Obtener métodos de pago para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $metodosPago = $model->getMetodosPago($page, $perPage);
        $total = $model->countMetodosPago();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDMetPagos.php");
    }

    public static function getMetodoPagoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $metodoPago = $model->getMetodoPagoById($id);
            echo json_encode($metodoPago);
        }
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //MODIFICACIONES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDModificaciones()
    {
        $model = new AdminModel();
        
        // Obtener datos para los selects
        $usuarios = $model->getUsuarios1();
        $operaciones = $model->getOperaciones();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'TablaAfectada' => $_POST['TablaAfectada'],
                'IdOperacion' => $_POST['IdOperacion'],
                'IdUsuario' => $_POST['IdUsuario'],
                'Fecha_Hora' => $_POST['Fecha_Hora'],
                'Descripcion' => $_POST['Descripcion']
            ];

            if (!empty($_POST['IdModificaciones'])) {
                $id = $_POST['IdModificaciones'];
                $result = $model->updateModificacion($id, $data);
                $message = $result ? 'Modificación actualizada correctamente' : 'Error al actualizar la modificación';
            } else {
                $result = $model->createModificacion($data);
                $message = $result ? 'Modificación creada correctamente' : 'Error al crear la modificación';
            }

            header("Location: ?a=CRUDModificaciones&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteModificacion($id);
            $message = $result ? 'Modificación eliminada correctamente' : 'Error al eliminar la modificación';
        }
        
        // Obtener modificaciones para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $modificaciones = $model->getModificaciones($page, $perPage);
        $total = $model->countModificaciones();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDModificaciones.php");
    }

    public static function getModificacionById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $modificacion = $model->getModificacionById($id);
            echo json_encode($modificacion);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //MUNICIPIO INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDMunicipio() {
        $model = new AdminModel();

        $estados = $model->getEstados1();

        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre'],
                'IdEstado' => $_POST['IdEstado']
            ];

            if (!empty($_POST['IdMunicipio'])) {
                $id = $_POST['IdMunicipio'];
                $result = $model->updateMunicipio($id, $data);
                $message = $result ? 'Municipio actualizado correctamente' : 'Error al actualizar el municipio';
            } else {
                $result = $model->createMunicipio($data);
                $message = $result ? 'Municipio creado correctamente' : 'Error al crear el municipio';
            }

            header("Location: ?a=CRUDMunicipio&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }

        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteMunicipio($id);
            $message = $result ? 'Municipio eliminado correctamente' : 'Error al eliminar el municipio';
        }

        // Obtener municipios para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $municipios = $model->getMunicipios($page, $perPage);
        $total = $model->countMunicipios();
        $totalPages = ceil($total / $perPage);

        require_once("view/Admin/CRUDS/CRUDMunicipio.php");
    }

    public static function getMunicipioById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $municipio = $model->getMunicipioById($id);
            echo json_encode($municipio);
        }
    }

    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //OPERACIONES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDOperaciones()
    {
        $model = new AdminModel();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Nombre' => $_POST['Nombre']
            ];

            if (!empty($_POST['IdOperacion'])) {
                $id = $_POST['IdOperacion'];
                $result = $model->updateOperacion($id, $data);
                $message = $result ? 'Operación actualizada correctamente' : 'Error al actualizar la operación';
            } else {
                $result = $model->createOperacion($data);
                $message = $result ? 'Operación creada correctamente' : 'Error al crear la operación';
            }

            header("Location: ?a=CRUDOperaciones&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deleteOperacion($id);
            $message = $result ? 'Operación eliminada correctamente' : 'Error al eliminar la operación';
        }
        
        // Obtener operaciones para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $operaciones = $model->getOperaciones($page, $perPage);
        $total = $model->countOperaciones();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDOperaciones.php");
    }

    public static function getOperacionById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $operacion = $model->getOperacionById($id);
            echo json_encode($operacion);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //PAGOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDPagos()
    {
        $model = new AdminModel();
        
        // Obtener datos para los selects
        $boletos = $model->getBoletos();
        $metodosPago = $model->getMetodosPago();
        
        // Procesar formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'IdBoleto' => $_POST['IdBoleto'],
                'FechaPago' => $_POST['FechaPago'],
                'Monto' => $_POST['Monto'],
                'IdMetodoPago' => $_POST['IdMetodoPago']
            ];

            if (!empty($_POST['IdPago'])) {
                $id = $_POST['IdPago'];
                $result = $model->updatePago($id, $data);
                $message = $result ? 'Pago actualizado correctamente' : 'Error al actualizar el pago';
            } else {
                $result = $model->createPago($data);
                $message = $result ? 'Pago creado correctamente' : 'Error al crear el pago';
            }

            header("Location: ?a=CRUDPagos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Procesar eliminación
        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $result = $model->deletePago($id);
            $message = $result ? 'Pago eliminado correctamente' : 'Error al eliminar el pago';
            header("Location: ?a=CRUDPagos&message=" . urlencode($message) . "&result=" . ($result ? 1 : 0));
            exit;
        }
        
        // Obtener pagos para la tabla
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $pagos = $model->getPagos($page, $perPage);
        $total = $model->countPagos();
        $totalPages = ceil($total / $perPage);
        
        // Cargar vista
        require_once("view/Admin/CRUDS/CRUDPagos.php");
    }

    public static function getPagoById() {
        if (isset($_GET['id'])) {
            $model = new AdminModel();
            $id = $_GET['id'];
            $pago = $model->getPagoById($id);
            echo json_encode($pago);
        }
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //PAIS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDPais()
    {
        require_once("view/Admin/CRUDS/CRUDPais.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //PROMOCIONES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDPromociones()
    {
        require_once("view/Admin/CRUDS/CRUDPromociones.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //PUESTO INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDPuesto()
    {
        require_once("view/Admin/CRUDS/CRUDPuesto.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //ROLES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDRoles()
    {
        require_once("view/Admin/CRUDS/CRUDRoles.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //RUTAS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDRutas()
    {
        require_once("view/Admin/CRUDS/CRUDRutas.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //TERMINAL INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDTerminal()
    {
        require_once("view/Admin/CRUDS/CRUDTerminal.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //TIPOASIENTOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDTipoAsientos()
    {
        require_once("view/Admin/CRUDS/CRUDTipoAsientos.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //USUARIOS INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDUsuarios()
    {
        require_once("view/Admin/CRUDS/CRUDUsuarios.php");
    }
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------


    //VIAJES INICIO
    //-----------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------
    public static function CRUDViajes()
    {
        require_once("view/Admin/CRUDS/CRUDViajes.php");
    }
}
?>