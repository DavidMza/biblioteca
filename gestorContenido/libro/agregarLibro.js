$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var autores;
        var editoriales;
        var caracteristicas;
        var clasif = [];
        var caract = [];
        var fotos = [];
        var libro;
        app.init = function () {
            var datosCombo = {};
            
            app.bindings();
            if (sessionStorage.aux != null) {
                $('#tituloModal').html("Editar Libro");
                libro = JSON.parse(sessionStorage.aux);
                sessionStorage.removeItem("aux");
                $("#id").val(libro.id);
                $("#titulo").val(libro.titulo);
                $("#isbn").val(libro.isbn);
                $("#pag").val(libro.paginas);
                
                datosCombo.idioma = libro.idioma;
                datosCombo.autor = libro.hidAutor;
                datosCombo.editorial = libro.hidEditorial;
                datosCombo.publicacion = libro.publicacion;
                //app.cargarFormulario(datosCombo);
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
                //app.recuperarCaracteristicas(libro.id);
                //app.recuperarClasificaciones(libro.id);
                //console.log(libro);
            }
            app.cargarFormulario(datosCombo);
        };

        app.recuperarClasificaciones = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "buscar";
            datos.formulario = "Clasificacion";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {

                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.bindings = function () {

            $("input:file").change(function () {
                app.limpiarFotos();
                var arch = $(this)[0].files[0];
                var div = $("#canvasFoto")[0];
                //$(div).html("");
                var canvas = document.createElement('canvas');
                canvas.width = 199;
                canvas.height = 299;
                var contexto = canvas.getContext('2d');
                var url = URL.createObjectURL(arch);
                var img = new Image();
                img.onload = function () {
                    canvas.width = img.width;
                    canvas.height = img.height;
                    contexto.drawImage(img, 0, 0, img.width, img.height);
                };
                img.src = url;
                div.appendChild(canvas);
                /*console.log(canvas.width);
                 if (canvas.width <= 200 && canvas.width >= 100) {
                 if (canvas.height <= 300 && canvas.height >= 200) {
                 div.appendChild(canvas);
                 } else {
                 alert("alto de la imagen esta mal");
                 }
                 } else {
                 alert("ancho de la imagen esta mal");
                 }*/
                //var data = canvas.toDataURL().split('base64,')[1];
                //fotos.push(data);
                //console.log(data);
                //app.mostrarVistaPrevia();
            });

            $("#refLog").on('click', function (event) {
                $("#contenido").load('../libro/log/logLibro.html #contenido');
                $.getScript("../libro/log/logLibro.js");
            });

            $('#tablaCaract tbody').on('click', 'tr', function () {
                var data = caracteristicas.row(this).data();
                if (caract.indexOf(data.id_caracteristicas) == -1) {
                    caract.push(data.id_caracteristicas);
                    $("#caract").append("<label>" + data.denominacion_caracteristica + "</label><br>");
                    console.log(caract);
                }
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

            $("#btnLimpiarCaract").on("click", function (event) {
                caract = [];
                $("#caract").html("");
            });

            $("#btnEliminar").on("click", function (event) {
                app.eliminar($("#id").val());
            });

            $("#formLibro").bootstrapValidator({
                excluded: [],
            });
        };

        app.limpiarFotos = function () {
            var div = $("#canvasFoto")[0];
            $(div).html("");
        };

        app.cargarFormulario = function (datoSelected) {

            app.comboPublicacion(datoSelected.publicacion);
            app.comboAutor(datoSelected.autor);
            app.comboEditorial(datoSelected.editorial);
            app.comboIdioma(datoSelected.idioma);
            app.listarClasificaciones();
            app.listarCaracteristicas();
        };

        app.comboPublicacion = function (publicacionSelected) {
            var inicio = 1800;
            var fin = 2015;
            var html = "";

            for (; inicio < fin; inicio++) {
                if (publicacionSelected == inicio)
                    html += '<option selected value="' + inicio + '">' + inicio + '</option>';
                else
                    html += '<option value="' + inicio + '">' + inicio + '</option>';
            }
            $("#publi").html(html);
        };

        app.comboIdioma = function (idiomaSelected) {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "Idioma";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    var inicio = 0;
                    var fin = data.length;
                    var html = "";
                    for (; inicio < fin; inicio++) {
                        if (idiomaSelected == data[inicio].nombre)
                            html += '<option selected value="' + data[inicio].id_idioma + '">' + data[inicio].nombre + '</option>';
                        else
                            html += '<option value="' + data[inicio].id_idioma + '">' + data[inicio].nombre + '</option>';

                    }
                    $("#idioma").html(html);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.listarCaracteristicas = function () {
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
                    app.cargarTablaCaract(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });

        };

        app.cargarTablaCaract = function (data) {
            $('#tablaCaract').dataTable().fnDestroy();
            caracteristicas = $('#tablaCaract').dataTable({
                scrollY: "150px",
                searching: false,
                scrollCollapse: true,
                paging: false,
                jQueryUI: true,
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

        app.comboAutor = function (autorSelected) {
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
                    var inicio = 0;
                    var fin = data.length;
                    var html = "";
                    for (; inicio < fin; inicio++) {
                        if (autorSelected == data[inicio].id_autor)
                            html += '<option selected value="' + data[inicio].id_autor + '">' + data[inicio].nombre_autor + '</option>';
                        else
                            html += '<option value="' + data[inicio].id_autor + '">' + data[inicio].nombre_autor + '</option>';

                    }
                    $("#autor").html(html);
                }
            });
        };

        app.comboEditorial = function (editorialSelected) {
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
                    var inicio = 0;
                    var fin = data.length;
                    var html = "";
                    for (; inicio < fin; inicio++) {
                        if (editorialSelected == data[inicio].id_editorial)
                            html += '<option selected value="' + data[inicio].id_editorial + '">' + data[inicio].nombre_editorial + '</option>';
                        else
                            html += '<option value="' + data[inicio].id_editorial + '">' + data[inicio].nombre_editorial + '</option>';

                    }
                    $("#editorial").html(html);
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
            datos.autor = $("#autor").val();
            datos.editorial = $("#editorial").val();
            datos.idioma = $("#idioma").val();
            datos.disponible = $("#disponible").prop('checked');
            datos.destacado = $("#destacado").prop('checked');

            datos.clasificaciones = clasif;
            datos.caracteristicas = caract;
            fotos.push($("canvas")[0].toDataURL().split('base64,')[1]);
            datos.fotos = fotos;
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
