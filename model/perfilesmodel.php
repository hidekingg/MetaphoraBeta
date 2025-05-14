<?php

class Usuarios{
    private $listaUsuario;

    public function __construct() {
        $this->listaUsuario = array();
    }
    public function mostrarUsuarios(){

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        include_once("conexion.php");
        $Username = $_SESSION['Username'];
        $cnn=new Conexion();
        $consulta="SELECT * FROM usuarios WHERE Username = '$Username'";
        $resultado = $cnn->prepare($consulta);  
        $resultado->execute();
        while ($row = $resultado->fetchAll(PDO::FETCH_ASSOC)) {
            $this->listaUsuario[]=$row;
        }
        return $this->listaUsuario;    
    }

    public function MostrarDatos(){
        require_once("conexion.php");
        $cnn = new Conexion();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $Usuario = $_SESSION["IdUsuario"];

        
        $consulta = "SELECT 
        u.FotoPerfil,
        u.Nombre,
        u.Paterno,
        u.Materno,
        u.Edad,
        u.Sexo,
        u.Pais AS IdPais,
        u.Estado AS IdEstado,
        u.Municipio AS IdMunicipio,
        p.Nombre AS Pais,
        e.Nombre AS Estado,
        m.Nombre AS Municipio,
        u.Direccion,
        u.CP,
        u.Telefono
        FROM 
            usuarios u
        LEFT JOIN 
            pais p ON u.Pais = p.IdPais
        LEFT JOIN 
            estado e ON u.Estado = e.IdEstado
        LEFT JOIN 
            municipio m ON u.Municipio = m.IdMunicipio
        WHERE 
            u.IdUsuario = '$Usuario';";    
        
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarDatosUsuario($datos)
    {
        require_once("conexion.php");
        $cnn = new Conexion();
        $consulta = "UPDATE usuarios SET 
                    Nombre = ?, 
                    Paterno = ?, 
                    Materno = ?, 
                    Edad = ?, 
                    Sexo = ?, 
                    Pais = ?, 
                    Estado = ?, 
                    Municipio = ?, 
                    Direccion = ?, 
                    CP = ?, 
                    Telefono = ?" .
                    ($datos['FotoPerfil'] ? ", FotoPerfil = ?" : "") . 
                " WHERE IdUsuario = ?";

        $resultado = $cnn->prepare($consulta);

        $parametros = [
            $datos['Nombre'],
            $datos['Paterno'],
            $datos['Materno'],
            $datos['Edad'],
            $datos['Sexo'],
            $datos['IdPais'],
            $datos['IdEstado'],
            $datos['IdMunicipio'],
            $datos['Direccion'],
            $datos['CP'],
            $datos['Telefono'],
        ];

        if ($datos['FotoPerfil']) {
            $parametros[] = $datos['FotoPerfil'];
        }

        $parametros[] = $datos['IdUsuario'];

        return $resultado->execute($parametros);
    }


}

class Paises{
    private $listaPaises;

    public function __construct() {
        $this->listaPaises = array();
    }
    public function mostrarPaises(){
        include_once("conexion.php");
        $cnn=new Conexion();
        $consulta="SELECT IdPais, Nombre FROM pais ORDER BY IdPais";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        $this->listaPaises = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $this->listaPaises;
    }

}

class Estados{
    private $listaEstados;

    public function __construct() {
        $this->listaEstados = array();
    }
    public function mostrarEstados(){
        include_once("conexion.php");
        $cnn=new Conexion();
        $consulta="SELECT IdEstado, Nombre, IdPais FROM estado ORDER BY IdEstado";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        $this->listaEstados = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $this->listaEstados;   
    }
}

class Municipios{
    private $listaMunicipios;

    public function __construct() {
        $this->listaMunicipios = array();
    }
    public function mostrarMunicipios(){
        include_once("conexion.php");
        $cnn=new Conexion();
        $consulta="SELECT IdMunicipio, Nombre, IdEstado FROM municipio ORDER BY IdMunicipio";
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        $this->listaMunicipios = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $this->listaMunicipios;   
    }
}

class BoletosUsuarios{
    public function MostrarViajes(){
        include_once("conexion.php");
        $cnn = new Conexion();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $Usuario = $_SESSION["IdUsuario"];

        
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
            b.Idusuario = '$Usuario'
        AND b.IdEstatusBoleto = 1;";    
        
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDatosBoletos($idBoleto)
    {
        include_once("conexion.php");
        $cnn = new Conexion();
        
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
            b.IdBoleto = '$idBoleto';";
        
        $resultado = $cnn->prepare($consulta);
        $resultado->execute();
        
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>