var form_asesor = [];
/*, wp = ["0", "1"]*/

/*$(document).ready(function(){*/

$("#logout_btn").on("click", function () {
    window.location = "php/cerrar_sesion.php";
});

$("#mostrar_perfil").on("click", function () {
    $("#contenido_perfil").show("100");
});

$("#mostrar_asesoria").on("click", function () {
    $("#contenido_asesoria").show("100");
});

$("#submit_asesor").on("click", function () {
    var id = $("#asesor_id").val();
    var carrera = $("#asesor_carrera").val();
    var materia = $("#asesor_materia").val();
    var dominio = $("#asesor_dominio").val();
    var costo = $("#asesor_costo").val();
    var descripcion = $("#asesor_descripcion").val();

    var info_usuario = {
        "id": id,
        "carrera": carrera,
        "materia": materia,
        "dominio": dominio,
        "costo": costo,
        "descripcion": descripcion,
        "tipo": "asesoria"
    }

    $.post("php/registrar_info.php", info_usuario, function (data) {
        var respuesta = $.parseJSON(data);
        console.log(respuesta);
        bootbox.alert(respuesta.mensaje);
        $("#asesor_descripcion").val("");
    });
});

$("#submit_profesor").on("click", function () {
    var id = $("#asesor_id").val();
    var nombre = $("#profesor_nombre").val();
    var asistencia = $("#profesor_asistencia").val();
    var conocimiento = $("#profesor_conocimiento").val();
    var exigencia = $("#profesor_exigencia").val();
    var evaluacion = $("#profesor_evaluacion").val();

    var info_profesor = {
        "id": id,
        "nombre": nombre,
        "asistencia": asistencia,
        "conocimiento": conocimiento,
        "exigencia": exigencia,
        "evaluacion": evaluacion,
        "tipo": "evaluacion"
    }
    //console.log(info_profesor);

    $.post("php/registrar_info.php", info_profesor, function (data) {
        var respuesta = $.parseJSON(data);
        console.log(respuesta);
        bootbox.alert(respuesta.mensaje);
        $("#profesor_evaluacion").val("");
    });
});

$("#actualizar_evaluacion").on("click", function () {
    var id = $("#asesoria_id").val();
    var descripcion = $("#evaluacion_descripcion").val();

    var actualizar_evaluacion = {
        "id": id,
        "descripcion": descripcion,
        "tipo": "evaluacion",
    }
    //console.log(actualizar_evaluacion);

    $.post("php/actualizar_datos.php", actualizar_evaluacion, function (data) {
        var respuesta = $.parseJSON(data);
        console.log(respuesta);
        bootbox.alert("Actualización realizada");
        setTimeout(function () {
            window.location = "perfil.php";
        }, 1500);
        /*$("#profesor_evaluacion").val("");*/
    });
});


/*if(cargarProfesores){
 $("#panel-comentario").hide();
 } else {
 $("#panel-comentario").show();
 $("#panel-profesor").hide();
 }*/
$("#panel-comentario").hide();

$("#lista_profesores").on("click", function () {
    $("#panel-comentario").hide(200);
    $("#panel-profesor").show(200);
});

/*$(".cargarComentario").on("click", function(){
 $("#panel-comentario").show("medium");
 $("#panel-profesor").hide("medium");
 var nombre = $(this).attr("id");
 $("#nombre_profesor").text(nombre);
 $("#tabla_comentarios").empty();
 $.post("php/cargar_comentarios.php", {"nombre": nombre}, function(data){
 var respuesta = $.parseJSON(data);
 for(var i=0; i<respuesta.length; i++){
 $("#tabla_comentarios").append("<tr><td class='text-justify'>"+respuesta[i].evaluacion+"</td></tr>");
 }
 });
 });*/


$("#panel-info").hide();

$("#lista_asesores").on("click", function () {
    $("#panel-info").hide("medium");
    $("#panel-asesor").show("medium");
});

$(document).ready(function () {
    /*if (wp[0][1] == "evaluacion") {
     console.log("Estas editando una evaluación");
     console.log(wp);
     $(".editar_evaluacion").show();
     $(".editar_asesoria").hide();
     } else if (wp[0][1] == "asesoria") {
     console.log("Estas editando una asesoria");
     $(".editar_asesoria").show();
     $(".editar_evaluacion").hide();
     }*/
});
/*
 $("#btn-registro").click(function (e) {
 var email = $("#registro_email").val();
 var nombre = $("#registro_nombre").val();
 var pass = $("#registro_pass").val();
 var pass2 = $("#registro_pass2").val();
 var carrera = $("#carrera").val();
 var data = {
 "correo": email,
 "nombre": nombre,
 "password": pass,
 "carrera": carrera,
 "servicio": "registrar"
 };

 if (validateEmail(email)) {
 if (nombre != "") {
 if (pass != "" || pass2 != "") {
 if (pass === pass2) {
 $.post("php/api_servicios.php", data, function (response) {
 if (response.mensaje == "Registro exitoso") {
 bootbox.alert("Registro exitoso, por favor inicia sesión.", function () {
 window.location.reload();
 });
 }
 }, "json");
 } else {
 bootbox.alert("Las contraseñas no coinciden");
 }
 } else {
 bootbox.alert("Escribe una contraseña");
 }
 } else {
 bootbox.alert("Escribe un nombre");
 }
 } else {
 bootbox.alert("El correo es inválido");
 }
 return e.preventDefault();

 });
 */
/*$("#login_btn").on("click", function () {
    var email = $("#login_email").val();
    var pass = $("#login_pass").val();
    var ajax_data = {
        "email": email,
        "pass": pass,
        "servicio": "iniciar-sesion"
    };
    $.post("php/api_servicios.php", ajax_data, function (data) {
        var datos = data;
        console.log(datos);
        if (datos.mensaje != "login") {
            bootbox.alert("Tus datos son incorrectos, intentalo de nuevo");
        } else {
            $.post("index.php", data, function (data) {
                console.log("Según se enviaron los datos");
                window.location.href = "index.php";
            });
        }
    }, "json");
    return false;
});*/

var validateEmail = function (email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};


/*});*/
















