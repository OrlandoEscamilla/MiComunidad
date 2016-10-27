<?php
include("php/head_inc.php");
if (isset($_SESSION['nombre'])) {
    echo "<script> window.location.href = 'index.php'</script>";
}
$carreras = ["Ambiental", "Eléctrica", "Electrónica", "Gestion", "Geociencias",
    "Industrial", "Mecánica", "Petrolera", "Química", "Sistemas", "ITIC"];
?>

<!-- SCRIPT PARA FACEBOOK LOGIN -->
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '175669589474239',
            xfbml: true,
            version: 'v2.6'
        });

        /*FB.getLoginStatus(function (response) {
         if (response.status === "connected") {

         } else {

         }
         });*/
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function login() {
        FB.login(function (response) {
            //console.log(response);
            if (response.status === "connected") {
                FB.api('/me', 'GET', {fields: 'name, email, picture.width(200).heigth(200)'}, function (response) {
                    var data = {
                        "nombre": response.name,
                        "email": response.email,
                        "foto": response.picture.data.url,
                        "servicio": "fb-login"
                    };
                    $.post("php/api_servicios.php", data, function (response) {
                        if (response.mensaje == "registro exitoso") {
                            bootbox.alert("Tu registro fue exitoso", function () {
                                window.location.reload();
                            });
                        } else if (response.mensaje == "login exitoso") {
                            bootbox.alert("Bienvenido a la comunidad", function () {
                                window.location.reload();
                            });
                        } else {
                            bootbox.alert("Acceso incorrecto", function () {
                                window.location.reload();
                            });
                        }
                    }, "json");
                });
            } else {
                bootbox.alert("Ha ocurrido un problema, consulta al webmaster");
            }
        }, {scope: "email"});
    }

    function logout() {
        FB.logout(function (response) {
        });
    }

    function getInfo() {
        FB.api('/me', 'GET', {fields: 'name, email, picture.width(200).heigth(200)'}, function (response) {
            console.log(response);
            //document.getElementById("status").innerHTML = "<img src='" + response.picture.data.url + "'/>";
        });
    }
</script>
<!-- SCRIPT PARA FACEBOOK LOGIN -->

<div class="row">
    <section class="seccion_noticias col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><p>Iniciar sesión</p></div>
            </div>
            <div class="panel-body">
                <section class="iniciar_sesion">
                    <form id="form-login" class="col-xs-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Ingresa tu email</label>
                            <input id="login_email" type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Ingresa tu password</label>
                            <input id="login_pass" type="password" class="form-control" name="pass" required>
                        </div>
                        <div class="" style="text-align: center;">
                            <input type="hidden" name="servicio" value="login">
                            <input id="login_btn" type="submit" class="btn btn-primary btn-danger"
                                   value="Iniciar sesión">
                        </div>
                    </form>
                    <div class="col-xs-12 text-center" style="margin-top: 35px">
                        <p><b>también puedes iniciar sesión con facebook o google</b></p>
                    </div>
                    <div>
                        <a onclick="login()" class="btn btn-block btn-social btn-facebook">
                            <span class="fa fa-facebook"></span> Iniciar sesión con Facebook
                        </a>
                    </div>
                    <div id="gSignInWrapper">
                        <div id="customBtn" class="btn btn-block btn-social btn-google">
                            <span class="fa fa-google"></span> Iniciar sesión con Google+
                        </div>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-default btn-round btn-recover-pass" data-toggle="modal"
                           data-target="#modalContraseña">Has olvidado tu contraseña?</a>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <section class="seccion_noticias col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><p>Registrarse</p></div>
            </div>
            <div class="panel-body">
                <section class="main col-xs-12">
                    <form id="form-registro">
                        <div class="form-group label-floating">
                            <label class="control-label">Email: </label>
                            <input id="registro_email" type="email" class="form-control" name="correo" required>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre y Apellido: </label>
                            <input id="registro_nombre" type="text" class="form-control" name="nombre" required>
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
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Contraseña: </label>
                            <input id="registro_pass" type="password" class="form-control" name="password"
                                   data-toggle="tooltip" data-placement="top" title="Minimo 6 caracteres" required>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label">Repetir Contraseña: </label>
                            <input id="registro_pass2" type="password" class="form-control" data-toggle="tooltip"
                                   data-placement="top" title="Minimo 6 caracteres" required>
                        </div>
                        <div class="form-group col-xs-12 col-sm-0 text-center">
                            <div class="g-recaptcha" data-sitekey="6LeXciMTAAAAAIRkv-8M5t-RP7wRgJd-HCDeWG70"
                                 data-theme="light" data-size="normal" style="display: inline-block;"></div>
                        </div>
                        <div class="form-group col-xs-12" style="text-align:center">
                            <input type="submit" class="btn btn-default btn-danger" id="btn-registro"
                                   value="Registrarse">
                            <input type="hidden" name="servicio" value="registrar">
                        </div>
                    </form>
                    <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
                </section>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalContraseña" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </button>
                    <h4 class="modal-title">Recuperar contraseña</h4>
                </div>
                <div class="modal-body">
                    <form id="form-recuperar-contraseña" class="">
                        <div class="form-group">
                            <input type="email" class="form-control" name="correo" placeholder="Introduce tu email"/>
                            <input type="hidden" name="servicio" value="recuperar-contraseña">
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-success" value="Recuperar">
                        </div>
                    </form>
                    <div>
                        <div id="notificacion-success" class="alert alert-success" style="display: none;">
                            <div class="container-fluid">
                                <div class="alert-icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                </button>
                                <b></b>
                            </div>
                        </div>
                        <div id="notificacion-danger" class="alert alert-danger" style="display: none;">
                            <div class="container-fluid">
                                <div class="alert-icon">
                                    <i class="fa fa-times"></i>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                </button>
                                <b></b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

</div>
<?php
include("php/footer_inc.php");
?>
<script src="https://apis.google.com/js/api:client.js"></script>
<script>
    var googleUser = {};
    var startApp = function () {
        gapi.load('auth2', function () {
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: 'your_own_id_key.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('customBtn'));
        });
    };

    function attachSignin(element) {
        auth2.attachClickHandler(element, {},
            function (googleUser) {
                var profile = googleUser.getBasicProfile();
                googleLogin(profile);
            }, function (error) {
                alert(JSON.stringify(error, undefined, 2));
            });
    }

    $("#form-registro").on("submit", function (e) {
        e.preventDefault();

        var email = $("#registro_email").val();
        var nombre = $("#registro_nombre").val();
        var pass = $("#registro_pass").val();
        var pass2 = $("#registro_pass2").val();

        if (validateEmail(email)) {
            if (nombre != "") {
                if (pass != "" || pass2 != "") {
                    if (pass.length >= 6) {
                        if (pass === pass2) {
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
                                        bootbox.alert(response.mensaje, function () {
                                            window.location.reload();
                                        });
                                    }
                                }
                            });
                        } else {
                            bootbox.alert("Las contraseñas no coinciden");
                        }
                    } else {
                        bootbox.alert("La contraseña debe contener minimo 6 caracteres");
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
    });

    var googleLogin = function (profile) {
        var data = {
            "servicio": "google-login",
            "email": profile.getEmail(),
            "nombre": profile.getName(),
            "foto": profile.getImageUrl()
        };
        $.post("php/api_servicios.php", data, function (response) {
            if (response.mensaje == "registro exitoso") {
                bootbox.alert("Tu registro fue exitoso", function () {
                    window.location.reload();
                });
            } else if (response.mensaje == "login exitoso") {
                bootbox.alert("Bienvenido a la comunidad", function () {
                    window.location.reload();
                });
            } else {
                bootbox.alert("Acceso incorrecto", function () {
                    window.location.reload();
                });
            }
        }, "json");
    };

    $("#login_bn").on("click", function () {
        var email = $("#login_email").val();
        var pass = $("#login_pass").val();
        var ajax_data = {
            "email": email,
            "pass": pass,
            "servicio": "login"
        };
        $.post("php/api_servicios.php", ajax_data, function (data) {
            bootbox.alert(data.mensaje, function () {
                if (data.status == "OK") {
                    window.location.reload();
                }
            });
        }, "json");
        return false;
    });

    $("#form-login").on("submit", function (e) {
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
                bootbox.alert(response.mensaje, function () {
                    if (response.status == "OK") {
                        window.location.reload();
                    }
                });
            }
        });
    });

    $("#form-recuperar-contraseña").on("submit", function (e) {
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
                    $("#notificacion-success").show("200").siblings().hide();
                    $("#notificacion-success b").html(response.mensaje);
                } else {
                    $("#notificacion-danger").show("200").siblings().hide();
                    $("#notificacion-danger b").html(response.mensaje);
                }
                setTimeout(function () {
                    //$("#modalContraseña").modal('hide');
                    window.location.reload();
                }, "5000");
            }
        });
    });

    startApp();
</script>
</body>
</html>
