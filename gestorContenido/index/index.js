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
            app.recuperarContactos();
            app.bindings();
            app.mostrarInfo();
            $("#nombre_usuario").html('<i class="fa fa-user"></i>' + sessionStorage.usuario + '');
        };

        app.mostrarInfo = function () {
            app.mostrarTotalLibrosCargados();
            app.mostrarTotalAutoresCargados();
            app.mostrarTotalEditorialesCargadas();
        };

        app.recuperarContactos = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Contacto";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $.each(data,function(clave,valor){
                        var html = '<tr><td><h4>'+valor.nombre+'</h4></td><td><h4>'+valor.mensaje+'</h4></td><td><a class="responder" data-id="'+valor.id_consultas+'" href="mailto:'+valor.email+'"><h4><i class="fa fa-envelope-o"></i>Responder</h4></a></td></tr>';
                        $("#contactos").append(html);
                    });
                    app.bindings();
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.bindings = function () {
            $(".responder").click(function (event) {
                var url = locacion + "controladores/Ruteador.php";
                var datos = {};
                datos.accion = "eliminar";
                datos.formulario = "Contacto";
                datos.seccion = "gestor";
                datos.id = $(this).data("id");
                var contacto = $(this)[0];
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: datos,
                    success: function (data) {
                        $("#contactos").find("a[data-id='" + datos.id + "']").parent().parent().remove();
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            });
            $("#optimizar").click(function (event) {
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
                    success: function (data) {
                        alert(data + " Archivos basuras limpiados");
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            });
            $("#logout-button").click(function (event) {
                app.logout();
            });
            $("#refLibro").on('click', function (event) {
                $("#contenido").load('../libro/libro.html #contenido');
                //$.getScript("../../recursos/datatable/jquery.dataTables.min.js");
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
            $("#refCaracteristica").on('click', function (event) {
                $("#contenido").load('../caracteristica/caracteristica.html #contenido');
                $.getScript("../caracteristica/caracteristica.js");
            });
            $("#btcambiar").on('click', function (event) {
                app.comprobarClaves();
            });
            $("#cambiarPassword").on('click', function (event) {
                $("#modalCambiarPass").modal({show: true});
            });
        };

        app.mostrarTotalEditorialesCargadas = function () {
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
                success: function (data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data.cantTotal + " editoriales";
                    $("#cantEditoriales").text(texto);
                    //Cantidad x usuario
                    texto = "Has cargado " + data.cantXusu + " editoriales";
                    $("#cantEditorialesUsu").text(texto);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.mostrarTotalAutoresCargados = function () {
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
                success: function (data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data.cantTotal + " autores";
                    $("#cantAutores").text(texto);
                    //Cantidad x usuario
                    texto = "Has cargado " + data.cantXusu + " autores";
                    $("#cantAutoresUsu").text(texto);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.mostrarTotalLibrosCargados = function () {
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
                success: function (data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data.cantTotal + " libros";
                    $("#cantLibros").text(texto);
                    //Cantidad x usuario
                    texto = "Has cargado " + data.cantXusu + " libros";
                    $("#cantiLibrosUsu").text(texto);
                },
                error: function (data) {
                    alert(data.responseText);
                }
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

        app.cambiar = function (passwordActual, pass) {

            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Usuario";
            datos.accion = "cambiarPass";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            datos.claveActual = $.md5(passwordActual);
            datos.claveNueva = $.md5(pass);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    if (data.bandera) {
                        //alert(data.retorno);
                        $("#modalCambiarPass").modal('hide');
                        app.limpiarModal();
                        $("#infoCambioPass").modal({show: true});
                        setTimeout(function () {
                            $("#infoCambioPass").modal("hide");
                        }, (2 * 1000));
                    } else {
                        alert(data.retorno);
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.limpiarModal = function (){
            $("#password").val("");
            $("#password1").val("");
            $("#password2").val("");
        };
        
        app.comprobarClaves = function () {
            var passwordActual = $("#password").val();
            var pass1 = $("#password1").val();
            var pass2 = $("#password2").val();
            if (pass1 == pass2) {
                if (pass1.length > 0 && passwordActual.length > 0) {
                    app.cambiar(passwordActual, pass1);
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
