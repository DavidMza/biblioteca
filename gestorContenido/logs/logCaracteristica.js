$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosLogsCaracteristicas;
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
            var aux = $("#tablaCaracteristica").html();//recupero el html del la tablaCaracteristica
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirCaracteristica").attr("action", locacion+"controladores/Imprimir.php");
            $("#imprimirCaracteristica").submit(); //imprimo
        };

        app.listar = function () {
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listar";
            datos.formulario = "_LogCaracteristicas";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosLogsCaracteristicas = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaHistorialCaracteristica').dataTable().fnDestroy();
            datosLogsCaracteristicas = $('#tablaHistorialCaracteristica').dataTable({
                data: data,
                "columns": [
                    {"data": "fecha"},
                    {"data": "hora"},
                    {"data": "nombreCaracteristicaAnterior"},
                    {"data": "nombreCaracteristicaNuevo"},
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
