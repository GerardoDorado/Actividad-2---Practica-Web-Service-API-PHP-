<?php
    include("conexion_PDO.php");
    
    $json = file_get_contents('php://input');
    $datos=json_decode($json);

    if(isset($datos)){
        $numeroControl = $datos->numControl;
        
        $conexionPDO = conexionPDO("user", "password", "escuela_web");
        $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        $consulta = "DELETE FROM alumnos WHERE numControl = ?;";
        
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$numeroControl]);

        $sentencia = null;

        echo json_encode("¡Datos eliminados correctamente!");
    }else{
        echo json_encode("¡Datos no eliminados!");
    }
