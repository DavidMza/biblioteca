$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    var nopaso = true;
    (function (app) {

        app.init = function () {
            app.recuperarContactos();
            app.bindings();
            app.mostrarInfo();
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
                    $.each(data, function (clave, valor) {
                        var html = '<tr><td><h4>' + valor.nombre + '</h4></td><td><h4>' + valor.mensaje + '</h4></td><td><a class="responder" data-id="' + valor.id_consultas + '" href="mailto:' + valor.email + '"><h4><i class="fa fa-envelope-o"></i>Responder</h4></a></td></tr>';
                        $("#contactos").append(html);
                    });
                    app.bindings();
                },
                error: function (data) {
                    console.log(data);
                    //alert(data.responseText);
                    //swal("Error!", data.responseText, "error");
                    //sessionStorage.aux = JSON.stringify(data.responseText);
                    //window.location = "../error/error.html";
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
                        console.log(data);
                        //alert(data.responseText);
                        //swal("Error!", data.responseText, "error");
                        //sessionStorage.aux = JSON.stringify(data.responseText);
                        //window.location = "../error/error.html";
                    }
                });
            });

            $(".optimizador").click(function (event) {
                if (nopaso) {
                    nopaso = false;
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
                            //alert(data + " Archivos basuras limpiados");
                            swal("Felicidades!", data + " Archivos basuras limpiados", "success");
                            nopaso = true;
                        },
                        error: function (data) {
                            console.log(data);
                            //alert(data.responseText);
                            //sessionStorage.aux = JSON.stringify(data.responseText);
                            //window.location = "../error/error.html";
                            //swal("Error!", data.responseText, "error");
                            nopaso = true;
                        }
                    });
                }
            });

        };

        app.mostrarTotalEditorialesCargadas = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Editorial";
            datos.accion = "contarEditorialesCargadas";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    //console.log(data);
                    //Cantidad general
                    var texto = data + " editoriales";
                    $("#cantEditoriales").text(texto);
                    //Cantidad x usuario
                    //texto = "Has cargado " + data.cantXusu + " editoriales";
                    //$("#cantEditorialesUsu").text(texto);
                },
                error: function (data) {
                    console.log(data);
                    //alert(data.responseText);
                    //swal("Error!", data.responseText, "error");
                    //sessionStorage.aux = JSON.stringify(data.responseText);
                    //window.location = "../error/error.html";
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
                    var texto = data + " autores";
                    $("#cantAutores").text(texto);
                    //Cantidad x usuario
                    //texto = "Has cargado " + data.cantXusu + " autores";
                    //$("#cantAutoresUsu").text(texto);
                },
                error: function (data) {
                    console.log(data);
                    //alert(data.responseText);
                    //swal("Error!", data.responseText, "error");
                    //sessionStorage.aux = JSON.stringify(data.responseText);
                    //window.location = "../error/error.html";
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
                    var texto = data + " libros";
                    $("#cantLibros").text(texto);
                    //Cantidad x usuario
                    //texto = "Has cargado " + data.cantXusu + " libros";
                    //$("#cantiLibrosUsu").text(texto);
                },
                error: function (data) {
                    console.log(data);
                    //alert(data.responseText);
                    //swal("Error!", data.responseText, "error");
                    //sessionStorage.aux = JSON.stringify(data.responseText);
                    //window.location = "../error/error.html";
                }
            });
        };

        app.init();

    })(TallerAvanzada);
});
