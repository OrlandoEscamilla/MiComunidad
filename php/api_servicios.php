<?php
session_start();
require("../../conexion.php");
require_once "recaptchalib.php";

$servicio = isset($_POST['servicio']) ? $_POST['servicio'] : $_GET['servicio'];
switch ($servicio) {
    case "asesores":
        $query = $conexion->prepare("SELECT nombre, materia, descripcion, costo, email FROM view_asesores WHERE estado = 2");
        if ($query->execute()) {
            $asesorias = $query->fetchAll(PDO::FETCH_NUM);
            //$response = array("status"=>"ok", "datos"=>$asesorias);
            echo json_encode(array("asesorias" => $asesorias));
        }
        break;
    case "profesores":
        $columnas = array(
            array(
                "title" => "id",
                "width" => "0%",
                "visible" => false,
                "className" => "classId"
            ),
            array(
                "title" => "Nombre",
                "width" => "70%"
            ),
            array(
                "title" => "Comentarios",
                "width" => "15%"
            ),
            array(
                "title" => "Evaluar",
                "width" => "15%"
            )
        );
        $table = "(SELECT id, nombre, CONCAT('<a data-id=',id,' class=\'cargarComentario btn btn-success btn-sm\'><i class=\'fa fa-eye\'></i></a>') as comentario, CONCAT('<a href=perfil.php#calificar class=\'btn btn-success btn-sm calificar\'><i class=\'fa fa-pencil\'></i></a>') as evaluar FROM profesores where estado = 1) as t";
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'nombre', 'dt' => 1),
            array('db' => 'comentario', 'dt' => 2),
            array('db' => 'evaluar', 'dt' => 3)

        );

        echo json_encode(array("columns" => $columnas, "table" => $table, "ssColumns" => $columns));


        /*$query = $conexion->prepare("SELECT id, nombre FROM profesores where estado = 1");
        $query->execute();
        $datos = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($datos);*/
        break;
    case "comentarios":

        $columnas = array(
            array(
                "title" => "id",
                "withd" => "0%",
                "visible" => false,
                "className" => "classId"
            ),
            array(
                "title" => "Evaluación"
            ),
            array(
                "title" => "<i class='fa fa-thumbs-up'></i>"
            ),
            array(
                "title" => "<i class='fa fa-thumbs-down'></i>"
            )
        );
        //$table = "(SELECT id, evaluacion, CONCAT('<a class=\'btn btn-success btn-sm btn-like\'>+',(SELECT count(*) FROM likes_evaluaciones likes where likes.id_evaluacion = ev.id and likes.estado = 1),'</a><a class=\'btn btn-danger btn-sm\'>-,'(SELECT count(*) FROM likes_evaluaciones likes where likes.id_evaluacion = ev.id and likes.estado = 0)',</a>') as evaluar FROM evaluaciones ev WHERE id_profesor = " . $_POST['id'] . " and estado = 2) as t";
        $table = "(SELECT id, evaluacion, CONCAT('<a data-id=',id,' class=\'btn-like btn btn-success btn-sm\'>+',(SELECT count(*) FROM likes_evaluaciones likes where likes.id_evaluacion = ev.id and likes.estado = 1),'</a>') as likes, CONCAT('<a data-id=',id,' class=\' btn-dislike btn btn-danger btn-sm\'>-',(SELECT count(*) FROM likes_evaluaciones likes where likes.id_evaluacion = ev.id and likes.estado = 0),'</a>') as dislikes FROM evaluaciones ev WHERE id_profesor = " . $_POST['id'] . " and estado = 2) as t";
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'evaluacion', 'dt' => 1),
            array('db' => 'likes', 'dt' => 2),
            array('db' => 'dislikes', 'dt' => 3)
        );
        echo json_encode(array("columns" => $columnas, "table" => $table, "ssColumns" => $columns));

        break;
    case "reviews":
        $nombre_profesor = $_POST['nombre_profesor'];

        $query = $conexion->prepare("SELECT evaluacion FROM evaluaciones WHERE nombre_profesor = :nombre_profesor");
        $query2 = $conexion->prepare("SELECT avg(asistencia) as asistencia, avg(exigencia) as exigencia, avg(conocimiento) as conocimiento FROM evaluaciones WHERE nombre_profesor = :nombre_profesor");

        $query->bindParam(":nombre_profesor", $nombre_profesor);
        $query2->bindParam(":nombre_profesor", $nombre_profesor);

        if ($query->execute()) {
            $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);
            if ($query2->execute()) {
                $row = $query2->fetch(PDO::FETCH_ASSOC);

                $calificacion = (intval($row['asistencia']) + intval($row['conocimiento']) + intval($row['exigencia'])) / 3;
                $response = array("status" => "ok", "datos" => $comentarios, "calificacion" => $calificacion);
            }
        } else {
            $response = array("mensaje" => "error");
        }

        echo json_encode($response);
        break;
    case "fb-login":
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $foto = $_POST['foto'];

        $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $query->bindParam(":email", $email);
        if ($query->execute() and $query->rowCount() == 1) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['permiso'] = $row['permiso'];
            $_SESSION['foto_perfil'] = $row['ruta_imagen'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['carrera'] = $row['carrera_usuario'];
            echo json_encode(array("mensaje" => "login exitoso"));
        } else {
            $query = $conexion->prepare("INSERT INTO usuarios VALUES (NULL, :nombre, :correo, '123456', NULL, NULL, 2, NOW(), 1, :foto);");
            $query->bindParam(":nombre", $nombre);
            $query->bindParam(":correo", $email);
            $query->bindParam(":foto", $foto);

            if ($query->execute()) {
                $_SESSION['id'] = $conexion->lastInsertId();
                $_SESSION['email'] = $email;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['permiso'] = 2;
                $_SESSION['foto_perfil'] = $foto;
                echo json_encode(array("mensaje" => "registro exitoso"));
            } else {
                echo json_encode(array("mensaje" => "error"));
            }
        }
        break;
    case "google-login":
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $foto = $_POST['foto'];

        $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
        $query->bindParam(":email", $email);
        if ($query->execute() and $query->rowCount() == 1) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['permiso'] = $row['permiso'];
            $_SESSION['foto_perfil'] = $row['ruta_imagen'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['carrera'] = $row['carrera_usuario'];
            echo json_encode(array("mensaje" => "login exitoso"));
        } else {
            $query = $conexion->prepare("INSERT INTO usuarios VALUES (NULL, :nombre, :correo, '123456', NULL, NULL, 2, NOW(), 1, :foto);");
            $query->bindParam(":nombre", $nombre);
            $query->bindParam(":correo", $email);
            $query->bindParam(":foto", $foto);

            if ($query->execute()) {
                $_SESSION['id'] = $conexion->lastInsertId();
                $_SESSION['email'] = $email;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['permiso'] = 2;
                $_SESSION['foto_perfil'] = $foto;
                echo json_encode(array("mensaje" => "registro exitoso"));
            } else {
                echo json_encode(array("mensaje" => "error"));
            }
        }
        break;
    case "lista-usuarios":
        $query = $conexion->prepare("SELECT ruta_imagen FROM usuarios");
        if ($query->execute()) {
            echo json_encode(array("datos" => $query->fetchAll()));
        }
        break;
    case "ultimas-noticias":

        $query = $conexion->prepare("SELECT * FROM noticias_eventos ORDER BY fecha_publicacion DESC LIMIT 12");
        if ($query->execute()) {
            echo json_encode(array("ultimas" => $query->fetchAll(PDO::FETCH_ASSOC)));
        }
        break;
    case "publicar_noticia":

        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        $query = $conexion->prepare("INSERT INTO noticias_eventos (tipo, titulo, contenido) VALUES ('noticia', :titulo, :contenido)");
        $query->bindParam(":titulo", $titulo);
        $query->bindParam(":contenido", $contenido);
        if ($query->execute()) {
            echo json_encode(array("status" => "OK"));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "publicar_evento":

        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        $query = $conexion->prepare("INSERT INTO noticias_eventos (tipo, titulo, contenido) VALUES ('evento', :titulo, :contenido)");
        $query->bindParam(":titulo", $titulo);
        $query->bindParam(":contenido", $contenido);
        if ($query->execute()) {
            echo json_encode(array("status" => "OK"));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "iniciar-sesion":

        $usuario = $_POST['email'];
        $pass = $_POST['pass'];
        try {
            $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = :usuario AND pass = :pass LIMIT 1");
            $query->bindParam(":usuario", $usuario);
            $query->bindParam(":pass", $pass);
            $query->execute();

            if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $respuesta = array(
                    "id" => $row['id'],
                    "email" => $row['email'],
                    "nombre" => $row['nombre'],
                    "telefono" => $row['telefono'],
                    "carrera" => $row['carrera_usuario'],
                    "permiso" => $row['permiso'],
                    "ruta_imagen" => $row['ruta_imagen'],
                    "mensaje" => "login"
                );
                echo json_encode($respuesta);
            } else {
                $respuesta = array("mensaje" => "datos incorrectos");
                echo json_encode($respuesta);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
    case "registrar":
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $password = hash("sha256", $_POST['password']);
        $carrera = $_POST['carrera'];

        $query = $conexion->prepare("INSERT INTO usuarios VALUES (NULL, :nombre, :correo, :password, NULL, :carrera, 2, NOW(), 1, null);");
        $query->bindParam(":nombre", $nombre);
        $query->bindParam(":correo", $correo);
        $query->bindParam(":password", $password);
        $query->bindParam(":carrera", $carrera);

        // tu clave secreta
        $secret = "6LeXciMTAAAAAK_AnISEm7K_3SaXiCBGnxWv7V2r";
        // respuesta vacía
        $response = null;
        // comprueba la clave secreta
        $reCaptcha = new ReCaptcha($secret);
        //echo "REMOTE ADDRESS: ".$_SERVER['REMOTE_ADDR'];
        // si se detecta la respuesta como enviada
        if ($_POST["g-recaptcha-response"]) {
            $response = $reCaptcha->verifyResponse(
                $_SERVER["REMOTE_ADDR"],
                $_POST["g-recaptcha-response"]
            );
        }
        if ($response != null && $response->success) {
            //echo "El captcha es correcto, a seguirle pa!";
            try {
                if ($query->execute()) {
                    echo json_encode(array("status" => "OK", "mensaje" => "Registro exitoso"));
                } else {
                    //echo json_encode(array("mensaje" => "Error"));
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo json_encode(array("status" => "ERROR", "mensaje" => "El correo ya habia sido registrado"));
                }
            }
        }

        /*if ($query->execute()) {
            echo json_encode(array("mensaje" => "Registro exitoso"));
        } else {
            echo json_encode(array("mensaje" => "Error"));
        }*/
        break;
    case "publicar-post":
        $msg = "";
        if (is_array($_FILES)) {
            if (is_uploaded_file($_FILES['post_imagen']['tmp_name'])) {
                $sourcePath = $_FILES['post_imagen']['tmp_name'];

                if ($_FILES['post_imagen']['size'] > 650000) {
                    $msg = $msg . "Tamaño máximo permitido 500kb";
                    echo json_encode(array("status" => "ERROR", "mensaje" => $msg));
                    exit();
                }

                if (!($_FILES['post_imagen']['type'] == "image/jpeg")) {
                    $msg = $msg . "Solo imagenes .JPG";
                    echo json_encode(array("status" => "ERROR", "mensaje" => $msg));
                    exit();
                }

                $query = $conexion->prepare("SELECT MAX(id) FROM publicaciones");
                if ($query->execute()) {
                    $id = $query->fetchColumn();
                    $imagen_id = ($id == null) ? "1" : intval($id) + 1;
                    $_FILES['post_imagen']['name'] = "imagen_post_" . $imagen_id . ".jpg";
                }

                $query = $conexion->prepare("INSERT INTO publicaciones (titulo, contenido, imagen, autor)
                                             VALUES (:titulo, :contenido, :imagen, :autor)");
                $query->bindParam(":titulo", $_POST['post_titulo']);
                $query->bindParam(":contenido", $_POST['post_descripcion']);
                $query->bindParam(":imagen", $_FILES['post_imagen']['name']);
                $query->bindParam(":autor", $_POST['post_autor']);

                $status = $query->execute();
                $targetPath = "../images/publicaciones/" . $_FILES['post_imagen']['name'];

                //Ruta de la imagen original
                //$rutaImagenOriginal = "./imagen/aprilia classic.jpg";
                $rutaImagenOriginal = $sourcePath;

                //Creamos una variable imagen a partir de la imagen original
                $img_original = imagecreatefromjpeg($rutaImagenOriginal);

                //Se define el maximo ancho o alto que tendra la imagen final
                $max_ancho = 600;
                $max_alto = 600;

                //Ancho y alto de la imagen original
                list($ancho, $alto) = getimagesize($rutaImagenOriginal);

                //Se calcula ancho y alto de la imagen final
                $x_ratio = $max_ancho / $ancho;
                $y_ratio = $max_alto / $alto;

                //Si el ancho y el alto de la imagen no superan los maximos,
                //ancho final y alto final son los que tiene actualmente
                if (($ancho <= $max_ancho) && ($alto <= $max_alto)) {//Si ancho
                    $ancho_final = $ancho;
                    $alto_final = $alto;
                } /*
         * si proporcion horizontal*alto mayor que el alto maximo,
         * alto final es alto por la proporcion horizontal
         * es decir, le quitamos al alto, la misma proporcion que
         * le quitamos al alto
         *
        */
                elseif (($x_ratio * $alto) < $max_alto) {
                    $alto_final = ceil($x_ratio * $alto);
                    $ancho_final = $max_ancho;
                } /*
         * Igual que antes pero a la inversa
        */
                else {
                    $ancho_final = ceil($y_ratio * $ancho);
                    $alto_final = $max_alto;
                }

                //Creamos una imagen en blanco de tama�o $ancho_final  por $alto_final .
                $tmp = imagecreatetruecolor($ancho_final, $alto_final);

                //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
                imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);

                //Se destruye variable $img_original para liberar memoria
                imagedestroy($img_original);

                //Definimos la calidad de la imagen final
                $calidad = 95;

                //Se crea la imagen final en el directorio indicado
                //imagejpeg($tmp, "../images/perfiles/retoque.jpg", $calidad);

                if ($status && imagejpeg($tmp, $targetPath, $calidad)) {
                    echo json_encode(array("status" => "OK"));
                } else {
                    echo json_encode(array("status" => "ERROR", "mensaje" => "Ha ocurrido un error"));
                }
            }
        }
        break;
    case "cambiar-foto-perfil":

        $msg = "";
        if ($_FILES['imagen_perfil']['size'] > 500000) {
            $msg = $msg . "Tamaño máximo permitido 500kb";
            echo json_encode(array("status" => "ERROR", "mensaje" => $msg));
            exit();
        }

        if (!($_FILES['imagen_perfil']['type'] == "image/jpeg")) {
            $msg = $msg . "Solo imagenes JPG";
            echo json_encode(array("status" => "ERROR", "mensaje" => $msg));
            exit();
        } else {
            if ($_FILES['imagen_perfil']['type'] == "image/jpeg") {
                $_FILES['imagen_perfil']['name'] = "usuario_" . $_SESSION['id'] . ".jpg";
            }
        }

        $file_name = $_FILES['imagen_perfil']['name'];
        $add = "../images/perfiles/$file_name";
        //$add = "../../comunidadimagenes/perfiles/$file_name";
        //$ruta = "images/perfiles/$file_name"; "Ya no se almacenara la ruta, solo el nombre del archivo.
        $ruta = $file_name;

        //Ruta de la imagen original
        $rutaImagenOriginal = $_FILES['imagen_perfil']['tmp_name'];

        //Creamos una variable imagen a partir de la imagen original
        $img_original = imagecreatefromjpeg($rutaImagenOriginal);

        //Se define el maximo ancho o alto que tendra la imagen final
        $max_ancho = 300;
        $max_alto = 300;

        //Ancho y alto de la imagen original
        list($ancho, $alto) = getimagesize($rutaImagenOriginal);

        //Se calcula ancho y alto de la imagen final
        $x_ratio = $max_ancho / $ancho;
        $y_ratio = $max_alto / $alto;

        //Si el ancho y el alto de la imagen no superan los maximos,
        //ancho final y alto final son los que tiene actualmente
        if (($ancho <= $max_ancho) && ($alto <= $max_alto)) {//Si ancho
            $ancho_final = $ancho;
            $alto_final = $alto;
        } /*
         * si proporcion horizontal*alto mayor que el alto maximo,
         * alto final es alto por la proporcion horizontal
         * es decir, le quitamos al alto, la misma proporcion que
         * le quitamos al alto
         *
        */
        elseif (($x_ratio * $alto) < $max_alto) {
            $alto_final = ceil($x_ratio * $alto);
            $ancho_final = $max_ancho;
        } /*
         * Igual que antes pero a la inversa
        */
        else {
            $ancho_final = ceil($y_ratio * $ancho);
            $alto_final = $max_alto;
        }

        //Creamos una imagen en blanco de tama�o $ancho_final  por $alto_final .
        $tmp = imagecreatetruecolor($ancho_final, $alto_final);

        //Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
        imagecopyresampled($tmp, $img_original, 0, 0, 0, 0, $ancho_final, $alto_final, $ancho, $alto);

        //Se destruye variable $img_original para liberar memoria
        imagedestroy($img_original);

        //Definimos la calidad de la imagen final
        $calidad = 95;

        //Se crea la imagen final en el directorio indicado
        if (imagejpeg($tmp, $add, $calidad)) {
            $query = $conexion->prepare("UPDATE usuarios SET ruta_imagen = :ruta WHERE id = " . $_SESSION['id']);
            $query->bindParam(":ruta", $ruta);
            if ($query->execute()) {
                $_SESSION['foto_perfil'] = $ruta;
                echo json_encode(array("status" => "OK", "mensaje" => "Se ha cambiado tu imagen de perfil"));
            }
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Error al subir el archivo"));
        }

        break;
    case "ultimas-entradas":
        $query = $conexion->prepare("SELECT * FROM publicaciones 
                                     ORDER BY fecha_publicacion DESC
                                     LIMIT " . $_POST['index'] . ",3");
        $status = $query->execute();
        if ($status) {
            echo json_encode(array("status" => "OK", "entradas" => $query->fetchAll(PDO::FETCH_ASSOC)));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "total-entradas":
        $query = $conexion->prepare("SELECT COUNT(*) FROM publicaciones");
        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "total" => $query->fetchColumn()));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "nuevo-asesor":

        $q = $conexion->prepare("SELECT * FROM materias WHERE materia = :materia and estado = 1");
        $q->bindParam(":materia", $_POST['materia']);

        if ($q->execute() && $q->rowCount() == 1) {

            $asesoria_existente = $conexion->prepare("SELECT * FROM asesorias WHERE id_usuario = :id AND materia = :materia");
            $asesoria_existente->bindParam(":id", $_POST['asesor-id']);
            $asesoria_existente->bindParam(":materia", $_POST['materia']);
            $asesoria_existente->execute();

            if ($asesoria_existente->rowCount() != 0) {
                $respuesta = array("status" => "ERROR", "mensaje" => "Ya eres asesor de " . $_POST['materia'] . ".");
            } else {
                $query = $conexion->prepare(
                    "call registrar_asesoria(:id, :carrera, :materia, :dominio, :costo, :descripcion, NOW())"
                );
                $query->bindParam(":id", $_POST['asesor-id']);
                $query->bindParam(":carrera", $_POST['carrera']);
                $query->bindParam(":materia", $_POST['materia']);
                $query->bindParam(":dominio", $_POST['dominio']);
                $query->bindParam(":costo", $_POST['costo']);
                $query->bindParam(":descripcion", $_POST['descripcion']);
                $query->execute();

                if ($query->rowCount() == 1) {
                    $respuesta = array("status" => "OK", "mensaje" => "Te has registrado como asesor");
                } else {
                    $respuesta = array("status" => "ERROR", "mensaje" => "Registro de asesoría fallido");
                }
            }
        } else {
            $respuesta = array("status" => "ERROR", "mensaje" => "Si no encuentras la materia, favor de notificar al admin");
        }
        echo json_encode($respuesta);
        break;
    case "nueva-evaluacion":
        //var_dump($_POST);
        $profesor = $_POST['profesor'];

        $q = $conexion->prepare("SELECT * FROM profesores WHERE nombre = :profesor");
        $q->bindParam(":profesor", $profesor);
        if ($q->execute() and $q->rowCount() > 0) {

            //$profesor = explode("|", $_POST['profesor']);
            $prev_comment = $conexion->prepare("SELECT * FROM evaluaciones WHERE id_usuario = :id AND nombre_profesor = :profesor");
            $prev_comment->bindParam(":id", $_SESSION['id']);
            $prev_comment->bindParam(":profesor", $profesor);
            $prev_comment->execute();

            if ($prev_comment->rowCount() != 0) {
                $respuesta = array("status" => "ERROR", "mensaje" => "Ya haz calificado a este profesor.");
            } else {
                //$query = $conexion->prepare(
                //    "call registrar_evaluacion(:id, :idprofesor, :nombre, :asistencia, :conocimiento, :exigencia, :evaluacion, NOW())"
                //);
                $query = $conexion->prepare("INSERT INTO evaluaciones 
                                         VALUES (NULL, :id, :idprofesor, :nombre, :asistencia, :exigencia, :conocimiento, :evaluacion, CURRENT_TIMESTAMP, 1)");
                $query->bindParam(":id", $_SESSION['id']);
                $query->bindParam(":idprofesor", $_POST['idenprofesor']);
                $query->bindParam(":nombre", $profesor);
                $query->bindParam(":asistencia", $_POST['asistencia']);
                $query->bindParam(":conocimiento", $_POST['conocimiento']);
                $query->bindParam(":exigencia", $_POST['exigencia']);
                $query->bindParam(":evaluacion", $_POST['evaluacion']);
                //$query->execute();

                if ($query->execute() and $query->rowCount() == 1) {
                    $respuesta = array("status" => "OK", "mensaje" => "Registro de asesoria exitoso");
                } else {
                    $respuesta = array("status" => "ERROR", "mensaje" => "Registro de asesoria fallido");
                }
            }

        } else {
            $respuesta = array("status" => "ERROR", "mensaje" => "Si no encuentras a tu profesor, favor de notificar al admin");
        }
        echo json_encode($respuesta);

        break;
    case "obtener-evaluacion":

        $query = $conexion->prepare("SELECT * FROM evaluaciones WHERE id = :id");
        $query->bindParam(":id", $_POST['evaluacion']);
        if ($query->execute()) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode(array("status" => "OK", "datos" => $row));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "actualizar-evaluacion":
        //var_dump($_POST);
        $query = $conexion->prepare("UPDATE evaluaciones SET evaluacion = :evaluacion, estado = 1 WHERE id = :id");
        $query->bindParam(":evaluacion", $_POST['evaluacion']);
        $query->bindParam(":id", $_POST['id']);
        $query->execute();

        if ($query->rowCount() > 0) {
            $respuesta = array("status" => "OK", "mensaje" => "Actualización exitosa");
        } else {
            $respuesta = array("status" => "ERROR", "mensaje" => "Ha ocurrido un problema");
        }
        echo json_encode($respuesta);
        break;
    case "cambiar-estado-evaluacion":
        $id = $_POST['id'];
        $query = $conexion->prepare("UPDATE evaluaciones SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->bindParam(":estado", $_POST['estado']);
        $query->execute();

        if ($query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }

        break;
    case "cambiar-estado-asesoria":
        $id = $_POST['id'];
        $query = $conexion->prepare("UPDATE asesorias SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->bindParam(":estado", $_POST['estado']);
        $query->execute();

        if ($query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }

        break;
    case "cargar-comentarios":

        $resultado = array();
        $query = $conexion->prepare("SELECT * FROM evaluaciones WHERE id_profesor = :id AND estado = 2");
        $query->bindParam(":id", $_POST['id']);
        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "datos" => $query->fetchAll(PDO::FETCH_ASSOC)));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    /*case "actualizar-carrera":
        $query = $conexion->prepare("UPDATE usuarios SET 
                  carrera_usuario = :carrera
                  WHERE id = :id");
        $query->bindParam(":carrera", $_POST['carrera']);
        $query->bindParam(":id", $_SESSION['id']);
        if ($query->execute()) {
            $_SESSION['carrera'] = $_POST['carrera'];
            echo json_encode(array("status" => "OK", "mensaje" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
*/
    case "actualizar-perfil":
        $query = $conexion->prepare("UPDATE usuarios SET
                                      telefono = :telefono,
                                      carrera_usuario = :carrera
                                      WHERE id = :id");
        $query->bindParam(":telefono", $_POST['telefono']);
        $query->bindParam(":carrera", $_POST['carrera']);
        $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

        if ($query->execute() and $query->rowCount() == 1) {
            $_SESSION['carrera'] = $_POST['carrera'];
            $_SESSION['telefono'] = $_POST['telefono'];
            echo json_encode(array("status" => "OK", "mensaje" => "Tu perfil ha sido actualizado"));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "profesor-calificacion":

        $query = $conexion->prepare("SELECT AVG(asistencia) as asistencia, AVG(conocimiento) as conocimiento, AVG(exigencia) as exigencia, nombre_profesor
                                     FROM evaluaciones
                                     WHERE id_profesor = :id and estado = 2");
        $query->bindParam(":id", $_POST['id']);
        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "datos" => $query->fetch(PDO::FETCH_ASSOC)));
        } else {
            echo json_encode(array("status" => "ERROR"));
        }
        break;
    case "agregar-profesor":

        $query = $conexion->prepare("INSERT INTO profesores VALUES (NULL, :nombre, NOW(), 1)");
        $query->bindParam(":nombre", $_POST['nuevo_profesor']);

        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "mensaje" => "Registro exitoso"));
        } else {
            echo json_encode(array("status" => "OK", "mensaje" => "Ha ocurrido un error, intenta más tarde."));
        }
        break;
    case "publicar-asesoria":
        $query = $conexion->prepare("UPDATE asesorias SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_POST['id']);
        $query->bindParam(":estado", $_POST['nuevo-estado']);
        $query->execute();
        if ($query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Asesoría publicada exitosamente"));
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Ha ocurrido un error, consulta al admin."));
        }
        break;
    case "publicar-evaluacion":
        $query = $conexion->prepare("UPDATE evaluaciones SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_POST['id']);
        $query->bindParam(":estado", $_POST['nuevo-estado']);
        $query->execute();
        if ($query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Evaluación publicada exitosamente"));
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Ha ocurrido un error, consulta al admin."));
        }
        break;
    case "evaluacion-mas-uno":
        if (isset($_SESSION['id'])) {
            $id_usuario = $_SESSION['id'];
            $id_evaluacion = $_POST['id'];
            $query = $conexion->prepare("SELECT * FROM likes_evaluaciones WHERE id_evaluacion = :id_evaluacion and id_usuario = :id_usuario");
            $query->bindParam(":id_evaluacion", $id_evaluacion);
            $query->bindParam(":id_usuario", $id_usuario);
            if ($query->execute() and $query->rowCount() == 0) {
                $queryInsert = $conexion->prepare("INSERT INTO likes_evaluaciones VALUES (NULL, :id_usuario, :id_evaluacion, 1)");
                $queryInsert->bindParam(":id_evaluacion", $id_evaluacion);
                $queryInsert->bindParam(":id_usuario", $id_usuario);
                if ($queryInsert->execute()) {
                    echo json_encode(array("status" => "OK", "mensaje" => "Gracias por tu voto"));

                } else {
                    echo json_encode(array("status" => "OK", "mensaje" => "Ha ocurrido un error, intentar más tarde"));

                }
            } else {
                echo json_encode(array("status" => "OK", "mensaje" => "Ya has votado esta evaluación"));
            }
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Debes iniciar sesión para poder votar."));
        }
        break;
    case "evaluacion-menos-uno":
        if (isset($_SESSION['id'])) {
            $id_usuario = $_SESSION['id'];
            $id_evaluacion = $_POST['id'];
            $query = $conexion->prepare("SELECT * FROM likes_evaluaciones WHERE id_evaluacion = :id_evaluacion and id_usuario = :id_usuario");
            $query->bindParam(":id_evaluacion", $id_evaluacion);
            $query->bindParam(":id_usuario", $id_usuario);
            if ($query->execute() and $query->rowCount() == 0) {
                $queryInsert = $conexion->prepare("INSERT INTO likes_evaluaciones VALUES (NULL, :id_usuario, :id_evaluacion, 0)");
                $queryInsert->bindParam(":id_evaluacion", $id_evaluacion);
                $queryInsert->bindParam(":id_usuario", $id_usuario);
                if ($queryInsert->execute()) {
                    echo json_encode(array("status" => "OK", "mensaje" => "Gracias por tu voto"));

                } else {
                    echo json_encode(array("status" => "OK", "mensaje" => "Ha ocurrido un error, reportalo por favor."));

                }
            } else {
                echo json_encode(array("status" => "OK", "mensaje" => "Ya has votado esta evaluación"));
            }
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Debes iniciar sesión para poder votar."));
        }
        break;
    case "cambiar-estado-profesor":
        $query = $conexion->prepare("UPDATE profesores SET estado = :estado WHERE id = :id");
        $query->bindParam(":id", $_POST['id']);
        $query->bindParam(":estado", $_POST['nuevo-estado']);
        $query->execute();

        if ($query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Cambio exitoso"));
        } else {
            echo json_encode(array("status" => "OK", "mensaje" => "Ha ocurrido un error, reportalo por favor."));
        }
        break;
    case "materias-autocomplete":

        $term = $_POST['term'];
        $limit = $_POST['limit'];

        $query = $conexion->prepare("SELECT materia FROM materias 
                                     WHERE materia LIKE '%$term%' LIMIT $limit");

        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "datos" => $query->fetchAll(PDO::FETCH_NUM)), JSON_UNESCAPED_UNICODE);
        }
        break;
    case "login":
        $query = $conexion->prepare("SELECT * FROM usuarios
                                     WHERE email = :email and pass = :pass and estado = 1");
        $query->bindParam(":email", $_POST['email']);
        $query->bindParam(":pass", hash("sha256", $_POST['pass']));

        if ($query->execute() and $query->rowCount() == 1) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['carrera'] = $row['carrera_usuario'];
            $_SESSION['permiso'] = $row['permiso'];
            $_SESSION['foto_perfil'] = $row['ruta_imagen'];
            echo json_encode(array("status" => "OK", "mensaje" => "Bienvenid@ a la comunidad"));
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Tus datos son incorrectos"));
        }
        break;
    case "obtener-datos-asesoria":

        $query = $conexion->prepare("SELECT * FROM asesorias WHERE id = :id");
        $query->bindParam(":id", $_POST['id']);

        if ($query->execute()) {
            echo json_encode(array("datos" => $query->fetch(PDO::FETCH_ASSOC)));
        }
        break;
    case "actualizar-asesoria":
        $query = $conexion->prepare("UPDATE asesorias
                                     SET dominio = :dominio,
                                     costo = :costo,
                                     descripcion = :descripcion,
                                     estado = 1
                                     WHERE id = :id");
        $query->bindParam(":id", $_POST['modal-id']);
        $query->bindParam(":dominio", $_POST['modal-dominio']);
        $query->bindParam(":costo", $_POST['modal-costo']);
        $query->bindParam(":descripcion", $_POST['modal-descripcion']);

        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "mensaje" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Ha ocurrido un error, consulta al admin."));
        }
        break;
    case "profesores-autocomplete":
        $term = $_POST['term'];
        $limit = $_POST['limit'];

        $query = $conexion->prepare("SELECT id, nombre FROM profesores 
                                     WHERE nombre LIKE '%$term%' LIMIT 5");

        if ($query->execute()) {
            echo json_encode(array("status" => "OK", "datos" => $query->fetchAll(PDO::FETCH_ASSOC)), JSON_UNESCAPED_UNICODE);
        }
        break;
    case "modificar-asesoria":
        $id = $_POST['id'];
        $query = $conexion->prepare("UPDATE asesorias
                         SET estado = 4
                         WHERE id = :id");
        $query->bindParam(":id", $id);
        if ($query->execute() and $query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Ha ocurrido un error, consulta al admin."));
        }
        break;
    case "modificar-evaluacion":
        $id = $_POST['id'];
        $query = $conexion->prepare("UPDATE evaluaciones
                         SET estado = 4
                         WHERE id = :id");
        $query->bindParam(":id", $id);
        if ($query->execute() and $query->rowCount() == 1) {
            echo json_encode(array("status" => "OK", "mensaje" => "Actualización exitosa"));
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Ha ocurrido un error, consulta al admin."));
        }
        break;
    case "recuperar-contraseña":

        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "your_email_hosting";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "your@email.com";
        $mail->Password = "your_password";
        $mail->setFrom('your@email.com', 'Comunidad ITCM');
        $mail->Subject = 'Recuperar contraseña ComunidadITCM';
        $mail->isHTML(true);

        $query = $conexion->prepare("SELECT id, email FROM usuarios WHERE email = :correo LIMIT 1");
        $query->bindParam(":correo", $_POST['correo']);

        $mail->addAddress($_POST['correo']);

        if ($query->execute() and $query->rowCount() == 1) {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $cadena = $row['id'] . $row['email'] . rand(1, 9999999) . date('Y-m-d');
            $token = sha1($cadena);

            //Revisar si ya se solicito el correo
            $query = $conexion->prepare("SELECT username FROM resetpassword WHERE username = :correo");
            $query->bindParam(":correo", $_POST['correo']);
            if ($query->execute() and $query->rowCount() == 0) {

                $query = $conexion->prepare("INSERT INTO resetpassword (idusuario, username, token, creado) VALUES(:id_usuario, :email, :token, NOW())");
                $query->bindParam(":id_usuario", $row['id']);
                $query->bindParam(":email", $row['email']);
                $query->bindParam(":token", $token);

                if ($query->execute()) {
                    $enlace = $_SERVER["SERVER_NAME"] . '/restablecer.php?idusuario=' . sha1($row['id']) . '&token=' . $token;

                    $bodyContent = '<h1>Correo de recuperación de Contraseña</h1>';
                    $bodyContent .= '<p>Has solicitado recuperar tu contraseña, a continuación te dejamos un enlace para que puedas cambiarla.</p>';
                    $bodyContent .= '<a href="https://' . $enlace . '">https://' . $enlace . '</a>';
                    $bodyContent .= '<p><br>Este enlace solo será válido durante las primeras 24 horas después de haberlo solicitado.</p>';
                    $mail->Body = $bodyContent;

                    if (!$mail->send()) {
                        //echo "Mailer Error: " . $mail->ErrorInfo;
                        echo json_encode(array("status" => "ERROR", "mensaje" => $mail->ErrorInfo));
                    } else {
                        echo json_encode(array("status" => "OK", "mensaje" => "Se ha enviado email de recuperación, revisa tu correo incluyendo la carpeta correo no deseado. "));
                    }

                } else {
                    echo json_encode(array("status" => "OK", "mensaje" => "No se pudo envíar, contacta al admin."));
                }
            } else {
                echo json_encode(array("status" => "ERROR", "mensaje" => "Revisa tu correo, ya habías solicitado recuperar tu contraseña."));
            }
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "Email no registrado"));
        }
        break;
    case "cambiar-contraseña":

        $query = $conexion->prepare("SELECT idusuario FROM resetpassword WHERE token = :token");
        $query->bindParam(":token", $_POST['token']);

        if ($query->execute() and $query->rowCount() == 1) {
            $id = $query->fetchColumn();

            $query = $conexion->prepare("UPDATE usuarios SET pass = :pass WHERE id = :idusuario");
            $query->bindParam(":pass", hash("sha256", $_POST['pass']));
            $query->bindParam(":idusuario", $id);

            if ($query->execute()) {

                $query = $conexion->prepare("DELETE FROM resetpassword WHERE token = :token");
                $query->bindParam(":token", $_POST['token']);

                if ($query->execute() and $query->rowCount() == 1) {
                    echo json_encode(array("status" => "OK", "mensaje" => "Tu contraseña ha sido actualizada."));
                }
            } else {
                echo json_encode(array("status" => "ERROR", "mensaje" => "Ocurrió un problema al actualizar.."));
            }
        } else {
            echo json_encode(array("status" => "ERROR", "mensaje" => "El enlace ha expirado."));
        }
        break;
}












