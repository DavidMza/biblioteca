$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosUsuarios;
        app.init = function () {
            app.listarTiposUsuarios();
            app.listar();
            app.bindings();
        };

        app.bindings = function () {
            $("#agregarUsuario").on('click', function (event) {
                app.limpiarModal();
                $("#id").val(0);
                $("#tituloModal").html("Agregar Nuevo Usuario");
                $("#modalUsuario").modal({show: true});
            });

            $("#listarTodo").on('click', function (event) {
                app.listar();
            });

            $("#imprimir").on('click', function (event) {
                app.imprimir();
            });

            $('#tablaUsuario tbody').on('click', 'tr', function () {
                app.limpiarModal();
                var data = datosUsuarios.row(this).data();
                $('#id').val(data.id_usuario);
                $('#index').val(datosUsuarios.row(this).index());
                $("#nombre").val(data.nombre_usuario);
                if (data.oculto == "0") {
                    $("#oculto").prop('checked', false);
                } else {
                    $("#oculto").prop('checked', true);
                }
                $("#tituloModal").html("Editar Usuario");
                $("#modalUsuario").modal({show: true});
            });

            $("#guardar").on("click", function (event) {
                //event.preventDefault();
                if ($("#id").val() == 0) {
                    app.guardar();
                } else {
                    app.modificar();
                }
            });

            $("#formUsuario").bootstrapValidator({
                excluded: [],
            });
        };

        app.listarTiposUsuarios = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "TiposUsuario";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $('#tipo').empty();
                    $('#tipo').append('<option value=' + 0 + ' >Selecciona un tipo</option>');
                    $.each(data, function (clave, tipo) {
                        $('#tipo').append('<option value=' + tipo.id_tipo_usuario + ' >' + tipo.descripcion_usuario + '</option>');
                    });
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaUsuario").html();//recupero el html del la tablaUsuario
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirUsuario").attr("action", locacion + "controladores/Imprimir.php");
            $("#imprimirUsuario").submit();//imprimo
        };

        app.guardar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = $("#formUsuario").serialize();
            datos.accion = "agregar";
            datos.formulario = "Usuario";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $("#modalUsuario").modal('hide');
                    app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.modificar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = $("#formUsuario").serialize();
            datos.accion = "modificar";
            datos.formulario = "Usuario";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalUsuario").modal('hide');
                    app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.listar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            if ($("#listarTodo").prop('checked')) {
                datos.accion = "listarTodo";
            } else {
                datos.accion = "listar";
            }
            datos.formulario = "Usuario";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosUsuarios = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaUsuario').dataTable().fnDestroy();
            datosUsuarios = $('#tablaUsuario').dataTable({
                data: data,
                "columns": [
                    {"data": "id_usuario"},
                    {"data": "nombre_usuario"},
                    {"data": "descripcion_usuario"}
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

        app.actualizarTabla = function (usuario, id) {
            if (id == 0) { //ES guardar
                $('#tablaUsuario').DataTable().row.add({
                    "id_usuario": usuario.id_usuario,
                    "nombre_usuario": usuario.nombre_usuario,
                    "descripcion_usuario": usuario.descripcion_usuario,
                }).draw();
            } else {    //Es Modificar
                datosUsuarios.row($("#index").val()).data({
                    "id_usuario": id,
                    "nombre_usuario": $("#nombre").val(),
                    "descripcion_usuario": $("#tipo").val(),
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
