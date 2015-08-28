$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosAutores;
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a id="refLog"> Ver Log de Autores</a>');
            }
            app.listar();
            app.bindings();
        };

        app.bindings = function () {
            
            $("#refLog").on('click', function (event) {
                $("#contenido").load('../autor/log/logAutor.html #contenido');
                $.getScript("../autor/log/logAutor.js");
            });
            
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
            
            $("#btnEliminar").on("click", function (event) {
                app.eliminar($("#id").val());
            });

            $("#formAutor").bootstrapValidator({
                excluded: [],
            });
        };
        
        app.eliminar = function (id) {    //funcion para eliminar
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "eliminar";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                success: function (data) {
                    $("#modalAutor").modal('hide');
                    app.borrarFila($("#index").val());
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };
        
        app.borrarFila = function (index) {
            $("#cuerpoTablaAutor").children('tr')[index].remove();
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaAutor").html();//recupero el html del la tablaAutor
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#formImprimir").attr("action", locacion+"controladores/Imprimir.php");
            $("#formImprimir").submit();//imprimo
        };

        app.guardar = function () {
            console.log("paso");
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            //datos.form = $("#formAutor").serialize();
            datos.nombre = $("#nombre").val();
            datos.accion = "agregar";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            //console.log(datos);
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
            //var datos = $("#formAutor").serialize();
            var datos = {};
            datos.id = $("#id").val();
            datos.nombre = $("#nombre").val();
            datos.accion = "modificar";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
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

        app.actualizarTabla = function (idAutor, id) {
            if (id == 0) { //ES guardar
                $('#tablaAutor').DataTable().row.add({
                    "id_autor": idAutor,
                    "nombre_autor": $("#nombre").val(),
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
        };

        app.init();

    })(TallerAvanzada);


});
