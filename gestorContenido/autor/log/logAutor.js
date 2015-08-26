$(function () {
    var TallerAvanzada = {};

    (function (app) {
        var tabla = new Tabla("aca",["Fecha","Hora","Autor","Usuario","Accion"],"LogAutor",false);
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
