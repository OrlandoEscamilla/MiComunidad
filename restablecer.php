<?php
require("php/head_inc.php");
require("../conexion.php");
if (!isset($_GET['token'])) {
    header("Location: index.php");
    exit();
} else {
    $query = $conexion->prepare("SELECT * FROM resetpassword WHERE token = :token");
    $query->bindParam(":token", $_GET['token']);

    if ($query->execute() and $query->rowCount() == 1) {

    } else {
        header("Location: index.php");
        exit();
    }
}
?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">
                    Cambiar mi contraseña
                </div>
            </div>
            <div class="panel-body">
                <form id="form-cambiar-contraseña" class="form">
                    <div class="form-group label-floating">
                        <label class="control-label">Nueva contraseña: </label>
                        <input type="password" name="pass" class="form-control" data-toggle="tooltip"
                               data-placement="top" title="Minimo 6 caracteres" required>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Repetir nueva contraseña: </label>
                        <input type="password" name="repass" class="form-control" data-toggle="tooltip"
                               data-placement="top" title="Minimo 6 caracteres" required>
                    </div>
                    <div class="form-group text-right">
                        <input type="hidden" name="token" value="">
                        <input type="hidden" name="servicio" value="cambiar-contraseña">
                        <input type="submit" class="btn btn-success" value="Guardar cambios">
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
        </div>
    </div>
</div>
<?php
require("php/footer_inc.php");
?>
<script>

    var token = window.location.search.split("&")[1].split("=")[1];
    $("input[name=token]").val(token);

    $("#form-cambiar-contraseña").on("submit", function (e) {
        e.preventDefault();

        if ($("input[name=pass]").val() === $("input[name=repass]").val() && $("input[name=pass]").val().length >= 6) {
            $.ajax({
                url: "php/api_servicios.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == "OK") {
                        $("#notificacion-success").show("200").siblings().hide();
                        $("#notificacion-success b").html(response.mensaje);
                        setTimeout(function () {
                            window.location.href = "acceder.php";
                        }, "5000");
                    } else {
                        $("#notificacion-danger").show("200").siblings().hide();
                        $("#notificacion-danger b").html(response.mensaje);
                    }
                }
            });
        }
    });
</script>
</body>
</html>

