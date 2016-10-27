<?php
require("php/head_inc.php");
//require("php/conexion.php");

if (!isset($_GET['id'])) {
    $cargarProfesores = true;
    echo "<script>cargarProfesores = true;</script>";
} else {
    $cargarProfesores = false;
    echo "<script>cargarProfesores = false;</script>";
}

?>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div id="panel-profesor" class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">PROFESORES</p>
            </div>
            <div class="panel-body">
                <table id="tabla_profesores" class="table table-striped table-responsive table-hover dt-responsive"
                       cellspacing="0" width="100%">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div id="panel-comentario" class="panel panel-default">
            <div class="panel-heading">
                <p id="nombre_profesor" class="panel-title"></p>
            </div>
            <div class="panel-body">
                <div class="comentario_container">
                    <div class="puntuacion">
                        <div class="calificacion">
                            <div class="col-xs-4 calif_contenedor">
                                <p>ASISTENCIA<span id="asistencia" class="calificacion_numero">5</span></p>
                            </div>
                            <div class="col-xs-4 calif_contenedor">
                                <p>CONOCIMIENTO<span id="conocimiento" class="calificacion_numero">5</span></p>
                            </div>
                            <div class="col-xs-4 calif_contenedor">
                                <p>EXIGENCIA<span id="exigencia" class="calificacion_numero">5</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="comentario">
                        <table id="tabla_comentarios" class="table table-striped table-responsive table-hover"
                               cellspacing="0" width="100%">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <a id="lista_profesores" href="#" class="btn btn-success"><i
                            class="fa fa-long-arrow-left"></i> Lista de Profesores</a>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
<?php
require("php/footer_inc.php");
?>
<script>

    //Delegando eventos para un mejor uso de la Datatable comentarios
    $("#tabla_comentarios").on("click", ".btn-like", function () {
        var id = $(this).data("id");
        bootbox.confirm("¿Dar +1 al comentario seleccionado?", function (response) {
            if (response) {
                var data = {
                    "servicio": "evaluacion-mas-uno",
                    "id": id
                };
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje);
                    $("#tabla_comentarios").DataTable().draw();
                }, "json");
            }
        });
    });
    //Delegando eventos para un mejor uso de la Datatable comentarios

    //Delegando eventos para un mejor uso de la Datatable comentarios
    $("#tabla_comentarios").on("click", ".btn-dislike", function () {
        var id = $(this).data("id");
        bootbox.confirm("¿Dar -1 al comentario seleccionado?", function (response) {
            if (response) {
                var data = {
                    "servicio": "evaluacion-menos-uno",
                    "id": id
                };
                $.post("php/api_servicios.php", data, function (response) {
                    bootbox.alert(response.mensaje);
                    $("#tabla_comentarios").DataTable().draw();
                }, "json");
            }
        });
    });
    //Delegando eventos para un mejor uso de la Datatable comentarios

    //Delegando eventos para un mejor uso de la Datatable profesores
    $("#tabla_profesores").on("click", ".cargarComentario", function () {
        $("#panel-comentario").show("medium");
        $("#panel-profesor").hide("medium");
        var data = {
            "servicio": "profesor-calificacion",
            "id": $(this).data("id")
        };
        $.post("php/api_servicios.php", data, function (response) {
            $("#asistencia").html(Math.floor(response.datos.asistencia));
            $("#conocimiento").html(Math.ceil(response.datos.conocimiento));
            $("#exigencia").html(Math.ceil(response.datos.exigencia));
            if (response.datos.nombre_profesor === null) {
                $("#nombre_profesor").html("Se el primero en evaluar!");
            } else {
                $("#nombre_profesor").html(response.datos.nombre_profesor);
            }
        }, "json");
        data = {
            "servicio": "comentarios",
            "id": $(this).data("id")
        };
        $.post("php/api_servicios.php", data, function (response) {
            $("#tabla_comentarios").dataTable({
                "language": {
                    "url": "assets/datatables.spanish.lang.json"
                },
                "columns": response.columns,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "php/server_processing.php",
                    type: "POST",
                    data: {
                        "servicio": "comentarios",
                        "table": response.table,
                        "ssColumns": response.ssColumns
                    }
                },
                "pageLength": 10,
                "destroy": true,
                "initComplete": function (settings, json) {
                },
                "searching": false
            });
        }, "json");

    });
    //Delegando eventos para un mejor uso de la Datatable


    $.post("php/api_servicios.php", {"servicio": "profesores"}, function (data) {

        $("#tabla_profesores").dataTable({
            "language": {
                "url": "assets/datatables.spanish.lang.json"
            },
            "columns": data.columns,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "php/server_processing.php",
                type: "POST",
                data: {
                    "servicio": "profesores",
                    "table": data.table,
                    "ssColumns": data.ssColumns
                }
            },
            "pageLength": 10,
            "destroy": true,
            "initComplete": function (settings, json) {
                //atarEventos();
            }
        });
    }, "json");

</script>
</body>
</html>
























