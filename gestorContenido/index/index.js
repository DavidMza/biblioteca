$(function() {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function(app) {

        app.init = function() {
            if (!sessionStorage.usuario && !sessionStorage.value) {
                window.location = "../login/login.html";
            }
            if (sessionStorage.value == '2') {
                $("#liUsuario").html('<a id="refUsuario"><i class="fa fa-user fa-3x"></i> Usuarios</a>');
            }
            app.bindings();
            app.mostrarInfo();
            $("#nombre_usuario").html(sessionStorage.usuario);
        };

        app.mostrarInfo = function() {
            app.mostrarTotalLibrosCargados();
            app.mostrarTotalAutoresCargados();
            app.mostrarTotalEditorialesCargadas();
        };

        app.bindings = function() {
            $("#optimizar").click(function(event) {
                var url = locacion + "controladores/Ruteador.php";
                var datos = {};
                datos.accion = "limpiarFotos";
                datos.formulario = "Foto";
                datos.seccion = "gestor";
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: datos,
                    success: function(data) {
                        alert(data + " Archivos basuras limpiados");
                    },
                    error: function(data) {
                        alert(data.responseText);
                    }
                });
            });
            $("#logout-button").click(function(event) {
                app.logout();
            });
            $("#refLibro").on('click', function(event) {
                $("#contenido").load('../libro/libro.html #contenido');
                //$.getScript("../../recursos/datatable/jquery.dataTables.min.js");
                $.getScript("../libro/libro.js");
                
            });
            $("#refAutor").on('click', function(event) {
                $("#contenido").load('../autor/autor.html #contenido');
                $.getScript("../autor/autor.js");
            });
            $("#refEditorial").on('click', function(event) {
                $("#contenido").load('../editorial/editorial.html #contenido');
                $.getScript("../editorial/editorial.js");
            });
            $("#refUsuario").on('click', function(event) {
                $("#contenido").load('../usuario/usuario.html #contenido');
                $.getScript("../usuario/usuario.js");
                $.getScript("../../recursos/md5/md5.js");
            });
            $("#refClasificacion").on('click', function(event) {
                $("#contenido").load('../clasificacion/clasificacion.html #contenido');
                $.getScript("../clasificacion/clasificacion.js");
                $.getScript("../../recursos/jsTree/jstree.min.js");
            });
            $("#refCaracteristica").on('click', function(event) {
                $("#contenido").load('../caracteristica/caracteristica.html #contenido');
                $.getScript("../caracteristica/caracteristica.js");
            });

            $("#btcambiar").on('click', function(event) {
                app.comprobarClaves();
            });

        };

        app.mostrarTotalEditorialesCargadas = function() {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Editorial";
            datos.accion = "contarAutoresCargados";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function(data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data.cantTotal + " editoriales";
                    $("#cantEditoriales").text(texto);
                    //Cantidad x usuario
                    texto = "Has cargado " + data.cantXusu + " editoriales";
                    $("#cantEditorialesUsu").text(texto);
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };
        
        app.mostrarTotalAutoresCargados = function() {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Autor";
            datos.accion = "contarAutoresCargados";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function(data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data.cantTotal + " autores";
                    $("#cantAutores").text(texto);
                    //Cantidad x usuario
                    texto = "Has cargado " + data.cantXusu + " autores";
                    $("#cantAutoresUsu").text(texto);
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };

        app.mostrarTotalLibrosCargados = function() {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Libro";
            datos.accion = "contarLibrosCargados";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function(data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data.cantTotal + " libros";
                    $("#cantLibros").text(texto);
                    //Cantidad x usuario
                    texto = "Has cargado " + data.cantXusu + " libros";
                    $("#cantiLibrosUsu").text(texto);
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };
        app.logout = function() {
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
                success: function(data) {
                    sessionStorage.clear();
                    window.location = "../login/login.html";
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };

        app.cambiar = function(pass) {

            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Usuario";
            datos.accion = "cambiarPass";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            datos.clave = $.md5(pass);
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function(data) {
                    alert("Tu contraseña ha sido cambiada con éxito");
                    window.location = "../index/";
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };

        app.comprobarClaves = function() {
            alert("entro");
            var pass1 = $("#password1").val();
            var pass2 = $("#password2").val();
            if (pass1 == pass2) {
                if (pass1.length > 0) {
                    app.cambiar(pass1);
                } else {
                    alert("No has llenado los campos");
                }

            } else {
                alert("Las claves no coinciden");
            }
        };
        app.init();
    })(TallerAvanzada);
});
