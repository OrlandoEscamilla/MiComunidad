<?php
include("php/head_inc.php");
include("../conexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_SESSION['email'])) {
        echo "<script> window.location.href = 'acceder.php'</script>";
    }

    $carreras = ["Ambiental", "Eléctrica", "Electrónica", "Gestion", "Geociencias",
        "Industrial", "Mecánica", "Petrolera", "Química", "Sistemas", "ITIC"];
    $dominios = ["Básico", "Intermedio", "Avanzado"];
    $costos = ["Gratuito", "Por Acordar"];
    $profesor_asistencia = ["Siempre falta", "Casi siempre falta", "50/50", "Casi siempre asiste", "Siempre asiste"];
    $profesor_exigencia = ["No es exigente", "Es poco exigente", "Es muy exigente"];
    $profesor_entendimiento = ["No explica bien", "Explica bien", "Explica muy bien"];
    $profesor_ranking = [5, 6, 7, 8, 9, 10];
    if ($_SESSION['foto_perfil'] == "") {
        $imagen = "images/perfiles/placeholder.jpg";
    } else if (strlen($_SESSION['foto_perfil']) > 15) {
        $imagen = $_SESSION['foto_perfil'];
    } else {
        $imagen = "images/perfiles/" . $_SESSION['foto_perfil'];
    }
}

?>
<div class="row">
    <section class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">MI PERFIL <span id="mostrar_perfil"></span></p>
            </div>
            <div id="" class="panel-body">
                <div class="seccion_avatar col-sm-4">
                    <!--div class="img-perfil">
                        <img class="avatar" src="<?php echo $imagen ?>" alt="">
                    </div-->
                    <!--Form para cambiar imagen-->
                    <form id="cambiar_img_perfil" enctype="multipart/form-data">

                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                            <div class="fileinput-new thumbnail img-raised"
                                 style="max-width: 400px; max-height: 250px;">
                                <img src="<?php echo $imagen ?>" alt="imagen-perfil">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail img-raised"
                                 style="max-width: 400px; max-height: 250px;"></div>
                            <div>
                            <span class="btn btn-success btn-file">
                                <span class="fileinput-new">Elegir imagen</span>
                                <span class="fileinput-exists">Cambiar</span>
                                <input type="file" name="imagen_perfil">
                            </span>
                                <a href="#" class="btn btn-danger btn-simple fileinput-exists" data-dismiss="fileinput">
                                    <i class="fa fa-times"></i> Remover
                                </a>
                            </div>
                        </div>
                        <!--input type="file" name="imagen_perfil" class="" id="profile-pic">
                        <!--label for="profile-pic" class="btn btn-success btn-sm">Elegir imagen</label-->
                        <input type="hidden" name="servicio" value="cambiar-foto-perfil">
                        <input type="submit" value="Subir foto" class="btn btn-primary"
                               style="display: block; margin: 0 auto">
                    </form>
                </div>
                <div class="seccion_datos col-sm-7">
                    <table class="table table-hover">
                        <tr>
                            <td>Nombre:</td>
                            <td><?php echo $_SESSION['nombre']; ?></td>
                        </tr>
                        <tr>
                            <td>Correo:</td>
                            <td><?php echo $_SESSION['email']; ?></td>
                        </tr>
                        <tr id="fila_tel">
                            <td>Telefono:</td>
                            <td>
                                <?php
                                echo(isset($_SESSION['telefono']) ? $_SESSION['telefono'] : "");
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Carrera:</td>
                            <td>
                                <?php
                                echo(isset($_SESSION['carrera']) ? $_SESSION['carrera'] : "");
                                ?>
                            </td>
                        </tr>
                    </table>
                    <div class="pull-right">
                        <a id="subscribe-link" class="btn btn-primary">
                            <span id="span-notification"></span> <i class="fa fa-bell"></i>
                        </a>
                        <a id="editar_perfil" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit"><i
                                class="fa fa-pencil"></i> Editar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="row">
    <section class="col-sm-10 col-sm-offset-1">
        <ul class="nav nav-tabs nav-justified pad">
            <li role="presentation" class="active">
                <a href="#mis_asesorias" data-toggle="tab" class="tab-title">Mis asesorías</a>
            </li>
            <li role="presentation">
                <a href="#asesor" data-toggle="tab" class="tab-title">Quiero ser asesor</a>
            </li>
        </ul>
        <div class="tab-content">

            <div id="asesor" class="tab-pane fade in col-xs-12 col-xs-offset-0">
                <div class="col-sm-6 text-center hidden-xs">
                    <img src="img/asesora.png" alt="" class="img-responsive" width="60%" style="margin: 10em auto 0">
                </div>
                <form id="form-asesor" class="form-horizontal col-sm-6">
                    <input id="asesor_id" type="text" hidden="hidden"
                           value="<?php echo $_SESSION['id']; ?>" name="asesor-id">

                    <div class="form-group label-floating">
                        <label class="control-label">Carrera</label>
                        <select id="asesor_carrera" class=" select form-control" name="carrera">
                            <?php
                            echo "<option value='" . $_SESSION['carrera'] . "'>" . $_SESSION['carrera'] . "</option>";
                            ?>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Materia</label>
                        <input id="materia" type="text" class="form-control" name="materia">
                        <div class="sugerencias" style="display: none"></div>
                        <!--select id="asesor_materia" class=" select form-control" name="materia">
                            <?php
                        foreach ($materias as $materia) {
                            echo "<option value='$materia'>$materia</option>";
                        }
                        ?>
                        </select-->
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Dominio</label>
                        <select id="asesor_dominio" class=" select form-control" name="dominio">
                            <?php
                            foreach ($dominios as $dominio) {
                                echo "<option value='$dominio'>$dominio</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Costo</label>
                        <select id="asesor_costo" class=" select form-control" name="costo">
                            <option value="Gratuito">Gratuito</option>
                            <option value="Por acordar">Por acordar</option>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Describe como te gusta dar asesorías</label>
                        <textarea name="descripcion" id="asesor_descripcion" cols="30" rows="6" class="form-control"
                                  required></textarea>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <input type="hidden" name="servicio" value="nuevo-asesor">
                            <?php
                            if ($_SESSION['carrera'] != null) {
                                echo '<input type="submit" class="btn btn-primary" value="Enviar solicitud">';
                            } else {
                                echo '<span class="definir-carrera label label-danger" data-toggle="modal" data-target="#modal-edit">Da Click para completar tus datos</span><br>';
                                echo '<input type="submit" class="btn btn-primary" value="Enviar solicitud" disabled>';
                            }
                            ?>
                        </div>
                    </div>

                </form>
            </div>
            <div id="mis_asesorias" class="tab-pane fade in active col-xs-12 col-xs-offset-0">
                <table class="table table-striped">
                    <tr>
                        <!--th>Carrera</th-->
                        <th>Materia</th>
                        <th>Editar</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    <?php
                    try {
                        $query = $conexion->prepare("SELECT * FROM asesorias where id_usuario = :id");
                        $query->bindParam(":id", $_SESSION['id']);
                        $query->execute();

                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            //$cadena = ($row['estado']==1) ? "Dar de baja" : "Dar de Alta";
                            switch ($row['estado']) {
                                case 1:
                                    $cadena = "";
                                    $status = "Necesita aprobación";
                                    $classAsesoria = "fa fa-question-circle btn-danger";
                                    $modal = "";
                                    break;
                                case 2:
                                    $cadena = "Dar de baja";
                                    $status = "Activa";
                                    $classAsesoria = "estado-asesoria btn-danger";
                                    $modal = "";
                                    break;
                                case 3:
                                    $cadena = "Dar de alta";
                                    $status = "Inactiva";
                                    $classAsesoria = "estado-asesoria btn-success";
                                    $modal = "";
                                    break;
                                case 4:
                                    $cadena = "Requiere Modificar";
                                    $status = "Inactiva";
                                    $classAsesoria = "btn-danger";
                                    $modal = "#modal-asesorar";
                                    break;
                            }
                            echo "<tr>
                                    <!--td>" . $row['carrera'] . "</td-->
                                    <td>" . $row['materia'] . "</td>
                                    <td>
                                        <a class='btn btn-primary btn-sm editar-asesoria' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#modal-edit-asesoria'><i class='fa fa-pencil'></i></a>
                                        
                                    </td>
                                    <td>" . $status . "</td>
                                    <td><a id='" . $row['id'] . "' class='$classAsesoria btn btn-sm' data-status='$status' data-toggle='modal' data-target='$modal'>" . $cadena . "</a></td>
                                </tr>";
                        }
                    } catch (PDOException $e) {
                        echo "error: " . $e->getMessage();
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</div>
<br><br>
<div class="row">
    <section class="col-sm-10 col-sm-offset-1">
        <!-- moviendo -->
        <ul class="nav nav-tabs nav-justified pad">
            <li role="presentation" class="active">
                <a href="#mis_calificaciones" data-toggle="tab" class="tab-title">Mis
                    evaluaciones</a>
            </li>
            <li role="presentation">
                <a href="#calificar" data-toggle="tab" class="tab-title">Evaluar profesor</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="calificar" class="tab-pane fade in col-xs-12 col-xs-offset-0">
                <form id="form-evaluacion" class="form-horizontal  col-sm-6">
                    <div class="form-group label-floating">
                        <label class="control-label">Escribe el nombre del profesor</label>
                        <input id="profesor" type="text" class="form-control" name="profesor" required>
                        <input id="idenprofesor" type="hidden" data-id="" name="idenprofesor">
                        <div class="sugerencias-profesor" style="display: none"></div>
                        <!--select id="profesor_nombre" class="select form-control" name="profesor">
                            <?php
                        try {
                            $query = $conexion->prepare("SELECT id, nombre FROM profesores");
                            $query->execute();

                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['id'] . "|" . $row['nombre'] . "'>" . $row['nombre'] . "</option>";
                            }
                        } catch (PDOException $e) {
                            echo "error: " . $e->getMessage();
                        }
                        ?>
                        </select-->
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Asistencia</label>
                        <select id="profesor_asistencia" class="select form-control" name="asistencia">
                            <?php
                            /*foreach ($profesor_ranking as $ranking) {
                                echo "<option value='$ranking'>$ranking</option>";
                            }*/
                            /*foreach ($profesor_asistencia as $ranking) {
                                echo "<option value='$ranking'>$ranking</option>";
                            }*/
                            for ($i = 6; $i < 6 + count($profesor_asistencia); $i++) {
                                echo "<option value=$i>" . $profesor_asistencia[$i - 6] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Exigencia</label>
                        <select id="profesor_exigencia" class="selected form-control" name="exigencia">
                            <?php
                            /*foreach ($profesor_ranking as $ranking) {
                                echo "<option value='$ranking'>$ranking</option>";
                            }*/
                            /*for($i=6; $i<11; $i+=2){
                                echo "<option value=".(6+(1*$i)).">".$profesor_exigencia[6-(1*$i)]."</option>";
                            }*/
                            foreach ($profesor_exigencia as $key => $value) {
                                echo "<option value=" . (6 + ($key * 2)) . ">$value</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Entendimiento</label>
                        <select id="profesor_conocimiento" class="form-control" name="conocimiento">
                            <?php
                            /*foreach ($profesor_ranking as $ranking) {
                                echo "<option value='$ranking'>$ranking</option>";
                            }*/
                            foreach ($profesor_entendimiento as $key => $value) {
                                echo "<option value=" . (6 + ($key * 2)) . ">$value</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Describe como fue tu experiencia y que consejos puedes
                            aportar</label>
                        <textarea name="evaluacion" id="profesor_evaluacion" cols="30" rows="6" class="form-control"
                                  required></textarea>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 text-center frm_submit">
                            <!--input id="submit_profesor" type="button" class="btn btn-primary btn_sbmt"
                                   value="Enviar calificación"-->
                            <input type="submit" class="btn btn-primary" value="Enviar evaluación">
                            <input type="hidden" name="servicio" value="nueva-evaluacion">
                        </div>
                    </div>

                </form>
                <div class="col-sm-6 col-sm-offset-0 text-center hidden-xs">
                    <img src="img/test.png" alt="" class="img-responsive" width="60%" style="margin: 10em auto 0">
                </div>
            </div>
            <div id="mis_calificaciones" class="tab-pane fade in active col-xs-12 col-xs-offset-0">
                <table class="table table-striped">
                    <tr>
                        <th>Profesor</th>
                        <th>Comentario</th>
                        <th>Editar</th>
                        <th>Acción</th>
                    </tr>
                    <?php
                    try {
                        $query = $conexion->prepare("SELECT * FROM evaluaciones where id_usuario = :id");
                        $query->bindParam(":id", $_SESSION['id']);
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            //$cadena = ($row['estado']==2) ? "Dar de baja" : "Dar de Alta";
                            switch ($row['estado']) {
                                case 1:
                                    $cadena = "Necesita Aprobación";
                                    $class = "btn-default";
                                    $status = "";
                                    $modal = "";
                                    break;
                                case 2:
                                    $cadena = "Dar de baja";
                                    $class = "estado-evaluacion btn-danger";
                                    $status = "alta";
                                    $modal = "";
                                    break;
                                case 3:
                                    $cadena = "Dar de alta";
                                    $class = "estado-evaluacion btn-success";
                                    $status = "baja";
                                    $modal = "";
                                    break;
                                case 4:
                                    $cadena = "Requiere Modificar";
                                    $class = "modal-evaluar btn-danger";
                                    $status = "";
                                    $modal = "#modal-evaluar";
                                    break;
                            }
                            echo "<tr>
                                    <td class='col-xs-3'>" . $row['nombre_profesor'] . "</td>
                                    <td class='col-xs-6'>" . $row['evaluacion'] . "</td>
                                    <td class='col-xs-1'>
                                        <a href='editar.php?tipo=evaluacion&id=" . $row['id'] . "' data-id='" . $row['id'] . "' class='modal-edit btn btn-primary btn-sm'><i class='fa fa-pencil'></i></a>
                                    </td>
                                    <td class='col-xs-2'>
                                        <a id='" . $row['id'] . "' class='$class btn btn-sm' data-status='$status' data-toggle='modal' data-target='$modal'>$cadena</a>
                                    </td>
                                </tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="row">
    <div class="col-xs-12 text-center">
        <div class="btn-group" role="group" aria-label="...">
            <button id="btn-logout" type="button" class="btn btn-danger">
                <i class="fa fa-sign-out"></i>&nbsp;&nbsp;Cerrar Sesión
            </button>
            <?php
            if ($_SESSION['permiso'] != 1) {
                $link = "index.php";
                $text = "Inicio";
            } else {
                $link = "admin.php";
                $text = "Administrador";
            }
            ?>
            <button id="btn-admin" type="button" class="btn btn-success" data-link="<?php echo $link ?>">
                <i class="fa fa-user-plus"></i>&nbsp;&nbsp;<?php echo $text; ?>
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-asesorar" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Reglas para asesorar</h4>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Debes definir materia, dominio y costo.</li>
                    <li>El lugar y horario donde es más fácil para ti dar asesorias</li>
                </ul>
                <p style="font-style: italic">Ejemplo: Me gusta dar asesorías de X materia, te puedo ayudar a prepararte
                    para los
                    exámenes o para realizar tu proyecto final. Y mi disponibilidad sería los lunes, miercoles y viernes
                    en un horario de 16:00 a 19:00 hrs. Mi whatsapp o teléfono (opcional) es 833 1234567.
                </p>
                <b>Por favor presiona el botón editar y modifica tu asesoria, Gracias.</b>
            </div>
            <div class="modal-footer">
                <!--button id="btn-editar-datos" class="btn btn-success" data-dismiss="modal">Guardar cambios</button-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-evaluar" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Reglas para evaluar</h4>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Tu evaluación no debe contener ofensas o insultos.</li>
                    <li>Tu evaluación debe ser objetiva.</li>
                    <li>"Es un buen profesor" no será aceptado, intenta ser más descriptivo.</li>
                </ul>
                <p style="font-style: italic">Ejemplo: El profesor X casi siempre asiste a clase y no tolera que falten.
                    Sus examenes siempre son en base a los temas vistos, y siempre vuelve a explicar los temas si los
                    alumnos lo requieren. Encarga poca tarea pero el proyecto final debe estar bien hecho.
                </p>
                <b>Por favor presiona el botón editar y modifica tu evaluación, Gracias.</b>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Editar mis datos</h4>
            </div>
            <div class="modal-body">
                <form id="form-editar-perfil" class="col-xs-12">
                    <div class="form-group label-floating">
                        <label class="control-label">Nombre</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['nombre'] ?>" disabled>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" value="<?php echo $_SESSION['email'] ?>" disabled>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Teléfono (opcional)</label>
                        <input type="number" class="form-control" value="<?php echo $_SESSION['telefono'] ?>"
                               name="telefono">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Carrera: </label>
                        <select id="carrera" class="selected form-control" name="carrera">
                            <?php
                            foreach ($carreras as $carrera) {
                                echo "<option value='$carrera'>$carrera</option>";
                            }
                            ?>
                        </select>
                        <input type="hidden" name="servicio" value="actualizar-perfil">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-editar-datos" class="btn btn-success" data-dismiss="modal">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-asesoria" tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">Editar asesoría</h4>
            </div>
            <div class="modal-body">
                <form id="form-editar-asesoria" class="form-horizontal">
                    <input id="modal-id" type="text" hidden="hidden" name="modal-id">

                    <div class="form-group label-floating col-sm-6">
                        <label class="control-label">Asesor:</label>
                        <div class="">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['nombre'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group label-floating col-sm-6">
                        <label class="control-label">Materia:</label>
                        <input id="modal-materia" type="text" class="form-control" disabled>
                    </div>
                    <div class="form-group label-floating col-xs-12">
                        <label class="control-label">Dominio:</label>
                        <select id="modal-dominio" class="form-control" name="modal-dominio">
                            <?php
                            foreach ($dominios as $dominio) {
                                echo "<option value='$dominio'>$dominio</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group label-floating col-xs-12">
                        <label class="control-label">Costo:</label>
                        <select id="modal-costo" class="form-control" name="modal-costo">
                            <?php
                            foreach ($costos as $costo) {
                                echo "<option value='$costo'>$costo</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group label-floating col-xs-12">
                        <label class="control-label">Describe la forma en que ofreces asesorías.</label>
                        <textarea name="modal-descripcion" id="modal-descripcion" cols="30" rows="3"
                                  class="form-control"
                                  value="<?php echo $row['descripcion'] ?>"><?php echo $row['descripcion'] ?>
                        </textarea>
                    </div>
                    <div class="form-group col-xs-12 text-center">
                        <input type="hidden" name="servicio" value="actualizar-asesoria">
                        <!--input id="" type="submit" class="btn btn-primary"
                               value="Actualizar Asesoría"/-->
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button id="actualizar_asesoria" class="btn btn-success" data-dismiss="modal">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<?php
include("php/footer_inc.php");
?>
<script src="js/jasny-bootstrap.min.js"></script>
<script>

    if (window.location.hash != "") {
        var anchor = window.location.hash;
        $("a[href=" + anchor + "]").trigger("click");
    }

    function subscribe() {
        OneSignal.push(["registerForPushNotifications"]);
        event.preventDefault();
    }

    var OneSignal = OneSignal || [];
    OneSignal.push(function () {
        // If we're on an unsupported browser, do nothing
        if (!OneSignal.isPushNotificationsSupported()) {
            return;
        }
        OneSignal.isPushNotificationsEnabled(function (isEnabled) {
            if (isEnabled) {
                document.getElementById("span-notification").innerHTML = "Notificaciones activas";
                $("#subscribe-link").addClass("disabled");
            } else {
                document.getElementById("subscribe-link").addEventListener('click', subscribe);
                //document.getElementById("subscribe-link").style.display = '';
                $("#subscribe-link").removeClass("disabled");
                document.getElementById("span-notification").innerHTML = "Recibir notificaciones";
            }
        });
    });

    $("#btn-logout").click(function () {
        window.location.href = "php/cerrar_sesion.php";
    });

    $("#btn-admin").click(function () {
        window.location.href = $(this).data("link");
    });

    $("#cambiar_img_perfil").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "php/api_servicios.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == "OK") {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                } else if (response.status == "ERROR") {
                    bootbox.alert(response.mensaje);
                }
            }
        });
    });

    $("#form-asesor").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "php/api_servicios.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == "OK") {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                } else if (response.status == "ERROR") {
                    bootbox.alert(response.mensaje);
                }
            }
        });
    });

    $("#form-evaluacion").on("submit", function (e) {
        e.preventDefault();
        if (new FormData(this).get("idenprofesor") > 0) {
            $.ajax({
                url: "php/api_servicios.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    if (response.status == "OK") {
                        bootbox.alert(response.mensaje, function () {
                            window.location.reload();
                        });
                    } else if (response.status == "ERROR") {
                        bootbox.alert(response.mensaje);
                    }
                }
            });
        } else {
            bootbox.alert("Debes seleccionar al profesor de la lista, si no aparece favor de reportar al admin.");
        }
    });

    $(".estado-asesoria").on("click", function () {
        var este = $(this);
        var id = $(this).attr("id");
        var nuevoEstado = (este.data("status") == "Activa") ? 3 : 2;
        bootbox.confirm("¿Modificar estado de asesoría?", function (response) {
            if (response) {
                var data = {
                    "servicio": "cambiar-estado-asesoria",
                    "estado": nuevoEstado,
                    "id": id
                };
                $.post("php/api_servicios.php", data, function (response) {
                    if (response.status == "OK") {
                        bootbox.alert(response.mensaje, function () {
                            window.location.reload();
                        });
                    } else if (response.status == "ERROR") {
                        bootbox.alert(response.mensaje);
                    }
                }, "json");
            }
        });
    });

    $(".estado-evaluacion").on("click", function () {
        var id = $(this).attr("id");
        //var nuevoEstado = ($(this).html() == "Dar de alta") ? 3 : 2;
        var nuevoEstado = ($(this).data("status") == "alta") ? 3 : 2;
        bootbox.confirm("¿Modificar estado de evaluación?", function (response) {
            if (response) {
                var data = {
                    "servicio": "cambiar-estado-evaluacion",
                    "tipo": "evaluacion",
                    "estado": nuevoEstado,
                    "id": id
                };
                $.post("php/api_servicios.php", data, function (response) {
                    if (response.status == "OK") {
                        bootbox.alert(response.mensaje, function () {
                            window.location.reload();
                        });
                    } else if (response.status == "ERROR") {
                        bootbox.alert(response.mensaje);
                    }
                }, "json");
            }
        });
    });

    $(".modal-edit").click(function (e) {
        e.preventDefault();
        var data = {
            "servicio": "obtener-evaluacion",
            "evaluacion": $(this).data("id")
        };
        $.post("php/api_servicios.php", data, function (response) {
            if (response.status == "OK") {
                var datos = response.datos;
                bootbox.dialog({
                    title: "Editar comentario",
                    message: '<div class="row">' +
                    '<div class="col-md-12"> ' +
                    '<form id="form-actualizar-evaluacion" class="form-horizontal"> ' +
                    '<input id="asesoria_id" type="text" hidden="hidden" name="id" value="' + datos.id + '"> ' +
                    '<div class="form-group"> ' +
                    '<label for="" class="control-label col-xs-offset-1 col-sm-2 col-sm-offset-1">Profesor: </label> ' +
                    '<div class="col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0"> ' +
                    '<input type="text" class="form-control" value="' + datos.nombre_profesor + '" disabled> ' +
                    '</div> ' +
                    '</div>' +
                    '<div class="form-group"> ' +
                    '<label for="nombre" class="control-label col-xs-offset-1 col-sm-2 col-sm-offset-1">Comentario: </label>' +
                    '<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">' +
                    '<textarea id="evaluacion" cols="30" rows="6" class="form-control" required>' +
                    datos.evaluacion +
                    '</textarea> ' +
                    '</div> ' +
                    '</div>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: "Actualizar <i class='fa fa-check'></i>",
                            className: "btn-success",
                            callback: function () {
                                var data = {
                                    "id": datos.id,
                                    "evaluacion": $("#evaluacion").val(),
                                    "servicio": "actualizar-evaluacion"
                                };
                                $.post("php/api_servicios.php", data, function (response) {
                                    bootbox.alert(response.mensaje, function (response) {
                                        window.location.reload();
                                    })
                                }, "json");
                            }
                        }
                    }
                });
            }
        }, "json");

    });


    $("#btn-carrera").click(function () {
        var data = {
            "carrera": $("#carreras").val(),
            "servicio": "actualizar-carrera"
        };
        $.post("php/api_servicios.php", data, function (response) {
            if (response.status == "OK") {
                $("#modal-carrera").hide();
                bootbox.alert(response.mensaje, function () {
                    window.location.reload();
                });
            } else if (response.status == "ERROR") {
                bootbox.alert(response.mensaje);
            }
        }, "json");

    });

    $("#editar_perfil").click(function () {
        $("#carrera").val("<?php echo isset($_SESSION['carrera']) ? $_SESSION['carrera'] : "";?>");
    });

    $("#btn-editar-datos").click(function () {
        $.ajax({
            url: "php/api_servicios.php",
            type: "POST",
            data: new FormData(document.getElementById("form-editar-perfil")),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == "OK") {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                } else if (response.status == "ERROR") {
                    bootbox.alert(response.mensaje);
                }
            }
        });
    });

    $("#profesor").keyup(function () {
        $(".sugerencias-profesor").empty();

        if ($(this).val().length >= 2) {
            $.ajax({
                url: "php/api_servicios.php",
                type: "POST",
                data: {
                    "servicio": "profesores-autocomplete",
                    "term": $("#profesor").val(),
                    "limit": 5
                },
                dataType: "json",
                success: function (response) {
                    ponerSugerenciasProfesores(response.datos);
                }
            });
        }
    });

    var ponerSugerenciasProfesores = function (profesores) {
        var sugerencias = $(".sugerencias-profesor");
        sugerencias.append("<ul class='lista-profesores'></ul>").show();
        for (var i = 0; i < profesores.length; i++) {
            $(".lista-profesores").append("<li data-id=" + profesores[i].id + " class='seleccion-profesores'>" + profesores[i].nombre + "</li>");
        }

        $(".seleccion-profesores").click(function () {
            $("#profesor").val($(this).html());
            $("#idenprofesor").val($(this).data("id"));
            sugerencias.hide();
        }).hover(
            function () {
                $(this).css({"background": "dodgerblue", "color": "#fff"});
            }, function () {
                $(this).css({"background": "none", "color": "#333"});
            }
        );
    };

    $("#materia").keyup(function () {
        $(".sugerencias").empty();

        if ($(this).val().length >= 2) {
            $.ajax({
                url: "php/api_servicios.php",
                type: "POST",
                data: {
                    "servicio": "materias-autocomplete",
                    "term": $("#materia").val(),
                    "limit": 5
                },
                dataType: "json",
                success: function (response) {
                    ponerSugerencias(response.datos);
                }
            });
        }
    });

    var ponerSugerencias = function (materias) {
        var sugerencias = $(".sugerencias");
        sugerencias.append("<ul class='lista-materias'></ul>").show();
        for (var i = 0; i < materias.length; i++) {
            $(".lista-materias").append("<li class='seleccion'>" + materias[i] + "</li>");
        }

        $(".seleccion").click(function () {
            $("#materia").val($(this).html());
            sugerencias.hide();
        }).hover(
            function () {
                $(this).css({"background": "dodgerblue", "color": "#fff"});
            }, function () {
                $(this).css({"background": "none", "color": "#333"});
            }
        );
    };

    $(".editar-asesoria").click(function () {
        var data = {
            "id": $(this).data("id"),
            "servicio": "obtener-datos-asesoria"
        }
        $.post("php/api_servicios.php", data, function (response) {
            var datos = response.datos;
            $("#modal-id").val(datos.id);
            $("#modal-materia").val(datos.materia);
            $("#modal-dominio").val(datos.dominio);
            $("#modal-costo").val(datos.costo);
            $("#modal-descripcion").val(datos.descripcion);
        }, "json");
    });

    $("#actualizar_asesoria").click(function () {
        $.ajax({
            url: "php/api_servicios.php",
            type: "POST",
            data: new FormData(document.getElementById("form-editar-asesoria")),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == "OK") {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                } else if (response.status == "ERROR") {
                    bootbox.alert(response.mensaje);
                }
            }
        });
    });

    $(".fa-question-circle").click(function () {
        bootbox.alert("Todas las evaluaciones y asesorías son revisadas antes de publicarse.");
    });

</script>
</body>
</html>
