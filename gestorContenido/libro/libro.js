$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosLibros;
        var autores;
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a id="refLog"> Ver Log de Libros</a>');
            }
            app.listar();
            app.bindings();
        };

        app.bindings = function () {

            $("#refLog").on('click', function (event) {
                $("#contenido").load('../libro/log/logLibro.html #contenido');
                $.getScript("../libro/log/logLibro.js");
            });

            $("#agregarLibro").on('click', function (event) {
                $("#cuerpoFormulario").load('../libro/agregarLibro.html #cuerpoFormulario');
                $.getScript("../libro/agregarLibro.js");
            });

            $("#listarTodo").on('click', function (event) {
                app.listar();
            });

            $("#imprimir").on('click', function (event) {
                app.imprimir();
            });

            $('#tablaLibro tbody').on('click', 'tr', function () {
                app.limpiarModal();
                var data = datosLibros.row(this).data();
                sessionStorage.aux = JSON.stringify(data);
                $("#cuerpoFormulario").load('../libro/agregarLibro.html #cuerpoFormulario');
                $.getScript("../libro/agregarLibro.js");
            });

        };

        app.eliminar = function (id) {    //funcion para eliminar
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "eliminar";
            datos.formulario = "Libro";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalLibro").modal('hide');
                    app.borrarFila($("#index").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.borrarFila = function (index) {
            $("#cuerpoTablaLibro").children('tr')[index].remove();
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaLibro").html();//recupero el html del la tablaLibro
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val('<table border="1">' + aux + '</table>');
            $("#formImprimir").attr("action", locacion + "controladores/Imprimir.php");
            $("#formImprimir").submit();//imprimo
        };

        app.listar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            if ($("#listarTodo").prop('checked')) {
                datos.accion = "listarTodo";
            } else {
                datos.accion = "listar";
            }
            datos.formulario = "Libro";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosLibros = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaLibro').dataTable().fnDestroy();
            datosLibros = $('#tablaLibro').dataTable({
                data: data,
                "columns": [
                    {"data": "id"},
                    {"data": "titulo"},
                    {"data": "autor"},
                    {"data": "editorial"},
                    {"data": "disponible"},
                    {"data": "destacado"}
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

        app.actualizarTabla = function (idLibro, id) {
            if (id == 0) { //ES guardar
                $('#tablaLibro').DataTable().row.add({
                    "id_libro": idLibro,
                    "nombre_libro": $("#nombre").val(),
                }).draw();
            } else {    //Es Modificar
                datosLibros.row($("#index").val()).data({
                    "id_libro": id,
                    "nombre_libro": $("#nombre").val(),
                }).draw();
            }
        };

        app.limpiarModal = function () {    //funcion para limpiar los textbox del modal
            $("#id").val(0);
            $("#index").val(-1);
            $("#nombre").val('');
        };

        app.init();

    })(TallerAvanzada);


});
