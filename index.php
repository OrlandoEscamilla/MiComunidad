<?php
include("php/head_inc.php");
?>

<div class="row">
    <section class="seccion_noticias col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><p>Noticias</p></div>
            </div>
            <div class="panel-body panel-noticias"></div>
            <div class="panel-footer">
                <nav>
                    <ul class="pager">
                        <li id="link-anteriores" class="previous"><a class="no-jump" href="#">&larr; Anteriores</a></li>
                        <li id="link-recientes" class="next"><a class="no-jump" href="#">Siguientes &rarr;</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <section class="seccion_eventos col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><p>En el Tec</p></div>
            </div>
            <div class="panel-body panel-blog"></div>
            <div class="panel-footer">
                <nav>
                    <ul class="pager">
                        <li id="blog-anteriores" class="previous"><a class="no-jump" href="#">&larr; Anteriores</a></li>
                        <li id="blog-recientes" class="next"><a class="no-jump" href="#">Siguientes &rarr;</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</div>
<?php
include("php/footer_inc.php");
?>
<script>
    var indiceNoticias = 0, indiceBlog = 0, paginasBlog;
    var noticias, entradas;
    var dataBlog = {
        "servicio": "ultimas-entradas",
        "index": (indiceBlog * 3)
    };

    //Obtener el número total de entradas
    $.post("php/api_servicios.php", {"servicio": "total-entradas"}, function (response) {
        if (response.status == "OK") {
            paginasBlog = Math.ceil(response.total / 3) - 1;
        }
    }, "json");

    $.post("php/api_servicios.php", {"servicio": "ultimas-noticias"}, function (response) {
        noticias = response.ultimas;
        ponerNoticias();
    }, "json");

    var ponerNoticias = function () {
        $(".panel-noticias").fadeOut(300, function () {
            $(".panel-noticias").empty();
            for (var i = indiceNoticias * 3; i < (indiceNoticias + 1) * 3; i++) {
                if (noticias[i] !== undefined) {
                    var imagen = (noticias[i].tipo == "noticia") ? "img/speaker.png" : "img/calendar.png";
                    $(".panel-noticias").append(
                        '<div class="noticia">' +
                        '<h5 class="titulo_noticia">' + noticias[i].titulo + '</h5>' +
                        '<figure class="tipo_logo"><img src=' + imagen + ' width="100%"/></figure>' +
                        '<div class="well">' + noticias[i].contenido + '</div>' +
                        '</div>' +
                        '');
                } else {
                    break;
                }
            }
            if (indiceNoticias == 0) {
                $("#link-recientes").addClass("disabled");
            } else if (indiceNoticias == 3) {
                $("#link-anteriores").addClass("disabled");
            } else {
                $("#link-anteriores, #link-recientes").removeClass("disabled");
            }
            $(".panel-noticias").fadeIn(300);
        });
    };

    var ponerBlog = function () {
        $.post("php/api_servicios.php", dataBlog, function (response) {
            entradas = response.entradas;
            $(".panel-blog").fadeOut(300, function () {
                $(".panel-blog").empty();
                $.each(entradas, function (index, value) {
                    var fecha = value.fecha_publicacion.split(" ");
                    fecha = fecha[0].split("-").reverse().join("/");
                    $(".panel-blog").append(
                        '<div class="post row"> ' +
                        '<div class="post-titulo col-xs-12"> ' +
                        '<h4 class="pull-left">' + value.titulo + '</h4> ' +
                        '<h4 class="pull-right">' + fecha + '</h4> ' +
                        '</div> ' +
                        '<div class="post-img col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3"> ' +
                        '<img src="images/publicaciones/' + value.imagen + '" alt="" style="width: 100%;"> ' +
                        '</div> ' +
                        '<div class="post-descripcion col-xs-12"> ' +
                        '<div class="well"> ' +
                        '<p class="">' + value.contenido + '</p> ' +
                        '<br> ' +
                        '<p style="text-align: right;">Publicado por <b>' + value.autor + '</b></p> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div>' +
                        '<hr>');
                });
                $("#blog-recientes").addClass("disabled");
                if (paginasBlog == 0) {
                    $("#blog-anteriores").addClass("disabled");
                } else {
                    if (indiceBlog == paginasBlog) {
                        $("#blog-anteriores").addClass("disabled");
                        $("#blog-recientes").removeClass("disabled");
                    } else if (indiceBlog == 0) {
                        $("#blog-recientes").addClass("disabled");
                        $("#blog-anteriores").removeClass("disabled");
                    } else {
                        $("#blog-anteriores, #blog-recientes").removeClass("disabled");
                    }
                }
                $(".panel-blog").fadeIn(300);
            });
        }, "json");
    };

    $("#link-anteriores").click(function () {
        if (indiceNoticias < 3) {
            indiceNoticias++;
            ponerNoticias();
        }
    });

    $("#link-recientes").click(function () {
        if (indiceNoticias > 0) {
            indiceNoticias--;
            ponerNoticias();
        }
    });

    var retrocederPagina = function () {
        indiceBlog++;
        dataBlog.index = (indiceBlog * 3);
        ponerBlog();
    };

    var avanzarPagina = function () {
        indiceBlog--;
        dataBlog.index = (indiceBlog * 3);
        ponerBlog();
    };

    $("#blog-anteriores").click(function () {
        if (!$(this).hasClass("disabled")) {
            retrocederPagina();
            //console.log("Página: " + indiceBlog);
        }
    });

    $("#blog-recientes").click(function () {
        if (!$(this).hasClass("disabled")) {
            avanzarPagina();
            //console.log("Página: " + indiceBlog);
        }
    });

    $(".no-jump").click(function (e) {
        e.preventDefault();
    });

    ponerBlog();

</script>
</body>
</html>















