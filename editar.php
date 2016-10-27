<?php
include("php/head_inc.php");
require("php/conexion.php");
if (!isset($_GET['tipo'])) {

} else {

    $dominios = ["Básico", "Intermedio", "Avanzado"];
    $costos = ["Gratuito", "Por Acordar"];
    try {
        if ($_GET['tipo'] == "asesoria") {
            $query = $conexion->prepare("SELECT * FROM asesorias WHERE id = :id");
            $query->bindParam(":id", $_GET['id']);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
        } else if ($_GET['tipo'] == "evaluacion") {
            $query = $conexion->prepare("SELECT * FROM evaluaciones WHERE id = :id");
            $query->bindParam(":id", $_GET['id']);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<div class="row editar_asesoria">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">Editar asesoría</p>
            </div>
            <div class="panel-body">
                <form class="form-horizontal col-sm-6">
                    <input id="asesoria_id" type="text" hidden="hidden" value="<?php echo $_GET['id']; ?>">

                    <div class="form-group label-floating">
                        <label class="control-label">Asesor:</label>
                        <div class="">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['nombre'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Carrera:</label>
                        <div class="">
                            <input id="asesoria_carrera" type="text" class="form-control"
                                   value="<?php echo $row['carrera'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Materia:</label>
                        <div class="">
                            <input type="text" class="form-control" value="<?php echo $row['materia'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Dominio:</label>
                        <select id="asesoria_dominio" class="form-control">
                            <?php
                            foreach ($dominios as $dominio) {
                                echo "<option value='$dominio'>$dominio</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Costo:</label>
                        <select id="asesoria_costo" class="form-control">
                            <?php
                            foreach ($costos as $costo) {
                                echo "<option value='$costo'>$costo</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Describe la forma en que ofreces asesorías.</label>
                        <textarea name="" id="asesoria_descripcion" cols="30" rows="6" class="form-control"
                                  value="<?php echo $row['descripcion'] ?>"><?php echo $row['descripcion'] ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <a id="actualizar_asesoria" type="button" class="btn btn-warning">
                                <i class="fa fa-pencil"> Actualizar asesoría</i>
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="row editar_evaluacion">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">Editar evaluación</p>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal">
                    <input id="asesoria_id" type="text" hidden="hidden" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group">
                        <label for="" class="control-label col-xs-offset-1 col-sm-2 col-sm-offset-2">Profesor: </label>
                        <div class="col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                            <input type="text" class="form-control" value="<?php echo $row['nombre_profesor'] ?>"
                                   disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre"
                               class="control-label col-xs-offset-1 col-sm-2 col-sm-offset-2">Comentario: </label>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0">
                            <textarea name="" id="evaluacion_descripcion" cols="30" rows="9" class="form-control"
                                      placeholder="Algun comentario que quieras hacer?"
                                      value="<?php echo $row['descripcion'] ?>"><?php echo $row['evaluacion'] ?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-5">
                            <input id="actualizar_evaluacion" type="button" class="btn btn-default btn_sbmt"
                                   value="Actualizar evaluación">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


</div>
<?php
include("php/footer_inc.php");
?>
<script>
    var wp = window.location.search;
    wp = wp.replace('?', '').split('&');
    wp[0] = wp[0].split('=');
    wp[1] = wp[1].split('=');

    if (wp[0][1] == "evaluacion") {
        $(".editar_evaluacion").show();
        $(".editar_asesoria").hide();
    } else if (wp[0][1] == "asesoria") {
        $(".editar_asesoria").show();
        $(".editar_evaluacion").hide();
    }
</script>
</body>
</html>