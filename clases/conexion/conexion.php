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

    //esto para convertir caracteres a utf8 y no tenga problema con las ñ y las tildes
    //los registros los convertira a utf8
    private function convertirUTF8($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,'utf-8',true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    
    }
    //obtengo los objetos de la base de datos 
    public function obtenerDatos($sqlstr){
        $results = $this->conexion->query($sqlstr);
        $resultArray = array();
        foreach ($results as $key) {
            $resultArray[] = $key;
        }
        return $this->convertirUTF8($resultArray);
    }

    //metodo para guardar 
    public function nonQuery($sqlstr){
        $results = $this->conexion->query($sqlstr);
        return $this->conexion->affected_rows;
    }

     //guardar y nos devuelve el id de lo guardado 
     public function nonQueryId($sqlstr){
        $results = $this->conexion->query($sqlstr);
         $filas = $this->conexion->affected_rows;
         if($filas >= 1){
             //si hay fila afectada me devuelve este id
            return $this->conexion->insert_id;
         }else{
             return 0;
         }
    }
      //encriptar

      protected function encriptar($string){
        return md5($string);
    }

     

}
