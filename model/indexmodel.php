<?php
class Promociones{
    private $listaPromociones;

    public function __construct() {
        $this->listaPromociones = array();
    }
    public function mostrarUltimosPromociones(){
        include_once("conexion.php");
        $cnn=new Conexion();
        $consulta="SELECT Condiciones, ImagenPromocion FROM promociones
        WHERE activo = 1 Order by IdPromocion DESC LIMIT 6";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        while ($row = $resultado->fetchAll(PDO::FETCH_ASSOC)) {
            $this->listaPromociones[]=$row;
        }
        return $this->listaPromociones;    
    }
}

class Terminales{
    private $listaTerminales;

    public function __construct() {
        $this->listaTerminales = array();
    }
    public function mostrarTerminales(){
        include_once("conexion.php");
        $cnn=new Conexion();
        $consulta="SELECT IdTerminal, Nombre FROM terminal ORDER BY Nombre";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        while ($row = $resultado->fetchAll(PDO::FETCH_ASSOC)) {
            $this->listaTerminales[]=$row;
        }
        return $this->listaTerminales;    
    }
}

class Index{
    private $usuarios;
    public function __construct() {
        $this->usuarios = array();
    }

    public function autentificacion($Username,$password){
        include_once("conexion.php");
        $cnn=new Conexion();
        $consulta="SELECT * FROM usuarios WHERE Username = '$Username' AND Password = '$password'";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        while ($row = $resultado->fetchAll(PDO::FETCH_ASSOC)) {
            $this->usuarios[]=$row;
        }
        return $this->usuarios;    
    }

    public function registrarse($Username1,$password1){
        include_once("conexion.php");
        $cnn=new Conexion();

        if ($this->verificarEmail($Username1)) {
            return "email_existente";
        }

        $consulta="INSERT INTO usuarios(Username,Password, FotoPerfil,
        IdRol)VALUES('$Username1','$password1','view/img/Usuarios/Default.png',1)";
        $resultado=$cnn->prepare($consulta);
        $resultado->execute();
        if($resultado){
            return true;
        }
        else{
            return false;
        }   
    }

    public function verificarEmail($Username1) {
        include_once("conexion.php");
        $cnn = new Conexion();
        $consulta = "SELECT COUNT(*) as count FROM usuarios WHERE Username LIKE ?";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute([$Username1]);
        $row = $resultado->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    }
}

class Boletos {
    private $Boletos;

    public function __construct() {
        $this->Boletos = array();
    }

    public function VistaPreviaViaje(){
        include_once("conexion.php");
        $cnn = new Conexion();
        $Viaje = $_SESSION['id_viaje'];
        
        $consulta = "SELECT 
            t_origen.Nombre AS TerminalOrigen,
            t_destino.Nombre AS TerminalDestino,
            v.FechaSalida,
            v.HoraSalida,
            v.IdViaje
        FROM 
            viajes v
        JOIN 
            rutas r ON v.IdRuta = r.IdRuta
        JOIN 
            terminal t_origen ON r.IdTerminalOrigen = t_origen.IdTerminal
        JOIN 
            terminal t_destino ON r.IdTerminalDestino = t_destino.IdTerminal
        WHERE 
            v.IdViaje = '$Viaje';";
    
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
    
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function VistaAsiento(){
        include_once("conexion.php");
        $cnn = new Conexion();
        
        // Obtener los asientos seleccionados de la sesión
        $asientosSeleccionados = $_SESSION['asientos_seleccionados'];
        
        // Verificar si hay asientos seleccionados
        if(empty($asientosSeleccionados)) {
            return array(); // Retornar arreglo vacío si no hay selección
        }
        
        // Crear marcadores de posición para la consulta preparada
        $placeholders = implode(',', array_fill(0, count($asientosSeleccionados), '?'));
        
        $consulta = "SELECT 
            IdAsiento,
            NumeroAsiento,
            Columna
        FROM 
            asientos
        WHERE 
            IdAsiento IN ($placeholders)";
        
        $resultado = $cnn->prepare($consulta);
        
        // Ejecutar la consulta con los valores de los asientos
        $resultado->execute($asientosSeleccionados);
        
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardarBoletos($idViaje, $pasajeros) {
        include_once("conexion.php");
        $cnn = new Conexion();
        $idsBoletos = [];
        $usuario = $_SESSION["IdUsuario"];
        
        try {
            $cnn->beginTransaction();
            
            foreach ($pasajeros as $pasajero) {
                $sql = "INSERT INTO boletos 
                        (IdEstatusBoleto, IdUsuario, IdViaje, IdAsiento, Nombre, Apellidos) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = $cnn->prepare($sql);
                $stmt->execute([
                    1,
                    $usuario,
                    $idViaje,
                    $pasajero['id_asiento'],
                    $pasajero['nombre'],
                    $pasajero['apellido'],
                ]);

                $idsBoletos[] = $cnn->lastInsertId();
            }
            
            $cnn->commit();
            return $idsBoletos;
            
        } catch (PDOException $e) {
            $cnn->rollBack();
            error_log("Error al guardar boletos: " . $e->getMessage());
            return false;
        }
    }

    public function AsientosOcupado($pasajeros) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        try {
            $cnn->beginTransaction();
            
            foreach ($pasajeros as $pasajero) {
                $sql = "UPDATE asientos SET
                        IdEstadoAsiento = 2
                        WHERE IdAsiento = ?";
                
                $stmt = $cnn->prepare($sql);
                $stmt->execute([
                    $pasajero['id_asiento'],
                ]);
            }
            
            $cnn->commit();
            return true;
            
        } catch (PDOException $e) {
            $cnn->rollBack();
            error_log("Error al actualizar estado de asientos: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerDatosBoletos($idsBoletos)
    {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        // Convertir array de IDs a string para la consulta
        $placeholders = implode(',', array_fill(0, count($idsBoletos), '?'));
        
        $consulta = "SELECT 
            b.IdBoleto,
            b.Nombre,
            b.Apellidos,
            t_origen.Nombre AS TerminalOrigen,
            t_destino.Nombre AS TerminalDestino,
            a.NumeroAsiento,
            a.Columna,
            v.FechaSalida,
            v.HoraSalida,
            v.Precio,
            v.IdAutobus,
            b.IdViaje
        FROM 
            boletos b
        JOIN usuarios u ON b.IdUsuario = u.IdUsuario
        JOIN viajes v ON b.IdViaje = v.IdViaje
        JOIN rutas r ON v.IdRuta = r.IdRuta
        JOIN terminal t_origen ON r.IdTerminalOrigen = t_origen.IdTerminal
        JOIN terminal t_destino ON r.IdTerminalDestino = t_destino.IdTerminal
        JOIN asientos a ON b.IdAsiento = a.IdAsiento
        WHERE 
            b.IdBoleto IN ($placeholders)";
        
        $resultado = $cnn->prepare($consulta);
        $resultado->execute($idsBoletos);
        
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}

class Viajes {
    private $Viajes;

    public function __construct() {
        $this->Viajes = array();
    }

    public function BuscarViajes($origen, $destino, $fecha) {
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $consulta = "SELECT 
            c.LogoClase,
            r.IdRuta,
            tor.Nombre AS TerminalOrigen,
            tdes.Nombre AS TerminalDestino,
            v.FechaSalida,
            v.Precio,
            v.FechaLlegada,
            v.HoraSalida,
            v.HoraLlegada,
            v.IdViaje
        FROM 
            viajes v
        JOIN 
            rutas r ON v.IdRuta = r.IdRuta
        JOIN 
            terminal tor ON r.IdTerminalOrigen = tor.IdTerminal
        JOIN 
            terminal tdes ON r.IdTerminalDestino = tdes.IdTerminal
        JOIN 
            autobuses a ON v.IdAutobus = a.IdAutobus
        LEFT JOIN 
            clase c ON a.IdClase = c.IdClase
        WHERE 
            r.IdTerminalOrigen = :origen
            AND r.IdTerminalDestino = :destino
            AND v.FechaSalida = :fecha
            AND v.IdEstatusViaje = 1;";
    
        $resultado = $cnn->prepare($consulta);
        $resultado->bindParam(':origen', $origen);
        $resultado->bindParam(':destino', $destino);
        $resultado->bindParam(':fecha', $fecha);
        $resultado->execute();
    
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarAsientos($Viaje){
        include_once("conexion.php");
        $cnn = new Conexion();

        $consulta = "SELECT v.IdViaje, a.IdAsiento, a.IdAutobus, a.NumeroAsiento, a.Columna, a.IdTipoAsiento, a.IdEstadoAsiento
        FROM 
            asientos a
        JOIN 
            viajes v ON a.IdAutobus = v.IdAutobus
        WHERE 
            v.IdViaje = :Viaje;";

        $resultado = $cnn->prepare($consulta);
        $resultado->bindParam(':Viaje', $Viaje);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }

}

class MapaTerminales{
    private $listaMapaTerminales;

    public function __construct() {
        $this->listaMapaTerminales = array();
    }
    public function mostrarMapaTerminales(){
        include_once("conexion.php");
        $cnn = new Conexion();
        
        $consulta = "SELECT 
            t.Nombre, 
            t.ImgTerminal, 
            t.Coordenadas, 
            CONCAT(
                t.Direccion,', ',
                t.CP,', ',
                m.Nombre,', ',
                e.Nombre,', ',
                p.Nombre
            ) AS DireccionCompleta 
        FROM 
            `terminal` t
        LEFT JOIN 
            `municipio` m ON t.`Municipio` = m.`IdMunicipio`
        LEFT JOIN 
            `estado` e ON m.`IdEstado` = e.`IdEstado`
        LEFT JOIN 
            `pais` p ON e.`IdPais` = p.`IdPais`;";
        
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
