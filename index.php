<?php
require_once "clases/conexion/conexion.php";

$conexion =new conexion; 

/*instancia para obtener los datos de la bd 
$query = "select *from pacientes";
print_r($conexion->obtenerDatos($query));
*/

/*instancia para hacer unn insert 
$query = "INSERT INTO pacientes (DNI)value('0')";
print_r($conexion->nonQuery($query));
*/

/*instancia para hacer un insert que devuelve la fila 
$query = "INSERT INTO pacientes (DNI)value('0')";
print_r($conexion->nonQueryId($query));
*/
?>