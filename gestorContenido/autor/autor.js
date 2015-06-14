$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosAutores;
        app.init = function () {
            app.listar();
            app.bindings();
        };

        app.bindings = function () {
            $("#agregarAutor").on('click', function (event) {
                app.limpiarModal();
                $("#id").val(0);
                $("#tituloModal").html("Agregar Nuevo Autor");
                $("#modalAutor").modal({show: true});
            });
            
            $("#listarTodo").on('click', function (event) {
                app.listar();
            });

            $("#imprimir").on('click', function (event) {
                app.imprimir();
            });

            $('#tablaAutor tbody').on('click', 'tr', function () {
                app.limpiarModal();
                var data = datosAutores.row(this).data();
                $('#id').val(data.id_autor);
                $('#index').val(datosAutores.row(this).index());
                $("#nombre").val(data.nombre_autor);
                if (data.oculto == "0") {
                    $("#oculto").prop('checked', false);
                } else {
                    $("#oculto").prop('checked', true);
                }
                $("#tituloModal").html("Editar Autor");
                $("#modalAutor").modal({show: true});
            });

            $("#guardar").on("click", function (event) {
                //event.preventDefault();
                if ($("#id").val() == 0) {
                    app.guardar();
                } else {
                    app.modificar();
                }
            });

            $("#formAutor").bootstrapValidator({
                excluded: [],
            });
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaAutor").html();//recupero el html del la tablaAutor
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirAutor").attr("action", locacion+"controladores/Imprimir.php");
            $("#imprimirAutor").submit();//imprimo
        };

        app.guardar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = $("#formAutor").serialize();
            datos.accion = "agregar";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $("#modalAutor").modal('hide');
                    app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.modificar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = $("#formAutor").serialize();
            datos.accion = "modificar";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalAutor").modal('hide');
                    app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.listar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            if ($("#listarTodo").prop('checked')) {
                datos.accion = "listarTodo";
            }else{
                datos.accion = "listar";
            }
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosAutores = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaAutor').dataTable().fnDestroy();
            datosAutores = $('#tablaAutor').dataTable({
                data: data,
                "columns": [
                    {"data": "id_autor"},
                    {"data": "nombre_autor"}
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

        app.actualizarTabla = function (autor, id) {
            if (id == 0) { //ES guardar
                $('#tablaAutor').DataTable().row.add({
                    "id_autor": autor.id_autor,
                    "nombre_autor": autor.nombre_autor,
                }).draw();
            } else {    //Es Modificar
                datosAutores.row($("#index").val()).data({
                    "id_autor": id,
                    "nombre_autor": $("#nombre").val(),
                }).draw();
            }
        };

        app.limpiarModal = function () {    //funcion para limpiar los textbox del modal
            $("#id").val(0);
            $("#index").val(-1);
            $("#nombre").val('');
            $("#oculto").prop('checked', false);
        };

        app.init();

    })(TallerAvanzada);


});
