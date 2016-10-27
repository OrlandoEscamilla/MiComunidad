<?php
require("php/head_inc.php");
?>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div id="panel-asesor" class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">ASESORES</p>
            </div>
            <div class="panel-body">
                <table id="tbl-asesores"
                       class="table table-striped table-responsive table-bordered table-hover dt-responsive"
                       cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Materia</th>
                        <th>Descripcion</th>
                        <th>Costo</th>
                        <th>Contacto</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <br>
                <span style="font-weight: bold; text-transform: uppercase;">Dominas muy bien alguna(s) materias? Ofrece tu apoyo a otros estudiantes</span>
                <br>
                <a href="perfil.php#asesor" class="btn btn-success" style="font-weight: bold">Quiero ser asesor!</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
        <div id="panel-info" class="panel panel-default">
            <div class="panel-heading">
                <p id="nombre_asesor" class="panel-title">ASESOR</p>
            </div>
            <div class="panel-body col-sm-offset-2 col-sm-8">
                <table id="tabla-asesores" class="table table-striped table-hovered table-responsive table-bordered">
                    <tr>
                        <td>Nombre:</td>
                        <td id="nombre-asesor"></td>
                    </tr>
                    <tr>
                        <td>Correo:</td>
                        <td id="usuario-asesor">correo@prueba.com</td>
                    </tr>
                    <tr>
                        <td>Teléfono</td>
                        <td id="telefono-asesor">123456789</td>
                    </tr>
                </table>
                <a id="lista_asesores" href="#">&lt;&lt; Lista de Asesores</a>
            </div>
        </div>
    </div>
</div>


</div>
<?php
require("php/footer_inc.php");
?>

<script>

    $.post("php/api_servicios.php", {"servicio": "asesores"}, function (response) {
        $("#tbl-asesores").dataTable({
            "language": {
                "url": "assets/datatables.spanish.lang.json"
            },
            "data": response.asesorias,
            "destroy": true,
            "deferRender": true
        });
    }, "json");

</script>
</body>
</html>