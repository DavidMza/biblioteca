$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {

        app.init = function () {
            app.cargarPagina();
            app.bindings();
        };

        app.bindings = function () {


        };

        app.cargarPagina = function () {
            app.listarUltimosLibros();
            app.listarClasificaciones();
            app.listarCaracteristicas();
            app.listarDestacados();


            $.getScript("../recursos/portalWeb/home/js/jquery.jcarousel.min.js");
            $.getScript("js/funcionesHome.js");
        };

        app.listarUltimosLibros = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listarUltimos";
            datos.formulario = "Libro";
            datos.seccion = "portal";
            $.post(url, datos, function (data) {
                console.log(data);
                $.each(data, function (clave, valor) {
                    $("#ultimos").append('<li><div class="image"><img src="../' + valor.ruta + '" alt="" /></div><div class="details"><h2>' + valor.titulo + '</h2><h3>' + valor.autor + '</h3><p class="title">Editorial: ' + valor.editorial + '</p></div></li>');
                });
            }, "json");
        };

        app.listarDestacados = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listarDestacados";
            datos.formulario = "Libro";
            datos.seccion = "portal";
            $.post(url, datos, function (data) {
                console.log(data);
                $.each(data, function (clave, valor) {
                    $("#destacados").append('<li><div class="product"><a href="#" class="info"><span class="holder"><img src="../' + valor.ruta + '" alt="" /><span class="book-name">' + valor.titulo + '</span><span class="author">by ' + valor.autor + '</span></span></a></div></li>');
                });
            }, "json");
        };

        app.listarClasificaciones = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Clasificacion";
            datos.seccion = "portal";
            $.post(url, datos, function (data) {
                console.log(data);
                $.each(data, function (clave, valor) {
                    $("#clasif").append('<li><a href="#">' + valor.text + '</a></li>');
                })

            }, "json");
        };

        app.listarCaracteristicas = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Caracteristica";
            datos.seccion = "portal";
            $.post(url, datos, function (data) {
                console.log(data);
                $.each(data, function (clave, valor) {
                    $("#caract").append('<li><a href="#">' + valor.text + '</a></li>');
                })

            }, "json");
        };

        app.init();

    })(TallerAvanzada);


});

