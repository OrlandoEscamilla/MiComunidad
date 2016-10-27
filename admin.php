<?php
require("php/head_inc.php");
require("../conexion.php");
if ($_SESSION['permiso'] != 1) {
    echo "<script> window.location.href = 'perfil.php'</script>";
}

?>
<div class="row">

    <!-- PANEL ADMINISTRADOR -->
    <aside id="mod_admin" class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0">

        <!-- MENU RESPONSIVO -->
        <div class="panel panel-default admin-responsive">
            <div class="panel-heading">
                <div class="panel-title">ADMINISTRADOR</div>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal col-xs-12">
                    <select id="menu-admin" class="form-control">
                        <option value="">SELECCIONA UNA OPCIÓN AQUÍ</option>
                        <option value="opt-profesores">PROFESORES</option>
                        <option value="opt-asesores">ASESORES</option>
                        <option value="opt-evaluaciones">EVALUACIONES</option>
                        <option value="opt-noticias">NOTICIAS</option>
                        <option value="opt-eventos">EVENTOS</option>
                        <option value="opt-publicaciones">ENTRADAS</option>
                    </select>
                </form>
            </div>
        </div>
        <!-- MENU RESPONSIVO -->

        <div class="panel panel-default admin-nonresponsive">
            <div class="panel-heading">
                <div class="panel-title">ADMINISTRADOR</div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li id="show_profesores" role="presentation" class="admin-opcion">
                        <a href="#mod_profesores">profesores</a>
                    </li>
                    <li id="show_asesores" role="presentation" class="admin-opcion">
                        <a href="#mod_asesorias">asesores</a>
                    </li>
                    <li id="show_evaluaciones" role="presentation" class="admin-opcion">
                        <a href="#mod_evaluaciones">evaluaciones</a>
                    </li>
                    <li id="show_noticias" role="presentation" class="admin-opcion">
                        <a href="#mod_noticias">noticias</a>
                    </li>
                    <li id="show_eventos" role="presentation" class="admin-opcion">
                        <a href="#mod_eventos">eventos</a>
                    </li>
                    <li id="show_publicaciones" role="presentation" class="admin-opcion">
                        <a href="#mod_publicaciones">entradas</a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <!-- PANEL ADMINISTRADOR -->

    <!-- SECCIÓN BIENVENIDA -->
    <section id="mod_bienvenida" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">BIENVENIDO ADMINISTRADOR</p>
            </div>
            <div class="panel-body no-padding bienvenido">
                <div class="well" style="font-size: 20px">
                    <p class="text-center">Para empezar a trabajar debes seleccionar una opción del panel de
                        administración.</p>
                    <p class="text-center">Si tienes alguna duda y/o sugerencia, no dudes en comunicarte con el
                        webmaster a
                        la siguiente dirección: webmaster@comunidaditcm.eichgi.com</p>
                </div>
            </div>
        </div>
    </section>
    <!-- SECCIÓN BIENVENIDA -->

    <!-- SECCIÓN PROFESORES -->
    <section id="mod_profesores" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <ul class="nav nav-tabs nav-justified pad">
            <li role="presentation" class="active">
                <a href="#editar_profe" data-toggle="tab">Editar Profesor</a>
            </li>
            <li role="presentation">
                <a href="#agregar_profe" data-toggle="tab">Agregar Profesor</a>
            </li>
        </ul>

        <div class="tab-content" style="background: #fff">
            <div id="editar_profe" class="tab-pane fade in active col-md-12 col-md-offset-0">
                <table class="table table-striped table-hover table-responsive">
                    <tr>
                        <th>Profesor</th>
                        <th>Información</th>
                        <th>Estado</th>
                    </tr>
                    <?php
                    try {
                        $query = $conexion->prepare("SELECT * FROM profesores ORDER BY nombre");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $cadena = ($row['estado'] == 1) ? "Dar de Baja" : "Dar de Alta";
                            echo "<tr>
                                    <td><b>" . $row['nombre'] . "</b></td>
                                    <td><a class='btn btn-primary btn-sm' disabled><i class='fa fa-pencil'></i></a></td>
                                    <td><a data-id='" . $row['id'] . "' data-estado='" . $row['estado'] . "' class='estado-profesor btn btn-danger btn-sm'>$cadena</a></td>
                                </tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </table>
            </div>
            <div id="agregar_profe" class="tab-pane fade in">
                <form id="form-agregar-profesor" class="form-horizontal col-xs-10 col-xs-offset-1">
                    <div class="form-group label-floating">
                        <label class="control-label">Nombre del profesor(a)</label>
                        <input type="text" class="form-control" name="nuevo_profesor" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="hidden" name="servicio" value="agregar-profesor">
                        <input id="agregar_profesor" type="submit" class="btn btn-primary" value="AGREGAR PROFESOR">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- SECCIÓN PROFESORES -->

    <!-- SECCIÓN EVALUACIONES -->
    <section id="mod_evaluaciones" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">NUEVAS EVALUACIONES</p>
            </div>
            <div class="panel-body no-padding">
                <table class="table table-striped">
                    <tr>
                        <th>Profesor</th>
                        <th>Evaluación</th>
                        <th>Reportar</th>
                        <th>Publicar</th>
                    </tr>
                    <?php
                    try {
                        $query = $conexion->prepare("SELECT * FROM evaluaciones WHERE estado = 1");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                    <td class='col-xs-3'>" . $row['nombre_profesor'] . "</td>
                                    <td class='col-xs-5 text-justify'>" . $row['evaluacion'] . "</td>
                                    <td class='col-xs-2'>
                                        <a data-id='" . $row['id'] . "' class='btn btn-danger modificar-evaluacion'>Requiere Modificaciones</a>
                                    </td>
                                    <td class='col-xs-2'>
                                        <a data-id='" . $row['id'] . "' class='publicar-comentario btn btn-primary'>Publicar</a>
                                    </td>
                                </tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </table>
            </div>
    </section>
    <!-- SECCIÓN EVALUACIONES -->


    <!-- SECCIÓN ASESORÍAS -->
    <section id="mod_asesorias" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">NUEVAS ASESORÍAS</p>
            </div>
            <div class="panel-body no-padding">
                <table class="table table-striped">
                    <tr>
                        <th>Materia</th>
                        <th>Descripción</th>
                        <th>Reportar</th>
                        <th>Publicar</th>
                    </tr>
                    <?php
                    try {
                        $query = $conexion->prepare("SELECT * FROM view_asesores WHERE estado = 1");
                        $query->execute();
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                    <tr>
                        <td class='col-xs-2'>" . $row['materia'] . "</td>
                        <td class='col-xs-6 text-justify'>" . $row['descripcion'] . "</td>
                        <td class='col-xs-2'>
                            <a data-id='" . $row['id'] . "' class='btn btn-danger modificar-asesoria'>Requiere Modificaciones</a>
                        </td>
                        <td class='col-xs-2'>
                            <a data-id='" . $row['id'] . "' class='publicar-asesoria btn btn-primary'>Publicar</a>
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
    <!-- SECCIÓN ASESORÍAS -->

    <!-- SECCIÓN NOTICIAS -->
    <section id="mod_noticias" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">REDACTAR NOTICIA</p>
            </div>
            <div class="panel-body">
                <form action="#">
                    <div class="form-group label-floating">
                        <label class="control-label">Titulo: </label>
                        <input id="noticia_titulo" type="text" class="form-control" value="" required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descripción: </label>
                        <textarea id="noticia_descripcion" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <input id="noticia_btn" type="submit" class="btn btn-primary"
                               value="PUBLICAR NOTICIA">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- SECCIÓN NOTICIAS -->

    <!-- SECCIÓN EVENTOS -->
    <section id="mod_eventos" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">REDACTAR EVENTO</p>
            </div>
            <div class="panel-body">
                <form action="#">
                    <div class="form-group label-floating">
                        <label class="control-label">Titulo: </label>
                        <input id="evento_titulo" type="text" class="form-control" required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descripción: </label>
                        <textarea id="evento_descripcion" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <input id="evento_btn" type="submit" class="btn btn-primary" value="PUBLICAR EVENTO">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- SECCIÓN EVENTOS -->

    <!-- SECCIÓN PUBLICACIONES -->
    <section id="mod_posts" class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">REDACTAR ENTRADA</p>
            </div>
            <div class="panel-body">
                <form id="post_form" enctype="multipart/form-data">
                    <div class="form-group label-floating">
                        <label class="control-label">Titulo: </label>
                        <input id="post_titulo" type="text" class="form-control" value="" name="post_titulo">
                    </div>
                    <h4>
                        <small>Imagenes</small>
                    </h4>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-raised" style="max-width: 400px; max-height: 250px;">
                            <img src="img/img-placeholder.png" alt="Imagen">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"
                             style="max-width: 400px; max-height: 250px;"></div>
                        <div>
                            <span class="btn btn-round btn-default btn-file">
                                <span class="fileinput-new">Seleccionar imagen</span>
                                <span class="fileinput-exists">Change</span>
                                <input id="post_imagen" type="file" name="post_imagen">
                            </span>
                            <a href="#" class="btn btn-danger btn-simple fileinput-exists" data-dismiss="fileinput">
                                <i class="fa fa-times"></i> Remove
                            </a>
                        </div>
                    </div>
                    <!-- CAMBIOS -->
                    <div class="form-group label-floating">
                        <label class="control-label">Descripción: </label>
                        <textarea id="post_descripcion" class="form-control" rows="7"
                                  name="post_descripcion"></textarea>
                        <input type="hidden" name="post_autor" value="<?php echo $_SESSION['nombre'] ?>">
                        <input type="hidden" name="servicio" value="publicar-post">
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <input id="post_btn" type="submit" class="btn btn-primary" value="PUBLICAR POST">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- SECCIÓN PUBLICACIONES -->
</div>

<?php
require("php/footer_inc.php");
?>
<script src="js/jasny-bootstrap.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        menubar: false,
        setup: function (editor) {
            editor.on('change', function () {
                tinymce.triggerSave();
            });
        },
        height: 200
    });

    $("#mod_admin").show().siblings().hide();
    $("#mod_bienvenida").show();

    $("#show_profesores").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_profesores").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_asesores").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_asesorias").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_evaluaciones").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_evaluaciones").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_noticias").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_noticias").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_eventos").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_eventos").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_publicaciones").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_posts").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#noticia_btn").click(function (e) {
        var titulo = $("#noticia_titulo").val();
        var contenido = $("#noticia_descripcion").val();
        var data = {
            "titulo": titulo,
            "contenido": contenido,
            "servicio": "publicar_noticia"
        };
        if (titulo != "" && contenido != "") {
            $.post("php/api_servicios.php", data, function (response) {
                if (response.status == "OK") {
                    bootbox.alert("NOTICIA PUBLICADA CORRECTAMENTE", function () {
                        window.location.reload();
                    });
                } else {
                    bootbox.alert("NO SE PUDO PUBLICAR LA NOTICIA, INTENTA DE NUEVO", function () {

                    });
                }
            }, "json");
        } else {
            bootbox.alert("Por favor llena todos los campos");
        }
        return false;
    });

    $("#evento_btn").click(function (e) {
        var titulo = $("#evento_titulo").val();
        var contenido = $("#evento_descripcion").val();
        var data = {
            "titulo": titulo,
            "contenido": contenido,
            "servicio": "publicar_evento"
        };
        if (titulo != "" && contenido != "") {
            $.post("php/api_servicios.php", data, function (response) {
                if (response.status == "OK") {
                    bootbox.alert("EVENTO PUBLICADO CORRECTAMENTE", function () {
                        window.location.reload();
                    });
                } else {
                    bootbox.alert("NO SE PUDO PUBLICAR EL EVENTO, INTENTA DE NUEVO", function () {
                    });
                }
            }, "json");
        } else {
            bootbox.alert("Por favor llena todos los campos");
        }
        return false;
    });

    $("#post_form").on("submit", (function (e) {
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
                    bootbox.alert("LA ENTRADA HA SIDO PUBLICADA", function () {
                        window.location.reload();
                    });
                } else if (response.status == "ERROR") {
                    bootbox.alert(response.mensaje);
                }
            }
        });
    }));

    $("#menu-admin").change(function () {
        switch ($(this).val()) {
            case "opt-profesores":
                $("#mod_profesores").show("300").siblings().hide();
                $("#mod_admin").show();
                break;
            case "opt-asesores":
                $("#mod_asesorias").show("300").siblings().hide();
                $("#mod_admin").show();
                break;
            case "opt-evaluaciones":
                $("#mod_evaluaciones").show("300").siblings().hide();
                $("#mod_admin").show();
                break;
            case "opt-noticias":
                $("#mod_noticias").show("300").siblings().hide();
                $("#mod_admin").show();
                break;
            case "opt-eventos":
                $("#mod_eventos").show("300").siblings().hide();
                $("#mod_admin").show();
                break;
            case "opt-publicaciones":
                $("#mod_posts").show("300").siblings().hide();
                $("#mod_admin").show();
                break;
        }

    });

    $("#form-agregar-profesor").on("submit", (function (e) {
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
    }));

    $(".publicar-asesoria").on("click", function () {
        var id = $(this).data("id");
        bootbox.confirm("¿Desea publicar esta asesoría?", function (response) {
            if (response) {
                //window.location.href = "php/cambiarestado.php?nuevoestado=" + 2 + "&tipo=pub_asesoria&id=" + id;
                var data = {
                    "nuevo-estado": 2,
                    "servicio": "publicar-asesoria",
                    "id": id
                };
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                }, "json");
            }
        });
    });

    $(".publicar-comentario").on("click", function () {
        var id = $(this).data("id");
        bootbox.confirm("¿Desea publicar esta evaluación?", function (response) {
            if (response) {
                //window.location.href = "php/cambiarestado.php?nuevoestado=" + 2 + "&tipo=pub_evaluacion&id=" + id;
                var data = {
                    "nuevo-estado": 2,
                    "servicio": "publicar-evaluacion",
                    "id": id
                };
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                }, "json");
            }
        });
    });

    $(".estado-profesor").on("click", function () {
        var data = {
            "id": $(this).data("id"),
            "nuevo-estado": ($(this).data("estado") == 1) ? 0 : 1,
            "servicio": "cambiar-estado-profesor"
        };
        bootbox.confirm("¿Modificar estado de profesor(a)?", function (response) {
            if (response) {
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                }, "json");
            }
        });
    });

    $(".modificar-asesoria").on("click", function () {
        var data = {
            "id": $(this).data("id"),
            "servicio": "modificar-asesoria"
        };
        bootbox.confirm("¿Solicitar modificar aseosría?", function (response) {
            if (response) {
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                }, "json");
            }
        });
    });

    $(".modificar-evaluacion").on("click", function(){
        var data = {
            "id": $(this).data("id"),
            "servicio": "modificar-evaluacion"
        };
        bootbox.confirm("¿Solicitar modificar evaluación?", function (response) {
            if (response) {
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje, function () {
                        window.location.reload();
                    });
                }, "json");
            }
        });
    });

</script>
</body>
</html>
