<?php
session_start();
include("conexion.php");

$msg = "";
$uploadedfileload = "true";
$uploadedfile_size = $_FILES['imagen_perfil']['size'];

if ($_FILES['imagen_perfil']['size'] > 300000) {
    $msg = $msg . "El archivo es mayor que 300KB, debes reduzcirlo antes de subirlo<BR>";
    $uploadedfileload = "false";
}

if (!($_FILES['imagen_perfil']['type'] == "image/jpeg" OR $_FILES['imagen_perfil']['type'] == "image/gif")) {
    $msg = $msg . " Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
    $uploadedfileload = "false";
} else {
    if ($_FILES['imagen_perfil']['type'] == "image/jpeg") {
        $_FILES['imagen_perfil']['name'] = "usuario_" . $_SESSION['id'] . ".jpg";
    } else if ($_FILES['imagen_perfil']['type'] == "image/gif") {
        $_FILES['imagen_perfil']['name'] = "usuario_" . $_SESSION['id'] . ".gif";
    }
}

//echo "New name: " . $_FILES['imagen_perfil']['name'];

$file_name = $_FILES['imagen_perfil']['name'];
$add = "../images/$file_name";
$ruta = "images/$file_name";

if ($uploadedfileload == "true") {
    if (move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $add)) {
        //echo " Ha sido subido satisfactoriamente";

        $query = $conexion->prepare("UPDATE usuarios set ruta_imagen = :ruta WHERE id = " . $_SESSION['id']);
        $query->bindParam(":ruta", $ruta);
        if ($query->execute()) {
            //echo "Actualización BD exitosa.";
            $_SESSION['foto_perfil'] = $ruta;
            echo json_encode(array("status" => "OK", "mensaje" => "Se ha cambiado tu imagen de perfil"));
        }
    } else {
        echo json_encode(array("status" => "OK", "mensaje" => "Error al subir el archivo"));
    }
} else {
    echo $msg;
}