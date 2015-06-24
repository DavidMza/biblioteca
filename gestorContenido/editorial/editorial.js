$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosEditoriales;
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a id="refLog"> Ver Log de Editoriales</a>');
            }
            app.listar();
            app.bindings();
        };

        app.bindings = function () {
            
            $("#refLog").on('click', function (event) {
                $("#contenido").load('../editorial/log/logEditorial.html #contenido');
                $.getScript("../editorial/log/logEditorial.js");
            });
            
            $("#agregarEditorial").on('click', function (event) {
                app.limpiarModal();
                $("#id").val(0);
                $("#tituloModal").html("Agregar Nueva Editorial");
                $("#modalEditorial").modal({show: true});
            });
            
            $("#listarTodo").on('click', function (event) {
                app.listar();
            });

            $("#imprimir").on('click', function (event) {
                app.imprimir();
            });

            $('#tablaEditorial tbody').on('click', 'tr', function () {
                app.limpiarModal();
                var data = datosEditoriales.row(this).data();
                $('#id').val(data.id_editorial);
                $('#index').val(datosEditoriales.row(this).index());
                $("#nombre").val(data.nombre_editorial);
                $("#tituloModal").html("Editar Editorial");
                $("#modalEditorial").modal({show: true});
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

            $("#formEditorial").bootstrapValidator({
                excluded: [],
            });
        };
        
        app.eliminar = function (id) {    //funcion para eliminar
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "eliminar";
            datos.formulario = "Editorial";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalEditorial").modal('hide');
                    app.borrarFila($("#index").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };
        
        app.borrarFila = function (index) {
            $("#cuerpoTablaEditorial").children('tr')[index].remove();
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaEditorial").html();//recupero el html del la tablaEditorial
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirEditorial").attr("action", locacion+"controladores/Imprimir.php");
            $("#imprimirEditorial").submit();//imprimo
        };

        app.guardar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.nombre = $("#nombre").val();
            datos.accion = "agregar";
            datos.formulario = "Editorial";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            //console.log(datos);
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    $("#modalEditorial").modal('hide');
                    app.actualizarTabla(data, $("#id").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.modificar = function () {
            var url = locacion+"controladores/Ruteador.php";
            //var datos = $("#formEditorial").serialize();
            var datos = {};
            datos.id = $("#id").val();
            datos.nombre = $("#nombre").val();
            datos.accion = "modificar";
            datos.formulario = "Editorial";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalEditorial").modal('hide');
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
            datos.formulario = "Editorial";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosEditoriales = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaEditorial').dataTable().fnDestroy();
            datosEditoriales = $('#tablaEditorial').dataTable({
                data: data,
                "columns": [
                    {"data": "id_editorial"},
                    {"data": "nombre_editorial"}
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

        app.actualizarTabla = function (idEditorial, id) {
            if (id == 0) { //ES guardar
                $('#tablaEditorial').DataTable().row.add({
                    "id_editorial": idEditorial,
                    "nombre_editorial": $("#nombre").val(),
                }).draw();
            } else {    //Es Modificar
                datosEditoriales.row($("#index").val()).data({
                    "id_editorial": id,
                    "nombre_editorial": $("#nombre").val(),
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
