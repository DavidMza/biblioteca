$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosUsuarios;
        app.init = function () {
            app.listar();
            app.bindings();
        };

        app.bindings = function () {
            
            $("#refLog").on('click', function (event) {
                $("#contenido").load('../usuario/log/logUsuario.html #contenido');
                $.getScript("../usuario/log/logUsuario.js");
            });
            
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
                $("#clave").val('');
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
            
            $("#btnEliminar").on("click", function (event) {
                app.eliminar($("#id").val());
            });

            $("#formUsuario").bootstrapValidator({
                excluded: [],
            });
        };
        
        app.eliminar = function (id) {    //funcion para eliminar
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "eliminar";
            datos.formulario = "Usuario";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalUsuario").modal('hide');
                    app.borrarFila($("#index").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };
        
        app.borrarFila = function (index) {
            $("#cuerpoTablaUsuario").children('tr')[index].remove();
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaUsuario").html();//recupero el html del la tablaUsuario
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val('<table border="1">'+aux+'</table>');
            $("#formImprimir").attr("action", locacion+"controladores/Imprimir.php");
            $("#formImprimir").submit();//imprimo
        };

        app.guardar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            //datos.form = $("#formUsuario").serialize();
            datos.nombre = $("#nombre").val();
            datos.clave = $.md5($("#clave").val());
            datos.accion = "agregar";
            datos.formulario = "Usuario";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            //console.log(datos);
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
            var url = locacion+"controladores/Ruteador.php";
            //var datos = $("#formUsuario").serialize();
            var datos = {};
            datos.id = $("#id").val();
            datos.nombre = $("#nombre").val();
            datos.clave = $.md5($("#clave").val());
            datos.accion = "modificar";
            datos.formulario = "Usuario";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
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
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            if ($("#listarTodo").prop('checked')) {
                datos.accion = "listarTodo";
            }else{
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
                    {"data": "tipo_usuario"}
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

        app.actualizarTabla = function (idUsuario, id) {
            if (id == 0) { //ES guardar
                $('#tablaUsuario').DataTable().row.add({
                    "id_usuario": idUsuario,
                    "nombre_usuario": $("#nombre").val(),
                    "tipo_usuario": 'administrador',
                }).draw();
            } else {    //Es Modificar
                datosUsuarios.row($("#index").val()).data({
                    "id_usuario": id,
                    "nombre_usuario": $("#nombre").val(),
                    "tipo_usuario": 'administrador',
                }).draw();
            }
        };

        app.limpiarModal = function () {    //funcion para limpiar los textbox del modal
            $("#id").val(0);
            $("#index").val(-1);
            $("#nombre").val('');
            $("#clave").val('');
        };

        app.init();

    })(TallerAvanzada);


});
