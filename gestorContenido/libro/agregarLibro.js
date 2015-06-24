$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var autores;
        var editoriales;
        var clasif = [];
        app.init = function () {
            app.cargarFormulario();
            app.bindings();
            if (sessionStorage.aux != null) {
                $('#tituloModal').html("Editar Libro");
                var libro = JSON.parse(sessionStorage.aux);
                sessionStorage.removeItem("aux");
                $("#id").val(libro.id);
                $("#titulo").val(libro.titulo);
                $("#isbn").val(libro.isbn);
                $("#pag").val(libro.paginas);
                $("#publi").val(libro.publicacion);
                $("#autor").val(libro.autor);
                $("#hiddenAutor").val(libro.hidAutor);
                $("#editorial").val(libro.editorial);
                $("#hiddenEditorial").val(libro.hidEditorial);
                $("#idioma").val(libro.idioma);
                if (libro.destacado == "0") {
                    $("#destacado").prop('checked', false);
                } else {
                    $("#destacado").prop('checked', true);
                }
                if (libro.disponible == "0") {
                    $("#disponible").prop('checked', false);
                } else {
                    $("#disponible").prop('checked', true);
                }
                console.log(libro);
            }
        };

        app.bindings = function () {

            $("#refLog").on('click', function (event) {
                $("#contenido").load('../libro/log/logLibro.html #contenido');
                $.getScript("../libro/log/logLibro.js");
            });

            $("#guardar").on("click", function (event) {
                //event.preventDefault();
                if ($("#id").val() == 0) {
                    app.guardar();
                } else {
                    app.modificar();
                }
            });

            $("#arbol").bind("select_node.jstree", function (e, data) {
                if (data.node.id != '1') {
                    if (clasif.indexOf(data.node.id) == -1) {
                        clasif.push(data.node.id);
                        $("#clasif").append("<label>" + data.node.text + "</label><br>");
                        console.log(clasif);
                    }
                }
            });

            $("#btnLimpiarClasif").on("click", function (event) {
                clasif = [];
                $("#clasif").html("");
            });

            $("#btnEliminar").on("click", function (event) {
                app.eliminar($("#id").val());
            });

            $("#formLibro").bootstrapValidator({
                excluded: [],
            });
        };

        app.cargarFormulario = function () {
            app.autocompletarAutor();
            app.autocompletarEditorial();
            app.listarClasificaciones();
            app.listarCaracteristicas();
        };

        app.listarCaracteristicas = function () {
            var datosCaracteristicas = null;
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Caracteristica";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosCaracteristicas = data;
                    console.log(datosCaracteristicas);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            var data = datosCaracteristicas;

            $('#tablaCaract').dataTable().fnDestroy();
            datosCaracteristicas = $('#tablaCaract').dataTable({
                data: data,
                "columns": [
                    {"data": "id_caracteristicas"},
                    {"data": "denominacion_caracteristica"}
                ],
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    }
                ]
            }).api();
        };

        app.listarClasificaciones = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Clasificacion";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    app.ArmarArbol(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.ArmarArbol = function (data) {
            $('#arbol').jstree({'core': {
                    'data': data
                }});
            $("#arbol").jstree('open_all');
        };

        app.autocompletarAutor = function () {
            autores = new Array();
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $.each(data, function (clave, autor) {
                        autores.push({id: autor.id_autor, label: autor.nombre_autor, value: autor.nombre_autor});
                    });
                }
            });
            $("#autor").autocomplete({
                source: autores,
                autoFocus: true,
                minLength: 2,
                select: function (event, ui) {
                    //console.log(ui);
                    $("#autor").val(ui.item.value);
                    $("#hiddenAutor").val(ui.item.id);
                }
            });
        };

        app.autocompletarEditorial = function () {
            editoriales = new Array();
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Editorial";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $.each(data, function (clave, editorial) {
                        editoriales.push({id: editorial.id_editorial, label: editorial.nombre_editorial, value: editorial.nombre_editorial});
                    });
                }
            });
            $("#editorial").autocomplete({
                source: editoriales,
                autoFocus: true,
                minLength: 2,
                select: function (event, ui) {
                    $("#editorial").val(ui.item.value);
                    $("#hiddenEditorial").val(ui.item.id);
                }
            });
        };

        app.eliminar = function (id) {    //funcion para eliminar
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.id = $("#id").val();
            datos.accion = "eliminar";
            datos.formulario = "Libro";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {

                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };


        app.guardar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            //datos.form = $("#formLibro").serialize();
            datos.titulo = $("#titulo").val();
            datos.isbn = $("#isbn").val();
            datos.paginas = $("#pag").val();
            datos.publicacion = $("#publi").val();
            datos.autor = $("#hiddenAutor").val();
            datos.editorial = $("#hiddenEditorial").val();
            datos.idioma = $("#idioma").val();
            datos.disponible = $("#disponible").prop('checked');
            datos.destacado = $("#destacado").prop('checked');

            datos.accion = "agregar";
            datos.formulario = "Libro";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            //console.log(datos);
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    console.log(data);
                    //app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.modificar = function () {
            var url = locacion + "controladores/Ruteador.php";
            //var datos = $("#formLibro").serialize();
            var datos = {};
            datos.id = $("#id").val();
            datos.titulo = $("#titulo").val();
            datos.isbn = $("#isbn").val();
            datos.paginas = $("#pag").val();
            datos.publicacion = $("#publi").val();
            datos.autor = $("#hiddenAutor").val();
            datos.editorial = $("#hiddenEditorial").val();
            datos.idioma = $("#idioma").val();
            datos.disponible = $("#disponible").prop('checked');
            datos.destacado = $("#destacado").prop('checked');

            datos.accion = "modificar";
            datos.formulario = "Libro";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {

                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.limpiarModal = function () {    //funcion para limpiar los textbox del modal
            $("#id").val(0);
            $("#index").val(-1);
            $("#nombre").val('');
        };

        app.init();

    })(TallerAvanzada);


});
