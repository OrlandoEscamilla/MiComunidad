<?php

require("conexion.php");
$id = $_GET['id'];

$query = $conexion->prepare("DELETE FROM persona WHERE id = :id");
$query->bindParam(":id", $id, PDO::PARAM_INT);
$query->execute();

header("Location: ../servicios.php");
