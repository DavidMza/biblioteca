$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var tabla = new Tabla("aca",["Denominacion"],"Caracteristica");
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a href="log/logCaracteristica.html"> Ver Log de Caracteristicas</a>');
            }
            tabla.crearTabla();
            
            app.bindings();
        };

        app.bindings = function () {

            $("#guardar").on("click", function (event) {
                tabla.accion();
            });
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaCaracteristica").html();//recupero el html del la tablaCaracteristica
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val('<table border="1">'+aux+'</table>');
            $("#formImprimir").attr("action", locacion+"controladores/Imprimir.php");
            $("#formImprimir").submit();//imprimo
        };

        app.limpiarModal = function () {    //funcion para limpiar los textbox del modal
            $("#id").val(0);
            $("#index").val(-1);
            $("#nombre").val('');
        };

        app.init();

    })(TallerAvanzada);


});
