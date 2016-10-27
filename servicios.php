<?php
require("php/head_inc.php");
require("php/conexion.php");

$query = $conexion->prepare("SELECT * FROM servicios");
$query->execute();

?>


<div class="row new">
    <div class="col-xs-10 col-xs-offset-1 introduccion">
        <p class="intro">
            En ITCM Asesorías encontrarás al asesor que necesitas para aprender
            más en la materia de tu interes, tenemos una gran cantidad de asesores
            clasificados por materias y proyectos.
        </p>
    </div>
</div>
<div class="row">
    <section class="main col-xs-12 col-sm-10 col-sm-offset-1">
        <table class="table table-striped">
            <caption style="text-align: center; font-size:20px; font-weight: bold; margin-bottom: 1em;">NUESTROS SERVICIOS</caption>
            <tr>
                <th>Servicio</th>
                <th>Asesor</th>
                <th>Descripción</th>
            </tr>
            <?php
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            while($row = array_shift($rows)){
                echo "<tr>
                        <td>".$row['servicio']."</td>
                        <td>".$row['asesor']."</td>
                        <td>".$row['descripcion']."</td>
                     </tr>";
            }
            ?>

        </table>
    </section>
</div>
</div>
<?php
require("php/footer_inc.php");
?>