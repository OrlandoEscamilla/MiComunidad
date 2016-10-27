<?php
require("conexion.php");
$usuario = array();

$query = $conexion->prepare("SELECT nombre, email, telefono FROM usuarios WHERE id = :id");
$query->bindParam(":id", $_POST['id']);
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $usuario[] = array("nombre"=>$row['nombre'],
                       "email"=>$row['email'],
                       "telefono"=>$row['telefono'],
                       "mensaje"=>"Registro exitoso");
}

echo json_encode($usuario);