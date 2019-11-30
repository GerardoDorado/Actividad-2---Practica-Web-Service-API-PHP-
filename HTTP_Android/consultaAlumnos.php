<?php
    include("conexion_PDO.php");
    
    $conexionPDO = conexionPDO("user", "password", "escuela_web");
    $query = "SELECT * FROM alumnos;";

    $sentencia = $conexionPDO->prepare($query);
    $sentencia->execute([]);
    
    $resultadoConsulta = array();
    
    while ($row = $sentencia->fetch(PDO::FETCH_ASSOC)) { 
        $resultadoConsulta[] = $row; 
    }

    $sentencia = null;
    echo json_encode($resultadoConsulta);
    
?>