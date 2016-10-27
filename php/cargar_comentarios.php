<?php
require("conexion.php");
$resultado = array();
$query = $conexion->prepare("SELECT * FROM evaluaciones WHERE nombre_profesor = :nombre AND estado = 2");
$query->bindParam(":nombre", $_POST['nombre']);
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $resultado[] = array("asistencia"=>$row['asistencia'],
                         "conocimiento"=>$row['conocimiento'],
                         "exigencia"=>$row['exigencia'],
                         "evaluacion"=>$row['evaluacion']);
}
echo json_encode($resultado);