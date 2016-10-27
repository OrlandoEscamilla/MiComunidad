$.post("php/api_servicios.php", {"servicio": "asesores"}, function (data) {
    //console.log(data[1].id_usuario);
    for (var i = 0; i < data.length; i++) {
        var linea = "<td class='col-xs-2'><a href='#' id=" + data[i].id_usuario + " class='cargarAsesor'>" + data[i].nombre + "</a></td><td class='col-xs-2'>" + data[i].materia + "</td><td class='col-xs-6 text-justify'>" + data[i].descripcion + "</td><td class='col-xs-2'>" + data[i].costo + "</td>";
        $("#tbl-asesores").append("<tr>" + linea + "</tr>");

        $(".cargarAsesor").on("click", function () {
            console.log("Entre");
            $("#panel-info").show("medium");
            $("#panel-asesor").hide("medium");
            var id = $(this).attr("id");
            $.post("php/mostrarUsuario.php", {"id": id}, function (data) {
                var respuesta = $.parseJSON(data);
                $("#nombre-asesor").html(respuesta[0].nombre);
                $("#usuario-asesor").html(respuesta[0].email);
                $("#telefono-asesor").html(respuesta[0].telefono);
            });
        });
    }
}, "json");