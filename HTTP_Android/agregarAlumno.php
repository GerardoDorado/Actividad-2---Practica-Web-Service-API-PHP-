<?php
include("conexion_PDO.php");
$json = file_get_contents('php://input');
$datos = json_decode($json);

if (isset($datos)) {

    $nm = $datos->numControl;
    $n = $datos->nombre;
    $pA = $datos->primerAp;
    $sA = $datos->segundoAp;
    $s = $datos->semestre;
    $e = $datos->edad;
    $c = $datos->carrera;

    $conexionPDO = conexionPDO("user", "password", "escuela_web");
    $conexionPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $consulta = "SELECT COUNT(*) FROM alumnos WHERE numControl LIKE ?;";

    $sentencia = $conexionPDO->prepare($consulta);
    $sentencia->execute([$nm]);

    $cons = $sentencia->fetch(PDO::FETCH_ASSOC);
    $a1 = $cons["COUNT(*)"];
    $sentencia = null;

    if (!($a1 >= 1)) {
        $sql = "INSERT INTO alumnos (numControl, nombre, primerAp, segundoAp, edad, semestre, carrera) 
                    VALUES(?,?,?,?,?,?,?);";

        $sqlPreparado = $conexionPDO->prepare($sql);
        $sqlPreparado->execute([$nm, $n, $pA, $sA, $s, $e, $c]);
        $sqlPreparado = null;

        echo json_encode("¡Datos insertados correctamente!");
    } else {
        echo json_encode("¡Datos no insertados!");
    }
} else {
    echo json_encode("¡No llegaron los datos!");
}
