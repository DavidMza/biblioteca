$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {

        app.init = function () {
            if (!sessionStorage.usuario && !sessionStorage.value) {
                window.location = "../login/login.html";
            }
            if (sessionStorage.value == '2') {
                $("#liUsuario").html('<a id="refUsuario"><i class="fa fa-user fa-3x"></i> Usuarios</a>');
            }
            app.bindings();


            $("#nombre_usuario").html(sessionStorage.usuario);

        };

        app.bindings = function () {
            $("#logout-button").click(function (event) {
                app.logout();
            });
            $("#refLibro").on('click', function (event) {
                $("#contenido").load('../libro/libro.html #contenido');
                $.getScript("../libro/libro.js");
            });
            $("#refAutor").on('click', function (event) {
                $("#contenido").load('../autor/autor.html #contenido');
                $.getScript("../autor/autor.js");
            });
            $("#refEditorial").on('click', function (event) {
                $("#contenido").load('../editorial/editorial.html #contenido');
                $.getScript("../editorial/editorial.js");
            });
            $("#refUsuario").on('click', function (event) {
                $("#contenido").load('../usuario/usuario.html #contenido');
                $.getScript("../usuario/usuario.js");
                $.getScript("../../recursos/md5/md5.js");
            });
            $("#refClasificacion").on('click', function (event) {
                $("#contenido").load('../clasificacion/clasificacion.html #contenido');
                $.getScript("../clasificacion/clasificacion.js");
                $.getScript("../../recursos/jsTree/jstree.min.js");
            });
            $("#refImagen").on('click', function (event) {
                $("#contenido").load('../imagenes/imagen.html #contenido');
                $.getScript("../imagenes/imagen2.js");
                
            });
            $("#refCaracteristica").on('click', function (event) {
                $("#contenido").load('../caracteristica/caracteristica.html #contenido');
                $.getScript("../caracteristica/caracteristica.js");
            });
            
            
        };

        app.logout = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Login";
            datos.accion = "logout";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    sessionStorage.clear();
                    window.location = "../login/login.html";
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.init();

    })(TallerAvanzada);


});
