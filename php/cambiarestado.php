<?php
require("conexion.php");

if($_SERVER['REQUEST_METHOD'] == "GET"){

    $page="perfil";

    if($_GET['tipo'] == "asesoria"){
        $id = $_GET['id'];
        $query = $conexion->prepare("UPDATE asesorias SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->bindParam(":estado", $_GET['nuevoestado']);
        $query->execute();

        if($query->rowCount() == 1){
            echo "<script>console.log('Actualización exitosa.')</script>";
        }   
    } else if($_GET['tipo'] == "evaluacion"){
        $id = $_GET['id'];
        $query = $conexion->prepare("UPDATE evaluaciones SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->bindParam(":estado", $_GET['nuevoestado']);
        $query->execute();

        if($query->rowCount() == 1){
            echo "<script>console.log('Actualización exitosa.')</script>";
        }   
    } else if($_GET['tipo'] == "profesor"){
        $id = $_GET['id'];
        $query = $conexion->prepare("UPDATE profesores SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->bindParam(":estado", $_GET['nuevoestado']);
        $query->execute();

        if($query->rowCount() == 1){
            echo "<script>console.log('Actualización exitosa.')</script>";
        }
        $page = "admin";
    } else if($_GET['tipo'] == "pub_evaluacion"){
        $id = $_GET['id'];
        $query = $conexion->prepare("UPDATE evaluaciones SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->bindParam(":estado", $_GET['nuevoestado']);
        $query->execute();

        if($query->rowCount() == 1){
            echo "<script>console.log('Actualización exitosa.')</script>";
        }
        $page = "admin";
    } else if($_GET['tipo'] == "pub_asesoria"){
        $id = $_GET['id'];
        $query = $conexion->prepare("UPDATE asesorias SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->bindParam(":estado", $_GET['nuevoestado']);
        $query->execute();

        if($query->rowCount() == 1){
            echo "<script>console.log('Actualización exitosa.')</script>";
        }
        $page = "admin";
    }

    header("Location: ../$page.php");
}