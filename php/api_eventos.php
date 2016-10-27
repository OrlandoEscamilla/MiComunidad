<?php
include("conexion.php");

$query = $conexion->prepare("SELECT * FROM eventos");
if($query->execute()){
    echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
}