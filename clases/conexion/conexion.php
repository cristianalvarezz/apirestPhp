<?php


class conexion
{
// atributos de la base de datos
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;

    //primera funcion que se ejecuta y no hace falta volverla a llamar
    function __construct(){
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }
        $this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
        if($this->conexion->connect_errno){
            echo "algo va mal con la conexion";
            die();
        }
    }

    //direccion donde obtengo todos los datos de las variables para la conexion a la base de datos 
    private function datosConexion(){
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . "/" . "config");
        return json_decode($jsondata, true);
    }
}
