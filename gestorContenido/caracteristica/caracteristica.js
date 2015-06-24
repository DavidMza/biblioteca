$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosCaracteristicas;
        app.init = function () {
            app.listar();
            app.bindings();
        };

        app.bindings = function () {
            $("#agregarCaracteristica").on('click', function (event) {
                app.limpiarModal();
                $("#id").val(0);
                $("#tituloModal").html("Agregar Nueva Caracteristica");
                $("#modalCaracteristica").modal({show: true});
            });
            
            $("#listarTodo").on('click', function (event) {
                app.listar();
            });

            $("#imprimir").on('click', function (event) {
                app.imprimir();
            });

            $('#tablaCaracteristica tbody').on('click', 'tr', function () {
                app.limpiarModal();
                var data = datosCaracteristicas.row(this).data();
                $('#id').val(data.id_caracteristicas);
                $('#index').val(datosCaracteristicas.row(this).index());
                $("#nombre").val(data.denominacion_caracteristica);
                $("#tituloModal").html("Editar Caracteristica");
                $("#modalCaracteristica").modal({show: true});
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

            $("#formCaracteristica").bootstrapValidator({
                excluded: [],
            });
        };
        
        app.eliminar = function (id) {    //funcion para eliminar
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "eliminar";
            datos.formulario = "Caracteristica";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalCaracteristica").modal('hide');
                    app.borrarFila($("#index").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };
        
        app.borrarFila = function (index) {
            $("#cuerpoTablaCaracteristica").children('tr')[index].remove();
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaCaracteristica").html();//recupero el html del la tablaCaracteristica
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirCaracteristica").attr("action", locacion+"controladores/Imprimir.php");
            $("#imprimirCaracteristica").submit();//imprimo
        };

        app.guardar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.nombre = $("#nombre").val();
            datos.accion = "agregar";
            datos.formulario = "Caracteristica";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            //console.log(datos);
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $("#modalCaracteristica").modal('hide');
                    app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.modificar = function () {
            var url = locacion+"controladores/Ruteador.php";
            //var datos = $("#formCaracteristica").serialize();
            var datos = {};
            datos.id = $("#id").val();
            datos.nombre = $("#nombre").val();
            datos.accion = "modificar";
            datos.formulario = "Caracteristica";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalCaracteristica").modal('hide');
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
            datos.formulario = "Caracteristica";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosCaracteristicas = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            console.log(data);
            $('#tablaCaracteristica').dataTable().fnDestroy();
            datosCaracteristicas = $('#tablaCaracteristica').dataTable({
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

        app.actualizarTabla = function (idCaracteristica, id) {
            if (id == 0) { //ES guardar
                $('#tablaCaracteristica').DataTable().row.add({
                    "id_caracteristicas": idCaracteristica,
                    "denominacion_caracteristica": $("#nombre").val(),
                }).draw();
            } else {    //Es Modificar
                datosCaracteristicas.row($("#index").val()).data({
                    "id_caracteristicas": id,
                    "denominacion_caracteristica": $("#nombre").val(),
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
