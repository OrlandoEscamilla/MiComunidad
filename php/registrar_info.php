<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../index.php");
}

try {
    switch($_POST['tipo']){
        case "asesoria":

            $asesoria_existente = $conexion->prepare("SELECT * FROM asesorias WHERE id_usuario = :id AND materia = :materia");
            $asesoria_existente->bindParam(":id", $_POST['id']);
            $asesoria_existente->bindParam(":materia", $_POST['materia']);
            $asesoria_existente->execute();

            if($asesoria_existente->rowCount() != 0){
                $respuesta = array("mensaje" => "Ya eres asesor de ".$_POST['materia'].".");
            } else {
                $query = $conexion->prepare(
                    "call registrar_asesoria(:id, :carrera, :materia, :dominio, :costo, :descripcion, NOW())"
                );
                $query->bindParam(":id", $_POST['id']);
                $query->bindParam(":carrera", $_POST['carrera']);
                $query->bindParam(":materia", $_POST['materia']);
                $query->bindParam(":dominio", $_POST['dominio']);
                $query->bindParam(":costo", $_POST['costo']);
                $query->bindParam(":descripcion", $_POST['descripcion']);
                $query->execute();

                if($query->rowCount() == 1){
                    $respuesta = array("mensaje" => "Registro de comentario exitoso");
                } else {
                    $respuesta = array("mensaje" => "Registro de comentario fallido");
                }
            }
            break;
        case "evaluacion":

            $prev_comment = $conexion->prepare("SELECT * FROM evaluaciones WHERE id_usuario = :id AND nombre_profesor = :nombre"); 
            $prev_comment->bindParam(":id", $_POST['id']);
            $prev_comment->bindParam(":nombre", $_POST['nombre']);
            $prev_comment->execute();

            if($prev_comment->rowCount() != 0){
                $respuesta = array("mensaje" => "Ya haz calificado a este profesor.");
            } else {
                $query = $conexion->prepare(
                    "call registrar_evaluacion(:id, :nombre, :asistencia, :conocimiento, :exigencia, :evaluacion, NOW())"
                );
                $query->bindParam(":id", $_POST['id']);
                $query->bindParam(":nombre", $_POST['nombre']);
                $query->bindParam(":asistencia", $_POST['asistencia']);
                $query->bindParam(":conocimiento", $_POST['conocimiento']);
                $query->bindParam(":exigencia", $_POST['exigencia']);
                $query->bindParam(":evaluacion", $_POST['evaluacion']);
                $query->execute();

                if($query->rowCount() == 1){
                    $respuesta = array("mensaje" => "Registro de asesoria exitoso");
                } else {
                    $respuesta = array("mensaje" => "Registro de asesoria fallido");
                }
            }
            break;
    }
    echo json_encode($respuesta);

} catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}













