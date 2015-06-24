$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosLogAutores;
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
            var aux = $("#tablaLogAutor").html();//recupero el html del la tablaAutor
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val('<table border="1">'+aux+'</table>');
            $("#formImprimir").attr("action", locacion + "controladores/Imprimir.php");
            $("#formImprimir").submit();//imprimo
        };

        app.listar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.accion = "listarLogs";
            datos.formulario = "Autor";
            datos.seccion = "gestor";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    datosLogAutores = data;
                    app.rellenarTabla(data);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.rellenarTabla = function (data) {
            $('#tablaLogAutor').dataTable().fnDestroy();
            datosLogAutores = $('#tablaLogAutor').dataTable({
                data: data,
                "columns": [
                    {"data": "fecha"},
                    {"data": "hora"},
                    {"data": "autor"},
                    {"data": "usuario"},
                    {"data": "accion"}
                ]
            }).api();
        };

        app.init();

    })(TallerAvanzada);


});
