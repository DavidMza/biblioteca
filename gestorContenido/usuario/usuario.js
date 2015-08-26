$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var tabla = new Tabla("aca",["Nombre","Usuario"],"Usuario");
        app.init = function () {
            $("#liuser")[0].className = "active-menu";
            tabla.crearTabla();
            
            app.bindings();
        };

        app.bindings = function () {

            $("#guardar").on("click", function (event) {
                tabla.accion();
            });
        };

        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaUsuario").html();//recupero el html del la tablaUsuario
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
