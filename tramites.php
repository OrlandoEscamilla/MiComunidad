<?php
require("php/head_inc.php");
?>

<div class="row">

    <!-- PANEL ADMINISTRADOR -->
    <aside id="mod_admin" class="col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-0">

        <!-- MENU RESPONSIVO -->
        <div class="panel panel-default admin-responsive">
            <div class="panel-heading">
                <div class="panel-title">ELIGE UNA OPCIÓN</div>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal col-xs-12">
                    <select id="menu-admin" class="form-control">
                        <option value="opt-cc">CRÉDITOS COMPLEMENTARIOS</option>
                        <option value="opt-ss">SERVICIO SOCIAL</option>
                        <option value="opt-practicas">RESIDENCIAS PROFESIONALES</option>
                        <option value="opt-titulacion">TITULACIÓN</option>
                    </select>
                </form>
            </div>
        </div>
        <!-- MENU RESPONSIVO -->

        <div class="panel panel-default admin-nonresponsive">
            <div class="panel-heading">
                <div class="panel-title">ELIJE UNA OPCIÓN</div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li id="show_cc" role="presentation" class="admin-opcion">
                        <a href="#mod_cc">CRÉDITOS COMPLEMENTARIOS</a>
                    </li>
                    <li id="show_ss" role="presentation" class="admin-opcion">
                        <a href="#mod_ss">SERVICIO SOCIAL</a>
                    </li>
                    <li id="show_pp" role="presentation" class="admin-opcion">
                        <a href="#mod_pp">PRÁCTICAS PROFESIONALES</a>
                    </li>
                    <li id="show_titulacion" role="presentation" class="admin-opcion">
                        <a href="#mod_titulacion">TITULACIÓN</a>
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
                <p class="panel-title">GUÍA DE TRÁMITES</p>
            </div>
            <div class="panel-body no-padding bienvenido">
                <div class="well" style="font-size: 20px">
                    <p class="text-justify">Bienvenido a esta sección, aquí encontrarás información que te ayudará a
                        realizar todos los trámites que un estudiante del ITCM necesita realizar durante su estancia en
                        el Insituto.</p>
                    <p>Por favor elige una opción del panel para poder visualizar la información; si tienes alguna duda
                        o sugerencia por favor dirígete al módulo de <a class="link-soporte"
                                                                        href="soporte.php">soporte</a> donde encontrarás
                        la forma de contactar con el administrador del sitio.</p>
                    <p>Ten en cuenta que la información aquí proveída podría cambiar, si notas alguna discrepancia en
                        cuanto a la información oficial no dudes en hacérnoslo saber. Gracias</p>
                </div>
            </div>
        </div>
    </section>
    <!-- SECCIÓN BIENVENIDA -->

    <!-- SECCIÓN C.C. -->
    <section id="mod_cc" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">CRÉDITOS COMPLEMENTARIOS</p>
            </div>
            <div class="panel-body no-padding">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                <h4 class="panel-title">
                                    ¿Qué son los créditos complementarios?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingOne">
                            <div class="panel-body">
                                <p>R: Los Créditos Complementarios (CC) son oficios que obtienes cada vez que haces una
                                    actividad extracurricular como estudiante. Es necesario obtener una cantidad de al
                                    menos 5 CC para que puedas realizar más trámites como el Servicio Social. Durante el
                                    1° Semestre que cursas en el ITCM debes de realizar tu primera actividad donde
                                    puedes obtener de 1 a 2 CC una vez que hayas cumplido con tu participación.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 class="panel-title">
                                    ¿Cualés son las actividades donde puedo obtener CC?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <p>R: Los tipos de actividades en el Instituto pueden ser deportivas, artísticas o de
                                    apoyo en la gestión de conferencias y/o eventos. Ejemplos de actividades son:
                                    Basketball, Fútbol, Americano,
                                    Ajedrez, Danza, Música, Dibujo. Apoyar en la logística de los eventos propios de
                                    cada carrera así como también participar en la limpieza del Instituto puede hacerte
                                    acreedor de algunos. </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h4 class="panel-title">
                                    ¿A que oficina debo recurrir para inscribirme o solicitar mayor información?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingThree">
                            <div class="panel-body">
                                <p>La oficina de actividades extracurriculares se encuentra en el gimnasio. Entrando en
                                    la puerta a mano izquierda. El horario de atención es de Lunes a Viernes de 09:00 a
                                    14:00.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <h4 class="panel-title">
                                    Información importante sobre los CC
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingFour">
                            <div class="panel-body">
                                <p>Al momento de finalizar una actividad debes ir a la oficina por tu oficio de
                                    terminacion de la actividad realizada. Esta contendrá la actividad, el periodo de
                                    realización, tus datos así como también el número de créditos obtenidos. NO DEBES
                                    PERDER LOS OFICIOS, PUES UNA VEZ QUE VAYAS A INICIAR TU SERVICIO SOCIAL DEBES
                                    PRESENTARLOS CON TU SECRETARIA DE CARRERA.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SECCIÓN C.C. -->

    <!-- SECCIÓN S.S. -->
    <section id="mod_ss" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">SERVICIO SOCIAL</p>
            </div>
            <div class="panel-body no-padding">
                <div class="panel-group" id="accordionSS" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaSSUno">
                            <a role="button" data-toggle="collapse" data-parent="#accordionSS" href="#ssUno"
                               aria-expanded="true" aria-controls="ssUno">
                                <h4 class="panel-title">
                                    ¿Qué es el Servicio Social?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ssUno" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="preguntaSSUno">
                            <div class="panel-body">
                                <p>R: Es una actividad que todas las personas que estudien en nivel superior deben
                                    realizar como apoyo en instituciones públicas o de gobierno. Se deben cumplir con un
                                    periodo de 280 horas y no necesariamente debe ser relacionado a la carrera que se
                                    estudia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaSSDos">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionSS"
                               href="#ssDos" aria-expanded="false" aria-controls="ssDos">
                                <h4 class="panel-title">
                                    ¿Requisitos para tramitar el SS?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ssDos" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaSSDos">
                            <div class="panel-body">
                                <p>R: Debes haber completado el 80% de tus créditos para poder iniciar el trámite en
                                    linea, también debes tener al menos 5 CC. Te solicitarán 2 fotografías tamaño
                                    infantil, además de los siguientes documentos:
                                <ul>
                                    <li>Documento #1</li>
                                    <li>Documento #2</li>
                                    <li>Documento #3</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaSSTres">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionSS"
                               href="#ssTres" aria-expanded="false" aria-controls="ssTres">
                                <h4 class="panel-title">
                                    ¿A que oficina debo recurrir para inscribirme o solicitar mayor información?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ssTres" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaSSTres">
                            <div class="panel-body">
                                <p>R: Si necesitas mayor información acude a la oficina de Servicio Social, la cuál se
                                    encuentra en el edificio
                                    Administrativo. Entrando al edificio a mano izquierda y luego por el pasillo a la
                                    derecha. Justo al lado de la oficina del Centro de Computo. El horario para realizar
                                    trámites es de 08:00 a 12:00.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaSSCuatro">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionSS"
                               href="#ssCuatro" aria-expanded="false" aria-controls="ssCuatro">
                                <h4 class="panel-title">
                                    Información importante sobre el SS
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ssCuatro" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaSSCuatro">
                            <div class="panel-body">
                                <p>Tienes un periodo máximo de 6 meses para finalizar tu SS desde el momento en que lo
                                    inscribiste. Procura entregar tus documentos en tiempo y forma.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--div class="pregunta">
                    <h4 class="text-danger">¿Qué es el Servicio Social (S.S.) ?</h4>
                    <p>R: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, mollitia, nihil. Accusamus
                        atque distinctio ea, eligendi error et, harum itaque laudantium necessitatibus nostrum numquam
                        optio quidem, quos ratione similique totam.</p>
                </div>
                <div class="pregunta">
                    <h4 class="text-danger">¿Qué requisitos debo cumplir para hacer el S.S.?</h4>
                    <p>R: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, mollitia, nihil. Accusamus
                        atque distinctio ea, eligendi error et, harum itaque laudantium necessitatibus nostrum numquam
                        optio quidem, quos ratione similique totam.</p>
                </div>
                <div class="pregunta">
                    <h4 class="text-danger">¿Dónde debo tramitar el S.S.?</h4>
                    <p>R: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, mollitia, nihil. Accusamus
                        atque distinctio ea, eligendi error et, harum itaque laudantium necessitatibus nostrum numquam
                        optio quidem, quos ratione similique totam.</p>
                </div-->
            </div>
    </section>
    <!-- SECCIÓN S.S. -->

    <!-- SECCIÓN P.P. -->
    <section id="mod_pp" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">RESIDENCIAS PROFESIONALES</p>
            </div>
            <div class="panel-body no-padding">
                <div class="panel-group" id="accordionPP" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaPPUno">
                            <a role="button" data-toggle="collapse" data-parent="#accordionPP" href="#ppUno"
                               aria-expanded="true" aria-controls="ppUno">
                                <h4 class="panel-title">
                                    ¿Qué son las prácticas profesionales?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ppUno" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="preguntaPPUno">
                            <div class="panel-body">
                                <p>R: Se conciben las prácticas profesionales (PP) como una estrategia educativa, con un
                                    carácter curricular, que permite al estudiante, aún estando en proceso de formación,
                                    incorporarse profesionalmente a los sectores productivos de bienes y servicios, a
                                    través del desarrollo de un proyecto definido de trabajo profesional, asesorado por
                                    instancias académicas e instancias externas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaPPDos">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionPP"
                               href="#ppDos" aria-expanded="false" aria-controls="ppDos">
                                <h4 class="panel-title">
                                    ¿Requisitos para tramitar las PP?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ppDos" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaPPDos">
                            <div class="panel-body">
                                <p>R: Debes tener
                                <ul>
                                    <li>Carta de terminación de S.S.</li>
                                    <li>Registrados en el SII tus C.C.</li>
                                    <li>Horario sellado del semestre en curso</li>
                                    <li>Cursar como máximo tus 2 últimas materias</li>
                                </ul>
                                A continuación una gráfica del flujo de los trámites para poder realizarlo:
                                <a href="img/residencias.jpg"><img src="img/residencias.jpg" alt="" width="100%"></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaPPTres">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionPP"
                               href="#ppTres" aria-expanded="false" aria-controls="ppTres">
                                <h4 class="panel-title">
                                    ¿A que oficina debo recurrir para inscribirme o solicitar mayor información?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ppTres" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaPPTres">
                            <div class="panel-body">
                                <p>R: Si necesitas mayor información acude a la oficina de Servicio Social, la cuál se
                                    encuentra en el edificio Administrativo. Entrando al edificio a mano izquierda y
                                    luego por el pasillo a la derecha. Justo al lado de la oficina del Centro de
                                    Computo. El horario para realizar trámites es de 08:00 a 12:00.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaPPCuatro">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionPP"
                               href="#ppCuatro" aria-expanded="false" aria-controls="ppCuatro">
                                <h4 class="panel-title">
                                    Información importante sobre las PP
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ppCuatro" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaPPCuatro">
                            <div class="panel-body">
                                <p>
                                <ul>
                                    <li>Para poder iniciar el trámite debes acudir en las fechas establecidas en el
                                        calendario escolar para el semestre en curso (Qué es entre el primer y segundo
                                        mes
                                        después de haber iniciado el semestre).
                                    </li>
                                    <li>
                                        <b>Debes cumplir con al menos 500 HORAS en un periodo no menor a 4 meses y no
                                            mayor a 6 meses.
                                        </b>
                                    </li>
                                    <li>Además es importante acudir al departamento de vinculación de tu carrera, los
                                        profesores encargados siempre realizan juntas informativas sobre <b>CUÁNDO,
                                            DÓNDE Y CÓMO</b> debes realizar el prodecimiento.
                                    </li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--div class="pregunta">
                    <h4 class="text-danger">¿Qué es el Servicio Social (S.S.) ?</h4>
                    <p>R: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, mollitia, nihil. Accusamus
                        atque distinctio ea, eligendi error et, harum itaque laudantium necessitatibus nostrum numquam
                        optio quidem, quos ratione similique totam.</p>
                </div>
                <div class="pregunta">
                    <h4 class="text-danger">¿Qué requisitos debo cumplir para hacer el S.S.?</h4>
                    <p>R: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, mollitia, nihil. Accusamus
                        atque distinctio ea, eligendi error et, harum itaque laudantium necessitatibus nostrum numquam
                        optio quidem, quos ratione similique totam.</p>
                </div>
                <div class="pregunta">
                    <h4 class="text-danger">¿Dónde debo tramitar el S.S.?</h4>
                    <p>R: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum, mollitia, nihil. Accusamus
                        atque distinctio ea, eligendi error et, harum itaque laudantium necessitatibus nostrum numquam
                        optio quidem, quos ratione similique totam.</p>
                </div-->
            </div>
    </section>
    <!-- SECCIÓN P.P. -->

    <!-- SECCIÓN TITULACIÓN -->
    <section id="mod_titulacion" class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p class="panel-title">TITULACIÓN</p>
            </div>
            <div class="panel-body">
                <div class="panel-group" id="accordionTitulacion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaTitulacionUno">
                            <a role="button" data-toggle="collapse" data-parent="#accordionTitulacion"
                               href="#titulacionUno"
                               aria-expanded="true" aria-controls="titulacionUno">
                                <h4 class="panel-title">
                                    Proceso de Titulación
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="titulacionUno" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="preguntaPPUno">
                            <div class="panel-body">
                                <p>R: Se conciben las prácticas profesionales (PP) como una estrategia educativa, con un
                                    carácter curricular, que permite al estudiante, aún estando en proceso de formación,
                                    incorporarse profesionalmente a los sectores productivos de bienes y servicios, a
                                    través del desarrollo de un proyecto definido de trabajo profesional, asesorado por
                                    instancias académicas e instancias externas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaTitulacionDos">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionTitulacion"
                               href="#titulacionDos" aria-expanded="false" aria-controls="titulacionDos">
                                <h4 class="panel-title">
                                    Requisitos para realizar el proceso de Titulación
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="titulacionDos" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaPPDos">
                            <div class="panel-body">
                                <p>R: Debes haber completado el 80% de tus créditos para poder iniciar el trámite en
                                    linea, también debes tener al menos 5 CC. Te solicitarán 2 fotografías tamaño
                                    infantil, además de los siguientes documentos:
                                <ul>
                                    <li>Documento #1</li>
                                    <li>Documento #2</li>
                                    <li>Documento #3</li>
                                </ul>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaTitulacionTres">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionTitulacion"
                               href="#titulacionTres" aria-expanded="false" aria-controls="titulacionTres">
                                <h4 class="panel-title">
                                    ¿A que oficina debo recurrir para inscribirme o solicitar mayor información?
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="titulacionTres" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaPPTres">
                            <div class="panel-body">
                                <p>R: Si necesitas mayor información acude a la oficina de Servicio Social, la cuál se
                                    encuentra en el edificio Administrativo. Entrando al edificio a mano izquierda y
                                    luego por el pasillo a la derecha. Justo al lado de la oficina del Centro de
                                    Computo. El horario para realizar trámites es de 08:00 a 12:00.</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="preguntaTitulacionCuatro">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordionTitulacion"
                               href="#ttCuatr" aria-expanded="false" aria-controls="ttCuatro">
                                <h4 class="panel-title">
                                    Información importante sobre el proceso de Titulación
                                    <i class="fa fa-caret-down"></i>
                                </h4>
                            </a>
                        </div>
                        <div id="ttCuatro" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="preguntaTitulacionCuatro">
                            <div class="panel-body">
                                <p>Tienes un periodo máximo de 6 meses para finalizar tu SS desde el momento en que lo
                                    inscribiste. Procura entregar tus documentos en tiempo y forma.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- SECCIÓN S.S. -->

</div>


<?php
require("php/footer_inc.php");
?>
<script>
    $("#mod_disclaimer").show().siblings().hide();
    $("#mod_admin").show();
    $("#show_disclaimer").addClass("active");

    $("#show_cc").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_cc").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_ss").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_ss").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_pp").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_pp").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#show_titulacion").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        $("#mod_titulacion").show("300").siblings().hide();
        $("#mod_admin").show();
    });

    $("#menu-admin").change(function () {
        switch ($(this).val()) {
            case "opt-cc":
                $("#show_cc").trigger("click");
                break;
            case "opt-ss":
                $("#show_ss").trigger("click");
                break;
            case "opt-pp":
                $("#show_pp").trigger("click");
                break;
            case "opt-titulacion":
                $("#show_titulacion").trigger("click");
                break;
        }
    });

</script>
</body>
</html>















