<?php
include("conexion_PDO.php");
$json = file_get_contents('php://input');
$datos = json_decode($json);
$respuesta=array();

if (isset($datos)) {
    $carrera=$datos->c;

    $conexionPDO = conexionPDO("user", "password", "escuela_web");
    $query = "SELECT * FROM alumnos WHERE carrera LIKE ?;";

    $sentencia = $conexionPDO->prepare($query);
    $sentencia->execute([$carrera]);
    
    $resultadoConsulta = array();
    
    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) { 
        $resultadoConsulta[] = $row; 
    }

    $sentencia = null;

    echo json_encode($resultadoConsulta);
   
}else{
    $respuesta['exito']=0;
    $respuesta['msj']="Busqueda incorrecta";
    json_encode($respuesta);
}