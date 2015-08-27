$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
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
            
            $(".optimizar").click(function (event) {
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
            
            /*$("#optimizar").click(function (event) {
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
            });*/
            
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

        app.init();

    })(TallerAvanzada);
});
