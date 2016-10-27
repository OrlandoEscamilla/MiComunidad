$.post("php/api_servicios.php", {"servicio": "profesores"}, function (data) {

    for (var i = 0; i < data.length; i++) {
        var linea = "<tr>" +
            "<td>" + data[i].nombre + "</td>" +
            "<td><a href='#' id='" + data[i].nombre + "' class='cargarComentario btn btn-success btn-sm'><i class='fa fa-eye'></i></a></td>" +
            "<td><a href='perfil.php' class='btn btn-success btn-sm calificar'><i class='fa fa-pencil'></i></a></td>" +
            "</tr>";
        $("#tabla_profesores").append(linea);
    }
    $(".cargarComentario").on("click", function () {
        $("#panel-comentario").show("medium");
        $("#panel-profesor").hide("medium");
        var nombre = $(this).attr("id");
        $("#nombre_profesor").text(nombre);
        $("#tabla_comentarios").empty();
        $.post("php/cargar_comentarios.php", {"nombre": nombre}, function (data) {
            var respuesta = $.parseJSON(data);
            console.log(respuesta);
            for (var j = 0; j < respuesta.length; j++) {
                $("#tabla_comentarios").append("<tr><td class='text-justify'>" + respuesta[j].evaluacion + "</td></tr>");
            }
        });
    });
}, "json");