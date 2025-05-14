<?php
class AdminModel {

    //CRUD TABLA ASIENTOS
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getAsientos($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT a.*, au.Nombre as NombreAutobus, ta.Nombre as TipoAsiento, ea.Nombre as EstadoAsiento 
                  FROM asientos a
                  LEFT JOIN autobuses au ON a.IdAutobus = au.IdAutobus
                  LEFT JOIN tipoasientos ta ON a.IdTipoAsiento = ta.IdTipoAsiento
                  LEFT JOIN estadoasientos ea ON a.IdEstadoAsiento = ea.IdEstadoAsiento
                  LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countAsientos() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM asientos";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getAsientoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM asientos WHERE IdAsiento = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createAsiento($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO asientos (IdAutobus, NumeroAsiento, Columna, IdTipoAsiento, IdEstadoAsiento) 
                VALUES (:IdAutobus, :NumeroAsiento, :Columna, :IdTipoAsiento, :IdEstadoAsiento)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdAutobus', $data['IdAutobus']);
        $stmt->bindParam(':NumeroAsiento', $data['NumeroAsiento']);
        $stmt->bindParam(':Columna', $data['Columna']);
        $stmt->bindParam(':IdTipoAsiento', $data['IdTipoAsiento']);
        $stmt->bindParam(':IdEstadoAsiento', $data['IdEstadoAsiento']);

        $result = $stmt->execute();
        return $result; 

    }
    
    public function updateAsiento($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE asientos SET 
                  IdAutobus = :IdAutobus,
                  NumeroAsiento = :NumeroAsiento,
                  Columna = :Columna,
                  IdTipoAsiento = :IdTipoAsiento,
                  IdEstadoAsiento = :IdEstadoAsiento
                  WHERE IdAsiento = :IdAsiento";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdAutobus', $data['IdAutobus']);
        $stmt->bindParam(':NumeroAsiento', $data['NumeroAsiento']);
        $stmt->bindParam(':Columna', $data['Columna']);
        $stmt->bindParam(':IdTipoAsiento', $data['IdTipoAsiento']);
        $stmt->bindParam(':IdEstadoAsiento', $data['IdEstadoAsiento']);
        $stmt->bindParam(':IdAsiento', $id);
        
        return $stmt->execute();
    }
    
    public function deleteAsiento($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM asientos WHERE IdAsiento = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    public function getAutobuses() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM autobuses";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTiposAsiento() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM tipoasientos";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEstadosAsiento() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estadoasientos";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA AUTOBUSES
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    public function getAutobusesList($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT a.*, c.Nombre as NombreClase, e.Nombre as NombreEmpleado 
              FROM autobuses a
              LEFT JOIN clase c ON a.IdClase = c.IdClase
              LEFT JOIN empleados emp ON a.IdEmpleado = emp.IdEmpleado
              LEFT JOIN usuarios e ON emp.IdEmpleado = e.IdEmpleado
              LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAutobuses() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM autobuses";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAutobusById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM autobuses WHERE IdAutobus = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createAutobus($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO autobuses (IdClase, Nombre, IdEmpleado, Capacidad, Modelo, `Año`, Placas) 
                VALUES (:IdClase, :Nombre, :IdEmpleado, :Capacidad, :Modelo, :Anio, :Placas)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdClase', $data['IdClase']);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEmpleado', $data['IdEmpleado']);
        $stmt->bindParam(':Capacidad', $data['Capacidad']);
        $stmt->bindParam(':Modelo', $data['Modelo']);
        $stmt->bindParam(':Anio', $data['Año']);
        $stmt->bindParam(':Placas', $data['Placas']);

        return $stmt->execute();
    }

    public function updateAutobus($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE autobuses SET 
                IdClase = :IdClase,
                Nombre = :Nombre,
                IdEmpleado = :IdEmpleado,
                Capacidad = :Capacidad,
                Modelo = :Modelo,
                `Año` = :Anio,
                Placas = :Placas
                WHERE IdAutobus = :IdAutobus";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdClase', $data['IdClase']);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEmpleado', $data['IdEmpleado']);
        $stmt->bindParam(':Capacidad', $data['Capacidad']);
        $stmt->bindParam(':Modelo', $data['Modelo']);
        $stmt->bindParam(':Anio', $data['Año']);
        $stmt->bindParam(':Placas', $data['Placas']);
        $stmt->bindParam(':IdAutobus', $id);
        
        return $stmt->execute();
    }

    public function deleteAutobus($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM autobuses WHERE IdAutobus = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function getClases() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM clase";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpleados() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT e.IdEmpleado, u.Nombre, u.Paterno, u.Materno 
                FROM empleados e
                JOIN usuarios u ON e.IdEmpleado = u.IdEmpleado";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA BOLETOS
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getBoletos($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT b.*, 
                eb.Nombre as EstatusBoleto,
                u.Nombre as NombreUsuario, 
                u.Paterno as ApellidoUsuario,
                p.Descuento as DescuentoPromocion,
                v.Precio as PrecioViaje,
                a.NumeroAsiento as NumeroAsiento,
                a.Columna as ColumnaAsiento,
                au.Nombre as NombreAutobus
              FROM boletos b
              LEFT JOIN estatusboleto eb ON b.IdEstatusBoleto = eb.IdEstatusBoleto
              LEFT JOIN usuarios u ON b.IdUsuario = u.IdUsuario
              LEFT JOIN promociones p ON b.IdPromocion = p.IdPromocion
              LEFT JOIN viajes v ON b.IdViaje = v.IdViaje
              LEFT JOIN asientos a ON b.IdAsiento = a.IdAsiento
              LEFT JOIN autobuses au ON a.IdAutobus = au.IdAutobus
              LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countBoletos() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM boletos";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getBoletoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM boletos WHERE IdBoleto = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createBoleto($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO boletos (IdEstatusBoleto, IdUsuario, Nombre, Apellidos, IdPromocion, IdViaje, IdAsiento) 
                VALUES (:IdEstatusBoleto, :IdUsuario, :Nombre, :Apellidos, :IdPromocion, :IdViaje, :IdAsiento)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdEstatusBoleto', $data['IdEstatusBoleto']);
        $stmt->bindParam(':IdUsuario', $data['IdUsuario']);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':Apellidos', $data['Apellidos']);
        $stmt->bindParam(':IdPromocion', $data['IdPromocion']);
        $stmt->bindParam(':IdViaje', $data['IdViaje']);
        $stmt->bindParam(':IdAsiento', $data['IdAsiento']);

        return $stmt->execute();
    }

    public function updateBoleto($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE boletos SET 
                IdEstatusBoleto = :IdEstatusBoleto,
                IdUsuario = :IdUsuario,
                Nombre = :Nombre,
                Apellidos = :Apellidos,
                IdPromocion = :IdPromocion,
                IdViaje = :IdViaje,
                IdAsiento = :IdAsiento
                WHERE IdBoleto = :IdBoleto";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdEstatusBoleto', $data['IdEstatusBoleto']);
        $stmt->bindParam(':IdUsuario', $data['IdUsuario']);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':Apellidos', $data['Apellidos']);
        $stmt->bindParam(':IdPromocion', $data['IdPromocion']);
        $stmt->bindParam(':IdViaje', $data['IdViaje']);
        $stmt->bindParam(':IdAsiento', $data['IdAsiento']);
        $stmt->bindParam(':IdBoleto', $id);
        
        return $stmt->execute();
    }

    public function deleteBoleto($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM boletos WHERE IdBoleto = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function getEstatusBoletos() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estatusboleto";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuarios() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT IdUsuario, CONCAT(Nombre, ' ', Paterno, ' ', Materno) as NombreCompleto 
                FROM usuarios";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPromociones() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM promociones";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getViajes() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT v.IdViaje, 
                    CONCAT(r.NombreRuta, ' - ', DATE_FORMAT(v.FechaSalida, '%d/%m/%Y'), ' ', TIME_FORMAT(v.HoraSalida, '%H:%i')) as DescripcionViaje
                FROM viajes v
                JOIN rutas r ON v.IdRuta = r.IdRuta";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAsientosDisponibles() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT a.IdAsiento, 
                    CONCAT('Asiento ', a.NumeroAsiento, a.Columna, ' - ', au.Nombre) as DescripcionAsiento
                FROM asientos a
                JOIN autobuses au ON a.IdAutobus = au.IdAutobus";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Clase
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getClases1($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT * FROM clase LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countClases() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM clase";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getClaseById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM clase WHERE IdClase = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createClase($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO clase (Nombre, LogoClase) VALUES (:Nombre, :LogoClase)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':LogoClase', $data['LogoClase']);
        
        $result = $stmt->execute();
        
        if($result) {
            return $cnn->lastInsertId();
        }
        
        return false;
    }

    public function updateClase($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE clase SET Nombre = :Nombre";
        
        // Solo actualizar la imagen si se proporciona una nueva
        if(isset($data['LogoClase']) && !empty($data['LogoClase'])) {
            $query .= ", LogoClase = :LogoClase";
        }
        
        $query .= " WHERE IdClase = :IdClase";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        if(isset($data['LogoClase']) && !empty($data['LogoClase'])) {
            $stmt->bindParam(':LogoClase', $data['LogoClase']);
        }
        $stmt->bindParam(':IdClase', $id);
        
        return $stmt->execute();
    }

    public function deleteClase($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        // Primero obtenemos la información de la clase para eliminar la imagen
        $clase = $this->getClaseById($id);
        if($clase && !empty($clase['LogoClase'])) {
            $rutaImagen = $clase['LogoClase'];
            if(file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }
        }
        
        $query = "DELETE FROM clase WHERE IdClase = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function handleImageUpload($file, $idClase = null) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        // Validar extensión del archivo
        if(!in_array($fileExtension, $allowedExtensions)) {
            return ['success' => false, 'message' => 'Solo se permiten archivos JPG, JPEG, PNG o WEBP'];
        }
        
        // Crear directorio si no existe
        $uploadDir = 'view/img/Marcas/MarcaViajes/';
        if(!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Generar nombre del archivo
        $fileName = 'Clase_' . ($idClase ?? 'temp') . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;
        
        // Mover el archivo subido
        if(move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['success' => true, 'path' => $targetPath];
        }
        
        return ['success' => false, 'message' => 'Error al subir la imagen'];
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Empleados
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    public function getEmpleados1($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT e.*, p.Nombre as NombrePuesto, t.Nombre as NombreTerminal 
              FROM empleados e
              LEFT JOIN puesto p ON e.IdPuesto = p.IdPuesto
              LEFT JOIN terminal t ON e.IdTerminal = t.IdTerminal
              LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countEmpleados() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM empleados";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getEmpleadoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM empleados WHERE IdEmpleado = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEmpleado($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO empleados (IdPuesto, IdTerminal) 
                VALUES (:IdPuesto, :IdTerminal)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdPuesto', $data['IdPuesto']);
        $stmt->bindParam(':IdTerminal', $data['IdTerminal']);

        return $stmt->execute();
    }

    public function updateEmpleado($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE empleados SET 
                IdPuesto = :IdPuesto,
                IdTerminal = :IdTerminal
                WHERE IdEmpleado = :IdEmpleado";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdPuesto', $data['IdPuesto']);
        $stmt->bindParam(':IdTerminal', $data['IdTerminal']);
        $stmt->bindParam(':IdEmpleado', $id);
        
        return $stmt->execute();
    }

    public function deleteEmpleado($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM empleados WHERE IdEmpleado = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function getPuestos() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM puesto";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTerminales() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM terminal";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Estados
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    public function getEstados($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM estado LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countEstados() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM estado";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getEstadoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estado WHERE IdEstado = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createEstado($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO estado (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        
        return $stmt->execute();
    }
    
    public function updateEstado($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE estado SET Nombre = :Nombre WHERE IdEstado = :IdEstado";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstado', $id);
        
        return $stmt->execute();
    }
    
    public function deleteEstado($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM estado WHERE IdEstado = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Estadoasientos
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getEstadoAsientos($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM estadoasientos LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countEstadoAsientos() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM estadoasientos";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getEstadoAsientoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estadoasientos WHERE IdEstadoAsiento = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createEstadoAsiento($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO estadoasientos (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        
        return $stmt->execute();
    }
    
    public function updateEstadoAsiento($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE estadoasientos SET Nombre = :Nombre WHERE IdEstadoAsiento = :IdEstadoAsiento";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstadoAsiento', $id);
        
        return $stmt->execute();
    }
    
    public function deleteEstadoAsiento($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM estadoasientos WHERE IdEstadoAsiento = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Estadoasientos
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    public function getEstadoAsientos1($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM estadoasientos LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countEstadoAsientos1() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM estadoasientos";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getEstadoAsientoById1($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estadoasientos WHERE IdEstadoAsiento = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createEstadoAsiento1($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO estadoasientos (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        
        return $stmt->execute();
    }
    
    public function updateEstadoAsiento1($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE estadoasientos SET Nombre = :Nombre WHERE IdEstadoAsiento = :IdEstadoAsiento";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstadoAsiento', $id);
        
        return $stmt->execute();
    }
    
    public function deleteEstadoAsiento1($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM estadoasientos WHERE IdEstadoAsiento = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Estatusboletos
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getEstatusBoleto($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM estatusboleto LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countEstatusBoleto() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM estatusboleto";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getEstatusBoletoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estatusboleto WHERE IdEstatusBoleto = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createEstatusBoleto($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO estatusboleto (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        
        return $stmt->execute();
    }
    
    public function updateEstatusBoleto($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE estatusboleto SET Nombre = :Nombre WHERE IdEstatusBoleto = :IdEstatusBoleto";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstatusBoleto', $id);
        
        return $stmt->execute();
    }
    
    public function deleteEstatusBoleto($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM estatusboleto WHERE IdEstatusBoleto = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA EstadoViajes
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    public function getEstatusViajes($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM estatusviajes LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countEstatusViajes() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM estatusviajes";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getEstatusViajeById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM estatusviajes WHERE IdEstatusViaje = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function createEstatusViaje($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO estatusviajes (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        
        return $stmt->execute();
    }
    
    public function updateEstatusViaje($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE estatusviajes SET Nombre = :Nombre WHERE IdEstatusViaje = :IdEstatusViaje";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstatusViaje', $id);
        
        return $stmt->execute();
    }
    
    public function deleteEstatusViaje($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM estatusviajes WHERE IdEstatusViaje = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA MetodosPago
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------

    public function getMetodosPago($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT * FROM metodospago LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countMetodosPago() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM metodospago";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getMetodoPagoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM metodospago WHERE IdMetodoPago = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMetodoPago($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO metodospago (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);

        return $stmt->execute();
    }

    public function updateMetodoPago($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE metodospago SET Nombre = :Nombre WHERE IdMetodoPago = :IdMetodoPago";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdMetodoPago', $id);
        
        return $stmt->execute();
    }

    public function deleteMetodoPago($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM metodospago WHERE IdMetodoPago = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Modificaciones
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getModificaciones($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT m.*, u.Username as NombreUsuario, o.Nombre as NombreOperacion 
              FROM modificaciones m
              LEFT JOIN usuarios u ON m.IdUsuario = u.IdUsuario
              LEFT JOIN operaciones o ON m.IdOperacion = o.IdOperacion
              LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countModificaciones() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM modificaciones";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getModificacionById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM modificaciones WHERE IdModificaciones = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createModificacion($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO modificaciones (TablaAfectada, IdOperacion, IdUsuario, Fecha_Hora, Descripcion) 
                VALUES (:TablaAfectada, :IdOperacion, :IdUsuario, :Fecha_Hora, :Descripcion)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':TablaAfectada', $data['TablaAfectada']);
        $stmt->bindParam(':IdOperacion', $data['IdOperacion']);
        $stmt->bindParam(':IdUsuario', $data['IdUsuario']);
        $stmt->bindParam(':Fecha_Hora', $data['Fecha_Hora']);
        $stmt->bindParam(':Descripcion', $data['Descripcion']);

        return $stmt->execute();
    }

    public function updateModificacion($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE modificaciones SET 
                TablaAfectada = :TablaAfectada,
                IdOperacion = :IdOperacion,
                IdUsuario = :IdUsuario,
                Fecha_Hora = :Fecha_Hora,
                Descripcion = :Descripcion
                WHERE IdModificaciones = :IdModificaciones";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':TablaAfectada', $data['TablaAfectada']);
        $stmt->bindParam(':IdOperacion', $data['IdOperacion']);
        $stmt->bindParam(':IdUsuario', $data['IdUsuario']);
        $stmt->bindParam(':Fecha_Hora', $data['Fecha_Hora']);
        $stmt->bindParam(':Descripcion', $data['Descripcion']);
        $stmt->bindParam(':IdModificaciones', $id);
        
        return $stmt->execute();
    }

    public function deleteModificacion($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM modificaciones WHERE IdModificaciones = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function getUsuarios1() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT IdUsuario, Username FROM usuarios";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOperaciones() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM operaciones";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Municipios
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
    public function getMunicipios($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();

        $offset = ($page - 1) * $perPage;
        $query = "SELECT m.*, e.Nombre AS NombreEstado 
                FROM municipio m 
                LEFT JOIN estado e ON m.IdEstado = e.IdEstado 
                LIMIT :offset, :perPage";

        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countMunicipios() {
        include_once("conexion.php");
        $cnn = new Conexion();
        $query = "SELECT COUNT(*) as total FROM municipio";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getMunicipioById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        $query = "SELECT * FROM municipio WHERE IdMunicipio = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createMunicipio($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        $query = "INSERT INTO municipio (Nombre, IdEstado) VALUES (:Nombre, :IdEstado)";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstado', $data['IdEstado']);
        return $stmt->execute();
    }

    public function updateMunicipio($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        $query = "UPDATE municipio SET Nombre = :Nombre, IdEstado = :IdEstado WHERE IdMunicipio = :IdMunicipio";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdEstado', $data['IdEstado']);
        $stmt->bindParam(':IdMunicipio', $id);
        return $stmt->execute();
    }

    public function deleteMunicipio($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        $query = "DELETE FROM municipio WHERE IdMunicipio = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getEstados1() {
        include_once("conexion.php");
        $cnn = new Conexion();
        $query = "SELECT * FROM estado";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------


    //CRUD TABLA Operaciones
    //------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------
        public function getOperaciones1($page = 1, $perPage = 10) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM operaciones LIMIT :offset, :perPage";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countOperaciones() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM operaciones";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getOperacionById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM operaciones WHERE IdOperacion = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createOperacion($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO operaciones (Nombre) VALUES (:Nombre)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);

        return $stmt->execute();
    }

    public function updateOperacion($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE operaciones SET Nombre = :Nombre WHERE IdOperacion = :IdOperacion";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':Nombre', $data['Nombre']);
        $stmt->bindParam(':IdOperacion', $id);
        
        return $stmt->execute();
    }

    public function deleteOperacion($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM operaciones WHERE IdOperacion = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    //----------------------------------------------
    public function getPagos($page = 1, $perPage = 10) {
    include_once("conexion.php");
    $cnn = new Conexion();
    
    $offset = ($page - 1) * $perPage;
    $query = "SELECT p.*, 
                b.IdBoleto as BoletoId,
                CONCAT(u.Nombre, ' ', u.Paterno) as NombreUsuario,
                mp.Nombre as MetodoPago,
                DATE_FORMAT(p.FechaPago, '%d/%m/%Y') as FechaFormateada
              FROM pagos p
              LEFT JOIN boletos b ON p.IdBoleto = b.IdBoleto
              LEFT JOIN usuarios u ON b.IdUsuario = u.IdUsuario
              LEFT JOIN metodospago mp ON p.IdMetodoPago = mp.IdMetodoPago
              LIMIT :offset, :perPage";
    
    $stmt = $cnn->prepare($query);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPagos() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT COUNT(*) as total FROM pagos";
        $stmt = $cnn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getPagoById($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM pagos WHERE IdPago = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPago($data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "INSERT INTO pagos (IdBoleto, FechaPago, Monto, IdMetodoPago) 
                VALUES (:IdBoleto, :FechaPago, :Monto, :IdMetodoPago)";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdBoleto', $data['IdBoleto']);
        $stmt->bindParam(':FechaPago', $data['FechaPago']);
        $stmt->bindParam(':Monto', $data['Monto']);
        $stmt->bindParam(':IdMetodoPago', $data['IdMetodoPago']);

        return $stmt->execute();
    }

    public function updatePago($id, $data) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "UPDATE pagos SET 
                IdBoleto = :IdBoleto,
                FechaPago = :FechaPago,
                Monto = :Monto,
                IdMetodoPago = :IdMetodoPago
                WHERE IdPago = :IdPago";
        
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':IdBoleto', $data['IdBoleto']);
        $stmt->bindParam(':FechaPago', $data['FechaPago']);
        $stmt->bindParam(':Monto', $data['Monto']);
        $stmt->bindParam(':IdMetodoPago', $data['IdMetodoPago']);
        $stmt->bindParam(':IdPago', $id);
        
        return $stmt->execute();
    }

    public function deletePago($id) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "DELETE FROM pagos WHERE IdPago = :id";
        $stmt = $cnn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function getBoletos1() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT b.IdBoleto, 
                    CONCAT(u.Nombre, ' ', u.Paterno, ' - Viaje ', v.IdViaje) as DescripcionBoleto
                FROM boletos b
                JOIN usuarios u ON b.IdUsuario = u.IdUsuario
                JOIN viajes v ON b.IdViaje = v.IdViaje";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMetodosPago1() {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $query = "SELECT * FROM metodospago";
        $stmt = $cnn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>