$(function () {
    var TallerAvanzada = {};

    (function (app) {
        var tabla = new Tabla("aca",["Fecha","Hora","Caracteristica","Usuario","Accion"],"LogCaracteristicas",false);
        app.init = function () {
            tabla.crearCabeceraTabla();
            tabla.listar();
            
            app.bindings();
        };

        app.bindings = function () {
            
        };

        app.init();

    })(TallerAvanzada);


});
