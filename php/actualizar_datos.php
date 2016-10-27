<?php
require("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../index.php");
} else {

    if($_POST['tipo'] == "asesoria"){
        $query = $conexion->prepare("UPDATE asesorias SET dominio = :dominio, costo = :costo, descripcion = :descripcion WHERE id = :id");
        $query->bindParam(":dominio", $_POST['dominio']);
        $query->bindParam(":costo", $_POST['costo']);
        $query->bindParam(":descripcion", $_POST['descripcion']);
        $query->bindParam(":id", $_POST['id']);
        $query->execute();

        if($query->rowCount() == 1){
            $respuesta = array("mensaje"=>"Registro exitoso");
        } else {
            $respuesta = array("mensaje"=>"Registro fallido");
        }

    } else if($_POST['tipo'] == "evaluacion"){
        $query = $conexion->prepare("UPDATE evaluaciones SET evaluacion = :evaluacion, estado = 1 WHERE id = :id");
        $query->bindParam(":evaluacion", $_POST['evaluacion']);
        $query->bindParam(":id", $_POST['id']);
        $query->execute();

        if($query->rowCount() > 0){
            $respuesta = array("mensaje"=>"Registro exitoso");
        } else {
            $respuesta = array("mensaje"=>"Registro fallido");
        }
    }
}
echo json_encode($respuesta);
