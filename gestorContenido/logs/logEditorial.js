$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosLogsEditoriales;
        app.init = function () {
            app.listar();
            app.bindings();
        };

        app.bindings = function () {

            $("#imprimir").on('click', function (event) {
                app.imprimir();
            });

        };
        
        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaEditorial").html();//recupero el html del la tablaEditorial
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirEditorial").attr("action", locacion+"controladores/Imprimir.php");
            $("#imprimirEditorial").submit(); //imprimo
        };

        app.listar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "_LogEditoriales";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosLogsEditoriales = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaEditorial').dataTable().fnDestroy();
            datosLogsEditoriales = $('#tablaEditorial').dataTable({
                data: data,
                "columns": [
                    {"data": "fecha"},
                    {"data": "hora"},
                    {"data": "nombreEditorialAnterior"},
                    {"data": "nombreEditorialNuevo"},
                    {"data": "accion"},
                    {"data": "nombreActual"},
                    {"data": "usuario"}
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

        app.init();

    })(TallerAvanzada);


});
