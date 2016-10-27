<?php
require("php/head_inc.php");
?>

<div class="row">

    <!-- PANEL ADMINISTRADOR -->
    <aside id="mod_admin" class="col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-0">

        <!-- MENU RESPONSIVO -->
        <div class="panel panel-default admin-responsive">
            <div class="panel-heading">
                <div class="panel-title">ADMINISTRADOR</div>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal col-xs-12">
                    <select id="menu-admin" class="form-control">
                        <option value="opt-disclaimer">DISCLAIMER</option>
                        <option value="opt-faq">PREGUNTAS FRECUENTES</option>
                        <option value="opt-contacto">CONTACTO</option>
                        <option value="opt-colaboradores">COLABORADORES</option>
                    </select>
                </form>
            </div>
        </div>
        <!-- MENU RESPONSIVO -->

        <div class="panel panel-default admin-nonresponsive">
            <div class="panel-heading">
                <div class="panel-title">ELIGE UNA OPCIÓN</div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li id="show_faq" role="presentation" class="admin-opcion">
                        <a href="#mod_faq">PREGUNTAS FRECUENTES</a>
                    </li>
                    <li id="show_contacto" role="presentation" class="admin-opcion">
                        <a href="#mod_contacto">CONTACTO</a>
                    </li>
                    <li id="show_disclaimer" role="presentation" class="admin-opcion">
                        <a href="#mod_disclaimer">DISCLAIMER</a>
                    </li>
                    <li id="show_colaboradores" role="presentation" class="admin-opcion">
                        <a href="#mod_colaboradores">COLABORADORES</a>
                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <!-- PANEL ADMINISTRADOR -->

    <!-- SECCIÓN BIENVENIDA -->
    <section id="mod_disclaimer" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">EXCLUSIÓN DE RESPONSABILIDAD</p>
            </div>
            <div class="panel-body no-padding bienvenido">
                <div class="well" style="font-size: 20px">
                    <p class="text-justify">Comunidad ITCM es una plataforma libre y gratuita para los estudiantes del
                        tec de madero. Fue planeada para servir como guía y referencia para todos aquellos
                        que deseen participar en el proyecto. No esta regulada por ninguna autoridad, solo por
                        alumnos de la misma institución. Es un plataforma que busca mejorar constantemente y sin fines
                        de lucro, además ha sido liberada con una licencia Apache 2.0 para que cualquier persona pueda
                        ver o modificar el proyecto.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- SECCIÓN BIENVENIDA -->

    <!-- SECCIÓN F.A.Q. -->
    <section id="mod_faq" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">PREGUNTAS FRECUENTES</p>
            </div>
            <div class="panel-body no-padding">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                <h4 class="panel-title">
                                    ¿Cuáles son los navegadores recomendados?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p>R: Google Chrome y Mozilla Firefox son totalmente compatibles con este sitio, tanto
                                    en su version de escritorio como en versión móvil. Otros navegadores podrían
                                    presentar problemas de compatibilidad con el sitio.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 class="panel-title">
                                    ¿Por qué no puedo registrarme / iniciar sesión con Facebook?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>R: Si usas un bloqueador de publicidad como Adblock o Ghostery estos pueden bloquear
                                    los rastreadores de Facebook, Google, entre otros. Asegurate de desactivaros o
                                    añadir a
                                    la lista blanca el sitio Comunidad ITCM.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4 class="panel-title">
                                    ¿Por qué no me llegan las notificaciones a mi computadora/celular si ya he iniciado
                                    sesión?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingThree">
                            <div class="panel-body">
                                <p>R: Debes asegurarte de permitir las notificaciones en el navegador.</p>
                                <img src="http://www.practica.eichgi.com/notificaciones.gif" alt="">
                                <p>Actualmente las notificaciones no estan 100% habilitadas en Safari iOS (incluso Chrome
                                    para iOS presenta problemas). En Escritorio y Android son 100% funcionales con las últimas versiones.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- SECCIÓN F.A.Q. -->

    <!-- SECCIÓN CONTACTO -->
    <section id="mod_contacto" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">CONTACTO</p>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 well">
                    <h4 class="">
                        <i class="fa fa-question"></i>&nbsp;
                        Si tienes alguna duda, sugerencia, o estás interesado en participar más a fondo
                        no dudes en contactar al staff encargado en la siguiente dirección: contacto@comunidaditcm.com
                    </h4>
                    <br>
                    <h4>
                        <i class="fa fa-life-saver"></i>&nbsp;
                        Si te ha gustado este proyecto y deseas contribuir como desarrollador o diseñador te invito a
                        que
                        revises el repositorio oficial: <a href="http://google.com" target="_blank">GitHub</a></h4>
                    <br>
                    <h4>
                        <i class="fa fa-usd"></i>&nbsp;
                        Si te interesa un proyecto similar con fines comerciales o algún trabajo particular te invito a
                        que
                        revises mi sitio personal: <a href="https://eichgi.com" target="_blank">eichgi.com</a></h4>
                </div>
            </div>
    </section>
    <!-- SECCIÓN CONTACTO -->

    <!-- SECCIÓN COLABORADORES -->
    <section id="mod_colaboradores" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">NUESTROS COLABORADORES</p>
            </div>
            <div class="panel-body">
                <div class="col-xs-12 well">
                    <div class="col-xs-6 col-xs-offset-0 col-sm-4 col-sm-offset-0">
                        <div class="staff-image text-center">
                            <img class="img-circle" src="img/square-me.jpg" alt="Hiram Guerrero" width="50%">
                            <h4><b>Creador y Administrador</b></h4>
                            <p>Hiram Guerrero</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-xs-offset-0 col-sm-4 col-sm-offset-0">
                        <div class="staff-image text-center">
                            <img class="img-circle" src="img/requena.jpg" alt="Avatar" width="50%">
                            <h4><b>Administrador</b></h4>
                            <p>Francisco Requena</p>
                        </div>
                    </div>
                    <div class="col-xs-6 col-xs-offset-0 col-sm-4 col-sm-offset-0">
                        <div class="staff-image text-center">
                            <img class="img-circle" src="img/yadira.jpg" alt="Avatar" width="50%">
                            <h4><b>Administrador</b></h4>
                            <p>Yadira Ortíz</p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- SECCIÓN COLABORADORES -->

</div>


<?php
require("php/footer_inc.php");
?>
<script>
    $("#mod_disclaimer").show().siblings().hide();
    $("#mod_admin").show();
    $("#show_disclaimer").addClass("active");

    $("#show_faq").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_faq").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_contacto").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_contacto").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_disclaimer").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_disclaimer").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_colaboradores").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_colaboradores").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#menu-admin").change(function () {
        switch ($(this).val()) {
            case "opt-faq":
                $("#show_faq").trigger("click");
                break;
            case "opt-contacto":
                $("#show_contacto").trigger("click");
                break;
            case "opt-disclaimer":
                $("#show_disclaimer").trigger("click");
                break;
            case "opt-colaboradores":
                $("#show_colaboradores").trigger("click");
                break;
        }
    });

</script>
</body>
</html>















