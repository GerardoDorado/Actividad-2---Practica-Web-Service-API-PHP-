<?php
    include("conexion_PDO.php");
    $conexionPDO = conexionPDO("user", "password", "escuela_web");
    $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        
    $json = file_get_contents('php://input');
    $datos=json_decode($json);

    if(isset($datos)){
        $nm = $datos->numControl;
        $n = $datos->nombre;
        $pA = $datos->primerAp;
        $sA = $datos->segundoAp;
        $e = $datos->edad;
        $s = $datos->semestre; 
        $c = $datos->carrera;
        
        $consulta = "UPDATE alumnos SET nombre = ?, primerAP =  ?, segundoAP = ?, edad = ?, semestre = ?, 
                    carrera = ? WHERE numControl = ?";
        
        $sentencia = $conexionPDO->prepare($consulta);
        $sentencia->execute([$n, $pA, $sA, $e, $s, $c, $nm]);

        $sentencia = null;

        echo json_encode("¡Datos modificados correctamente!");
    }else{
        echo json_encode("¡Datos no modificados!");
    }    
?>